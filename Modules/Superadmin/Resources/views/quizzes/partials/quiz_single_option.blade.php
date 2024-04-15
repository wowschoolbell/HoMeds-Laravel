<tr data-row="{{ $key }}">
    <td>
        {{ Form::hidden("quiz_option[$key][option_id]", @$option->id) }}
        <div class="custom-control custom-radio custom-control-inline">
            {{ Form::hidden("quiz_option[$key][is_correct]", '0') }}
            {{ Form::radio("quiz_option[$key][is_correct]", '1', @$option->is_correct, ['class' => "custom-control-input single-type", "id" => $key.'-single-type']) }}
            {{ Form::label($key.'-single-type', ' ', ['class' => "custom-control-label"]) }}
        </div>
    </td>
    <td>
        {{ Form::text("quiz_option[$key][option]", @$option->option, ['class' => "form-control custom-text-box"]) }}
    </td>
    <td>
        @if ($key != 0)
        <button type="button" class="btn btn-sm btn-danger mdi mdi-delete row-delete" title="Delete"></button>
        @endif
    </td>
</tr>
