<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 00:25
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
        <li class="active">Historique</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tbody>
                    @foreach($historics as $i)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object circle img-circle" src="{{ asset('uploads/img/profile_pics/' . $i->author->picture) }}" alt="..." width="40" height="40">
                                    </a>
                                </div>
                                <div class="media-body media-middle">
                                    {!! '<a href="#">'. $i->author->first_name . ' ' . $i->author->last_name . '</a> ' . $i->content !!}
                                    <span class="pull-right">
                                        {{ $i->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

