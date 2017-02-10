<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 00:25
 */
?>

@extends('layouts.master')

@section('title', 'Nouveau rendez-vous')

@section('style-link')
    <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li><a href="{{ url('/meeting/all') }}">Rendez-vous</a></li>
        <li class="active">Nouveau</li>
    </ol>

    <div class="row">
        <div class="col-md-5">
            <form action="{{url('meeting/create')}}" method="post" role="form" class="col s12">
                {{csrf_field()}}
                <div class="form-group">
                    <select name="project_id" class="form-control">
                        @foreach(App\Project::where('mentor_id', '=', Auth::user()->userable->id)->get()  as $project)
                            <option value="{{ $project->id }}">{{$project->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="membres">Avec</label>
                    <select name="students[]" class="form-control selectize-add" placeholder="Membre" multiple>
                        <option>Membre</option>
                        @foreach(App\Student::all() as $s)
                            <option value="{{ $s->id }}">{{ $s->user->first_name .' '. $s->user->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="dateD">Date</label>
                    <input type="text" class="form-control datepicker" name="dateD" id="dateD" placeholder="jj/mm/aaaa" required>
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="inputWarning1">Lieu</label>
                    <input name="location" type="text" class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
        <div class="col-md-7">
            <div id="calendar"></div>
        </div>
    </div>

@endsection

@section('jquery')
    //<script>
        $(document).ready(function() {

            $('#calendar').fullCalendar({
                defaultDate: '{{ Carbon\Carbon::now()->formatLocalized('%Y-%m-%d') }}',
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                        @foreach($meetings as $m)
                        {
                        title: '{{ $m->project->title }}',
                        start: '{{ $m->date->formatLocalized('%Y-%m-%d') }}'
                    },
                    @endforeach
                ]
            });

        });

        //</script>
@endsection