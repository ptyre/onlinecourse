@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.titles.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('title').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('header_photo', trans('header-photo').'', ['class' => 'control-label']) !!}
                    {!! Form::file('header_photo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('header_photo_max_size', 2) !!}
                    {!! Form::hidden('header_photo_max_width', 4096) !!}
                    {!! Form::hidden('header_photo_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('header_photo'))
                        <p class="help-block">
                            {{ $errors->first('header_photo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type', trans('type').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('type', 'index', false, []) !!}
                            INDEX
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'news', false, []) !!}
                            NEWS
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'contact', false, []) !!}
                            CONTACT
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'teacher', false, []) !!}
                            TEACHER
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('show', trans('show').'', ['class' => 'control-label']) !!}
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

