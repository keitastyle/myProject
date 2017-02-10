<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Student;
use App\Mentor;
use App\Project;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function Validator(array $data){
        return Validator::make($data,[
            'location'=>'required',
        ]);
    }
    public function create(){

        if(Auth::user()->userable instanceof Mentor){
            $projects = Project::where('mentor_id', '=', Auth::user()->userable->id)->get();
            $l = array();
            foreach($projects as $p){
                array_push($l, $p->id);
            }
            $meetings = Meeting::whereIn('project_id', $l)->where('date', '>=', Carbon::now())->where('status','=',3 )->orderBy('date','asc')->get();

        }
        else{
            $s = Auth::user()->userable;
            $meetings = $s->meetings()->where('date', '>=', Carbon::now())->orderBy('date','asc')->get();
        }
        return view('meeting.create')->with([
            'meetings' => $meetings,
        ]);
    }
    public function store(Request $request){

        $validator=$this->Validator($request->all());

        if(!$validator->fails()){
            $meeting = Meeting::create([
                'project_id' => $request->input('project_id'),
                'date'=>$request->input('dateD'),
                'location'=>$request->input('location'),
                'status'=>'3',
            ]);


            foreach($request->input('students') as $s){
                $meeting->students()->attach($s);
            }
            $meeting->save();

        }
        return redirect('/meeting/all');
    }

    public function index(){
        if(Auth::user()->userable instanceof Mentor){
            $projects = Project::where('mentor_id', '=', Auth::user()->userable->id)->get();
            $l = array();
            foreach($projects as $p){
                array_push($l, $p->id);
            }
            $meeting = Meeting::whereIn('project_id', $l)->where('date', '>=', Carbon::now())->where('status','=',3 )->orderBy('date','asc')->get();
        }
        else{
            $s = Auth::user()->userable;
            $meeting = $s->meetings()->where('date', '>=', Carbon::now())->orderBy('date','asc')->get();
        }

        return view('meeting.index')->with([
            'meetings' => $meeting,

        ]);
    }

    public function pending(){
        $meeting = Meeting::where('status', '=',1)->orderBy('date','asc')->get();
        $p_meetings = 0;

        if(Auth::user()->userable instanceof Mentor){
            $projects = Project::where('mentor_id', '=', Auth::user()->userable->id)->get();
            $l = array();
            foreach($projects as $p){
                array_push($l, $p->id);
            }
            $meetings = Meeting::whereIn('project_id', $l)->where('date', '>=', Carbon::now())->where('status','=',3 )->orderBy('date','asc')->get();
            $p_meetings = Meeting::whereIn('project_id', $l)->where('date', '>=', Carbon::now())->where('status','=',1 )->orderBy('date','asc')->count();
        }
        else{
            $s = Auth::user()->userable;
            $meetings = $s->meetings()->where('date', '>=', Carbon::now())->orderBy('date','asc')->get();
        }
        return view('meeting.pending')->with([
            'meetingsPending'=> $meeting,
            'meetings'=> $meetings,
            'p_meetings'=> $p_meetings,
        ]);
    }


    public function edit($id){
        $meeting = Meeting::find($id);
        $p_meetings = 0;

        if(Auth::user()->userable instanceof Mentor){
            $projects = Project::where('mentor_id', '=', Auth::user()->userable->id)->get();
            $l = array();
            foreach($projects as $p){
                array_push($l, $p->id);
            }
            $meetings = Meeting::whereIn('project_id', $l)->where('date', '>=', Carbon::now())->where('status','=',3 )->orderBy('date','asc')->get();
            $p_meetings = Meeting::whereIn('project_id', $l)->where('date', '>=', Carbon::now())->where('status','=',1 )->orderBy('date','asc')->count();
        }
        else{
            $s = Auth::user()->userable;
            $meetings = $s->meetings()->where('date', '>=', Carbon::now())->orderBy('date','asc')->get();
        }
        return view('meeting.edit')->with([
            'meeting'=>$meeting,
            'meetings'=>$meetings,
            'p_meetings'=> $p_meetings,
        ]);
    }
    public function update($id,Request $request){
        $meeting = Meeting::find($id);
        if(Auth::user()->userable instanceof Mentor){
            $i='3';
        }
        else{
            $i='1';
        }
        $meeting->update([
            'date' => $request->input('dateD'),
            'location' => $request->input('location'),
            'status'=>$i,
        ]);
        $meeting->save();
        return redirect('/meeting/all');
    }
    public function destroy($id)
    {
        $m = Meeting::find($id);
        $m->delete();
        return redirect()->back();
    }

    public function valide($id)
    {
        $m = Meeting::find($id);
        $m->status = 3;
        $m->save();
        return redirect()->back();
    }
    public function showAll(){
        $p_meetings = 0;

        if(Auth::user()->userable instanceof Mentor){
            $projects = Project::where('mentor_id', '=', Auth::user()->userable->id)->get();
            $l = array();
            foreach($projects as $p){
                array_push($l, $p->id);
            }
            $meeting = Meeting::whereIn('project_id', $l)->orderBy('date','asc')->get();

        }
        else{
            $s = Auth::user()->userable;
            $meeting = $s->meetings()->orderBy('date','asc')->get();
        }
        return view('meeting.index')->with([
            'meetings' => $meeting,
        ]);

    }
}
