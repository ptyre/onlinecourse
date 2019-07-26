<tr data-index="{{ $index }}">
    <td>{!! Form::text('news['.$index.'][title]', old('news['.$index.'][title]', isset($field) ? $field->title: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('news['.$index.'][writer]', old('news['.$index.'][writer]', isset($field) ? $field->writer: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>