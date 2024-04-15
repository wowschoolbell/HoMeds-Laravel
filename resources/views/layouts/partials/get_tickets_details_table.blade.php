<table class="table table-hover ">
    <thead>
        <tr>
            <th>Category</th>
            <th>Total</th>
            <th>Open</th>
            <th>Closed</th>
        </tr>
    </thead>
    <tbody>
        @php
            $route = request()->value == 'A' ? 'tickets' : 'mytickets';
        @endphp
        @foreach ($mycomplaints_details as $item)
            <tr>
                <td>
                    <a href="{{ route($route.'.index',["category" => $item->id]) }}"><i class="mdi mdi-circle  fw-600" style="color:{{@$item->color}}"  ></i> {{@$item->name}} </a>
                </td>
                <td>{{@$item->pending + @$item->solved}}</td>
                <td>{{@$item->pending}}</td>
                <td>{{@$item->solved}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@if(@$mycomplaints_details->isempty())
    <h6 class="text-danger text-center">No Data</h6>
@endif
        