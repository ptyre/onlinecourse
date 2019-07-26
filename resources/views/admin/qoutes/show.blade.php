@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.qoute.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.qoute.fields.title')</th>
                            <td field-key='title'>{{ $qoute->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.qoute.fields.description')</th>
                            <td field-key='description'>{!! $qoute->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.qoute.fields.picture-qoute')</th>
                            <td field-key='picture_qoute'>@if($qoute->picture_qoute)<a href="{{ asset(env('UPLOAD_PATH').'/' . $qoute->picture_qoute) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $qoute->picture_qoute) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.qoute.fields.show')</th>
                            <td field-key='show'>{{ Form::checkbox("show", 1, $qoute->show == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.qoutes.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
