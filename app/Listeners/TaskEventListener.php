<?php

namespace App\Listeners;

use Auth;

use App\Events\TaskWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use App\Historic;


class TaskEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function created($event){
        Historic::create([
            'project_id' => $event->task->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a crée la tâche <a href="'. url('project/'. $event->task->project->id . '/tasks/'.$event->task->id) .'">' . $event->task->title . '</a>',
        ]);
    }

    public function updated($event){
        Historic::create([
            'project_id' => $event->task->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a modifié la tâche <a href="'. url('project/'. $event->task->project->id . '/tasks/'.$event->task->id) .'">' . $event->task->title . '</a>',
        ]);
    }

    public function deleted($event){
        Historic::create([
            'project_id' => $event->task->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a supprimé la tâche <a href="#">' . $event->task->title . '</a>',
        ]);
    }

    public function ended($event){
        Historic::create([
            'project_id' => $event->task->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a marqué la tâche <a href="'. url('project/'. $event->task->project->id . '/tasks/'.$event->task->id) .'">' . $event->task->title . '</a>' . ' comme terminé',
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\TaskWasCreated',
            'App\Listeners\TaskEventListener@created'
        );

        $events->listen(
            'App\Events\TaskWasUpdated',
            'App\Listeners\TaskEventListener@updated'
        );

        $events->listen(
            'App\Events\TaskWasDeleted',
            'App\Listeners\TaskEventListener@deleted'
        );

        $events->listen(
            'App\Events\TaskEnded',
            'App\Listeners\TaskEventListener@ended'
        );
    }
}
