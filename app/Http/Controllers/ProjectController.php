<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TaskController;

use Illuminate\Http\Request;
use Event;
use App\Http\Requests;
use Auth;
use Validator;
use Input;
use App\User;
use App\Project;
use App\Student;
use Carbon\Carbon;

use App\Events\ProjectEnded;
use App\Events\ProjectWasCreated;
use App\Events\ProjectWasCanceled;
use App\Events\ProjectWasUpdated;
use App\Events\ProjectWasDeleted;


class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required',
            'theme' => 'required',
            'type' => 'required',
            'description' => 'required',
            'beginning_date' => 'required',
        ]);
    }
    public function index(){
        $projects=Project::where('mentor_id','=', Auth::user()->userable->id)->get();
        return view('project.index')->with([
            'projects'=>$projects,
        ]);
    }
    public function indexEnded(){
        $projects=Project::where('mentor_id','=', Auth::user()->userable->id)->where('status','=',3)->get();
        return view('project.index')->with([
            'projects'=>$projects,
        ]);
    }
    public function indexCanceled(){
        $projects=Project::where('mentor_id','=', Auth::user()->userable->id)->where('status','=',2)->get();
        return view('project.index')->with([
            'projects'=>$projects,
        ]);
    }
    public function indexPending(){
        $projects=Project::where('mentor_id','=', Auth::user()->userable->id)->where('status','=',1)->get();
        return view('project.index')->with([
            'projects'=>$projects,
        ]);
    }

    public function show($id)
    {
        $project = Project::find($id);
        $project->description = nl2br($project->description);
        $project->comments = $project->comments()->orderBy('created_at', 'desc')->get();
        return view('project.view')->with([
            'project' => $project,
        ]);
    }

    public function create()
    {
        $projects = Project::where('mentor_id', '=', Auth::user()->id)
            ->take(3)
            ->get();
        return view('project.create')->with([
            'projects' => $projects,
        ]);
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $o_projects = Project::where('mentor_id', '=', $project->mentor_id);
        return view('project.edit')->with([
            'project' => $project,
            'o_projects' => $o_projects,
        ]);
    }

    public function update($id, Request $data)
    {
        $project = Project::find($id);
        $project->update([
            'title' => $data->input('title'),
            'type' => $data->input('type'),
            'theme' => $data->input('theme'),
            'description' => $data->input('description'),
            'beginning_date' => $data->input('dateD'),
            'status' => '1',
        ]);

        $project->save();

        if ($data->input('dateF') != "") {
            $project->ending_date = $data->input('dateF');
            if($project->ending_date <= $project->beginning_date){
                $project->ending_date = Null;
            }
            $project->save();
        }

        Event::fire(new ProjectWasUpdated($project));
        return redirect('project/'.$id);

    }

    public function delete($id)
    {
        $project=Project::find($id);

        foreach($project->tasks as $t){
            $controller = new TaskController();
            $controller->delete($project->id, $t->id);
        }

        $meetings=$project->meetings();
        $meetings->delete();
        $project->delete();
        Event::fire(new ProjectWasDeleted($project));
        return redirect('/dashboard');
    }

    public function restore($id){
        $project=Project::find($id);
        $project->status='1';
        $project->save();

        return redirect('project/' . $id);
    }
    public function store(Request $data)
    {
        $validator = $this->validator($data->all());
        if (!$validator->fails()) {
            $project = Project::create([
                'mentor_id' => Auth::user()->userable->id,
                'title' => $data->input('title'),
                'type' => $data->input('type'),
                'theme' => $data->input('theme'),
                'description' => $data->input('description'),
                // 'location' => $data->input('location'),
                'beginning_date' => $data->input('beginning_date'),
                'status' => '1',
            ]);

            if ($data->input('ending_date') != "") {
                $project->ending_date = $data->input('ending_date');
                if($project->ending_date <= $project->beginning_date){
                    $project->ending_date = Null;
                }
                $project->save();
            }

            foreach (explode(";", $data->input('members')) as $member) {
                $u = User::where('email', '=', $member)->first();
                if ($u != NULL) {
                    if ($u->userable instanceof Student) {
                        if ($u->userable->project_id == null) {
                            $u->userable->project_id = $project->id;
                            $u->userable->save();
                        }
                    }
                } else {
                    /*
                     * Sending inscription email to the user
                     */

                    $to = $member;

                    // Sujet
                    $subject = 'Ajout à un projet';

                    // message
                    $message = '';
                    $message .= '<html>';
                    $message .= '<body>';
                    $message .= Auth::user()->first_name . ' ' . Auth::user()->last_name . ' vous a ajouté au projet ' . $project->type . ' sur myProject<br>';
                    $message .= "<a href=\"" . url('/project/' . $project->id . '/add/' . $member) . "\"> Confirmer </a>";
                    $message .= '</body>';
                    $message .= '</html>';

                    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // En-têtes additionnels
                    $headers .= 'From: myProject <no-reply@myProject.com>' . "\r\n";

                    // Envoi
                    mail($to, $subject, $message, $headers);
                }
            }

            Event::fire(new ProjectWasCreated($project));
            return view('project.view')->with(['project' => $project]);
        } else {
            Input::flash();
            return redirect()->back()->withErrors($validator);
        }
    }

    public function historic($id)
    {
        $project = Project::find($id);
        return view('project.historic')->with([
            'project' => $project,
            'historics' => $project->historics()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function files($id)
    {
        $project = Project::find($id);
        return view('project.files')->with([
            'project' => $project,
        ]);
    }

    public function end($id)
    {
        $project = Project::find($id);
        $project->status = '3';
        $project->save();

        Event::fire(new ProjectEnded($project));
        return redirect('project/' . $id);
    }


    public function cancel($id)
    {
        $project = Project::find($id);
        $project->status = '2';
        $project->save();
        Event::fire(new ProjectWasCanceled($project));
        return redirect('project/' . $id );
    }
}