@extends('masterlayout.masterlayout')

@section('content')

<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" name="bedform" id="bedform">
                            <input type="hidden" id="saveurl" value="{{ url('bed/saveData') }}" />
                            <input type="hidden" id="recordid" name="recordid" value="" />
                            <input type="hidden" id="mode" name="mode">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Bed</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;font-weight:600">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="bed_no" class="form-label">Bed No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Bed No" id="bed_no" name="bed_no">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bed_type" class="form-label">Bed Type<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Bed Type" id="bed_type" name="bed_type">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bed_code" class="form-label">Bed Code<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Bed Code" id="bed_code" name="bed_code">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">Floor<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="floor" name="floor" onchange="showBlock(this)">
                                            <option value="" selected disabled>Please select floor</option>
                                            @foreach($floors as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach   
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="block" class="form-label">Block<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="block" name="block" onchange="showRoom(this)"></select>
                                    </div>
                                    <div id="rooms"></div>
                                    <div id="inputFields"></div>
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
                                    <h3 class="headingcolor">Beds</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-secondary"><a href="{{url('masters')}}">Masters</a></li>
                                            <li class="breadcrumb-item active text-primary" aria-current="page">Beds</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class='col-lg-6 pb-2'>
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add New</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Bed No</th>
                                            <th>Bed Type</th>
                                            <th>Bed Code</th>
                                            <th>Floor</th>
                                            <th>Block</th>
                                            <th>Cabin</th>
                                            <th>Ward</th>
                                            <th>ICU</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
@section('scripts')

<script>
function showBlock(floors, selectedBlock = null) {
    let floor = $(floors).val();
    //alert(floor);
    if (floor) {
        $.ajax({
            type: "POST",
            url: "{{ url('bed/loadblocks') }}",
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
function showRoom(blocks, selectedRoom = null) {
    let block = $(blocks).val();
    alert(block);
    if (block) {
        $.ajax({
            type: "POST",
            url: "{{ url('bed/loadroom') }}",
            data: { _token: "{{ csrf_token() }}", block: block },
            success: function(response) {
    if (response.cabins) {
        let cabins = response.cabins;
        let cabinCardHtml = '<div class="card mb-3"><div class="card-header">Cabins</div><div class="card-body"><div class="form-check">';
        cabins.forEach(cabin => {
            cabinCardHtml += `<input class="form-check-input" type="radio" name="room" id="cabin_${cabin.id}" value="${cabin.id}">
                                <label class="form-check-label" for="cabin_${cabin.id}">${cabin.cabin_name} (Occupancy: ${cabin.occupancy})</label><br>`;
        });
        cabinCardHtml += '</div></div></div>';
        $('#rooms').append(cabinCardHtml);
    }

    if (response.wards) {
        let wards = response.wards;
        let wardCardHtml = '<div class="card mb-3"><div class="card-header">Wards</div><div class="card-body"><div class="form-check">';
        wards.forEach(ward => {
            wardCardHtml += `<input class="form-check-input" type="radio" name="room" id="ward_${ward.id}" value="${ward.id}">
                                <label class="form-check-label" for="ward_${ward.id}">${ward.ward_name} (Occupancy: ${ward.occupancy})</label><br>`;
        });
        wardCardHtml += '</div></div></div>';
        $('#rooms').append(wardCardHtml);
    }

    if (response.icus) {
        let icus = response.icus;
        let icuCardHtml = '<div class="card mb-3"><div class="card-header">ICUs</div><div class="card-body"><div class="form-check">';
        icus.forEach(icu => {
            icuCardHtml += `<input class="form-check-input" type="radio" name="room" id="icu_${icu.id}" value="${icu.id}">
                                <label class="form-check-label" for="icu_${icu.id}">${icu.icu_name} (Occupancy: ${icu.occupancy})</label><br>`;
        });
        icuCardHtml += '</div></div></div>';
        $('#rooms').append(icuCardHtml);
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
<script>
    $(document).on('click', 'input[type="radio"][name="room"]', function() {
        let selectedRoomId = $(this).val();
        let occupancy = $(this).next('label').text().match(/\d+/)[0]; // Extract occupancy from label text
        
        // Generate input fields based on occupancy
        let inputFieldsHtml = '';
        for (let i = 1; i <= occupancy; i++) {
            inputFieldsHtml += `<div class="form-group">
                                    <label for="bed_${i}">Bed ${i}</label>
                                    <input type="text" class="form-control" id="bed_${i}" name="bed_${i}">
                                </div>`;
        }
        
        // Display input fields
        $('#inputFields').html(inputFieldsHtml);
    });
</script>

@endsection