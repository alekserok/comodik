@extends('layouts.app')

@section('htmlheader_title')
    Pages
@endsection

@section('main-content')
    <style>
        .edit_btn{
            margin-top: 20px;
        }

        .image{
            width: 179px;
            height: 157px;
            -ms-background-position-x: center;
            -ms-background-position-y: bottom;
            background-position: center center;
            background-size: cover;
        }
    </style>
    <a href={!! 'page/create' !!} }}><button type="button" class="btn btn-primary" style="margin-bottom: 20px">Створити нову</button></a>
    @foreach($pages as $article)
        <div class="panel panel-default">
            <div class="panel-body">
                <article>
                    <div class="media">
                        <div class="media-left media-middle">
                            <div class="media-object image" style="background-image: url({{ $article->image }});"></div>
                        </div>
                        <div class="media-body">
                            <a href="{{ 'page/'. $article->id }}/edit"><h2>{{ $article->title }}</h2></a>
                            <div class="body">{!! $article->description !!}</div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="btn-group edit_btn" role="group" aria-label="...">
                                        <a href="{{ 'page/' . $article->id }}/edit"><button type="button" class="btn btn-warning">Редагувати</button></a>
                                        {!! Form::open(array('url' => 'admin/page/' . $article->id, 'class' => 'pull-left', 'style' => 'margin-right: 4px;')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::submit('Видалити', array('class' => 'btn btn-danger')) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p style="padding-top: 20px">{{ $article->created_at }}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </article>
            </div>
        </div>
    @endforeach


@stop