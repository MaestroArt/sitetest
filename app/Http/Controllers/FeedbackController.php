<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Http\Requests\FeedbackPost;

class FeedbackController extends Controller
{
    public function saveFeedback(FeedbackPost $request)
    {
    	Feedback::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'msg' => $request['msg'],
        ]);
        
        return redirect(url('/feedback2'));
    }

    public function showForm()
    {
    	return view('feedbackform');
    }

    public function showForm2()
    {
    	return view('feedbackform')->with("thanks","Thanks for you feedback!");
    }

    public function showAll()
    {
        $msgs = Feedback::all();

    	return view('feedbackreport', compact('msgs'));
    }
}
