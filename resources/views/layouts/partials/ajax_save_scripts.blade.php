@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        let saveNext  = false;
        let mailPreview = false;
        ajaxSave();
        documentFileNameCall();

        $('body').on('click', '.record-delete', function () {
            $this = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                    $.ajax({
                        method: 'DELETE',
                        url: $this.data('url'),
                        success: function () {
                            swal({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                type: "success",
                            }).then((success_result) => {
                                if (success_result.value) {
                                    if(typeof $this.data('redirect') != 'undefined') {
                                        window.location = $this.data('redirect');
                                    }
                                    else {
                                        location.reload();
                                    }
                                }
                            });
                        },
                        error: function (jqXhr) {
                            swalError(jqXhr);
                        }
                    });
                }
            });
        });
    });

    function ajaxSave()
    {
        $('#save_next').attr("disabled",true);
        $("body").on('submit', '.ajax_form', function (e) {
            e.preventDefault();
            if (typeof saveNext != 'undefined' && saveNext == true) {
                $('#save_next').attr("disabled", false);
            } else {
                $('#save_next').attr("disabled", true);
            }
            var formEl = $(this);
            var submitButton = formEl.find(":submit:focus");
            var submitHtml = submitButton.html();
            $.ajax({
                method: formEl.attr('method'),
                url: formEl.attr('action'),
                data:new FormData(this),//serialize() cannot serialize the files(images, docs, etc...). So,we using Formdata().
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".save-next, .save-org").attr('disabled', 'disabled');
                    submitButton.prop('disabled', 'disabled').html('Please wait...');
                },
                complete: function () {
                    $(".save-next, .save-org").attr("disabled", false);
                    submitButton.prop('disabled', false).html(submitHtml);
                },
                success: function (data) {
                    if (typeof saveNext != 'undefined' && saveNext == true && mailPreview == true) {
                        $('.preview-mail').html(data);
                        saveNext = false;
                        mailPreview = false;

                        return true;
                    }
                    swal({
                        title: data.title,
                        text: data.message,
                        buttons: true,
                        type: "success",
                    })
                    .then((success_result) => {
                        if (success_result.value) {
                            if(typeof data.redirect != 'undefined') {
                                window.location = data.redirect;
                            } else {
                                location.reload();
                            }
                        }
                    });
                },
                error: function (jqXhr) {
                    swalError(jqXhr);
                }
            });

            return false;
        });
    }

    function documentFileNameCall()
    {
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            fileName = !fileName ? "Choose file" : fileName;
            if(fileName.length > 37) {
                fileName = fileName.substring(0, 37)+'...';
            }
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    }

</script>
@endpush
