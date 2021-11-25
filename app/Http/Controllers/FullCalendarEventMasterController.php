<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Quickdate;
use Redirect,Response;

class FullCalendarEventMasterController extends Controller
{
    public function index()
    {
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
        //  $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         $a = Event::selectRaw('id,title as title,start,end,"Event" as type')->whereRaw('start >= '.$start.' OR end <='. $end);
         $data = Quickdate::selectRaw('quickdates.id,CONCAT(packages.title," - NPR ",quickdates.rate)    as title,stdate as start,enddate as end,"Quick Date" as type')
         ->whereRaw('stdate >= '.$start.' OR enddate <='. $end)
         ->join('packages','packages.id','=','quickdates.package_id')
         ->union($a)
         ->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return view('bac.calendar.index');
    }
    
   
    public function create(Request $request)
    {  
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Event::insert($insertArr);   
        return Response::json($event);
    }

    public function addEvent(Request $request){
        $event = new Event;
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $save = $event->save();
        if($save){
            return back()->with('success','Added Successfully');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }
     
 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    } 
 
 
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    }
}