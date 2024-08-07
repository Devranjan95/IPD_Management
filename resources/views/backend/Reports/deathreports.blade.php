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
                                        <h3 class="headingcolor">Death Reports</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Death Reports</li>
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
                                            <th>Patient Name</th>
                                            <th>Addmission Date</th>
                                            <th>Addmission Time</th>
                                            <th>Death Date</th>
                                            <th>Death Time</th>
                                            <th>Dead Body Image</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @php 
                                            $sl = 1;
                                       @endphp
                                       @foreach($deathInfos as $death)
                                            <tr>
                                                <td style="text-align:center">{{$sl++}}</td>
                                                <td>{{$death->patient_regn_no}}</td>
                                                <td>{{$death->patient_name}}</td>
                                                <td>{{ \Carbon\Carbon::parse($death->date_of_addmission)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($death->time_of_addmission)->format('h:i A') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($death->date_of_death)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($death->time_of_death)->format('h:i A') }}</td>
                                                <td>
                                                    @if($death->image_path)
                                                        <img src="{{asset($death->image_path)}}" alt="New Born Image" style="width: 80px;height:80px; display: block; margin: 0 auto;">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                                <!-- <td>See Details</td> -->
                                            </tr>
                                       @endforeach
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