<script src="{{ asset('theme/light/vendor/jquery/jquery.min.js') }}"   ></script>
<script src="//code.jquery.com/jquery-migrate-3.0.1.js"></script>
<script src="{{ asset('theme/light/vendor/jquery-ui/jquery-ui.min.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/popper/popper.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/bootstrap/js/bootstrap.min.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/select2/js/select2.full.min.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/jquery-scrollbar/jquery.scrollbar.min.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/listjs/listjs.min.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('theme/light/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('theme/light/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('theme/light/vendor/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('theme/light/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"   ></script>
<script src="{{ asset('theme/light/vendor/croppie/croppie.js') }}"   ></script>
<script src="{{ asset('js/bootstrap-multiselect.js') }}"   ></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script> --}}
<script src="{{ asset('theme/light/js/atmos.min.js') }}"></script>
<!--page specific scripts for demo-->
<script src="{{ asset('js/custom.js?v='.File::lastModified('js/custom.js'))  }}"></script>
@stack('scriptsrc')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // sidebar-pinned
     $(document).ready(function(){
        $('#pinToggle').click(function(){
            if($('body').hasClass('sidebar-pinned')){
                localStorage.setItem('sidebar-pinned', false);
            }else{
                localStorage.setItem('sidebar-pinned', true);
            }
        });

        if(localStorage.getItem('sidebar-pinned') === null || localStorage.getItem('sidebar-pinned') == 'true'){
            $('body').addClass('sidebar-pinned');
        }else{
            $('body').removeClass('sidebar-pinned');
        }
    });
     
    // screen loader
    $(window).load(function() {
        $(".loader").fadeOut("slow");
    })
</script>

@stack('scripts')
