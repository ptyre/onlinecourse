@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.titlefooter.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.titlefooter.fields.title')</th>
                            <td field-key='title'>{{ $titlefooter->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.titlefooter.fields.qoute')</th>
                            <td field-key='qoute'>{{ $titlefooter->qoute }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.titlefooter.fields.small-descriptive-footer')</th>
                            <td field-key='small_descriptive_footer'>{!! $titlefooter->small_descriptive_footer !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.titlefooters.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


