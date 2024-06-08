@extends('masterlayout.masterlayout')

@section('content')

<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" name="bedassignform" id="bedassignform">
                            <input type="hidden" id="saveurl" value="{{ url('bedassign/saveData') }}" />
                            <input type="hidden" id="recordid" name="recordid" value="" />
                            <input type="hidden" id="mode" name="mode">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Bed Assigning</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;font-weight:600">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">Floor<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="floor" name="floor" onchange="showBlock(this)">
                                            <option value="" selected disabled>Please select floor</option>
                                            @foreach($floors as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">Block<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="block" name="block"></select>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                <div class="col-md-6">
                                        <label for="type" class="form-label">Type<span style="color:red" title="Mandatory">*</span></label>
                                       
                                          <div class="row">
                                                <div class="col-md-4">
                                                    <input class="form-check-input" type="radio" name="type" id="cabin" value="cabin" onclick="Takevalue('cabin')">
                                                    <label class="form-check-label" for="cabin">Cabins</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-check-input" type="radio" name="type" id="ward" value="ward" onclick="Takevalue('ward')">
                                                    <label class="form-check-label" for="ward">Wards</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-check-input" type="radio" name="type" id="icu" value="icu" onclick="Takevalue('icu')">
                                                    <label class="form-check-label" for="icu">ICUs</label>
                                                </div>
                                          </div>      
                                    </div>
                                    <div class="col-md-6">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ========== tables-wrapper start ========== -->
            <div class="card mb-30">
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class='row pb-2'>
                                <div class='col-lg-6'>
                                    <h3 class="headingcolor">Bed Assign</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-secondary"><a href="{{url('masters')}}">Masters</a></li>
                                            <li class="breadcrumb-item text-secondary"><a href="{{url('beds')}}">Beds</a></li>
                                            <li class="breadcrumb-item active text-primary" aria-current="page">Bed Assign</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class='col-lg-6 pb-2'>
                                    <!-- <a type="button" href="{{url('bedassign')}}" class="btn btn-rounded btn-fw btn-info" style="float:right;"></a> -->
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right;margin-right:10px;" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Assign Bed</button>
                                </div>

                            </div>
                            <ul class="nav nav-tabs" id="bedTypeTabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="Takevalue('cabin')">Cabins</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="Takevalue('ward')">Wards</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="Takevalue('icu')">ICUs</a>
                                </li>
                            </ul>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Floor</th>
                                            <th>Block</th>
                                            <th>Occupancy</th>
                                            <th>Assigned Beds</th>
                                            <th>Available Beds</th>
                                            <th>Assign Bed</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
    </div>
</section>
@endsection
<script>
function showBlock(floors, selectedBlock = null) {
    let floor = $(floors).val();
    //alert(floor);
    if (floor) {
        $.ajax({
            type: "POST",
            url: "{{ url('bedassign/loadblocks') }}",
            data: { _token: "{{ csrf_token() }}", floor: floor },
            success: function(response) {
                let blockSelect = $('#block');
                blockSelect.empty();
                blockSelect.append('<option value="" selected disabled>Please select block</option>');
                $.each(response.blocks, function(key, value) {
                    blockSelect.append('<option value="' + key + '">' + value + '</option>');
                });

                // If there's a selected block, set it as selected
                if (selectedBlock) {
                    blockSelect.val(selectedBlock);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error fetching blocks');
            }
        });
    }
}
function Takevalue(value, element) {
    
    if(value){
        $.ajax({
            type: "POST",
            url: "{{ url('bedassign/typevalue') }}",
            data: { _token: "{{ csrf_token() }}", value: value},
            success: function(response) {
                var tbody = $('#tbody');
                tbody.empty(); // Clear existing table rows

                if (response.message === "Cabins found" && response.cabins && response.cabinDetails) {
                    // Populate table with cabin data
                    for (var i = 0; i < response.cabins.length; i++) {
                        var cabin = response.cabins[i];
                        var cabinDetail = response.cabinDetails[i];

                        var row = $('<tr>');
                        row.append('<td>' + cabin.cabin_name + '</td>');
                        row.append('<td>' + cabinDetail.cabin_type + '</td>');
                        row.append('<td>' + cabinDetail.floor_no + '</td>');
                        row.append('<td>' + cabinDetail.block_name + '</td>');
                        row.append('<td>' + cabin.total_occupancy + '</td>');
                        row.append('<td>' + cabin.assigned + '</td>');
                        row.append('<td>' + cabin.available + '</td>');
                        row.append('<td><button class="btn btn-primary assign-bed" data-cabin-id="' + cabin.id + '">Assign</button></td>');
                        tbody.append(row);
                    }
                } else if (response.message === "No cabins found") {
                    // Show message if no cabins found
                    tbody.append('<tr><td colspan="7">No cabins found</td></tr>');
                }
               
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error fetching blocks');
            }
        });
    }
}
</script>
@section('scripts')