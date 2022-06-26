<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alarm;
use Illuminate\Support\Facades\Auth;

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
        $alarms = Alarm::where('user_id' , Auth::user()->id)->paginate(5);
        return view('home' , compact('alarms'));
    }

    public function store(Request $request){

        $request->validate([
            'alarm_hr' => 'required',
            'alarm_min' => 'required',
            
        ]);
        
        //return $request->alarm_hr . ':' . $request->alarm_min + 30;

        
        $alarm = new Alarm();
        $alarm->user_id = Auth::user()->id;
        $alarm->alarm = $request->alarm_hr . ':' . $request->alarm_min;
        $alarm->take_time_bath = $request->alarm_hr .':'. $request->alarm_min + 15;
        $alarm->take_time_breakfast = $request->alarm_hr .':'.$request->alarm_min + 30;
        $alarm->walkig_time = $request->alarm_hr .':'.$request->alarm_min + 45; 

        $save = Alarm::where('user_id' , Auth::user()->id)->get();
        if($save){
            $alarm->save();
        }

        return redirect()->back()->with(['success' => 'add alarm successfully']);

    }

    public function delete($id){
        $alarm = Alarm::find($id);
        $alarm->delete();

        return redirect()->back()->with(['success' => 'successfully deleted']);
    }
}
