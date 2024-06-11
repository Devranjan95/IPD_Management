@extends('masterlayout.masterlayout')

@section('content')
<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- Title Wrapper Start -->
        <div class="container-wrapper pt-30">
            <!-- Card Start -->
            <div class="card mb-30 shadow-sm border-0">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h3 class="headingcolor">Bed Assign Form</h3>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-secondary"><a href="{{url('masters')}}">Masters</a></li>
                                    <li class="breadcrumb-item text-secondary"><a href="{{url('beds')}}">Beds</a></li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Bed Assign</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <!-- Displaying the details of the selected cabin/ward/icu in the card -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title">{{ ucfirst($type) }} Details</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Occupancy</th>
                                                    <th>Assigned Beds</th>
                                                    <th>Available Beds</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                @if($type == 'cabin')
                                                    
                                                        
                                                        <td>{{ $data->cabin_name }}</td>
                                                    
                                                @elseif($type == 'ward')
                                                    
                                                        
                                                        <td>{{ $data->ward_name }}</td>
                                                   
                                                @elseif($type == 'icu')
                                                    
                                                        <td>{{ $data->icu_name }}</td>
                                                    
                                                @endif
                                                
                                                    <td>{{ $data->total_occupancy }}</td>
                                                
                                                
                                                    <td>{{ $data->assigned_beds }}</td>
                                                
                                                
                                                    <td>{{ $data->total_occupancy - $data->assigned_beds }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <form enctype="multipart/form-data" name="bedassignform" id="bedassignform" method="POST" action="{{ url('bedassign/saveData') }}">
                                @csrf
                                <input type="hidden" id="recordid" name="recordid" value="{{ $data->id }}" />
                                <input type="hidden" id="type" name="type" value="{{ $type }}">
                                
                                <h1 class="modal-title fs-5 text-dark mb-4" id="exampleModalLabel">Bed Assigning Form</h1>
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>

                                <!-- Dynamic Bed Number Inputs -->
                                @for ($i = 1; $i <= $data->total_occupancy; $i++)
                                    <div class="row pb-3">
                                        <div class="col-md-6">
                                            <label for="bed_no_{{ $i }}" class="form-label">Bed {{ $i }} Number<span style="color:red" title="Mandatory">*</span></label>
                                            <input type="text" class="form-control" id="bed_no_{{ $i }}" name="bed_no_{{ $i }}" value="{{ $i }}" required>
                                        </div>
                                    </div>
                                @endfor

                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</section>
@endsection

