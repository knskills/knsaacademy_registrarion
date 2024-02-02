<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\audience as Audience;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

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


    //========================================================================================
    //====================================== Admin pages =====================================
    //========================================================================================

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


    /**
     * Send test email
     */
    public function sendTestEmail()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'test@gmail.com',
            'subject' => 'Test Email',
            'body' => 'This is a test email'
        ];

        Mail::send('admin.mails.temp', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject($data['subject']);
        });

        return "Test email sent successfully";


        // return redirect()->back()->with('success', 'Test email sent successfully');
    }
}
