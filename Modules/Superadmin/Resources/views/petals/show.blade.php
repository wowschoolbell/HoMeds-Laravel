@extends('layouts.master')

@section('title','Courses')
@section('content')
    <div class="container">
        <div class="row p-t-20">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">{{ __('Course Details') }}</h5>
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
                                    <th scope="row">Category</th>
                                    <td>{{$categoryName}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sub Category</th>
                                    <td>{{@$subCategoryName}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{!! @$description !!}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Image</th>
                                    <td><img src="{{@$image}}" height="100" width="100"></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Video Hours</th>
                                    <th scope="col">Quizzes</th>
                                    <th scope="col">Assignments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{@$video_hours}}</th>
                                    <td>{{@$quizzes}}</td>
                                    <td>{{@$assignments}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Other Details</th>
                                    <th scope="col">Values</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Language</th>
                                    <td>{{@$language}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">CC Language</th>
                                    <td>{{$cc_language}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Course Items</th>
                                    <td>{{@$course_items}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tags</th>
                                    <td>{{ @$tags }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if(@$benefits || is_array(@$benefits))
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" scope="col">Benefits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($benefits as $benefit)
                                    <tr>
                                        <th>{{@$benefit['data']}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        @if(@$faqs || is_array(@$faqs))
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" scope="col">FAQ</th>
                                </tr>
                            </thead>
                            <thead class="table-light">
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faqs as $faq)
                                    <tr>
                                        <th>{{@$faq['question']}}</th>
                                        <td>{{@$faq['answer']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @endif
                        @if(@$sections || is_array(@$sections))
                        @foreach($sections as $key => $section)
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="2" scope="col">sections {{$key + 1}}</th>
                                    </tr>
                                </thead>
                                <thead class="table-light">
                                    <tr>
                                        <th>Section Name</th>
                                        <th>Section Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{@$section['section_name']}}</th>
                                        <td>{{@$section['section_number']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tile</th>
                                        <th>Video Id</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(@$section['details'] || is_array(@$section['details']))
                                    @foreach($section['details'] as $detail)
                                        <tr>
                                            <th>{{@$detail['title']}}</th>
                                            <td>
                                                @php
                                                    $embedUrlLink = App\User::embedUrlLink(@$detail['video_link']);
                                                @endphp
                                                <iframe src="{{ $embedUrlLink }}" 
                                                    frameborder="0" allow="autoplay" 
                                                    allowtransparency="true" scrolling="no" 
                                                    allowfullscreen=""
                                                    style="object-fit: cover; object-position: center;" width="100%"; height="300px";>
                                                </iframe> 
                                            </td>
                                            <td>{{@$detail['time']}}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
