@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.register.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.register.fields.title-register')</th>
                            <td field-key='title_register'>{{ $register->title_register }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.register.fields.deskripsi-register')</th>
                            <td field-key='deskripsi_register'>{!! $register->deskripsi_register !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.register.fields.show')</th>
                            <td field-key='show'>{{ Form::checkbox("show", 1, $register->show == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.registers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
