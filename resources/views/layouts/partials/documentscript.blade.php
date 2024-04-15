@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.tmpl.js') }}"></script>
    <script id="DocumentFormTemplate" type="text/x-jquery-tmpl">
        <tr>
             <td class="dynamic"></td>
            <td> {!! Form::text('document[${key}][filename]',' ', ['class' => 'form-control fileName']) !!}</td>
            <td>
                <span class="custom-file">
                    {{ Form::file('document[${key}][file]',['class' => 'custom-file-input documentFile','id' => 'inputGroupFile02']) }}
                    {{ Form::label('inputGroupFile02', 'Choose File', ['class' => 'custom-file-label']) }}
                </span>
            </td>
            <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
        </tr>
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var key= {{ $i + 1 }};
            sortserialnumber()

            $('#addDocumentRow').click(function () {
                var validation = 0;
                $(`tbody tr`).each(function(){
                    let $tr = $(this).closest('tr');

                    if ( $tr.find(`.fileName`).val() == 0 || $tr.find(`.documentFile`).val() == 0 )
                    {
                        validation = 1
                        return false;
                    }
                });
                if(validation == 1) {
                    swal("Empty Row", "Some fields are empty", "warning");
                    return false;
                }

                if($('.custom-file-input').length >= 5)
                {
                    swal({
                        title: "Warning",
                        text: "Only 5 rows allowed !",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, got it!",
                    })
                    return false;
                }
                var formfields = [{
                        key: key++
                    }];
                $("#DocumentFormTemplate").tmpl(formfields).appendTo(".document-add");
                sortserialnumber()
                documentname_call() //custom.js
            });
            $('body').on('click', '.row-delete', function(){
                sortserialnumber();
            });
        });
        function sortserialnumber()
        {
            $('.dynamic').each(function(idx, elem){
                $(elem).text(idx+1);
            });

        }
    </script>
@endpush
