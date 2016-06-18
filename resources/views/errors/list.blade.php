@if ($errors->any())
    <div class="message">
        <Span class="m">
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
            </Span>
    </div>
@endif