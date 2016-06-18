@extends('layouts.app')

@section('htmlheader_title')
    Menu
@endsection

@section('main-content')
    <a href={{"type/create"}}>
        <button type="button" class="btn btn-primary">Створити новий розділ меню</button>
    </a>
    <table class="table table-striped">
        <thead>
        <tr>
            <td><b>@if(count($types))Назва@endif</b></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="type/{{ $category->id }}/edit">
                        <button type="button" class="btn btn-warning btn-xs">Редагувати</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop