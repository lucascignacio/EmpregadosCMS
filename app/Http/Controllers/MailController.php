<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function create()
    {
        return view('admin.mail.create');
    } 

    public function store(Request $request)
    {   
        $this->validate($request,[
            'file'=>'mimes:docs,doc,pdf,jpeg,jpg,png',
            'body' => 'required|string',
        ]);
        $image = $request->file('file');
        $details = [
            'body' => $request->body,
            'file' => $image
        ];
        if($request->department){
            $users = User::where('department_id',$request->department)->get();
            foreach($users as $user){
                Mail::to($user->email)->send(new SendMail($details));
            }
        } elseif($request->person){
            $user = User::where('id', $request->person)->first();
            $userEmail = $user->email;
            Mail::to($user->email)->send(new Sendmail($details));
        } else {
            $users = User::get();
            foreach($users as $user){
                Mail::to($user->email)->send(new Sendmail($details));
            }
        }
        return redirect()->back()->with('message', 'Email sent');
    }
}
