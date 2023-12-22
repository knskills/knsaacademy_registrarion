<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function index()
    {
        return view('web.home');
    }

    public function beginnertobillionaire()
    {
        return view('web.ads.beginortobillinior');
    }

    public function sales()
    {
        return view('web.ads.sales');
    }

    public function billionaire()
    {
        return view('web.ads.bilinear');
    }
}
