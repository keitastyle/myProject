<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 22:21
 */
?>

@extends('layouts.master')
@section('style-link')
    <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Accueil</a></li>

    </ol>
    <div>
        <div class="dropdown" style="display: inline-block;">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                Filtrer
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="{{url('project/all')}}">Tous</a></li>
                <li><a href="{{url('project/sort/ended')}}">Achevés</a></li>
                <li><a href="{{url('project/sort/pending')}}">En cours</a></li>
                <li><a href="{{url('project/sort/canceled')}}">Annulés</a></li>
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($projects as $p)
            <div style="">
                <div class="col-md-12">
                    <div class="item">
                        <h4>
                            <a href="{{ url('project/'.$p->id) }}">{{ $p->title }}</a>
                        </h4>


                            <h5>
                                <small>avec </small> @foreach($p->students as $s)
                                 {{ $s->user->first_name . ' ' . $s->user->last_name }},
                                @endforeach
                            </h5>

                        <p>
                            {{ $p->description }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
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
