<div class="card m-t-0">
    <div class="card-header">
        <h5 class="text-bg-dark rounded"> <i class="mdi mdi-table-large"></i>
            Tickets Status per category  </h5>
    </div>
    <div class="card-controls">
        @php
            $status = ['M' => 'My Self','A' => 'All'];
        @endphp
        {{ Form::select('ticketscategory', @$status ,'', ['class' => "form-control select2 ", 'placeholder'=> @$placeholder, 'id'=>'ticketscategory']) }}
    </div>
    <div class="card-body widget-chart">
        <div class="card-body admin-sidebar-wrapper js-scrollbar tab-content pre-scrollable">
            <div class="vps-ticketscategory">
                @include('layouts.partials.get_tickets_details_table')
            </div>

            @if(@$complaints_details->isempty())
                <h6 class="text-danger text-center">No Data</h6>
            @endif
        </div>
    </div>
</div>
@push('stylesheets')
<style>
    .pre-scrollable
    {
        max-height: 300px;
    }
    .tptickets{
        height: 344px;
    }
</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function ()
    {
        $("body").on("change", '#ticketscategory',function(){
            var value= $(this).val();
            var Url = `/home/Ticketscategory/?value= ${value}`;
            $.ajax({
                method: 'GET',
                url: Url,
                data:{ value:value },
                success: function (data) {
                    $(".vps-ticketscategory").html(data);
                }
            });
        });

    });
</script>
@endpush