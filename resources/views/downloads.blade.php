@extends('layouts.app')
@section('htmlheader')
    @parent
    <!-- Gallery -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link href="{{ asset('/css/bootstrap-image-gallery.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('htmlheader_title')
    Downloads
@endsection


@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Documents</div>

                    <div class="panel-body">
                        <div class="row" id="links">
                            @foreach($files as $file)
                            <div class="col-xs-6 col-md-3">
                                <p><h5>{{ explode('/', $file)[1] }}</h5><a href="/admin/download/{{ $file }}" class="btn btn-primary" role="button">Download</a></p>
                                <a href="/admin/image/{{ $file }}" class="thumbnail" title="{{ explode('/', $file)[1] }}" data-gallery>
                                    <img src="/admin/image/{{ $file }}" alt="{{ explode('/', $file)[1] }}">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
        <!-- The container for the modal slides -->
        <div class="slides"></div>
        <!-- Controls for the borderless lightbox -->
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
        <!-- The modal dialog, which will be used to wrap the lightbox content -->
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body next"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left prev">
                            <i class="glyphicon glyphicon-chevron-left"></i>
                            Previous
                        </button>
                        <button type="button" class="btn btn-primary next">
                            Next
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
        <!-- Gallery -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="{{ asset('/js/bootstrap-image-gallery.min.js') }}"></script>
    <script>
        $( document ).ready(function () {
            $('#blueimp-gallery').data('useBootstrapModal', false);
            $('#blueimp-gallery').toggleClass('blueimp-gallery-controls', true)
        });
    </script>
@stop
