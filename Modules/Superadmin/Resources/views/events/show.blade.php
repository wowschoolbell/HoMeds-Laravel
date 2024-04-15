@extends('layouts.master')

@section('title','Event Detail')
@section('content')
    <div class="container">
        <div class="row p-t-20">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">{{ __('Event Details') }}</h5>
                    </div>                    
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Values</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>{{@$title}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Start Date</th>
                                    <td>{{$start_date}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Category</th>
                                    <td>{{@$category}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Speaker Name</th>
                                    <td>{{@$speaker['name']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{@$speaker['description']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">LinkedIn Link</th>
                                    <td>{{@$speaker['linked_in_link']}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Thumbnail</th>
                                    <td><img src="{{@$image}}" height="150px" width="150px"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{@$address}}</td>
                                </tr>                        
                                <tr>
                                    <th scope="row">Location Link</th>
                                    <td>{{@$location_link}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
