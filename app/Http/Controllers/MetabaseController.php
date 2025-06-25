<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class MetabaseController extends Controller
{
    public function showDashboard()
    {
        $METABASE_SITE_URL = "http://localhost:3000";
        $METABASE_SECRET_KEY = "4e85f12a96568fd5a5b5d6386b051b8c2b54cefa4fe5426b14fc9108f8adc2a3";

        $payload = [
            "resource" => ["dashboard" => 2],
            "params" => new \stdClass(),
            "exp" => time() + (10 * 60),
        ];

        $token = JWT::encode($payload, $METABASE_SECRET_KEY, 'HS256');
        $iframeUrl = $METABASE_SITE_URL . "/embed/dashboard/" . $token . "#background=false&bordered=false&titled=false";

        return view('metabase', compact('iframeUrl'));
    }
}
