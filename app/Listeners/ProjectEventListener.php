<?php

namespace App\Listeners;

use Auth;
use App\Project;
use App\Events\Event;
use App\Events\ProjectWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Historic;

class ProjectEventListener
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
            'project_id' => $event->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a crée le projet',
        ]);
    }

    public function updated($event){
        Historic::create([
            'project_id' => $event->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a modifié le projet',
        ]);
    }


    public function deleted($event){
        Historic::create([
            'project_id' => $event->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a supprimé le projet',
        ]);
    }
    public function canceled($event){
        Historic::create([
            'project_id' => $event->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a annulé le projet',
        ]);
    }

    public function ended($event){
        Historic::create([
            'project_id' => $event->project->id,
            'author_id' => Auth::user()->id,
            'content' => 'a marqué le projet comme terminé',
        ]);
    }


    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ProjectWasCreated',
            'App\Listeners\ProjectEventListener@created'
        );

        $events->listen(
            'App\Events\ProjectWasUpdated',
            'App\Listeners\ProjectEventListener@updated'
        );

        $events->listen(
            'App\Events\ProjectWasDeleted',
            'App\Listeners\ProjectEventListener@deleted'
        );

        $events->listen(
            'App\Events\ProjectEnded',
            'App\Listeners\ProjectEventListener@ended'
        );
    }

}
