<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public $errorMessage = 'Ocorreu um erro ao registrar';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $list = DB::table('tag')
            ->select('tag.id', 'tag.Tag', 'tag.UrlAmigavel', "tag.created_at")
            ->where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id] ])
            ->orderBy('tag.created_at', 'desc')
            ->paginate(10);
        
            $qtdeRegistros = $list->total();

            Paginator::defaultView('pagination::bootstrap-4');

            return view('dashboard.tag.index', compact('list', 'qtdeRegistros'));

        } catch (\Throwable $th) {
            dd($th);
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['UrlAmigavel'] = Str::slug($dados['Tag'], '-');
        $response = Tag::create($dados); 

        if ($response) { 
            $status = true;
            $message = 'Criada com sucesso';
        } 
        return redirect('dashboard/tag')->with(['data'=>$response ?? '', 'message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Tag::find($id);
        return view('dashboard.tag.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $response = Tag::find($id); 
        $response['UrlAmigavel'] = Str::slug($dataForm['Tag'], '-');
        $response->update($dataForm);
        
        if ($response) { 
            $status = true;
            $message = 'Editado com sucesso';
        } 
        return redirect('dashboard/tag')->with(['item'=>$response ?? '', 'message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = Tag::find($id);
        return view('dashboard.tag.delete', compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Tag::find($id);
        $item->delete();
        return redirect('dashboard/tag')->with('message', 'Deletado com sucesso');
    }

    public function tags()
    {
        try {
            return DB::table('tag')
            ->selectRaw('id, Tag, UrlAmigavel, created_at')
            ->where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id] ])
            ->orderBy('Tag', 'asc')->get();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function tagPorConhecimento($BaseId)
    {
        try {
            return DB::table('tag')
            ->join('base_tag', 'tag.id', '=', 'base_tag.TagId')
            ->selectRaw('tag.id, tag.Tag, tag.UrlAmigavel, tag.created_at')
            ->where([ ['base_tag.Status', '=', true], ['base_tag.BaseId', '=', $BaseId] ])
            ->orderBy('created_at', 'desc')->get();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
