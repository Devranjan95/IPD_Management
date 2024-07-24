@extends('masterlayout.masterlayout')

@section('content')

    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
  
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->
                <!-- Modal -->
                <!-- *************Registration Modal************** -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Bed Booking</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <!-- Modal content will be populated here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- ***************Number Modal**************** -->
                 <!-- <div class="modal fade" id="shownumbermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Booking Completed Successfully</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="shownum">
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="generate()">Generate Pass</button>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div id="success_tic" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                       
                        <div class="modal-content" style="background: linear-gradient(to bottom right, #4CAF50, #2E7D32);">
                            <a class="close" href="#" data-dismiss="modal">&times;</a>
                            <div class="page-body text-light">
                                <div class="head">  
                                    <h4 style="margin-top:5px; color: #ffffff;">Booking Completed Successfully</h4>
                                    <h4 style="color: #ffffff;">Your Registration Number is</h4>
                                    <h4 id="regnno" style="color: #FFEB3B;"></h4>
                                    <input type="hidden" id="resgistrationno" name="resgistrationno" />
                                </div>

                                <h1 style="text-align:center;">
                                    <div class="checkmark-circle">
                                        <div class="background"></div>
                                        <div class="checkmark draw"></div>
                                    </div>
                                </h1>
                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-warning" onclick="getregn()">Generate Pass</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div id="success_tic" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content -->
        <div class="modal-content" style="background: linear-gradient(to bottom right, #4CAF50, #2E7D32);">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body text-light">
                <div class="head">  
                    <h4 style="margin-top:5px; color: #ffffff;">Booking Completed Successfully</h4>
                    <h4 style="color: #ffffff;">Your Registration Number is</h4>
                    <h4 id="regnno" style="color: #FFEB3B;"></h4>
                    <input type="hidden" id="registrationno" name="registrationno" />
                </div>

                <h1 style="text-align:center;">
                    <div class="checkmark-circle">
                        <div class="background"></div>
                        <div class="checkmark draw"></div>
                    </div>
                </h1>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-warning" onclick="getregn()">Generate Pass</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



               <!-- **************************************** -->
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
                                'rgb(255,255,240)', // Gainsboro
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
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{$occupancy['floor_no']}} 
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div>
                                                            <div class="badge-container">
                                                                @if($occupancy['total_occupancy_sum_cabin'] > 0)
                                                                    <label class="badge badge-success">Cabin-beds: {{$occupancy['total_occupancy_sum_cabin']}}</label>
                                                                @else
                                                                    <label class="badge badge-danger">No cabins</label>
                                                                @endif

                                                                @if($occupancy['total_occupancy_sum_ward'] > 0)
                                                                    <label class="badge badge-info">Ward-beds: {{$occupancy['total_occupancy_sum_ward']}}</label>
                                                                @else
                                                                    <label class="badge badge-danger">No wards</label>
                                                                @endif

                                                                @if($occupancy['total_occupancy_sum_icu'] > 0)
                                                                    <label class="badge badge-primary">ICU-beds: {{$occupancy['total_occupancy_sum_icu']}}</label>
                                                                @else
                                                                    <label class="badge badge-danger">No ICUs</label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                            </div>
                                                        </div>
                                                       
                                                    </button>
                                                </h2>
                                                <div id="acc{{ $index }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{ $index }}">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            @foreach($occupancy['blockinfo'] as $blockIndex => $block)
                                                                <div class="col-md-4">
                                                                    <div class="card mb-3" style="background:rgb(245,245,220,0.3); height: 300px; overflow-y: auto;">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">{{$block->block_name}}</h5>
                                                                            <div class="card-text">
                                                                                @if(isset($occupancy['bedno'][$blockIndex]) && count($occupancy['bedno'][$blockIndex]) > 0)
                                                                                    <div class="row">
                                                                                        @foreach($occupancy['bedno'][$blockIndex] as $bedIndex => $bed)
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-check bed-icon-wrapper">
                                                                                                    <label class="form-check-label" for="bed{{$blockIndex}}{{$bedIndex}}">
                                                                                                        @if($bed->status != "Booked")
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
                                                                                                                <div class="bed-info-card">
                                                                                                                    <!-- Bed info content here -->
                                                                                                                    <p><strong>Bed No:</strong> {{$bed->bed_no}}</p>
                                                                                                                    <p><strong>Name:</strong> {{$bed->type_name}}</p>
                                                                                                                    <p><strong>Category:</strong> {{$bed->category}}</p>
                                                                                                                    <p><strong>Price:</strong> ₹{{$bed->bed_price}}</p>
                                                                                                                    <!-- Add more details as needed -->
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        @else
                                                                                                            <i class="fa fa-bed bed-icon" style="color:red;font-size:25px"></i>
                                                                                                            <div class="bed-info-card">
                                                                                                                <!-- Bed info content here -->
                                                                                                                <p><strong>Bed No:</strong> {{$bed->bed_no}}</p>
                                                                                                                <p><strong>Status:</strong> Booked</p>
                                                                                                            </div>
                                                                                                        @endif
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
        /* ****************************************************** */
        
        body {
        background-color: #e6e6e6;
        width: 100%;
        height: 100%;
    }
    #success_tic .page-body {
        max-width: 300px;
        color: #fff;
        margin: 10% auto;
    }
    #success_tic .page-body .head {
        text-align: center;
    }
    #success_tic .close {
        opacity: 1;
        position: absolute;
        right: 0px;
        font-size: 30px;
        padding: 3px 15px;
        margin-bottom: 10px;
        color: #ffffff;
    }
    #success_tic .checkmark-circle {
        width: 150px;
        height: 150px;
        position: relative;
        display: inline-block;
        vertical-align: top;
    }
    .checkmark-circle .background {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #ffffff;
        position: absolute;
    }
    #success_tic .checkmark-circle .checkmark {
        border-radius: 5px;
    }
    #success_tic .checkmark-circle .checkmark.draw:after {
        -webkit-animation-delay: 300ms;
        -moz-animation-delay: 300ms;
        animation-delay: 300ms;
        -webkit-animation-duration: 1s;
        -moz-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-timing-function: ease;
        -moz-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-name: checkmark;
        -moz-animation-name: checkmark;
        animation-name: checkmark;
        -webkit-transform: scaleX(-1) rotate(135deg);
        -moz-transform: scaleX(-1) rotate(135deg);
        -ms-transform: scaleX(-1) rotate(135deg);
        -o-transform: scaleX(-1) rotate(135deg);
        transform: scaleX(-1) rotate(135deg);
        -webkit-animation-fill-mode: forwards;
        -moz-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
    }
    #success_tic .checkmark-circle .checkmark:after {
        opacity: 1;
        height: 75px;
        width: 37.5px;
        -webkit-transform-origin: left top;
        -moz-transform-origin: left top;
        -ms-transform-origin: left top;
        -o-transform-origin: left top;
        transform-origin: left top;
        border-right: 15px solid #4CAF50;
        border-top: 15px solid #4CAF50;
        border-radius: 2.5px !important;
        content: '';
        left: 35px;
        top: 80px;
        position: absolute;
    }
    @-webkit-keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }
    @-moz-keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }
    @keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }


        /* ************************************************** */
        .badge-container {
            display: flex;
            gap: 25px; 
            align-items: center;
            margin-left: 10px; 
        }
        .bed-icon {
            transition: transform 0.4s ease, color 0.4s ease;
        }

        .bed-icon:hover {
            transform: scale(1.5);
        }

        .bed-icon-wrapper {
            position: relative;
            display: inline-block;
        }

        .bed-info-card {
            display: none;
            position: absolute;
            top: -10px; /* Adjust based on your preference */
            left: 40px; /* Adjust based on your preference */
            width: 200px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: opacity 0.4s ease, transform 0.4s ease;
            opacity: 0;
            z-index: 10;
        }

        .bed-icon-wrapper:hover .bed-info-card {
            display: block;
            opacity: 1;
            transform: translateY(-10px);
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- Bootstrap JS -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<!-- Select2 JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<!-- ************* -->

 <!-- ********** -->
<script>
 

    $('#staticBackdrop').on('shown.bs.modal', function () {
        initializeSelect2();
    });

    function initializeSelect2() {
        $('.select2').each(function() {
            $(this).select2({
                placeholder: "Search existing patient",
                allowClear: true,
                dropdownParent: $('#staticBackdrop')
            });
        });
    }
    function replaceAllSlashes(str) {
        return str.replace(/\//g, '-');
    }

    function getBedinfo(bednum) {
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
                    let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    myModal.show();
                },
                error: function() {
                    alert("Error!!");
                }
            });
        }
    }



function populateModal(bedinfo) {
    // ******************************************************
    let bedDetails = bedinfo[0];
    let floor = bedinfo[1];
    let block = bedinfo[2];
    let additionalInfo = bedinfo[3]; // This will be either cabininfo, wardinfo, or icuinfo
    let typeflag = bedinfo[4];
    let regnNos = bedinfo[5];
    let idproofs = bedinfo[6];
    let bedname = bedinfo[7];
    let amenities = bedinfo[8];
    let amenitylist = bedinfo[9];
    let amenitiesListItems = '';
    
    // Determine type-specific data
    let type = bedDetails.type;
    let typeName = additionalInfo[type + "_name"]; // assuming the type_name is stored in this format
    let type_id = additionalInfo['id'];
    let catid = additionalInfo[type + "_type_id"];
    let price = additionalInfo.price;
    
    //$('#totalcost').val(1);
    // Generate options for regnNos
    let regnOptions = '<option value="" selected disabled>Search existing patient</option>';
    for (let id in regnNos) {
        if (regnNos.hasOwnProperty(id)) {
            regnOptions += `<option value="${id}">${regnNos[id]}</option>`;
        }
    }

    // Generate options for idproofs
    let idproofOptions = '<option value="" selected disabled>Enter Id Proof</option>';
    for (let id in idproofs) {
        if (idproofs.hasOwnProperty(id)) {
            idproofOptions += `<option value="${id}">${idproofs[id]}</option>`;
        }
    }

    // Generate options for amenities
    let amenitiesOptions = '<option value="" selected disabled>Enter Amenities</option>';
    let amenityIdsPresent = amenitylist.map(amenity => Object.keys(amenity)[0]);
    for (let id in amenities) {
        if (amenities.hasOwnProperty(id) && !amenityIdsPresent.includes(id)) {
            amenitiesOptions += `<option value="${id}">${amenities[id]}</option>`;
        }
    }
    
    amenitylist.forEach(amenity => {
        for (let id in amenity) {
            if (amenity.hasOwnProperty(id)) {
                amenitiesListItems += `<li>${amenity[id]}</li>`;
            }
        }
    });
    // ***********************************************

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
                                    <h5 class="card-title pb-4">${bedname}</h5>
                                    <p class="card-text pb-2"><strong>Bed Number:</strong> ${bedDetails.bed_no}</p>
                                    <p class="card-text pb-2"><strong>Type:</strong> ${type.charAt(0).toUpperCase() + type.slice(1)}</p>
                                    <p class="card-text pb-2"><strong>Flag:</strong> ${typeflag}</p>
                                    <p class="card-text pb-2"><strong>Type Name:</strong> ${typeName}</p>
                                    <div class="card-text pb-2"><strong>Amenities</strong>
                                        <ul id="amenitiesList">
                                            ${amenitiesListItems}
                                        </ul>
                                    </div>
                                    <p class="card-text pb-2"><strong>Floor:</strong> ${floor}</p>
                                    <p class="card-text pb-2"><strong>Block:</strong> ${block}</p>
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
                                    <select id="regn" name="regn[]" class="form-control select2" onchange="searchPatient()">
                                        ${regnOptions}
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-inverse-warning btn-fw w-100" onclick="searchPatient()">Search</button>
                                </div>
                            </div>
                            <form enctype="multipart/form-data" name="registrationform" id="registrationform">
                                <input type="hidden" id="saveurl" value="{{ url('registration/saveData') }}" />
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="bedno" name="bedno" value="${bedDetails.bed_no}" />
                                <input type="hidden" id="bedname" name="bedname" value="${bedDetails.bed_name}" />
                                <input type="hidden" id="catid" name="catid" value="${catid}" />
                                <input type="hidden" id="typeid" name="typeid" value="${type_id}" />
                                <input type="hidden" id="flag" name="flag" value="${type.charAt(0).toUpperCase() + type.slice(1)}" />
                                <input type="hidden" id="price" name="price" value="${price}" />
                                <input type="hidden" id="mode" name="mode">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-2">
                                    <div class="col-md-4">
                                        <label for="pname" class="form-label">Patient Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter patient name" id="pname" name="pname">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Contact No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter contact no" id="phone" name="phone" maxlength="10">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" placeholder="Enter email" id="email" name="email">
                                    </div> 
                                </div>
                                <div class="row pb-2">
                                    <div class="col-md-4">
                                        <label for="idproof" class="form-label">ID Proof<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="idproof" name="idproof" class="form-select" onchange="getLength()">
                                            ${idproofOptions}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="idproofno" class="form-label">ID Proof No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter id proof no" id="idproofno" name="idproofno">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" placeholder="Enter address" id="address" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-md-4">
                                        <label for="aphone" class="form-label">Attendant Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter attendant name" id="aname" name="aname">
                                    </div>
                                   <div class="col-md-4">
                                        <label for="aphone" class="form-label">Attendant's Contact<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter attendant's contact no" id="aphone" name="aphone" maxlength="10">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="emergency" name="emergency">
                                            <label class="form-check-label" for="emergency">
                                                If from emergency
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-md-4">
                                        <label for="amenities" class="form-label">Extra Amenities</label>
                                        <select id="amenities" name="amenities[]" class="form-control select2" multiple="multiple" onchange = "amenityCalculate('${type}','${type_id}')">
                                            ${amenitiesOptions}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cost" class="form-label">Total Amount<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Reference" id="totalcost" name="totalcost" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="advance" class="form-label">Advance Amount<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter advance amount" id="advance" name="advance">
                                    </div>
                                </div>
                                <div class="row pt-2"> 
                                    <div class="col-md-12 pb-3">
                                        <label for="reff" class="form-label">Reference From</label>
                                        <input type="text" class="form-control" placeholder="Reference" id="reff" name="reff">
                                    </div>                                  
                                    <button type="submit" class="btn btn-success" onclick="initRegistrationSubmit()">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

    $('.select2').select2({
        width: '100%'
    });

    $('#bedInfoModal').modal('show');
    $('#totalcost').val(price);
}


// function amenityCalculate(type,typeid) {
//     //  alert(type);
//     // alert(typeid);
//     let selectedAmenities = $('#amenities').val(); // Get the selected values (IDs) from the Select2 element
//     // Perform your calculation or any other operations using the selectedAmenities array
//     //console.log('Selected Amenities:', selectedAmenities);
//     $.ajax({
//         type: "POST",
//         url: "{{url('getamenitycost')}}",
//         data:{_token:"{{csrf_token()}}",selectedAmenities:selectedAmenities,type:type,typeid:typeid},
//         success:function(response){
//             if(response.totalCost !== undefined) {
//                 // Update the value of the total cost field
//                 alert(response.totalCost);
//                 $('#totalcost').val(response.totalCost);
//                 //document.getElementById("totalcost").value = response.totalCost;
//             } else {
//                 // Display an error message if totalCost is not present
//                 alert(response.message);
//             }
//         },
//         error:function(response){
//             alert('Error');
//         }
//     })
// }

function amenityCalculate(type, typeid) {
    let selectedAmenities = $('#amenities').val(); // Get the selected values (IDs) from the Select2 element
    let hasSelectedAmenities = selectedAmenities.length > 0;
    
    $.ajax({
        type: "POST",
        url: "{{url('getamenitycost')}}",
        data: {
            _token: "{{csrf_token()}}",
            selectedAmenities: hasSelectedAmenities ? selectedAmenities : [], // Send an empty array if no amenities are selected
            type: type,
            typeid: typeid
        },
        success: function(response) {
            if (response.totalCost !== undefined) {
                $('#totalcost').val(response.totalCost);
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Error');
        }
    });
}


    function searchPatient() {
        let patid = document.getElementById('regn').value;
        document.getElementById('recordid').value = patid;
        //alert(patid);
        if (patid) {
            $.ajax({
                type: "GET",
                url: "{{url('getpatient/data')}}/" + patid,
                headers: { _token: "{{csrf_token()}}" },
                success: function(response) {
                    alert(response.message);
                    document.getElementById("pname").value = response.patinfo['patient_name'];
                    document.getElementById("phone").value = response.patinfo['patient_phone'];
                    document.getElementById("idproof").value = response.patinfo['idproof'];
                    document.getElementById("idproofno").value = response.patinfo['idproof_no'];
                    document.getElementById("email").value = response.patinfo['patient_email'];
                    document.getElementById("address").value = response.patinfo['patient_address'];
                },
                error: function() {
                    alert("Error!!");
                }
            });
        }
    }

    function getLength() {
        let idproofID = document.getElementById('idproof').value;
        if (idproofID) {
            $.ajax({
                type: "GET",
                url: "{{url('idprooflength')}}/" + idproofID,
                headers: { _token: "{{csrf_token()}}" },
                success: function(response) {
                    let idproofnoInput = document.getElementById('idproofno');
                    if (response.idproofLength) {
                        idproofnoInput.setAttribute('maxlength', response.idproofLength);
                    } else {
                        idproofnoInput.removeAttribute('maxlength');
                    }
                },
                error: function() {
                    alert("Error!!");
                }
            });
        }
    }

function initRegistrationSubmit() {
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Only letters and spaces are allowed.");

    $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value >= 0);
    }, "Price must be a positive number.");

    $.validator.addMethod("validphone", function(value, element) {
        const digits = value.replace(/\D/g, '');
        if (digits.length < 10) return false;
        const sum = digits.split('').reduce((a, b) => a + parseInt(b), 0);
        return sum > 0;
    }, "Please enter a valid phone number with at least 10 digits and a non-zero sum of digits.");

    $('#registrationform').validate({
        rules: {
            pname: {
                required: true,
                lettersonly: true
            },
            phone: {
                required: true,
                digits: true,
                validphone: true
            },
            idproof: {
                required: true
            },
            idproofno: {
                required: true
            },
            address: {
                required: true
            },
            aname: {
                required: true,
                lettersonly: true
            },
            aphone: {
                required: true,
                digits: true,
                validphone: true
            },
            treattype: {
                required: true
            },
            advance:{
                required: true,
                positiveNumber:true
            }
            
        },
        messages: {
            pname: {
                required: "Please enter patient name",
                lettersonly: "Please enter a valid name"
            },
            phone: {
                required: "Please enter contact number",
                digits: "Please enter valid phone number",
                validphone: "Phone number should have at least 10 digits and the sum of digits should not be 0"
            },
            idproof: {
                required: "Please select ID proof type"
            },
            idproofno: {
                required: "Please enter ID proof number"
            },
            address: {
                required: "Address is required"
            },
            aname: {
                required: "Please enter attendant's name",
                lettersonly: "Please enter a valid name"
            },
            aphone: {
                required: "Attendant's phone number is required",
                digits: "Please enter a valid phone number",
                validphone: "Phone number should have at least 10 digits and the sum of digits should not be 0"
            },
            treattype: {
                required: "Please select a treatment type"
            },
            advance:{
                required: "Amount required",
                positiveNumber:"Please enter valid amount"
            }
           
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            error.insertAfter(element);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            event.preventDefault();
            // Handle form submission here, e.g., AJAX
            var formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');
            //alert($('#totalcost').val());
            $.ajax({
        type: 'POST',
        url: $('#saveurl').val(),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {

            if (response.status) {
                $("#success").text(response.message).show();
                $("#error").hide();
                $('#regnno').html(response.regn);
                $('#registrationno').val(response.regn);
                let regn = $('#registrationno').val();
                //alert(regn);

                let myModal = new bootstrap.Modal(document.getElementById('success_tic'), {
                    backdrop: 'static',
                    keyboard: false
                });
                myModal.show();
            } else {
                $("#error").text(response.message).show();
                $("#success").hide();
                setTimeout(function() {
                    $('#error').slideUp();
                }, 4000);
            }
            
        },
        error: function(response) {
            $('#error').html('Error saving data!');
            $('#success').html('');
        }
    });
            return false; // Prevent form submission and page refresh
        }
    });
}

function getregn() {
    let regn = $('#registrationno').val();
    let modifiedRegn = regn.replace(/\//g, '-'); // Replace slashes with hyphens
    //alert(modifiedRegn);

    if (regn) {
        $.ajax({
            type: "GET",
            url: "{{ url('getregn/printpass') }}" + "/" + modifiedRegn,
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            success: function(response) {
                let printurl = "{{ url('getregn/printpass') }}" + "/" + modifiedRegn;
                window.open(printurl, '_blank'); // Open in a new tab
                window.location.reload();
            },
            error: function() {
                alert("Error!!");
            }
        });
    }
}


// function getregn() {
//     let regn = $('#registrationno').val();
//     let modifiedRegn = regn.replace(/\//g, '-'); // Replace slashes with hyphens
//     alert(modifiedRegn);

//     if (regn) {
//         $.ajax({
//             type: "GET",
//             url: "{{ url('getregn/printpass') }}" + "/" + modifiedRegn,
//             headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
//             success: function(response) {
//                 //alert(response.message);
//                 printurl = "{{ url('getregn/printpass') }}" + "/" + modifiedRegn;
//                 window.open(printurl,'_blank');
//             },
//             error: function() {
//                 alert("Error!!");
//             }
//         });
//     }
// }


    // function initRegistrationSubmit(){
    //      $.validator.addMethod("lettersonly", function(value, element) {
    //         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    //     }, "Only letters and spaces are allowed.");
        
       
    //     $('#registrationform').validate({
    //             rules: {
    //                 pname: {
    //                     required: true,
    //                     lettersonly:true
    //                 },
    //                 phone: {
    //                     required: true,
    //                     digits: true
    //                 },
    //                 idproof: {
    //                     required: true
    //                 },
    //                 idproofno: {
    //                     required: true
    //                 },
    //                 address:{
    //                     required: true,
    //                 }
    //                 aname: {
    //                     required: true,
    //                     lettersonly:true
    //                 },
    //                 aphone: {
    //                     required: true,
    //                     digits:true
    //                 },
    //                 treattype:{
    //                     required:true
    //                 }
    //             },
    //             messages: {
    //                 pname: {
    //                     required: "Please enter patient name",
    //                     lettersonly:"Please enter a valid name"
    //                 },
    //                 phone: {
    //                     required: "Please enter contact number",
    //                     digits: "Please enter valid phone number"
    //                 },
    //                 idproof: {
    //                     required: "Please select ID proof type"
    //                 },
    //                 idproofno: {
    //                     required: "Please enter ID proof number"
    //                 },
    //                 address:{
    //                     required: "Address is required",
    //                 }
    //                 aname: {
    //                     required: "Please enter attendants name",
    //                     lettersonly:"Please enter a valid name"
    //                 },
    //                 aphone: {
    //                     required: "Attendants phone no is required",
    //                     digits: "Please enter a valid phone number"
    //                 },
    //                 treattype:{
    //                     required:"Please select a treatment type"
    //                 }
    //             },
    //             errorElement: 'div',
    //             errorPlacement: function(error, element) {
    //                 error.addClass('invalid-feedback');
    //                 error.insertAfter(element);
    //             },
    //             highlight: function(element, errorClass, validClass) {
    //                 $(element).addClass('is-invalid').removeClass('is-valid');
    //             },
    //             unhighlight: function(element, errorClass, validClass) {
    //                 $(element).addClass('is-valid').removeClass('is-invalid');
    //             },
    //             submitHandler: function(form) {
    //                 event.preventDefault();
    //                 // You can handle form submission here, e.g., AJAX
    //                 alert("2");
    //                 var formData = new FormData(form);
    //                 formData.append('_token', '{{ csrf_token() }}');
                   
    //                 // for (let pair of formData.entries()) {
    //                 //         console.log(pair[0] + ': ' + pair[1]);
    //                 //     }
 

    //                 $.ajax({
    //                     type: 'POST',
    //                     url: $('#saveurl').val(),
    //                     data: formData,
    //                     processData:false,
    //                     contentType:false,
    //                     success: function(response) {
    //                         $('#success').html(response.message);
    //                         $('#error').html('');
    //                     },
    //                     error: function(response) {
    //                         $('#error').html('Error saving data!');
    //                         $('#success').html('');
    //                     }
    //                 });
    //                 return false; // Prevent form submission and page refresh
    //             }
    //         });
    // }
            
</script>


@endsection
