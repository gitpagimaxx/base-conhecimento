<?php

namespace App\Http\Controllers;

use App\Models\Memorias;
use App\Models\Pesquisa;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Analytics;
use App\Http\CommonFuncs\Common;

class MemoriasController extends Controller
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

            $where = [ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id] ];
            $palavra = Request('buscar') ? Request('buscar') : null;

            if ($palavra) {
                
                $list = DB::table('memorias')
                ->select('id', 'Atividade', 'DtHrMemoria', 'created_at')
                ->where($where)
                ->where([[ 'Atividade', 'like', '%' . $palavra . '%' ]])
                ->orWhere([[ 'Detalhamento', 'like', '%' . $palavra . '%' ]])
                ->orderBy('DtHrMemoria', 'desc')
                ->paginate(10);
    
                Pesquisa::create(['Palavra'=>Request('buscar'), 'Tela'=>'memorias']);
    
            } else {
    
                $list = DB::table('memorias')
                ->select('id', 'Atividade', 'DtHrMemoria', 'created_at')
                ->where($where)
                ->orderBy('DtHrMemoria', 'desc')
                ->paginate(10);
                
            }
    
            $qtdeRegistros = $list->total();
    
            Paginator::defaultView('pagination::bootstrap-4');
    
            return view('dashboard.memorias.index', compact('list', 'palavra', 'qtdeRegistros'));

        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('dashboard.memorias.create');
        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function criar()
    {
        try {
            return view('dashboard.memorias.create');
        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $dados = $request->all();
            $response = Memorias::create($dados);

            if ($response) { 
                $status = true;
                $message = 'Criada com sucesso';
            } 
            return redirect('dashboard/memorias')->with(['data'=>$response ?? '', 'message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);

        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memorias  $memorias
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $model = Memorias::where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id], [ 'id', '=', $id ] ])->get();
            return view('dashboard.memorias.show', compact('model'));
        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memorias  $memorias
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $model = Memorias::where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id], [ 'id', '=', $id ] ])->get();
            return view('dashboard.memorias.edit', compact('model'));
        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memorias  $memorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // atualizar registro
            $data = $request->all();
            $response = Memorias::find($id)->update($data);

            if ($response) { 
                $status = true;
                $message = 'Editado com sucesso';
            } 
            return redirect('dashboard/memorias/'.$id)->with(['message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);

        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    { 
        try {
            $item = Memorias::find($id);
            return view('dashboard.memorias.delete', compact('item'));
        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Memorias::where('id', $id)->update(['Status' => '0']);        
            return redirect('dashboard/memorias')->with('message', 'Deletado com sucesso');

        } catch (\Throwable $th) {
            $message = $th;
            return view('dashboard.memorias.index', compact('message'));
        }
    }
}
