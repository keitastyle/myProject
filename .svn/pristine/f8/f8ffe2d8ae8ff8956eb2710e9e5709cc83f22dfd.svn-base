<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 27/05/2016
 * Time: 15:01
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
        <li><a href="{{ url('/project/'. $project->id) }}">{{ $project->title }}</a></li>
        <li class="active">Fichiers</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            @foreach($project->tasks as $t)
                @if(count($t->files)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ $t->title }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($t->files as $f)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object circle img-circle" src="{{ asset('uploads/img/profile_pics/' . $f->author->picture) }}" alt="..." width="40" height="40">
                                            </a>
                                        </div>
                                        <div class="media-body media-middle">
                                            <a href="{{ asset('uploads/files/'.$f->link) }}" >
                                                <i class="fa fa-paperclip"></i> {{ $f->title }}
                                            </a>
                                            <span class="pull-right">
                                                {{ $f->created_at->diffForHumans() }}
                                            </span>
                                            <br>
                                            <span class="text-muted">{{ $f->author->first_name . ' ' . $f->author->last_name }} </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            @endforeach

        </div>
    </div>

@endsection
