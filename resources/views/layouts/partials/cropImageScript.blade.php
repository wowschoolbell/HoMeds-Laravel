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
    </script>
@endpush
