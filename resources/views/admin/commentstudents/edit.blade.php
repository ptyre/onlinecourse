@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.commentstudent.title')</h3>
    
    {!! Form::model($commentstudent, ['method' => 'PUT', 'route' => ['admin.commentstudents.update', $commentstudent->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.commentstudent.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('deskripsi', trans('quickadmin.commentstudent.fields.deskripsi').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('deskripsi', old('deskripsi'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('deskripsi'))
                        <p class="help-block">
                            {{ $errors->first('deskripsi') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($commentstudent->photo_comment)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$commentstudent->photo_comment) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$commentstudent->photo_comment) }}"></a>
                    @endif
                    {!! Form::label('photo_comment', trans('quickadmin.commentstudent.fields.photo-comment').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_comment', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_comment_max_size', 2) !!}
                    {!! Form::hidden('photo_comment_max_width', 4096) !!}
                    {!! Form::hidden('photo_comment_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_comment'))
                        <p class="help-block">
                            {{ $errors->first('photo_comment') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('job', trans('quickadmin.commentstudent.fields.job').'', ['class' => 'control-label']) !!}
                    {!! Form::text('job', old('job'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('job'))
                        <p class="help-block">
                            {{ $errors->first('job') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('show', trans('quickadmin.commentstudent.fields.show').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('show', 0) !!}
                    {!! Form::checkbox('show', 1, old('show', old('show')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('show'))
                        <p class="help-block">
                            {{ $errors->first('show') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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