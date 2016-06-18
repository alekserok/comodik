<div class="form-group">
    {!! Form::label('type_id', 'Батьківська категорія') !!}
    {!! Form::select('type_id', $types, $currentType, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('body', 'Body') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    @if(isset($page) && $page->image)
        <div id="imgContainer" style="display: block">
            <img id="blah" src="{{ $page->image }}" height="150" />
            <span class="glyphicon glyphicon-remove" aria-hidden="true" onclick=removeImage() style="cursor: pointer"></span>
        </div>
    @else
        <div id="imgContainer" style="display: none">
            <img id="blah" src="#" />
            <span class="glyphicon glyphicon-remove" aria-hidden="true" onclick=removeImage() style="cursor: pointer"></span>
        </div>
    @endif
</div>

<div class="form-group">
    {!! Form::label('file', null, 'Image') !!}
    {!! Form::file('file', ['onchange' => 'readURL(this)']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

{!! Form::text('image', null, ['id'=>'inputFileContainer', 'style' => 'display:none']) !!}

<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                $('#blah').attr('src', e.target.result).height(150);
                $('#imgContainer').css('display','block');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        $('#blah').attr('src', '#').height(0);
        $('#imgContainer').css('display','none');
        $('#inputFileContainer').val('');
    }
    CKEDITOR.replace('body')
</script>