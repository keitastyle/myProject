<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 08/04/2016
 * Time: 01:06
 */
?>

@extends('layouts.master')

@section('title', 'Tableau de bord')

@section('content')
    <ol class="breadcrumb">
        <li class="active">Accueil</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div id="calendar" style="position: relative; z-index: 99;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6" style="margin-top: 20px;">
            <div class="item" style="">
                <a href="{{ url('project/all') }}" class="default">
                    <h4>
                        <i class="fa fa-list"></i>&nbsp;
                        Tous les projets
                    </h4>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6" style="margin-top: 20px;">
            <div class="item" style="">
                <a href="{{ url('project/create') }}" class="default">
                    <h4>
                        <i class="fa fa-plus"></i>&nbsp;
                        Nouveau projet
                    </h4>
                </a>
            </div>
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
