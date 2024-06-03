<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use App\Models\Analytics;
use App\Models\Pesquisa;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\AnexoController;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class MidiaController extends Controller
{
    public $errorMessage = 'Ocorreu um erro ao registrar';
    protected $markdownRenderer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MarkdownRenderer $markdownRenderer)
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
        try {
            $where = [ ['midia.Status', '=', '1'], ['midia.UserId', '=', auth()->user()->id] ];
            $palavra = Request('buscar') ? Request('buscar') : null;
    
            switch (Request('tipoBusca')) {
                case 1:
                    $whereTipoBusca = [ [ 'midia.Titulo', 'like', '%' . $palavra . '%' ] ];
                    $orWhereTipoBusca = [ [ 'midia.Resenha', 'like', '%' . $palavra . '%' ] ];
                    break;
            }
    
            if ($palavra) {
                
                if (Request('tipoBusca') == 1) {
                    $list = DB::table('midia')
                    ->select('midia.id', 'midia.Titulo', "midia.created_at", 'xxxx')
                    ->where($where)
                    ->where($whereTipoBusca)
                    ->orWhere($orWhereTipoBusca)
                    ->orderBy('midia.created_at', 'desc')
                    ->paginate(10);
                }
                else {
    
                    // $tags = DB::table('tag')->select('id')->where([[ 'tag.Tag', 'LIKE', '%' . $palavra . '%' ]]);
    
                    // $list = DB::table('base_conhecimento')
                    // ->join('base_tag', 'base_conhecimento.id', '=', 'base_tag.BaseId')
                    // ->select('base_conhecimento.id', 'base_conhecimento.Titulo', 'base_conhecimento.created_at', 'base_tag.TagId')
                    // ->where($where)
                    // ->whereIn('base_tag.TagId', $tags)
                    // ->orderBy('base_conhecimento.created_at', 'desc')
                    // ->paginate(10);
                }
    
                Pesquisa::create(['Palavra'=>Request('buscar'), 'Tela'=>'midia']);
    
            } else {
    
                $list = DB::table('midia')
                ->select('id', 'Titulo', 'Data', "created_at")
                ->where($where)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            }
    
            $qtdeRegistros = $list->total();
    
            Paginator::defaultView('pagination::bootstrap-4');
            return view('dashboard.midias.index', compact('list', 'palavra', 'qtdeRegistros'));
        } catch (\Throwable $th) {
            dd($th);    
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {
        try {
            return view('dashboard.midias.novo');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Nova midia.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $entity = $request->all();
            $response = Midia::create($entity);

            if ($response) { 
                if ($request->hasFile('Anexo'))
                    (new AnexoController)->uploadAnexo($request, $response->id);

                $status = true;
                $message = 'Criada com sucesso';
            } 

            return redirect('dashboard/midias/');
        
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->midiaPorId($id);
            $htmlContent = $this->markdownRenderer->toHtml($item->Resenha);
            return view('dashboard.midias.show', compact('item', 'htmlContent'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Midia  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = $this->midiaPorId($id);
            return view('dashboard.midias.edit', compact('item'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // atualizar registro
            $data = $request->all();
            $response = Midia::find($id)->update($data);

            // atualizar tag
            if ($response) { 
                $status = true;
                $message = 'Editado com sucesso';
                (new AnexoController)->uploadAnexo($request, $id);
            } 

            return redirect('dashboard/midias/'.$id)->with(['message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $item = $this->midiaPorId($id);
            return view('dashboard.midias.delete', compact('item'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Midia::where('id', $id)->update(['Status' => '0']);
            return redirect('dashboard/midias')->with('message', 'Deletado com sucesso');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function midiaPorId($id)
    {
        try {
            $item = Midia::
                where([ 
                    ['Status', '=', '1'], 
                    ['UserId', '=', auth()->user()->id], 
                    [ 'id', '=', $id ] ])
                ->firstOrFail();
            $item->Anexo = (new AnexoController)->anexoPorId($item->id);
            return $item;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
