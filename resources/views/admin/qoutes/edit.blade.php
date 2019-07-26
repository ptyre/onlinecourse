@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.qoute.title')</h3>
    
    {!! Form::model($qoute, ['method' => 'PUT', 'route' => ['admin.qoutes.update', $qoute->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.qoute.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.qoute.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($qoute->picture_qoute)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$qoute->picture_qoute) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$qoute->picture_qoute) }}"></a>
                    @endif
                    {!! Form::label('picture_qoute', trans('quickadmin.qoute.fields.picture-qoute').'', ['class' => 'control-label']) !!}
                    {!! Form::file('picture_qoute', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('picture_qoute_max_size', 2) !!}
                    {!! Form::hidden('picture_qoute_max_width', 4096) !!}
                    {!! Form::hidden('picture_qoute_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('picture_qoute'))
                        <p class="help-block">
                            {{ $errors->first('picture_qoute') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('show', trans('quickadmin.qoute.fields.show').'', ['class' => 'control-label']) !!}
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