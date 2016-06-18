@extends('layouts.app')

@section('htmlheader_title')
    Menu
@endsection

@section('main-content')
    <h1>Створити новий пункт меню</h1>
    @include('errors.list')
    <hr/>

    {!! Form::open(['url'=>'admin/type']) !!}

    @include('type.form', ['submitButtonText' => 'Створити'])

    {!! Form::close() !!}
@stop