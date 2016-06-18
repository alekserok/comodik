@extends('layouts.app')

@section('htmlheader_title')
    Pages
@endsection

@section('main-content')
    <h1>Редагувати сторінку </h1> <br> <b>{{ $page->title }}</b>
    @include('errors.list')
    <hr/>

    {!! Form::model($page,['method'=>'PUT', 'action'=>['PageController@update', $page->id], 'files'=>true]) !!}

    @include('page.form', ['submitButtonText' => 'Сохранить'])

    {!! Form::close() !!}

@stop