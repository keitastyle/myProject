<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 16:48
 */
?>

@extends('layouts.master')

@section('title', $project->title)

@section('style-link')
    <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li><a href="{{ url('/project/'.$project->id) }}">{{ $project->title }}</a></li>
        <li><a href="{{ url('/project/'.$project->id.'/tasks') }}">Tâches</a></li>
        <li class="active">Nouvelle tache</li>
    </ol>
    <div class="row">
        <form action="{{ url('/project/'.$project->id.'/tasks/create') }}" method="post" role="form" class="col-md-6">
            {{ csrf_field() }}
            <div>
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="title" id="titre" placeholder="Titre" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Description de la tâche" ></textarea>
                </div>

                <div class="form-group">
                    <label for="membres">Attribuée à</label>
                    <select name="author_id" class="form-control selectize" placeholder="Membre">
                        <option>Membre</option>
                            @foreach($project->students as $s)
                            <option value="{{ $s->id }}">{{ $s->user->first_name .' '. $s->user->last_name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dateD">Date de début</label>
                    <input type="text" class="form-control datepicker" name="dateD" id="dateD" placeholder="jj/mm/aaaa" required>
                </div>
                <div class="form-group">
                    <label for="dateF">Date de fin</label>
                    <input type="text" class="form-control datepicker" name="dateF" id="dateD" placeholder="jj/mm/aaaa">
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </form>
        <div class="col-md-6">
            <h3>Modifier</h3>
            @foreach($tasks as $t)
            <div class="item">
                <div class="clearfix">
                    <h4>
                        <a href="{{ url('project/'.$t->project_id.'/tasks/'.$t->id.'/edit') }}">{{ $t->title }}</a>
                        <small class="pull-right">90%</small>
                    </h4>

                    <h5><small>par </small> ...</h5>
                    <p>
                        {{ $t->description }}
                    </p>
                    <a href="#" >{{ count($t->files) }} fichiers</a>
                    <br>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection