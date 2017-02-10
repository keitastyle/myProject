<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 22:21
 */
?>

@extends('layouts.master')

@section('title', 'Tâches | '. $project->title)

@section('style-link')
    <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li><a href="{{ url('/project/'.$project->id) }}">{{ $project->title }}</a></li>
        <li class="active">
            <a href="{{ url('/project/'.$project->id.'/tasks') }}" style="color: #777;">Taches</a>
            <form name="search" method="post" action="{{ url('/project/'.$project->id.'/tasks/search') }}" style="display: inline;">
                {!! csrf_field() !!}
                <input type="text" name="search" class="form-control breadcrumb-search" placeholder="Rechercher">
            </form>
        </li>
    </ol>
    <div >
        <div class="dropdown" style="display: inline-block;">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="glyphicon glyphicon-filter"></i>
                Filtrer
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="{{url('project/'.$project->id.'/tasks/ended')}}">Achevées</a></li>
                <li><a href="{{url('project/'.$project->id.'/tasks/pending')}}">En cours</a></li>
            </ul>
        </div>
        <div class="dropdown" style="display: inline-block;margin-left: 15px;">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="glyphicon glyphicon-sort"></i>
                Trier
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="{{url('project/'.$project->id.'/tasks/sort/title')}}">Titre</a></li>
                <li><a href="{{url('project/'.$project->id.'/tasks/sort/begin')}}">Date de début</a></li>
                <li><a href="{{url('project/'.$project->id.'/tasks/sort/end')}}">Date de de fin</a></li>
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($tasks as $t)
            <?php

            $progress = 0;
            $class = 'progress-bar-primary';
            if($t->ending_date){
                if(Carbon\Carbon::now() <= $t->ending_date  ){
                    if($t->beginning_date->formatLocalized('%d/%m/%Y') != $t->ending_date->formatLocalized('%d/%m/%Y')){
                        $progress = ceil(($t->beginning_date->diffInDays(Carbon\Carbon::now()) / $t->beginning_date->diffInDays($t->ending_date) ) * 100);
                    }else{
                        $progress = 100;
                        $class = 'progress-bar-warning';
                    }
                }else{
                    $progress = 100;
                    $class = 'progress-bar-danger';
                }
            }
            if($t->status == 3){
                $progress = 100;
                $class = 'progress-bar-success';
            }
            ?>
            <div class="col-md-12">
                <div class="item">
                    <div class="clearfix">
                        <h4>
                            <a href="{{ url('project/'.$project->id.'/tasks/'.$t->id) }}">{{ $t->title }}</a>
                            <small class="pull-right">{{ $progress }}%</small>
                        </h4>

                        <h5><small>par </small> {{ $t->author->user->first_name . ' ' . $t->author->user->last_name }}</h5>
                        <p>
                            {{ $t->description }}
                        </p>
                        <a href="#" >{{ count($t->files) }} fichiers</a>
                    </div>
                    <div class="progress xs">
                        <div class="progress-bar {{ $class }}" style="width: {{ $progress }}%;"></div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($project->status==1)
            <div class="col-md-12 col-sm-6" style="margin-top: 20px;">
                <div class="item" style="">
                    <a href="{{ url('project/'.$project->id.'/tasks/create') }}" class="default">
                        <h4>
                            <i class="fa fa-plus"></i>&nbsp;
                            Nouvelle tache
                        </h4>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
