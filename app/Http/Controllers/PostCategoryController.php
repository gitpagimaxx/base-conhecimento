<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = DB::table('SELECT * FROM post_category')
            ->where('Status', '=', 1)
            ->paginate(10);
        Paginator::defaultView('pagination::bootstrap-4');
        return view('bdb-admin.post.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->all();
        $response = PostCategory::create($req); 
        $status = false;
        $message = 'Ocorreu um erro ao registrar';
        if ($response) { 
            $status = true;
            $message = 'Registrado com sucesso';
        } 
        return redirect('bdb-admin/post/'.$req->PostId)->with(['data'=>$response ?? '', 'message'=>$message, 'status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        $response = PostCategory::find($id); 
        $response->update($request->all());
        $status = false;
        $message = 'Erro ao editar';
        if ($response) { 
            $status = true;
            $message = 'Editado com sucesso';
        } 
        return redirect('bdb-admin/post/'.$response->PostId)->with(['item'=>$response ?? '', 'message'=>$message, 'status'=>$status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        $item = PostCategory::find($id);
        $postId = $item->PostId;
        $item->delete();
        return redirect('admin/post/'.$postId)->with('message', 'Deletado com sucesso');
    }
}
