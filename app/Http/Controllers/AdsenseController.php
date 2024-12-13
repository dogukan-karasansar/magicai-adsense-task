<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdsenseController extends Controller
{
    public function index(Request $request)
    {
        $adsenses = $request->user()->adsenses;

        return view('panel.admin.frontend.adsense.index', compact('adsenses'));
    }
}
