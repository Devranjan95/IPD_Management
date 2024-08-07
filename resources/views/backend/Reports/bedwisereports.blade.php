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
                                        <h3 class="headingcolor">Bed Reports</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Bed Reports</li>
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
                                            <th>Bed Name</th>
                                            <th style="text-align:center">Total Beds</th>
                                            <th style="text-align:center">Total Patients</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bedInfos as $index => $bed)
                                            <tr>
                                                <td style="text-align:center">{{ $index + 1 }}</td>
                                                <td>{{ $bed['bedname'] }}</td>
                                                <td style="text-align:center">{{ $bed['totalbed'] }}</td>
                                                <td style="text-align:center">{{ $bed['totalPatient'] }}</td> <!-- Assuming 'total' is the total number of patients for now -->
                                                <!-- <td>
                                                    See Details
                                                </td> -->
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