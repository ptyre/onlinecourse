@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.titlefooter.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.titlefooters.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.titlefooter.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('qoute', trans('quickadmin.titlefooter.fields.qoute').'', ['class' => 'control-label']) !!}
                    {!! Form::text('qoute', old('qoute'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('qoute'))
                        <p class="help-block">
                            {{ $errors->first('qoute') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('small_descriptive_footer', trans('quickadmin.titlefooter.fields.small-descriptive-footer').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('small_descriptive_footer', old('small_descriptive_footer'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('small_descriptive_footer'))
                        <p class="help-block">
                            {{ $errors->first('small_descriptive_footer') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

