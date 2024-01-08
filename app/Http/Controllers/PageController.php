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

    public function terms()
    {
        return view('web.terms');
    }

    public function privacy()
    {
        return view('web.privacy');
    }

    /**
     * Whatsapp page
     */
    public function whatsapp(Request $request)
    {
        // if ($request->has('phone')) {
        //     $phone = $request->phone;
        //     $message = $request->message;
        //     $url = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . $message;
        //     return redirect($url);
        // }
        return view('web.whatsapp');
    }
}
