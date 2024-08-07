@extends('masterlayout.masterlayout')

@section('content')
    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                

                <!-- =================================================== -->
                <!-- ========== tables-wrapper start ========== -->
                <div class="card mb-30">
                    <div class="tables-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='row pb-2'>
                                    <div class='col-lg-6'>
                                        <h3 class="headingcolor">Birth Reports</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Birth Reports</li>
                                        </ol>
                                    </nav>
                                    </div>
                                    <!-- <div class='col-lg-6 pb-2'>
                                        <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right"
                                            data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add
                                            New</button>
                                    </div> -->
                                    <!-- <hr style="color:#030d04"> -->
                                </div>
                            </div>
                            <div class='col-lg-12'>
                                <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">Sl</th>
                                            <th>Regn No</th>
                                            <th>Mother's Name</th>
                                            <th>Addmission Date</th>
                                            <th>Addmission Time</th>
                                            <th>Birth Date</th>
                                            <th>Birth Time</th>
                                            <th>New Born Image</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       {{--@php --}}
                                            $sl = 1;
                                       {{--@endphp--}}
                                       {{--@foreach($birthInfos as $birth)-}}
                                            <tr>
                                                <td style="text-align:center">{{$sl++}}</td>
                                                <td>{{--{{$birth->regn}}--}}</td>
                                                <td>{{--{{$birth->patname}}--}}</td>
                                                <td>{{--{{ \Carbon\Carbon::parse($birth->addmission_date)->format('d/m/Y') }}--}}</td>
                                                <td>{{--{{ \Carbon\Carbon::parse($birth->addmission_time)->format('h:i A') }}--}}</td>
                                                <td>{{--{{ \Carbon\Carbon::parse($birth->birthdate)->format('d/m/Y') }}--}}</td>
                                                <td>{{--{{ \Carbon\Carbon::parse($birth->birthtime)->format('h:i A') }}--}}</td>
                                                <td>
                                                    {{--@if($birth->image_path)--}}
                                                        <img src="{{--{{asset($birth->image_path)}}--}}" alt="New Born Image" style="width: 80px;height:80px; display: block; margin: 0 auto;">
                                                    {{--@else--}}
                                                        No Image
                                                    {{--@endif--}}
                                                </td>
                                                <!-- <td>See Details</td> -->
                                            </tr>
                                       {{--@endforeach--}}
                                    </tbody>
                                </table>
                                </div>
                                
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- ========== tables-wrapper end ========== -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')


@endsection