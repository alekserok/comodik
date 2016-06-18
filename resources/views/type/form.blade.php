<div class="form-group">
    {!! Form::label('name', 'Назва') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('parent_id', 'Батьківська категорія') !!}
    {!! Form::select('parent_id', $types, $currentType, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>