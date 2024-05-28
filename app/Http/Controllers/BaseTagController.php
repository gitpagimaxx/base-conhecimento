<?php

namespace App\Http\Controllers;

use App\Models\BaseTag;
use Illuminate\Http\Request;

class BaseTagController extends Controller
{
    public function associarBaseIdTagId($BaseId, $TagId) 
    {
        try {

            $tagsAssociadas = BaseTag::where([['BaseId', '=', $BaseId], ['TagId', '=', $TagId], ['Status', '=', '1']])->get(); 
            if ($tagsAssociadas->count() > 0) 
                BaseTag::where('id', $tagsAssociadas[0]->id)->update(['Status' => false]);

            $response = BaseTag::create([ 'BaseId' => $BaseId, 'TagId' => $TagId ]);

            return $response;

        } catch (\Throwable $th) {

            dd($th);

        }
    }
}
