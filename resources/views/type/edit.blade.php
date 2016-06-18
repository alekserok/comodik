@extends('layouts.app')

@section('htmlheader_title')
    Menu
@endsection

@section('main-content')
    <h1>Редагувати розділ меню</h1>
    @include('errors.list')
    <hr/>
    {!! Form::model($type, ['method' => 'PUT', 'action' => ['TypeController@update', $type->id]]) !!}
    {!! Form::hidden('id', $type->id) !!}

    @include('type.form', ['submitButtonText' => 'Зберегти зміни'])

    {!! Form::close() !!}
    <hr>
    @if(count($children)||count($type->pages))
        @if(count($children))
            <h3>Вкладені розділи меню</h3>
            @foreach($children as $sub)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                             <h2>{{ $sub->name }}</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group edit_btn" role="group" aria-label="...">
                                            <a href="/admin/type/{{ $sub->id }}/edit"><button type="button" class="btn btn-warning">Редагувати</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        @endif
    @if(count($type->pages))
            <h3>Сторінки що відносяться до цьго розділу</h3>
            @foreach($type->pages as $page)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <h2>{{ $page->title }}</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group edit_btn" role="group" aria-label="...">
                                            <a href="/admin/page/{{ $page->id }}/edit"><button type="button" class="btn btn-warning">Редагувати</button></a>
                                        </div>
                                        <div class="btn-group edit_btn" role="group" aria-label="...">
                                            {!! Form::open(['action' => ['PageController@destroy', $page->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Видалити', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @else
        <div class="btn-group edit_btn" role="group" aria-label="...">
        {!! Form::open(['action' => ['TypeController@destroy', $type->id], 'method' => 'delete']) !!}
        {!! Form::submit('Видалити', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
        </div>
    @endif
@stop