
function isUpperCase()
{
    $(".uppercase").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });
}

function swalError(jqXhr)
{
    swal({
        title: errorTitle(jqXhr),
        html: errorMessage(jqXhr),
        type: 'error'
    });
}

function isPriceNumber(evt, element) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function isNumber(evt, value) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 48 || charCode > 57))
    {
        return false;
    }

    var maxChars = 10
    if ((value.toString().length > maxChars)) {
        return false;
    }

    return true;
}

function select2_without_search()
{
    $('.select2-wos').select2({
        minimumResultsForSearch: Infinity
    });
}

function select2_with_search()
{
    $('.select2-ws').select2();
}

function documentname_call()
{
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        fileName = !fileName ? "Choose file" : fileName;
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
}

function errorMessage(jqXhr)
{
    html = '<ul style="list-style-type: none;">';
    if (jqXhr.status === 401){
        html += '<li>Authentication Error</li>';
    }else if (jqXhr.status === 403) {
        html += '<li>Access Denied</li>';
    }else if (jqXhr.status === 422) {
        if(typeof jqXhr.responseJSON != 'undefined'){
            if (typeof jqXhr.responseJSON.errors != 'undefined') {
                //Errors list
                $errors = jqXhr.responseJSON.errors;
                $.each($errors, function (key, value) {
                    html += '<li>' + value[0] + '</li>';
                });
            }else if (typeof jqXhr.responseJSON.message != 'undefined') {
                //Message
                html += '<li>' + jqXhr.responseJSON.message + '</li>';
            }
        }else{
            html += '<li>Validation error</li>';
        }
    }else{
        if(typeof jqXhr.responseJSON != 'undefined'){
            if (typeof jqXhr.responseJSON.message != 'undefined') {
                //Message
                html += '<li>' + jqXhr.responseJSON.message + '</li>';
            }
        }else{
            html += '<li>Internal server error</li>';
        }
    }
    html += '</ul>';
    return html;
}

function errorTitle(jqXhr)
{
    var err = 'Something went wrong';

    if(jqXhr.status == 422){
        err = 'The given data was invalid';
    }

    return err;
}

$(document).ready(function () {

    $('ul.menu li.parent-li').each(function () {
        if($(this).find('ul.sub-menu').length){
            if($.trim($(this).find('ul.sub-menu').text()).length == 0)
            {
                $(this).remove();
            }
        }
    });

    //Delete
    $('body').on('click', '.row-delete', function(){
        $(this).tooltip('hide');
        $(this).parents('tr').remove();
    });

    $(document).on("keypress", ".isnumeric", function(){
        return isNumber(event, $(this).val())
    });

    $(".password_hide_show").on('click',function() {
        var $pwd = $(this).closest('.password').find('.pwd');
        if ($pwd.attr('type') === 'password') {
            $(this).find('i').removeClass('mdi-eye-off').addClass('mdi-eye');
            $pwd.attr('type', 'text');
        } else {
            $(this).find('i').removeClass('mdi-eye').addClass('mdi-eye-off');
            $pwd.attr('type', 'password');
        }
    });

    isUpperCase();
    select2_without_search();
    select2_with_search();
    documentname_call();

    /* Delete action in Course listing page */
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
                        });
                        location.reload();
                    },
                    error: function (jqXhr) {
                        swalError(jqXhr);
                    }
                });
            }
        });
    });

    /* Popup side form & Ajax form submission */
    $("body").on('submit', '.popup_form', function (e) {
        e.preventDefault();
        var formEl = $(this);
        var submitButton = formEl.find(':submit:last');
        var submitHtml = submitButton.html();

        $.ajax({
            method: formEl.attr('method'),
            url: formEl.attr('action'),
            data:new FormData(this),//serialize() cannot serialize the files(images, docs, etc...). So,we using Formdata().
            contentType: false,
            processData: false,
            beforeSend: function () {
                submitButton.prop('disabled', 'disabled').html('Please wait...');
            },
            complete: function () {
                submitButton.prop('disabled', false).html(submitHtml);
            },
            success: function (data) {

                console.log(data);
                swal({
                    title: data.title,
                    text: data.message,
                    buttons: true,
                })
                window.location = data.redirect;
                
                // ,function(){ 
                //     location.reload();
                // }
                // .then((success_result) => {
                //     if (success_result.value) {
                //         console.log(data.redirect);
                //         if(typeof data.redirect != 'undefined')
                //         {
                //             window.location = data.redirect;
                //         }
                //         else
                //         {
                //             location.reload();
                //         }
                //     }
                // });
            },
            error: function (data) {
                var errors = '';
                for(datos in data.responseJSON['message']){
                    errors += data.responseJSON['message'][datos] + '<br>';
                }
                swal("Validation Error", errors, "error");
            }
        });

        return false;
    });

    $(document).on("keypress", ".pricebox", function(){
        return isPriceNumber(event, this)
    });

    // ==============================================================
    // Auto select left navbar
    // ==============================================================
    // $(function () {
    //Hide by Nad.
        // var url = window.location.href;

        // var element = $('ul#sidebarnav a').filter(function () {
        //     return this.href == url;
        // }).parent().addClass('active');

        // while (true) {
        //     if (element.is('li')) {
        //         element = element.parent().css('display', 'block').parent().addClass('opened');
        //     }
        //     else {
        //         break;
        //     }
        // }
    //Hide by Nad.
    // });

    /* Subjects display in dropdown based on batch selection */
    $(".selectbatch").change(function(){
        var batchId = $(this).val();
        var placeholder = $("#subject_id option[value='']").text();
        if(batchId)
        {
            $.ajax({
                url: $(this).data('url'),
                type: "GET",
                dataType: "JSON",
                data: { batch_id: batchId },
                success: function(data){
                    $('#subject_id').empty().append('<option value="">'+placeholder+'</option>');
                    $.each(data, function(key, value) {
                        $('#subject_id').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        }
        else
        {
            $('#subject_id').empty().append('<option value="">'+placeholder+'</option>');
        }
    });

    /*datatable spinner (VS)*/
    $("div.dataTables_wrapper div.dataTables_processing").removeClass("card");

});
