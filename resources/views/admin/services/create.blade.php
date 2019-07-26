@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.service.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.services.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title_service', trans('quickadmin.service.fields.title-service').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title_service', old('title_service'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title_service'))
                        <p class="help-block">
                            {{ $errors->first('title_service') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.service.fields.description').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('photo_service', trans('quickadmin.service.fields.photo-service').'', ['class' => 'control-label']) !!}
                    {!! Form::text('photo_service', old('photo_service'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_service'))
                        <p class="help-block">
                            {{ $errors->first('photo_service') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('show', trans('quickadmin.service.fields.show').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('show', 0) !!}
                    {!! Form::checkbox('show', 1, old('show', false), []) !!}
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

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
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