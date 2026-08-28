<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Jobs\SendMailJob;
use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('applications.index')->with([
            'applications' => auth()->user()->applications()->latest()->paginate(5),
        ]);
    }
    public function checkDate()
    {
       
        $last_application = auth()->user()->applications()->latest()->first();
        
        
        if (!$last_application) {
            return true; 
        }
        
        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        
        if ($last_app_date == $today) {
            return false; 
        }

        return true; 
    }
    public function store(StoreApplicationRequest $request)
    {
        if(!$this->checkDate()){
            return redirect()->back()->with('error', 'You can create only 1 application a day!');
        }
        if ($request->hasfile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files', $name, 'public');
        }

        $applicaton = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

        dispatch(new SendMailJob($applicaton));

        return redirect()->back();
    }

    
}
