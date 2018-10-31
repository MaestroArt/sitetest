<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Weather extends Controller
{
    public function show()
    {
    	$dat=[];
    	$dat["time"]="123123";
    	$dat["city"]="Zaporizhzhya";
    	$dat["name"]="Art";
        return view('weather',$dat);
        //return view('weather')->with('city',"1111111");
		//return view('weather', ['name' => '23333','time' => '111','city' => '222']);
    }
}
