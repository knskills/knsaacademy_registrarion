<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.audiance.dashboard');
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
