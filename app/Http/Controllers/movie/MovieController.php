<?php

namespace App\Http\Controllers\movie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Bus;


class MovieController extends Controller
{
    public function index(){
        $movies = Movie::all();

        $user = Auth::user()->buses->first();
        $buses = Bus::where('user_id', Auth::user()->id)->get();

        foreach($buses as $bus){
            if($bus->time_to_cinema != ''){
                return view('movie-time' , compact('movies' , 'buses' ,'user'));
            }
        }

        return redirect()->route('bus')->with(['fail' => 'Bus must not empty']);

    }
}
