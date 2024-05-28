<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $list = DB::table('post')
        //     ->where('Status', '=', 1)
        //     ->paginate(10);
        // Paginator::defaultView('pagination::bootstrap-4');
        return view('blog-admin.comment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bdb-admin.comment.create');
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
        $response = Comment::create($dados); 
        $status = false;
        $message = 'Ocorreu um erro ao registrar';
        if ($response) { 
            $status = true;
            $message = 'Criada com sucesso';
        } 
        return redirect('bdb-admin/post/'.$dados->PostId)->with(['data'=>response ?? '', 'message'=>$message, 'status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Comment::find($id);
        return view('bdb-admin.comment.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Comment::find($id); 
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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Comment::find($id);
        $postId = $item->PostId;
        $item->delete();
        return redirect('admin/post/edit/'.$postId)->with('message', 'Deletado com sucesso');
    }
}
