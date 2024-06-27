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
                                    <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('masters')}}">Masters</a></li>
                                    <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('beds')}}">Beds</a></li>
                                    <li class="breadcrumb-item active text-warning" aria-current="page">Bed Assign</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            @foreach($floors as $floor)
                                <div class="floor-card mb-3 @if($floor->status != 'Active') bg-danger text-white @endif">
                                    <div class="card-body text-center">
                                        @if($floor->status != 'Active')
                                            <h6>{{$floor->floor_no}}</h6>
                                            <p>Floor is inactive</p>
                                        @else
                                            <h5 class="card-title">{{ $floor->floor_no }}</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card inner-card mb-3">
                                                        <div class="card-body scrollable">
                                                            <h5 class="card-title">Cabins</h5>
                                                            <div class="cabins-content d-flex flex-wrap">
                                                                @if(isset($cabindetails[$floor->count]) && count($cabindetails[$floor->count]) > 0)
                                                                    @foreach($cabindetails[$floor->count] as $cabin)
                                                                        @php 
                                                                            $occupancy = $cabin->total_occupancy;
                                                                            $assigned = $cabin->assigned;
                                                                            $available = $occupancy - $assigned;
                                                                        @endphp
                                                                        @if($available === 0)
                                                                            <div class="cabin-card bg-danger">
                                                                                
                                                                                    <h6 style="color:#fff">{{ $cabin->cabin_name }}</h6>
                                                                                    <p style="font-size:12px;color:#fff">Available 0</p>
                                                                                
                                                                            </div>
                                                                        @elseif($cabin->status != "Active")
                                                                            <div class="cabin-card bg-danger text-white">
                                                                                <h6>{{ $cabin->cabin_name }}</h6>
                                                                                <p style="font-size:12px">Cabin Not Active</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="cabin-card">
                                                                                <a href="#" style="text-decoration:none" onclick="takeValue({{$cabin->id}}, 'cabin')">
                                                                                    <h6 style="color:#006400">{{ $cabin->cabin_name }}</h6>
                                                                                    <p style="font-size:12px; color:red">Total:{{$cabin->total_occupancy}}</p>
                                                                                    <p style="font-size:12px; color:green">Vacant: {{ $available }}</p>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="no-cabins">
                                                                        <p class="card-text">No cabins available on this floor.</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card inner-card mb-3">
                                                        <div class="card-body scrollable">
                                                            <h5 class="card-title">Wards</h5>
                                                            <div class="wards-content d-flex flex-wrap">
                                                                @if(isset($warddetails[$floor->count]) && count($warddetails[$floor->count]) > 0)
                                                                    @foreach($warddetails[$floor->count] as $ward)
                                                                        @php 
                                                                            $occupancy = $ward->total_occupancy;
                                                                            $assigned = $ward->assigned;
                                                                            $available = $occupancy - $assigned;
                                                                        @endphp
                                                                        @if($available === 0)
                                                                            <div class="ward-card bg-danger text-white">
                                                                                <a href="#" style="text-decoration:none;color:#fff" onclick="takeValue({{$ward->id}}, 'ward')">
                                                                                    <h6>{{ $ward->ward_name }}</h6>
                                                                                    <p style="font-size:12px">Available 0</p>
                                                                                </a>
                                                                            </div>
                                                                        @elseif($ward->status != "Active")
                                                                            <div class="cabin-card bg-danger text-white">
                                                                                <h6>{{ $ward->ward_name }}</h6>
                                                                                <p style="font-size:12px">Ward Not Active</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="ward-card">
                                                                                <a href="#" style="text-decoration:none" onclick="takeValue({{$ward->id}}, 'ward')">
                                                                                    <h6 style="color:#dc143c">{{ $ward->ward_name }}</h6>
                                                                                    <p style="font-size:12px; color:red">Total:{{$ward->total_occupancy}}</p>
                                                                                    <p style="font-size:12px; color:green">Vacant: {{ $available }}</p>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="no-cabins">
                                                                        <p class="card-text">No wards available on this floor.</p>
                                                                    </div>       
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card inner-card mb-3">
                                                        <div class="card-body scrollable">
                                                            <h5 class="card-title">ICUs</h5>
                                                            <div class="icus-content d-flex flex-wrap">
                                                                @if(isset($icudetails[$floor->count]) && count($icudetails[$floor->count]) > 0)
                                                                    @foreach($icudetails[$floor->count] as $icu)
                                                                        @php 
                                                                            $occupancy = $icu->total_occupancy;
                                                                            $assigned = $icu->assigned;
                                                                            $available = $occupancy - $assigned;
                                                                        @endphp
                                                                        @if($available === 0)
                                                                            <div class="icu-card bg-danger text-white">
                                                                                <a href="#" style="text-decoration:none;color:#fff" onclick="takeValue({{$icu->id}}, 'icu')">
                                                                                    <h6>{{ $icu->icu_name }}</h6>
                                                                                    <p style="font-size:12px">Available 0</p>
                                                                                </a>
                                                                            </div>
                                                                        @elseif($icu->status != "Active")
                                                                            <div class="cabin-card bg-danger text-white">
                                                                                <h6>{{ $icu->icu_name }}</h6>
                                                                                <p style="font-size:12px">Icu Not Active</p>
                                                                            </div>
                                                                        @else
                                                                            <div class="icu-card">
                                                                                <a href="#" style="text-decoration:none" onclick="takeValue({{$icu->id}}, 'icu')">
                                                                                    <h6 style="color:#0000cd">{{ $icu->icu_name }}</h6>
                                                                                    <p style="font-size:12px; color:red">Total:{{$icu->total_occupancy}}</p>
                                                                                    <p style="font-size:12px; color:green">Vacant: {{ $available }}</p>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="no-cabins">
                                                                        <p class="card-text">No ICUs available on this floor.</p>
                                                                    </div>  
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <!-- Card End -->
        </div>
    </div>
</section>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Details / Bed Assign</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Content will be dynamically inserted here -->
         <div class="modalbodycontainer">
                <div id="bedInformation"></div>
                <div id="informationContainer"></div>
                <div id="bedAssignFormContainer"></div>
         </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editmodalLabel">Details / Bed Assign</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Content will be dynamically inserted here -->
         
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>

function takeValue(id,flag){
    if (id) {
        $.ajax({
            type: 'GET',
            url: '{{url("bedform/getalldata")}}/'+id+'/'+flag,
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                flag: flag
            },
            success:function(response){
                let urll = '{{url("bedform/getalldata")}}/'+id+'/'+flag;
                window.location.href = urll;
                //window.open(urll);
            },
            error:function(){
                alert('Error!!')
            }
        })
    }
}

// function takeValue(id, flag) {
//     if (id) {
//         $.ajax({
//             type: 'POST',
//             url: '{{url("bedform/getalldata")}}',
//             data: {
//                 _token: "{{ csrf_token() }}",
//                 id: id,
//                 flag: flag
//             },
//             success: function(response) {
//                 let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
//                 myModal.show();

//                 $('#staticBackdrop').data('flag', flag);
//                 $('#staticBackdrop').data('id', id);
                
//                 let xdata;
//                 if (flag === 'cabin') {
//                     xdata = response.cabininfo;
//                 } else if (flag === 'ward') {
//                     xdata = response.wardinfo;
//                 } else if (flag === 'icu') {
//                     xdata = response.icuinfo;
//                 }

//                 $('#staticBackdrop').data('floor', xdata.floor.count);
//                 $('#staticBackdrop').data('block', xdata.block.id);

//                 // Construct beds HTML
//                 let bedsHtml = '<div class="row justify-content-center mb-3">';
//                 response.beds.forEach(function(bed) {
//                     bedsHtml += `
//                         <div class="col-md-4 mb-3">
//                             <div class="card border-primary shadow">
//                                 <div class="card-body">
//                                     <h5 class="card-title text-primary">${bed.bed_name}</h5>
//                                     <p class="card-text"><strong>No of Beds:</strong> ${bed.no_of_beds}</p>
//                                     <p class="card-text"><strong>Assigned:</strong> ${bed.assigned_no}</p>
//                                     <p class="card-text"><strong>Available:</strong> ${bed.no_of_beds - bed.assigned_no}</p>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                 });
//                 bedsHtml += '</div>';

//                 // Construct the form inside an accordion
//                 let bedInputFields = `
//                     <div class="accordion pb-3" id="bedAssignAccordion">
//                         <div class="accordion-item">
//                             <h2 class="accordion-header" id="headingForm">
//                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
//                                     Bed Assignment Form
//                                 </button>
//                             </h2>
//                             <div id="collapseForm" class="accordion-collapse collapse" aria-labelledby="headingForm" data-bs-parent="#bedAssignAccordion">
//                                 <div class="accordion-body">
//                                     <form enctype="multipart/form-data" name="bedAssignForm" id="bedAssignForm">
//                 `;

//                 // Determine bed number prefix and total occupancy based on flag
//                 let totalOccupancy;
//                 let bedNumberPrefix = '';
//                 let infoData;

//                 if (flag === 'cabin') {
//                     infoData = response.cabininfo;
//                     totalOccupancy = infoData.total_occupancy;
//                     bedNumberPrefix = `${infoData.cabin_name}/${infoData.floor.floor_no}/${infoData.block.block_name}/`;
//                 } else if (flag === 'ward') {
//                     infoData = response.wardinfo;
//                     totalOccupancy = infoData.total_occupancy;
//                     bedNumberPrefix = `${infoData.ward_name}/${infoData.floor.floor_no}/${infoData.block.block_name}/`;
//                 } else if (flag === 'icu') {
//                     infoData = response.icuinfo;
//                     totalOccupancy = infoData.total_occupancy;
//                     bedNumberPrefix = `${infoData.icu_name}/${infoData.floor.floor_no}/${infoData.block.block_name}/`;
//                 }

//                 // Create a dropdown for bed names
//                 let bedAssignInputs = `
//                     <div class="row mb-3">
//                         <div class="col-md-6">
//                             <div class="mb-3">
//                                 <label for="bedNameDropdown" class="form-label">Bed Name</label>
//                                 <select class="form-select" id="bedNameDropdown" name="bedNameDropdown">
//                 `;
//                 response.beds.forEach(function(bed) {
//                     bedAssignInputs += `<option value="${bed.bed_name}">${bed.bed_name}</option>`;
//                 });
//                 bedAssignInputs += `
//                                 </select>
//                             </div>
//                         </div>
//                     </div>
//                 `;
//                 bedInputFields += bedAssignInputs;

//                 // Create checkboxes for bed numbers in row-column format
//                 bedInputFields += '<div class="row">';
//                 for (let i = 1; i <= totalOccupancy; i++) {
//                     bedInputFields += `
//                         <div class="col-md-3">
//                             <div class="form-check">
//                                 <input class="form-check-input" type="checkbox" id="bedNumber${i}" name="bedNumber[]" value="${bedNumberPrefix}${i}">
//                                 <label class="form-check-label" for="bedNumber${i}">
//                                     ${bedNumberPrefix}${i}
//                                 </label>
//                             </div>
//                         </div>
//                     `;
//                 }
//                 bedInputFields += '</div>';

//                 bedInputFields += `
//                     <div class="row justify-content-center mt-3">
//                         <div class="col-md-4">
//                             <button class="btn btn-success w-100" type="submit">Save</button>
//                         </div>
//                     </div>
//                 </form>
//                 </div>
//                 </div>
//                 </div>
//                 </div>`;

//                 // Construct information HTML inside another accordion item
//                 let infoHtml = '';
//                 if (flag === 'cabin') {
//                     infoHtml = `
//                         <div class="accordion pb-3" id="infoAccordion">
//                             <div class="accordion-item">
//                                 <h2 class="accordion-header" id="headingInfo">
//                                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo" aria-expanded="false" aria-controls="collapseInfo">
//                                         Cabin Information
//                                     </button>
//                                 </h2>
//                                 <div id="collapseInfo" class="accordion-collapse collapse" aria-labelledby="headingInfo" data-bs-parent="#infoAccordion">
//                                     <div class="accordion-body bg-light">
//                                         <table class="table table-bordered table-responsive">
//                                             <tbody>
//                                                 <tr>
//                                                     <th>Cabin Name</th>
//                                                     <td>${infoData.cabin_name}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Cabin Type</th>
//                                                     <td>${infoData.cabintype.cabin_type}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Floor</th>
//                                                     <td>${infoData.floor.floor_no}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Block</th>
//                                                     <td>${infoData.block.block_name}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Total Occupancy</th>
//                                                     <td>${infoData.total_occupancy}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Assigned</th>
//                                                     <td>${infoData.assigned}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Available</th>
//                                                     <td>${infoData.total_occupancy - infoData.assigned}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Amenities</th>
//                                                     <td>${infoData.amenities}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Price</th>
//                                                     <td>${infoData.price}</td>
//                                                 </tr>
//                                             </tbody>
//                                         </table>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                 } else if (flag === 'ward') {
//                     infoHtml = `
//                         <div class="accordion pb-3" id="infoAccordion">
//                             <div class="accordion-item">
//                                 <h2 class="accordion-header" id="headingInfo">
//                                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo" aria-expanded="false" aria-controls="collapseInfo">
//                                         Ward Information
//                                     </button>
//                                 </h2>
//                                 <div id="collapseInfo" class="accordion-collapse collapse" aria-labelledby="headingInfo" data-bs-parent="#infoAccordion">
//                                     <div class="accordion-body bg-light">
//                                         <table class="table table-bordered table-responsive">
//                                             <tbody>
//                                                 <tr>
//                                                     <th>Ward Name</th>
//                                                     <td>${infoData.ward_name}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Ward Type</th>
//                                                     <td>${infoData.wardtype.ward_type}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Floor</th>
//                                                     <td>${infoData.floor.floor_no}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Block</th>
//                                                     <td>${infoData.block.block_name}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Total Occupancy</th>
//                                                     <td>${infoData.total_occupancy}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Assigned</th>
//                                                     <td>${infoData.assigned}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Available</th>
//                                                     <td>${infoData.total_occupancy - infoData.assigned}</td>
//                                                 </tr>
//                                             </tbody>
                                       
//                                         </tbody>
//                                         </table>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                 } else if (flag === 'icu') {
//                     infoHtml = `
//                         <div class="accordion pb-3" id="infoAccordion">
//                             <div class="accordion-item">
//                                 <h2 class="accordion-header" id="headingInfo">
//                                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo" aria-expanded="false" aria-controls="collapseInfo">
//                                         ICU Information
//                                     </button>
//                                 </h2>
//                                 <div id="collapseInfo" class="accordion-collapse collapse" aria-labelledby="headingInfo" data-bs-parent="#infoAccordion">
//                                     <div class="accordion-body bg-light">
//                                         <table class="table table-bordered table-responsive">
//                                             <tbody>
//                                                 <tr>
//                                                     <th>ICU Name</th>
//                                                     <td>${infoData.icu_name}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>ICU Type</th>
//                                                     <td>${infoData.icutype.icu_type}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Floor</th>
//                                                     <td>${infoData.floor.floor_no}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Block</th>
//                                                     <td>${infoData.block.block_name}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Total Occupancy</th>
//                                                     <td>${infoData.total_occupancy}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Assigned</th>
//                                                     <td>${infoData.assigned}</td>
//                                                 </tr>
//                                                 <tr>
//                                                     <th>Available</th>
//                                                     <td>${infoData.total_occupancy - infoData.assigned}</td>
//                                                 </tr>
//                                             </tbody>
//                                         </table>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                 }

//                 // Update the modal content
//                 $('#bedInformation').html(bedsHtml);
//                 $('#bedAssignFormContainer').html(bedInputFields);
//                 $('#informationContainer').html(infoHtml);
//             },
//             error: function(response) {
//                 console.error('An error occurred while fetching data:', response);
//                 alert('An error occurred while fetching the data. Please try again.');
//             }
//         });
//     }
// }

// Handle form submission
// $(document).on('submit', '#bedAssignForm', function(event) {
//     event.preventDefault();
//     let formdata = new FormData(document.getElementById('bedAssignForm'));
//     let flag = $('#staticBackdrop').data('flag');
//     let id = $('#staticBackdrop').data('id');
//     let floor = $('#staticBackdrop').data('floor');
//     let block = $('#staticBackdrop').data('block');
//     formdata.append('_token', '{{ csrf_token() }}');
//     formdata.append('flag', flag);
//     formdata.append('id', id);
//     formdata.append('floor', floor);
//     formdata.append('block', block);

//     // Log the form data for debugging
//     for (let pair of formdata.entries()) {
//         console.log(pair[0] + ': ' + pair[1]);
//     }
    
//     $.ajax({
//         type: "POST",
//         url: "{{url('bedassign/assign')}}",
//         data: formdata,
//         processData: false,
//         contentType: false,
//         success: function(response) {
//             alert(response.message);
//             console.log(response.message);
//         },
//         error: function(response) {
//             console.error('An error occurred while assigning the bed:', response);
//             alert('An error occurred while assigning the bed. Please try again.');
//         }
//     });
// });



// function editBed(id, type) {
//     console.log(`Edit ${type} with ID: ${id}`);

//     $.ajax({
//         type: "GET",
//         url: "{{ url('editassignbed') }}/" + id + "/" + type,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: "json",
//         success: function(response) {
//             console.log(response);

//             // Clear previous modal content
//             $('#editmodal .modal-body').empty();

//             // Insert dynamic content into modal body
//             var modalBody = $('#editmodal .modal-body');

//             // Iterate over bedNames and bednumbers based on count
//             for (var i = 0; i < response.data.count; i++) 
//             {
//                 // Create row div
//                 var rowDiv = $('<div class="row"></div>');

//                 // Create first column for bed name
//                 var bedNameCol = $('<div class="col-md-6 mb-3"></div>');
//                 bedNameCol.append('<label for="bedNameSelect' + i + '" class="form-label">Bed Name ' + (i + 1) + '</label>');
//                 var bedNameSelect = $('<select class="form-select" id="bedNameSelect' + i + '" name="bed_name[]"></select>');
//                 $.each(response.data.beds, function(index, bed) {
//                     var option = $('<option>', {
//                         value: bed.id,
//                         text: bed.bed_name
//                     });
//                     // Check if bed.id exists in response.data.bedNames (IDs)
//                     if ($.inArray(bed.id.toString(), response.data.bedNames) !== -1) {
//                         option.attr('selected', 'selected');
//                     }
//                     bedNameSelect.append(option);
//                 });
//                 bedNameCol.append(bedNameSelect);
//                 rowDiv.append(bedNameCol);

//                 // Create second column for bed number
//                 var bedNumberCol = $('<div class="col-md-6 mb-3"></div>');
//                 bedNumberCol.append('<label for="bedNumber' + i + '" class="form-label">Bed Number ' + (i + 1) + '</label>');
//                 bedNumberCol.append('<input type="text" class="form-control" id="bedNumber' + i + '" name="bed_number[]" value="' + response.data.bednumber[i] + '">');
//                 rowDiv.append(bedNumberCol);

//                 // Append row to modal body
//                 modalBody.append(rowDiv);
//             }

//                 // Show the modal using Bootstrap
//                 let myModal = new bootstrap.Modal(document.getElementById('editmodal'));
//                 myModal.show();
//             },
//     });
// }

// function editBed(id, type) {
//     console.log(`Edit ${type} with ID: ${id}`);

//     $.ajax({
//         type: "GET",
//         url: "{{ url('editassignbed') }}/" + id + "/" + type,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: "json",
//         success: function(response) {
//             console.log(response);

//             // Clear previous modal content
//             $('#editmodal .modal-body').empty();

//             // Insert dynamic content into modal body
//             var modalBody = $('#editmodal .modal-body');

//             // Iterate over bedNames and bednumbers based on count
//             for (var i = 0; i < response.data.count; i++) {
//                 // Create row div
//                 var rowDiv = $('<div class="row"></div>');

//                 // Create first column for bed name
//                 var bedNameCol = $('<div class="col-md-6 mb-3"></div>');
//                 bedNameCol.append('<label for="bedNameSelect' + i + '" class="form-label">Bed Name ' + (i + 1) + '</label>');
//                 var bedNameSelect = $('<select class="form-select" id="bedNameSelect' + i + '" name="bed_name[]"></select>');
//                 $.each(response.data.beds, function(index, bed) {
//                     var option = $('<option>', {
//                         value: bed.id,
//                         text: bed.bed_name
//                     });
//                     // Check if bed.id exists in response.data.bedNames (IDs)
//                     if ($.inArray(bed.id.toString(), response.data.bedNames) !== -1) {
//                         option.attr('selected', 'selected');
//                     }
//                     bedNameSelect.append(option);
//                 });
//                 bedNameCol.append(bedNameSelect);
//                 rowDiv.append(bedNameCol);

//                 // Create second column for bed number
//                 var bedNumberCol = $('<div class="col-md-6 mb-3"></div>');
//                 bedNumberCol.append('<label for="bedNumber' + i + '" class="form-label">Bed Number ' + (i + 1) + '</label>');
//                 bedNumberCol.append('<input type="text" class="form-control" id="bedNumber' + i + '" name="bed_number[]" value="' + response.data.bednumber[i] + '">');
//                 rowDiv.append(bedNumberCol);

//                 // Append row to modal body
//                 modalBody.append(rowDiv);
//             }

//             // Append update button
//             var updateButton = $('<button>', {
//                 text: 'Update',
//                 class: 'btn btn-primary',
//                 click: function() {
//                     updateBedAssignment(id, type);
//                 }
//             });
//             modalBody.append(updateButton);

//             // Show the modal using Bootstrap
//             let myModal = new bootstrap.Modal(document.getElementById('editmodal'));
//             myModal.show();
//         }
//     });
// }











</script>
<style>
  .accordion-body {
    /* background-color: rgb(166,214,8); Light grey background */
    border-radius: 5px; /* Rounded corners */
    padding: 15px; /* Padding inside the accordion body */
    }

.accordion-button {
    /* background-color: rgb(166,214,8,0.7); Primary color background */
    background-color: rgb(172,225,175,0.6);
    /* White text color */
}

.accordion-button:focus {
    box-shadow: none; /* Remove focus shadow */
}

.accordion-button:not(.collapsed) {
    /* White text color when expanded */
    /* background-color: rgb(166,214,8,0.5); Darker primary color when expanded */
    background-color:#ace1af;
}

.floor-card {
    background-color: #f8f9fa; /* Light grey background */
    border: 1px solid #ddd; /* Light border */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Subtle shadow */
    margin-bottom: 20px; /* Space between cards */
}

.floor-card .card-body {
    padding: 20px; /* Padding inside the card */
}

.floor-card .card-title {
    font-size: 24px; /* Larger title font */
    margin-bottom: 15px; /* Space below title */
}

.floor-card .inner-card {
    background-color: #ffffff; /* White background for inner cards */
    border: 1px solid #ccc; /* Slightly darker border */
    border-radius: 5px; /* Slightly rounded corners */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow */
    margin-bottom: 15px; /* Space between inner cards */
}

.floor-card .inner-card .card-body {
    padding: 10px; /* Adjusted padding inside the inner card */
}

.floor-card .inner-card .card-title {
    font-size: 20px; /* Slightly smaller title font */
    margin-bottom: 10px; /* Space below title */
}

.floor-card .inner-card .card-text {
    font-size: 14px; /* Standard text size */
    color: #555; /* Slightly darker text color */
}

.cabin-card {
    background-color: #d1e7dd; /* Light green background for cabin cards */
    border: 1px solid #c1dfd1; /* Light green border */
}

.ward-card {
    background-color: #f0d6e9; /* Light purple background for ward cards */
    border: 1px solid #e1c9dc; /* Light purple border */
}

.icu-card {
    background-color: #c7e7fb; /* Light blue background for ICU cards */
    border: 1px solid #b9d9f2; /* Light blue border */
}

.cabin-card, .ward-card, .icu-card {
    border-radius: 5px; /* Slightly rounded corners */
    padding: 10px; /* Padding inside the card */
    margin-bottom: 15px; /* Space between cards */
    transition: transform 0.3s, box-shadow 0.3s; /* Transition effects */
    width: calc(50% - 10px); /* Full width minus margins */
    margin-right: 0; /* Reset margin between cards */
    display: block; /* Display as block for mobile responsiveness */
    box-sizing: border-box; /* Include padding and border in width calculation */
}

.cabin-card:hover, .ward-card:hover, .icu-card:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
    box-shadow: 0 4px 12px rgba(0,0,0,0.2); /* More pronounced shadow on hover */
}

.cabin-card .card-title, .ward-card .card-title, .icu-card .card-title {
    font-size: 16px; /* Smaller title font */
    margin-bottom: 5px; /* Space below title */
}

.cabin-card .card-text, .ward-card .card-text, .icu-card .card-text {
    font-size: 12px; /* Smaller text size */
    color: #333; /* Darker text color */
}

.scrollable {
    max-height: 300px; /* Adjust the max-height as per your design needs */
    overflow-y: auto;
}

.inner-card {
    height: 100%;
}

.no-cabins {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px; /* Adjust the height as needed */
    text-align: center; /* Ensure text is centered */
}

@media (min-width: 768px) {
    .cabin-card, .ward-card, .icu-card {
        width: calc(25% - 10px); /*Four cards in a row with margin between them */
        margin-right: 10px; /* Margin between cards */
        display: inline-block; /* Display as inline block to fit four in a row */
        vertical-align: top; /* Align cards to the top */
    }
}

.edit-btn {
    display: none;
    background-color: #dc075e; /* Blue background */
    color: #fff; /* White text */
    border: none;
    padding: 2px 15px; /* Increased padding for better look */
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px; /* Slightly larger font size */
    font-weight: bold; /* Bold text */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    opacity: 0; /* Start with hidden */
    margin-top: 10px;
    transform: translateY(20px); /* Start with button moved down */
}

.cabin-card.bg-danger:hover .edit-btn,
.ward-card.bg-danger:hover .edit-btn,
.icu-card.bg-danger:hover .edit-btn {
    display: block;
    transform: translateY(0); /* Move to original position */
    opacity: 1; /* Fully visible */
}
</style>




@endsection
