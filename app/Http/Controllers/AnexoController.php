<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use Illuminate\Http\Request;

class AnexoController extends Controller
{
    public function anexoPorBaseId($baseId)
    {
        try {
            return Anexo::where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id], [ 'BaseId', '=', $baseId ] ])->get();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function anexoPorId($id)
    {
        try {
            return Anexo::where([ ['Status', '=', '1'], ['UserId', '=', auth()->user()->id], [ 'id', '=', $id ] ])->get();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function uploadAnexo(Request $request, $baseId)
    {
        try {
            if ($anexo = $request->file('Anexo')) {
                $diretorio = 'anexos';
                $nomeAnexo = uniqid(date('HisYmd')) . "." . $anexo->getClientOriginalExtension();
                $anexo->move($diretorio, $nomeAnexo);

                $requestData = $request->all();
                $entityAnexo = [
                    'BaseId' => $baseId,
                    'NomeAnexo' => $nomeAnexo,
                    'Anexo' => $diretorio.'/'.$nomeAnexo,
                    'TipoAnexo' => $anexo->getClientOriginalExtension(),
                    'Decricao' => $requestData['Titulo'],
                    'UserId' => auth()->user()->id
                ];

                Anexo::create($entityAnexo);

                return $nomeAnexo;
            }
    
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function anexo($id)
    {
        try {
            $item = $this->anexoPorId($id); 
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
            Anexo::where('id', $id)->update(['Status' => '0']);
            return redirect('dashboard/conhecimento/'.$baseId)->with('message', 'Deletado com sucesso');

        } catch (\Throwable $th) {
            dd($th);
        }
        
    }
}
