<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;
use App\Project;
use App\Task;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function validator(array $data){
        return Validator::make($data, [
            'content' =>'required',
        ]);
    }

    public function commentProject($id, Request $data){
        $validator = $this->validator($data->all());
        if(!$validator->fails()){
            $comment = Comment::create([
                'author_id' => Auth::user()->id,
                'content' => $data->input('content'),
            ]);

            $project = Project::find($id);
            $project->comments()->save($comment);

            //return response()->json(['success'=> true]);
            return redirect()->back();
        }
        return response()->json(['success'=> false]);
    }

    public function commentTask($id,$task_id,Request $data){
        $validator = $this->validator($data->all());
        if(!$validator->fails()){
            $comment = Comment::create([
                'author_id' => Auth::user()->id,
                'content' => $data->input('content'),
            ]);

            $project = Project::find($id);
            $task = Task::find($task_id);
            $task->comments()->save($comment);

            // return response()->json(['success'=> true]);
            return redirect()->back();
        }
        return response()->json(['success'=> false]);
    }
}
