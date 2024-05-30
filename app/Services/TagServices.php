<?php
namespace App\Services;

use App\Models\BaseTag;
use App\Models\BaseConhecimento;
use App\Models\Tag;

class TagServices {

    public function TagsByKnowlegde(int $knoledge) {
        
        $tags = BaseTag::where('BaseId', $knoledge)
            ->join('tag', 'tag.Id', '=', 'base_tag.TagId')
            ->select('tag.Tag', 'tag.UrlAmigavel')
            ->get();

        return $tags;

    }

}