<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/04/2016
 * Time: 16:47
 */
?>

@extends('layouts.master')

@section('title', 'Nouveau projet')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li class="active">Nouveau projet</li>
    </ol>
    <div class="row">
        <form action="{{ url('project/create') }}" method="POST" role="form" class="col-md-6">
            {{ csrf_field() }}
            <div>
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="title" id="titre" placeholder="Titre" required>
                </div>
                <div class="form-group">
                    <label for="theme">Thème</label>
                    <input type="text" class="form-control" name="theme" id="theme" placeholder="Thème" required>
                </div>

                <div class="form-group">
                    <label >Type :</label>
                    <select name="type" class="form-control">
                        <option>PFE</option>
                        <option>Doctorat</option>
                        <option>Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Description du projet" ></textarea>
                </div>

                <div class="form-group">
                    <label for="membres">Membres</label>
                    <input type="text" name="members" class="form-control selectize-add" placeholder="xyz@exemple.com" required>
                </div>
                <div class="form-group">
                    <label for="dateD">Date de début</label>
                    <input type="text" class="form-control datepicker" name="beginning_date" id="dateD" placeholder="jj/mm/aaaa" required>
                </div>
                <div class="form-group">
                    <label for="dateF">Date de fin <em>Non requis</em></label>
                    <input type="text" class="form-control datepicker" name="ending_date" id="dateD" placeholder="jj/mm/aaaa">
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </form>
        <div class="col-md-6">
            @foreach($projects as $p)
            <h3>Modifier</h3>
            <div class="item">
                <a href="{{ url('project/'.$p->id.'/edit') }}">
                    <h4>
                        {{ $p->title }}
                    </h4>
                </a>
                <h5>
                    {{ $p->theme }} <sup>{{ $p->type }}</sup>
                </h5>
                <p>
                    {{ $p->description }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
@endsection