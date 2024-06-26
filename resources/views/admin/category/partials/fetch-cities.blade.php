@if($table == 1)
    <div class="table-responsive">
        <table class="table table-hover align-td-middle fetch-address-table">
            <thead>
            <tr>
                <th>Select</th>
                <th>Area</th>
                <th>City</th>
                <th>State</th>
                <th>Pincode</th>
            </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                <tr>
                    <td>
                        <label class="cstm-switch">
                            <input type="checkbox" name="option" value="{{$city->id}}" data-id="{{$city->id}}" class="cstm-switch-input {{$select_class_name}}">
                            <span class="cstm-switch-indicator bg-success"></span>
                        </label>
                    </td>
                    <td>{{ $city->area }}</td>
                    <td>{{ $city->city }}</td>
                    <td>{{ $city->state->name }}</td>
                    <td>{{ $city->pincode }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    @if ($drop)
        <tr class="<?php echo "drop-address-row-".$city->id ?>">
            <td>{{ $city->area }}</td>
            <td>{{ $city->city }}</td>
            <td>{{ $city->state->name }}</td>
            <td>{{ $city->pincode }}</td>
            <td>
                {{ Form::text('delivery_partner[drop_city_id][0]', $city->id, ['class' => "form-control drop-city-id", 'hidden' => 'true']) }}
                <button class="btn btn-sm btn-danger remove-drop-address" type="button" title="Delete" ><i class="mdi mdi-trash-can-outline"></i></button>
            </td>
        </tr>
    @else
        <div class="form-group col-md-6 can-hide">
            {{ Form::label('delivery_partner[area]', __('Area')) }}
            {{ Form::text('delivery_partner[area]', $city->area, ['class' => "form-control", 'disabled' => 'true']) }}
            {{ Form::text('city_id', $city->id, ['class' => "form-control", 'hidden' => 'true']) }}
        </div>
        <div class="form-group col-md-6 can-hide">
            {{ Form::label('delivery_partner[city]', __('City')) }}
            {{ Form::text('delivery_partner[city]', $city->city, ['class' => "form-control", 'disabled' => 'true' ]) }}
        </div>
        <div class="form-group col-md-6 can-hide">
            {{ Form::label('delivery_partner[state]', __('State')) }}
            {{ Form::text('delivery_partner[state]', $city->state->name, ['class' => "form-control", 'disabled' => 'true' ]) }}
        </div>
    @endif
@endif