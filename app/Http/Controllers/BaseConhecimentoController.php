<?php

namespace App\Http\Controllers;

use App\Models\BaseConhecimento;
use App\Models\BaseCategoria;
use App\Models\BaseTag;
use App\Models\Pesquisa;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Analytics;
use App\Http\CommonFuncs\Common;
use App\Http\Controllers\AnexoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BaseTagController;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class BaseConhecimentoController extends Controller
{
    public $errorMessage = 'Ocorreu um erro ao registrar';
    protected $markdownRenderer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarkdownRenderer $markdownRenderer)
    {
        $this->middleware('auth');
        $this->markdownRenderer = $markdownRenderer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [ ['base_conhecimento.Status', '=', '1'], ['base_conhecimento.UserId', '=', auth()->user()->id] ];
        $palavra = Request('buscar') ? Request('buscar') : null;

        switch (Request('tipoBusca')) {
            case 1:
                $whereTipoBusca = [ [ 'base_conhecimento.Titulo', 'like', '%' . $palavra . '%' ] ];
                $orWhereTipoBusca = [ [ 'base_conhecimento.Detalhamento', 'like', '%' . $palavra . '%' ] ];
                break;
            case 2:
                $whereTipoBusca = [ [ 'tag.Tag', 'like', '%' . $palavra . '%' ] ];
                $orWhereTipoBusca = [ [ 'tag.UrlAmigavel', 'like', '%' . $palavra . '%' ] ];
                break;
        }

        if ($palavra) {
            
            if (Request('tipoBusca') == 1) {
                $list = DB::table('base_conhecimento')
                ->select('base_conhecimento.id', 'base_conhecimento.Titulo', "base_conhecimento.created_at")
                ->where($where)
                ->where($whereTipoBusca)
                ->orWhere($orWhereTipoBusca)
                ->orderBy('base_conhecimento.created_at', 'desc')
                ->paginate(10);
            }
            else {

                $tags = DB::table('tag')->select('id')->where([[ 'tag.Tag', 'LIKE', '%' . $palavra . '%' ]]);

                $list = DB::table('base_conhecimento')
                ->join('base_tag', 'base_conhecimento.id', '=', 'base_tag.BaseId')
                ->select('base_conhecimento.id', 'base_conhecimento.Titulo', "base_conhecimento.created_at")
                ->where($where)
                ->whereIn('base_tag.TagId', $tags)
                ->orderBy('base_conhecimento.created_at', 'desc')
                ->paginate(10);
            }

            Pesquisa::create(['Palavra'=>Request('buscar'), 'Tela'=>'conhecimento']);

        } else {

            $list = DB::table('base_conhecimento')
            ->select('id', 'Titulo', "created_at")
            ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        }

        $qtdeRegistros = $list->total();

        Paginator::defaultView('pagination::bootstrap-4');

        return view('dashboard.baseconhecimento.index', compact('list', 'palavra', 'qtdeRegistros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaTags = (new TagController)->tags();

        return view('dashboard.baseconhecimento.create', compact('listaTags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entidade = $request->all(); 
        $response = BaseConhecimento::create($entidade);

        if ($response) { 

            (new BaseTagController)->associarBaseIdTagId($response->id, $entidade['TagId']);
            (new AnexoController)->uploadAnexo($request, $response->id);
            $status = true;
            $message = 'Criada com sucesso';
        } 

        return redirect('dashboard/conhecimento')->with(['data'=>$response ?? '', 'message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->conhecimentoPorId($id); 
        //$tagsAssociadas = BaseTag::where('BaseId', '=', $id)->get()->baseTags; dd($tagsAssociadas);
        $tagsAssociadas = (new TagController)->tagPorConhecimento($id);
        $anexosPorBaseId = (new AnexoController)->anexoPorBaseId($id);

        $htmlContent = $this->markdownRenderer->toHtml($item[0]->Detalhamento);

        return view('dashboard.baseconhecimento.show', compact('item', 'tagsAssociadas', 'anexosPorBaseId', 'htmlContent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listaTags = (new TagController)->tags();
        $tagsAssociadas = (new TagController)->tagPorConhecimento($id);
        $item = $this->conhecimentoPorId($id);
        return view('dashboard.baseconhecimento.edit', compact('item', 'listaTags', 'tagsAssociadas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // atualizar registro
            $data = $request->all();
            $response = BaseConhecimento::find($id)->update($data);

            // atualizar tag
            if ($response) { 
                $status = true;
                $message = 'Editado com sucesso';

                (new BaseTagController)->associarBaseIdTagId($id, $data['TagId']);
                (new AnexoController)->uploadAnexo($request, $id);
            } 

            return redirect('dashboard/conhecimento/'.$id)->with(['message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);
        
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $item = $this->conhecimentoPorId($id);
            return view('dashboard.baseconhecimento.delete', compact('item'));

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            BaseConhecimento::where('id', $id)->update(['Status' => '0']);
            return redirect('dashboard/conhecimento')->with('message', 'Deletado com sucesso');

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function anexo($id)
    {
        try {
            $item = (new AnexoController)->anexoPorId($id); 
            return view('dashboard.baseconhecimento.delete-anexo', compact('item'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Excluir anexo 
     */
    public function deleteAnexo($id, $baseId)
    {
        try {
            (new AnexoController)->deleteAnexo($id, $baseId);
            return redirect('dashboard/conhecimento/'.$baseId)->with('message', 'Deletado com sucesso');

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function conhecimentoPorId($id)
    {
        try {
            return BaseConhecimento::where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id], [ 'id', '=', $id ] ])->get();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
