<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\audience as Audience;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function lntm1()
    {
        return view('web.ads.lntm.lntm1');
    }

    public function lntm2()
    {
        return view('web.ads.lntm.lntm2');
    }

    public function lntm3()
    {
        return view('web.ads.lntm.lntm3');
    }

    public function beginnertobillionaire()
    {
        return view('web.ads.b2b.beginor-bilinear');
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

    public function registration()
    {
        return view('web.ads.registration');
    }

    /**
     * Whatsapp page
     */
    public function whatsapp(Request $request)
    {
        return view('web.whatsapp');
    }


    //========================================================================================//
    //====================================== Admin pages =====================================//
    //========================================================================================//

    /*
     * Dashboard
     */
    public function dashboard()
    {
        $audience = Audience::count();
        $events = Event::count();
        $messages = Message::count();
        return view('admin.dashboard.index')->with([
            'audience' => $audience,
            'events' => $events,
            'messages' => $messages,
        ]);
    }
}
