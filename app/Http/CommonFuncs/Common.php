<?php

namespace App\Http\CommonFuncs;

use App\Models\Analytics;
use Illuminate\Support\Facades\DB;

class Common {
    
    public function getIP()
    {
        $clientIP = $_SERVER['HTTP_CLIENT_IP'] 
        ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
        ?? $_SERVER['HTTP_X_FORWARDED'] 
        ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
        ?? $_SERVER['HTTP_FORWARDED'] 
        ?? $_SERVER['HTTP_FORWARDED_FOR'] 
        ?? $_SERVER['REMOTE_ADDR'] 
        ?? '0.0.0.0';

        return $clientIP;
    }

    function setPageAccess($page, $userType)
    {
        $ip = Common::getIP();

        $access = [
            'IP' => Common::getIP(),
            'Page' => $page,
            'UserTypeAccess' => $userType
        ];

        Analytics::create($access);
    }

}