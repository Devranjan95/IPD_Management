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
                                        <h3 class="headingcolor">Patient Reports</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Patient Reports</li>
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
                                            <th>Total visits</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $sl = 1;
                                        @endphp 
                                        @foreach($patientInfos as $patient)
                                            <tr>
                                                <td>{{$sl++}}</td>
                                                <td>{{$patient->patient_regn_no}}</td>
                                                <td>{{$patient->patient_name}}</td>
                                                <td>{{$patient->patient_phone}}</td>
                                                @if(isset($patient->patient_email))
                                                    <td>{{$patient->patient_email}}</td>
                                                @else
                                                    <td>Email not provided</td>
                                                @endif
                                                <td>{{$patient->total_visits}}</td>
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