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
                                        <h3 class="headingcolor">Discharge Reports</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Discharge Reports</li>
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
                                            <th>Patient Contact</th>
                                            <th>Patient Email</th>
                                            <th>Addmission Date</th>
                                            <th>Addmission Time</th>
                                            <th>Discharge Date</th>
                                            <th>Discharge Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($dischargedTokens as $index=>$token)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$token->patient->patient_regn_no}}</td>
                                                <td>{{$token->patient->patient_name}}</td>
                                                <td>{{$token->patient->patient_phone}}</td>
                                                @if(isset($token->patient->patient_email))
                                                    <td>{{$token->patient->patient_email}}</td>
                                                @else
                                                    <td>Email not provided</td>
                                                @endif
                                                <td>{{\Carbon\Carbon::parse($token->date_of_addmission)->format('d/m/Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($token->time_of_addmission)->format('h:i A')}}</td>
                                                @if(isset($token->date_of_discharge) && isset($token->time_of_discharge))
                                                <td>{{\Carbon\Carbon::parse($token->date_of_discharge)->format('d/m/Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($token->time_of_discharge)->format('h:i A')}}</td>
                                                @else
                                                <td>Not available</td>
                                                <td>Not available</td>
                                                @endif
                                                <td>See Details</td>
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