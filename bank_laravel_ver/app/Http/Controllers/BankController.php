<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accdetail;
use App\User;
use App\Http\Requests\BankRequest;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function deposit()
    {
        return view('deposit');
    }

    public function withdraw()
    {
        return view('withdraw');
    }

    public function list(){
        $accdetails=Accdetail::orderBy('ts','desc')->get();
        return view('list',compact('accdetails'));
    }

    public function save(BankRequest $request){
        User::find(auth()->user()->id)->update(['cash'=>auth()->user()->cash+$request->value]);
        Accdetail::create(['id'=>auth()->user()->id,'operate'=>1,'amount'=>$request->value]);
        return redirect()->back()->with('message','deposit succeed');
    }

    public function take(BankRequest $request){
        if($request->value>auth()->user()->cash){
            return redirect()->back()->with('error','Your account dont have that much money!!!');
        }
        User::find(auth()->user()->id)->update(['cash'=>auth()->user()->cash-$request->value]);
        Accdetail::create(['id'=>auth()->user()->id,'operate'=>2,'amount'=>$request->value]);
        return redirect()->back()->with('message','withdraw succeed');
    }
    
    public function display()
    {
        $dis=auth()->user()->display;
        if($dis){
            User::find(auth()->user()->id)->update(['display'=>false]);
        }else{
            User::find(auth()->user()->id)->update(['display'=>true]);
        }
        return redirect()->back();
    }
}
