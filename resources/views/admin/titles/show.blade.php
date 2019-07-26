@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.title.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.title.fields.title')</th>
                            <td field-key='title'>{{ $title->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.title.fields.header-photo')</th>
                            <td field-key='header_photo'>@if($title->header_photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $title->header_photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $title->header_photo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.title.fields.type')</th>
                            <td field-key='type'>{{ $title->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.title.fields.show')</th>
                            <td field-key='show'>{{ Form::checkbox("show", 1, $title->show == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.titles.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


