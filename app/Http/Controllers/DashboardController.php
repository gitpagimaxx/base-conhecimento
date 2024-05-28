<?php

namespace App\Http\Controllers;

use App\Models\BaseConhecimento;
use App\Models\Categoria;
use App\Models\BaseCategoria;
use App\Models\Pesquisa;
use App\Models\Memorias;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Analytics;
use App\Http\CommonFuncs\Common;
use App\Http\Tag;

class DashboardController extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

    public function index()
    {
        try {
            $conhecimento = DB::table('base_conhecimento')
            ->selectRaw('id, Titulo, created_at')
            ->whereRaw('Status = 1 AND UserId =  '.auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
            $qtdeConhecimento = $conhecimento->count();

            $memorias = DB::table('memorias')
            ->selectRaw('id, Atividade, created_at')
            ->whereRaw('Status = 1 AND UserId =  '.auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
            $qtdeMemorias = $memorias->count();

            return view('dashboard.dashboard', compact('conhecimento', 'qtdeConhecimento', 'memorias', 'qtdeMemorias'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}