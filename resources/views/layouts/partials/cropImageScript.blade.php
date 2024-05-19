@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.avatar-file-picker').on('change', function () {
                $(".profile").removeClass('d-none').addClass('d-block');
                $(".avatar-profile").removeClass('d-block').addClass('d-none');
            });
            $(".upload-result-cancel").click(function(){
                $(".profile").removeClass('d-block').addClass('d-none');
                $(".avatar-profile").removeClass('d-none').addClass('d-block');
            });
        });

        $('#upload').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $uploadCrop = $('#upload-profile').croppie({
            enableExif: true,
            viewport: {
                width: 120,
                height: 120,
                type: 'circle'
            },
            boundary: {
                width: 150,
                height: 150
            }
        });

        $('.upload-result-done').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $(".avatar-img").attr('src',resp);
                $(".cropImage").val(resp);
                $(".profile").removeClass('d-block').addClass('d-none');
                $(".avatar-profile").removeClass('d-none').addClass('d-block');
            });
        });

        $("#address-pincode").keyup(function () {
            $.ajax({
                url: "{{ route('admin.home.fetch-address') }}",
                method:"GET",
                dataType: "json",
                data: {
                    value : $(this).val()
                },
                success: function(data) {
                    $('.fetch-address-details').html(data['html']);

                    chooseAddress();
                }
            });
        });

        function chooseAddress() {
            $('.address-choose').on('change', function () {
                $('.fetch-address-details').html('');

                $.ajax({
                    url: "{{ route('admin.home.fetch-address') }}",
                    method:"GET",
                    dataType: "json",
                    data: {
                        id : $(this).val()
                    },
                    success: function(data) {
                        $('.can-hide').remove();
                        $('.can-append-address-fetch').append(data['html']);

                        chooseAddress();
                    }
                });
            });
        }

        $('#remove-address-pincode').on('click', function (ev) {
            $('#address-pincode').val('');
            $('.can-hide').remove();
        });
        
    </script>
@endpush
