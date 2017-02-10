<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Student;
use App\Mentor;
use App\User;
use App\Meeting;
use App\Project;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        return view('welcome');
    }

    public function dashboard(){
        if(Auth::user()->userable instanceof Mentor){
            $projects = Project::where('mentor_id', '=', Auth::user()->userable->id)->get();
            $l = array();
            foreach($projects as $p){
                array_push($l, $p->id);
            }
            $meeting = Meeting::whereIn('project_id', $l)->where('status','=',3 )->orderBy('date','asc')->get();

            return view('dashboard')->with([
                'meetings' => $meeting,
            ]);
        }
        if(Auth::user()->userable->project != null){
            $project = Project::find(Auth::user()->userable->project->id);
            return view('project.view')->with([
                'project' => $project
            ]);
        }
        return view('default');
    }

}
