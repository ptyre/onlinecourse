@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.question-option.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.question-option.fields.question')</th>
                            <td field-key='question'>{{ $question_option->question->question ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question-option.fields.option-text')</th>
                            <td field-key='option_text'>{!! $question_option->option_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.question-option.fields.correct')</th>
                            <td field-key='correct'>{{ Form::checkbox("correct", 1, $question_option->correct == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.question_options.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


