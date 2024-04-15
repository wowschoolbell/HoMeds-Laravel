<div class="fee-particular" id="fee-particular-{{ $ptkey }}" data-row="{{ $ptkey }}">
    <div class="card m-b-10 custom-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover fees-particulars">
                    <thead>
                        <tr>
                            <th>Section Name *</th>
                            <th>Section Number</th>
                            @if ($ptkey != '0')
                                <th>
                                    <a href="#" class="delete-text remove-particular row-delete" title = 'Delete'>
                                        <i class="mdi mdi-trash-can delete-icon "></i>
                                    </a>
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ Form::text("sections[$ptkey][section_name]", @$section['section_name'], ['class' => "form-control", 'placeholder'=>"Section Name"]) }}
                            </td>
                            <td>
                                {{ Form::text("sections[$ptkey][section_number]", @$section['section_number'], ['class' => "form-control",  'placeholder'=>"Section Number"]) }}
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h5 class="m-b-0">
                <div class="applicable">
                    Section Details
                    <button data-row="{{ $ptkey }}" type="button" class="btn m-b-15 m-t-15 btn-success add-particular-access float-right">
                        <i class="mdi mdi-plus mr-1"></i>Assign
                    </button>
                </div>
            </h5>
            {{-- Particular Applicables --}}
            <div id="particular-accesses-{{ $ptkey }}">
                @php
                    $details = @$section['details'] ?: [1] ;
                @endphp

                {{-- Foreach --}}
                @foreach ($details as $ackey => $detail)
                    @include('superadmin::courses.partials.access')
                @endforeach
                {{-- End --}}
            </div>


        </div>
    </div>
</div>
