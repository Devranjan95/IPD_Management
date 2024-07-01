@extends('masterlayout.masterlayout')

@section('content')

    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdrop">Bed Booking</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modalBody">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save</button> -->
                        </div>
                        </div>
                    </div>
                </div>
                <!-- ***********************TESTING******************************* -->
                <div class="modal fade" id="confModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Bed Booking</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="confModalbody">
                            jjjj
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save</button> -->
                        </div>
                        </div>
                    </div>
                </div>
                 <!-- ***************************************************************** -->
                <div class="card mb-30">
                    <div class="tables-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='row pb-2'>
                                    <div class='col-lg-6'>
                                        <h3 class="headingcolor">Registration</h3>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-12'>
                                @php 
                                $colors = [
                                    'rgb(240,248,255)', // White
                                    'rgba(245, 245, 245)', // White Smoke
                                    ' rgb(255,255,240)', // Gainsboro
                                    'rgba(255, 250, 250)', // Snow
                                    'rgb(240,255,240)',  // Ghost White
                                    'rgb(255,240,245,0.7)'
                                ]; 
                                @endphp
                                <div class='col-lg-12'>
                                    @foreach($floorOccupancy as $index => $occupancy)
                                        <div class="row pt-3">
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="panelsStayOpen-heading{{ $index }}">
                                                        <button class="accordion-button collapsed justify-content-center" style="background:{{ $colors[$index % count($colors)] }}; color: black;" type="button" data-bs-toggle="collapse" data-bs-target="#acc{{ $index }}" aria-expanded="false" aria-controls="acc{{ $index }}">
                                                            {{$occupancy['floor_no']}} 
                                                            <div style="padding-left:50px">
                                                                @if($occupancy['total_available_cabin'] > 0)
                                                                    <label class="badge badge-success">Cabin-beds: {{$occupancy['total_available_cabin']}}</label>
                                                                @else
                                                                    <label class="badge badge-danger">No cabins</label>
                                                                @endif
                                                                
                                                                @if($occupancy['total_available_ward'] > 0)
                                                                    <label class="badge badge-info">Ward-beds: {{$occupancy['total_available_ward']}}</label>
                                                                @else
                                                                    <label class="badge badge-danger">No wards</label>
                                                                @endif
                                                                
                                                                @if($occupancy['total_available_icu'] > 0)
                                                                    <label class="badge badge-primary">ICU-beds: {{$occupancy['total_available_icu']}}</label>
                                                                @else
                                                                    <label class="badge badge-danger">No ICUs</label>
                                                                @endif
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="acc{{ $index }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{ $index }}">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                @foreach($occupancy['blockinfo'] as $blockIndex => $block)
                                                                    <div class="col-md-4">
                                                                        <div class="card mb-3" style="background:rgb(248,244,255); height: 300px; overflow-y: auto;">
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">{{$block->block_name}}</h5>
                                                                                <div class="card-text">
                                                                                    @if(isset($occupancy['bedno'][$blockIndex]) && count($occupancy['bedno'][$blockIndex]) > 0)
                                                                                        <div class="row">
                                                                                            @foreach($occupancy['bedno'][$blockIndex] as $bedIndex => $bed)
                                                                                                <div class="col-md-3">
                                                                                                    <div class="form-check">
                                                                                                        <label class="form-check-label" for="bed{{$blockIndex}}{{$bedIndex}}">
                                                                                                            <a href="#" style="margin-left:-20px" onclick="getBedinfo('{{$bed->bed_no}}')">
                                                                                                                <i class="fa fa-bed bed-icon" style="color:
                                                                                                                    @if($bed->type == 'cabin')
                                                                                                                        var(--bs-success);
                                                                                                                    @elseif($bed->type == 'ward')
                                                                                                                        var(--bs-info);
                                                                                                                    @elseif($bed->type == 'icu')
                                                                                                                        var(--bs-primary);
                                                                                                                    @else
                                                                                                                        green
                                                                                                                    @endif;
                                                                                                                    font-size:25px"></i>
                                                                                                            </a>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                @if(($bedIndex + 1) % 4 == 0)
                                                                                                    </div><div class="row">
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @else
                                                                                        No beds assigned.
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .bed-icon {
            transition: transform 0.4s ease, color 0.4s ease;
        }

        .bed-icon:hover {
            transform: scale(1.5);
        }
        #modalBody .card {
    background-color: rgba(245, 245, 245, 0.8);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

#modalBody .card:hover {
    background-color: rgba(240, 240, 240, 0.9);
    transform: scale(1.02);
}

#modalBody .card-body {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


    </style>
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Select2 JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#staticBackdrop').on('shown.bs.modal', function () {
        initializeSelect2();
    });

    function initializeSelect2() {
        $('.select2').each(function() {
            $(this).select2({
                placeholder: "Search existinging patient",
                allowClear: true,
                dropdownParent: $('#staticBackdrop')
            });
        });
    }

    function replaceAllSlashes(str) {
        return str.replace(/\//g, '-');
    }

     function getBedinfo(bednum) {
        //alert(bednum);
        bednum = replaceAllSlashes(bednum);
        if (bednum) {
            $.ajax({
                type: "GET",
                url: "{{ url('getbedinfo') }}/" + encodeURIComponent(bednum),
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function(response) {
                    alert(response.message);
                    if(response.bedinfo) {
                         populateModal(response.bedinfo);
                    }
                    let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                    myModal.show();
                },
                error: function() {
                    alert("Error!!");
                }
            });
        }
    }

    
    function populateModal(bedinfo) {
        let bedDetails = bedinfo[0];
        let floor = bedinfo[1];
        let block = bedinfo[2];
        let additionalInfo = bedinfo[3]; // This will be either cabininfo, wardinfo, or icuinfo
        let typeflag = bedinfo[4];

        // Determine type-specific data
        let type = bedDetails.type;
        let typeName = additionalInfo[type + "_name"]; // assuming the type_name is stored in this format
        let amenities = additionalInfo.amenities;
        let price = additionalInfo.price;

        let modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" style="background:rgb(238,232,170)" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bed Information
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body" style="background: rgb(249,255,227)">
                                        <h5 class="card-title pb-4">${bedDetails.bed_name}</h5>
                                        <p class="card-text pb-2"><strong>Bed Number:</strong> ${bedDetails.bed_no}</p>
                                        <p class="card-text pb-2"><strong>Type:</strong> ${type.charAt(0).toUpperCase() + type.slice(1)}</p>
                                        <p class="card-text pb-2"><strong>Type Name:</strong> ${typeName}</p>
                                        <p class="card-text pb-2"><strong>Flag:</strong> ${typeName}</p>
                                        <p class="card-text pb-2"><strong>Floor:</strong> ${floor}</p>
                                        <p class="card-text pb-2"><strong>Block:</strong> ${block}</p>
                                        <p class="card-text pb-2"><strong>Amenities:</strong> ${amenities}</p>
                                        <p class="card-text pb-2"><strong>Price 24hrs:</strong> ₹${price}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                                <div class="card-header text-white" style="background:rgb(32,178,170)">
                                    Registration Form
                                </div>
                                <div class="card-body" style="background:rgb(245,255,250)">
                                    <div class="row pb-4">
                                        <div class="col-md-9">
                                            <select id="regn" name="regn[]" class="form-control select2" >
                                            <option value="" slected disabled>Search exisiting patient</option>
                                                <option value="001">ghhjgjgjg001</option>
                                                <option value="002">ghhjgjgjg002</option>  
                                            </select>
                                            
                                        </div> 
                                        <div class="col-md-3">
                                            <button class="btn btn-inverse-warning btn-fw w-100">Search</button>
                                        </div>
                                    </div>
                                    <form enctype="multipart/form-data" name="registrationform" id="registrationform">
                                        <input type="hidden" id="saveurl" value="{{ url('registration/saveData') }}" />
                                        <input type="hidden" id="recordid" name="recordid" value="" />
                                        <input type="hidden" id="bedno" name="bedno" value="${bedDetails.bed_no}" />
                                        <input type="hidden" id="bedname" name="bedname" value="${bedDetails.bed_name}" />
                                        <input type="hidden" id="type" name="type" value="${typeflag}" />
                                        <input type="hidden" id="mode" name="mode">
                                            <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                            <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                            <div class="row pb-2">
                                                <div class="col-md-6">
                                                    <label for="pname" class="form-label">Patient Name<span style="color:red" title="Mandatory">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter patient name" id="pname" name="pname">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label">Contact No<span style="color:red" title="Mandatory">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter contact no" id="phone" name="phone">
                                                </div>
                                            </div>
                                            <div class="row pb-2">
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" placeholder="Enter email" id="email" name="email">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea  class="form-control" placeholder="Enter address" id="address" name="address"></textarea>
                                                </div>
                                            </div>
                                            <div class="row pb-2">
                                                <div class="col-md-6">
                                                    <label for="aname" class="form-label">Attendant's Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter attendants name" id="email" name="email">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="aphone" class="form-label"> Attendant's Contact</label>
                                                    <input type="text" class="form-control" placeholder="Enter attendants no" id="aphone" name="aphone">
                                                </div>
                                            </div>
                                            <div class="row pb-2">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" id="emergency id="emergency" name="emergency">
                                                        <label class="form-check-label" for="checkBox">
                                                            If from emergency
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="treatment" class="form-label">Treatment Type</label>
                                                    <select id="treattype" name="treattype" class="form-select">
                                                        <option value="" selected disabled>Treatment type</option>
                                                        <option value="Surgery">Surgery</option>
                                                        <option value="Observation">Observation</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row pb-2">
                                                <div class="col-md-12">
                                                    <label for="treatment" class="form-label">Reference From</label>
                                                    <input type="text" class="form-control" placeholder="Reference" id="reff" name="reff">
                                                </div>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success" onclick="show()">Save</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        `;
    }

    function show(){
        // let myModal = new bootstrap.Modal(document.getElementById('confModal'));
        // myModal.show();
        let formData = new FormData(document.getElementById('registrationform'));
        
        for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
    }



// Function to initialize multi-step form behavior







</script>
@endsection
