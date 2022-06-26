<?php

namespace App\Http\Controllers\bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Alarm;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    public function index(){

        $buses = Bus::where('user_id' , Auth::user()->id)->paginate(5);

        $user = Auth::user()->alarms->first();

        $alarms = Alarm::where('user_id' , Auth::user()->id)->get();
        foreach($alarms as $alarm){
            if($alarm->alarm != ''){
                return view('bus-time' , compact('buses' , 'user') );
            }
        }
        return redirect()->route('home')->with(['fail' => 'Alarm must not empty']);

    }
    public function store(Request $request){
        $request->validate([
            'bus_time_hr' => 'required',
            'bus_time_min' => 'required'
        ]);

        //return $request->bus_time_hr + 1 .':'. $request->bus_time_min ;

        
        
        $bus = new Bus();
        $bus->user_id = Auth::user()->id;
        $bus->bus_time =  $request->bus_time_hr.':'.$request->bus_time_min;
        $bus->time_to_cinema = $request->bus_time_hr .':'. $request->bus_time_min + 45;
        $save = Bus::where('user_id' , Auth::user()->id)->get();

        if($save){
            $bus->save();
        }


        return redirect()->back()->with(['success' => 'bus time add successfully']);
        
    }

    public function delete($id){
        $bus = Bus::find($id);

        $bus->delete();

        return redirect()->back()->with(['success' => 'successfully deleted']);
    }
}
