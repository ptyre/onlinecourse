@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.commentstudent.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.commentstudent.fields.name')</th>
                            <td field-key='name'>{{ $commentstudent->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentstudent.fields.deskripsi')</th>
                            <td field-key='deskripsi'>{!! $commentstudent->deskripsi !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentstudent.fields.photo-comment')</th>
                            <td field-key='photo_comment'>@if($commentstudent->photo_comment)<a href="{{ asset(env('UPLOAD_PATH').'/' . $commentstudent->photo_comment) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $commentstudent->photo_comment) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentstudent.fields.job')</th>
                            <td field-key='job'>{{ $commentstudent->job }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentstudent.fields.show')</th>
                            <td field-key='show'>{{ Form::checkbox("show", 1, $commentstudent->show == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.commentstudents.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
