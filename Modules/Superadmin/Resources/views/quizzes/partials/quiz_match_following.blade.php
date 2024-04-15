<tr data-row="{{ $key }}">
    <td>
        {{ Form::textarea("quiz_option[$key][question]", @$option['question'], ['class' => "form-control custom-text-box", 'rows' => 3]) }}
        {{ Form::hidden("quiz_option[$key][key]", $key, ['class' => "form-control keys"]) }}
    </td>
    <td>
        <div class="form-row">
            <div class="form-group col-md-2 draggable">
                <div class="avatar avatar-sm">
                    <div class="avatar-title rounded-circle mf-no" style="background-color:#5269CA">
                        {{$key + 1}}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-10">
                {{ Form::textarea("quiz_option[$key][answer]", @$option['answer'], ['class' => "form-control custom-text-box", 'rows' => 3]) }}
            </div>
        </div>
    </td>
    <td class="sufffle-option">
        {{ Form::select("quiz_option[$key][shuffle_answer]", @$suffledOptions ?: [], @$option['shuffle_answer'], ['class' => "form-control amhl-select2-ws sufffle-options", 'placeholder' =>'--Shuffle--' ]) }}
    </td>
    <td>
        @if ($key != 0)
        <button type="button" class="btn btn-sm btn-danger mdi mdi-delete row-delete" title="Delete"></button>
        @endif
    </td>
</tr>
