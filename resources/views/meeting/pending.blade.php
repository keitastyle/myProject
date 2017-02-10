<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 19:16
 */
?>

@extends('layouts.master')

@section('title', 'Rendez-vous en attente de validation')

@section('style-link')
    <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li><a href="{{ url('/meeting/all') }}">Rendez-vous</a></li>
        <li class="active">Validation</li>
    </ol>

    <div class="row">
        <div class="col-md-5">
            <div>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Filtrer
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Tous</a></li>
                        <li><a href="#">A venir</a></li>
                    </ul>
                    @if(Auth::user()->userable instanceof App\Mentor)
                        <a href="{{url('meeting/pending')}}" class="btn btn-default dropdown-toggle" type="button">
                            En attente de validation
                            @if($p_meetings >0)
                                <span class="label label-danger">{{ $p_meetings }}</span>
                            @endif
                        </a>
                        <a href="{{ url('meeting/create') }}" class="btn btn-default dropdown-toggle" type="button">
                            <i class="fa fa-plus"></i>&nbsp;
                            Nouveau
                        </a>
                    @endif
                </div>

                <div>
                    <br>
                    @foreach($meetingsPending as $m)
                        <div class="item">
                            <h4>
                                Avec
                                @foreach($m->students as $s)
                                    {{$s->user->first_name}} {{$s->user->last_name}} ,
                                @endforeach
                            </h4>

                            <h6>{{$m->project->title}}</h6>
                            <div class="row">
                                <p class="col-sm-5">
                                    <i class="fa fa-clock-o"></i> {{$m->date->formatLocalized("%A, %d %B %Y")}}<br>
                                    {{$m->location}}
                                </p>
                                <div class="col-sm-7">
                                    <a href="{{ url('meeting/'.$m->id.'/edit') }}" class="btn btn-default dropdown-toggle" type="button">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        Modifier
                                    </a>
                                    <a href="{{ url('meeting/'.$m->id.'/valide') }}" class="btn btn-primary dropdown-toggle" type="button">
                                        <i class="fa fa-check"></i>&nbsp;
                                        Valider
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
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