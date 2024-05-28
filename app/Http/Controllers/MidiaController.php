<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use Illuminate\Http\Request;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function show(Midia $midia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function edit(Midia $midia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Midia $midia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Midia  $midia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Midia $midia)
    {
        //
    }
}
