<div class="particular-access" data-row="{{ $ackey }}">
    <div class="table-responsive" style="overflow: inherit;">
        <table class="table table-applicable table-card">
            <tbody>
                <tr class="applicable-col">
                    <td>
                        {{ Form::text("sections[$ptkey][details][$ackey][title]", @$detail['title'], ['class' => "form-control", "placeholder" => "Section Title"]) }}
                    </td>
                    <td>
                        {{ Form::text("sections[$ptkey][details][$ackey][video_link]", @$detail['video_link'], ['class' => "form-control", "placeholder" => "Video Id"]) }}
                    </td>
                    <td>
                        <div class="input-group">
                            {{ Form::select("sections[$ptkey][details][$ackey][section_minute]", $minutes, @$detail['section_minute'], ['class' => "form-control"]) }}
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info b-0 text-white" id="">Minutes</span>
                            </div>
                          </div>
                    </td>
                    <td>
                        {{ Form::number("sections[$ptkey][details][$ackey][sno]", @$detail['sno'], ['class' => "form-control", "placeholder" => "S no"]) }}
                    </td>
                    @if ($ackey != '0')
                        <td>
                            <a href="javascript:void(0);" class="row-delete " title = 'Delete' data-row="{{ $ptkey }}" >
                                <i class="mdi mdi-trash-can delete-icon"></i>
                            </a>
                        </td>
                    @else
                        <td>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
