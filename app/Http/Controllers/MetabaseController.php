<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class MetabaseController extends Controller
{
    public function showDashboard()
    {
        $METABASE_SITE_URL = "https://metabase.tulangbawangkab.go.id";
        $METABASE_SECRET_KEY = "ab882a228cf481710a6f85abf2e567c852f76412509a68dfc038a1b2a2a2698c";

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
