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

class MidiaController extends Controller
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
            $list = '';
            $palavra = '';
            $qtdeRegistros = '';
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
            dd($request->all());
            $entity = $request->all(); dd($entity);
            $response = Midia::create($entity);

            if ($response) { 
                
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
            return view('dashboard.midias.show');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function edit(Midia $midia)
    {
        try {
            return view('dashboard.midias.show');
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
            return view('dashboard.midias');
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
            return view('dashboard.midias');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
