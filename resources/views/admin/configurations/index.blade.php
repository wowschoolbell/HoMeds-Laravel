@extends('layouts.master')
@section('title', 'Store')

@section('content')
    <div class="container " style="margin-top: 3%;">
        <div class="row">
            <div class="col-lg-3">
                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="text-center" >
                            <img src="{{ url('images/state.png')}}" class="rounded-circle" width="80" alt="">
                        </div>
                        <h4 class="text-center m-t-20">
                            States
                        </h4>
                        <div class="text-muted text-center m-b-20">
                            No of states : {{$statesCount}}
                        </div>
                        <div class="text-center p-b-20">

                            <a href="{{ route('admin.states.index') }}" class="btn btn-primary btn-dark-lavender">
                                <i class="mdi mdi-view-list"></i> Lists
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-dark-lavender">
                                <i class="mdi mdi-import"></i> Import
                            </a>
                        </div>
                    </div>
                </div>
                <!--widget card ends-->
            </div>
            <div class="col-lg-3">
                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="text-center" >
                            <img src="{{ url('images/city.webp')}}" class="rounded-circle" width="80" alt="">
                        </div>
                        <h4 class="text-center m-t-20">
                            Cities
                        </h4>
                        <div class="text-muted text-center m-b-20">
                            No of cities : {{$citiesCount}}
                        </div>
                        <div class="text-center p-b-20">

                            <a href="{{ route('admin.cities.index') }}" class="btn btn-primary btn-dark-lavender">
                                <i class="mdi mdi-view-list"></i> Lists
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-dark-lavender">
                                <i class="mdi mdi-import"></i> Import
                            </a>
                        </div>
                    </div>
                </div>
                <!--widget card ends-->
            </div>
        </div>
    </div>
@endsection