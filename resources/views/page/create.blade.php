@extends('layouts.app')

@section('htmlheader_title')
    Pages
@endsection

@section('main-content')
    <h1>Створити сторінку</h1>
    @include('errors.list')
    <hr/>

    {!! Form::open(['url'=>'/admin/page', 'method' => 'POST', 'files'=>true]) !!}

    @include('page.form', ['submitButtonText' => 'Create'])

    {!! Form::close() !!}
@stop