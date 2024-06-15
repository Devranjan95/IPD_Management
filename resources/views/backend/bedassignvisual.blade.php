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
                        <div class="col-md-12">
                            @foreach($floors as $floor)
                                <div class="floor-card mb-3">
                                    <div class="card-body text-center">
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
                                                                        $occupancu = $cabin->total_occupancy;
                                                                        $assigned = $cabin->assigned;
                                                                        $available = $occupancu - $assigned;
                                                                    @endphp
                                                                    @if($available === 0)
                                                                        <div class="cabin-card bg-danger text-white">
                                                                            <h6>{{ $cabin->cabin_name }}</h6>
                                                                            <p style="font-size:12px">Not available</p>
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
                                                                        $occupancu = $ward->total_occupancy;
                                                                        $assigned = $ward->assigned;
                                                                        $available = $occupancu - $assigned;
                                                                    @endphp
                                                                    @if($available === 0)
                                                                        <div class="ward-card bg-danger text-white">
                                                                            <h6>{{ $ward->ward_name }}</h6>
                                                                            <p style="font-size:12px">Not available</p>
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
                                                                        $occupancu = $icu->total_occupancy;
                                                                        $assigned = $icu->assigned;
                                                                        $available = $occupancu - $assigned;
                                                                    @endphp
                                                                    @if($available === 0)
                                                                        <div class="icu-card bg-danger text-white">
                                                                            <h6>{{ $icu->icu_name }}</h6>
                                                                            <p style="font-size:12px">Not available</p>
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
        <h5 class="modal-title" id="staticBackdropLabel">Cabin and Bed Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Content will be dynamically inserted here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script>
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

//                 // Construct beds HTML with improved styling
//                 let bedsHtml = '<div class="row justify-content-center mb-3">';
//                 response.beds.forEach(function(bed) {
//                     bedsHtml += `
//                         <div class="col-md-4 mb-3">
//                             <div class="card border-primary shadow">
//                                 <div class="card-body">
//                                     <h5 class="card-title text-primary">${bed.bed_name}</h5>
//                                     <p class="card-text"><strong>No of Beds:</strong> ${bed.no_of_beds}</p>
//                                     <p class="card-text"><strong>Assigned:</strong> ${bed.assigned_no}</p>
//                                     <p class="card-text"><strong>Available:</strong> ${bed.no_of_beds-bed.assigned_no}</p>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                 });
//                 bedsHtml += '</div>';

//                 // Construct dynamic bed input fields based on cabin occupancy
//                 let bedInputFields = '';
//                 for (let i = 1; i <= response.cabininfo.total_occupancy; i++) {
//                     bedInputFields += `
//                     <div class="row">
//                         <div class="col-md-5">
//                             <div class="mb-3">
//                                 <label for="bedNumber" class="form-label">Bed Number</label>
//                                 <input type="number" class="form-control" id="bedNumber" name="bedNumber[]" placeholder="Enter Bed Number">
//                             </div>
//                         </div>
//                         <div class="col-md-5">
//                             <div class="mb-3">
//                                 <label for="bedName" class="form-label">Bed Name </label>
//                                 <select class="form-select" id="bedname" name="bedName[]">
//                                     ${response.beds.map(bed => `<option value="${bed.id}">${bed.bed_name}</option>`).join('')}
//                                 </select>
//                             </div>
//                         </div>
//                         <div class="col-md-2 mt-4">
//                             <a type="button" class="btn btn-sm btn-success">Save</a>
//                         </div>
//                     </div>
//                     `;
//                 }

//                 // Construct cabin info HTML inside an accordion with custom background
//                 let cabinInfoHtml = `
//                     <div class="accordion pb-3" id="cabinInfoAccordion">
//                         <div class="accordion-item">
//                             <h2 class="accordion-header" id="headingOne">
//                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
//                                     Cabin Information
//                                 </button>
//                             </h2>
//                             <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#cabinInfoAccordion">
//                                 <div class="accordion-body bg-light">
//                                     <table class="table table-bordered table-responsive">
//                                         <tbody>
//                                             <tr>
//                                                 <th>Cabin Name</th>
//                                                 <td>${response.cabininfo.cabin_name}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Cabin Type</th>
//                                                 <td>${response.cabintype}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Floor</th>
//                                                 <td>${response.floor}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Block</th>
//                                                 <td>${response.block}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Total Occupancy</th>
//                                                 <td>${response.cabininfo.total_occupancy}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Assigned</th>
//                                                 <td>${response.cabininfo.assigned}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Available</th>
//                                                 <td>${response.cabininfo.available}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Amenities</th>
//                                                 <td>${response.cabininfo.amenities}</td>
//                                             </tr>
//                                             <tr>
//                                                 <th>Price</th>
//                                                 <td>${response.cabininfo.price}</td>
//                                             </tr>
//                                         </tbody>
//                                     </table>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 `;

//                 // Construct bed input fields inside an accordion with a custom background
//                 let bedInputHtml = `
//                     <div class="accordion" id="bedInputAccordion">
//                         <div class="accordion-item">
//                             <h2 class="accordion-header" id="headingTwo">
//                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
//                                     Bed Assign Form
//                                 </button>
//                             </h2>
//                             <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#bedInputAccordion">
//                                 <div class="accordion-body">
//                                     ${bedInputFields}
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 `;

//                 // Update modal body with constructed HTML
//                 $('.modal-body').html(cabinInfoHtml + bedsHtml + bedInputHtml);
//             },
//             error: function(response) {
//                 console.log(response);
//             }
//         });
//     }
// }
function takeValue(id, flag) {
    if (id) {
        $.ajax({
            type: 'POST',
            url: '{{url("bedform/getalldata")}}',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                flag: flag
            },
            success: function(response) {
                let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                myModal.show();

                // Construct beds HTML with improved styling
                let bedsHtml = '<div class="row justify-content-center mb-3">';
                response.beds.forEach(function(bed) {
                    bedsHtml += `
                        <div class="col-md-4 mb-3">
                            <div class="card border-primary shadow">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">${bed.bed_name}</h5>
                                    <p class="card-text"><strong>No of Beds:</strong> ${bed.no_of_beds}</p>
                                    <p class="card-text"><strong>Assigned:</strong> ${bed.assigned_no}</p>
                                    <p class="card-text"><strong>Available:</strong> ${bed.no_of_beds - bed.assigned_no}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
                bedsHtml += '</div>';

                // Construct dynamic bed input fields
                let bedInputFields = '';
                let totalOccupancy;
                if (flag === 'cabin') {
                    totalOccupancy = response.cabininfo.total_occupancy;
                } else if (flag === 'ward') {
                    totalOccupancy = response.wardinfo.total_occupancy;
                } else if (flag === 'icu') {
                    totalOccupancy = response.icuinfo.total_occupancy;
                }

                for (let i = 1; i <= totalOccupancy; i++) {
                    bedInputFields += `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bedNumber" class="form-label">Bed Number</label>
                                <input type="number" class="form-control" id="bedNumber" name="bedNumber[]" placeholder="Enter Bed Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bedName" class="form-label">Bed Name </label>
                                <select class="form-select" id="bedname" name="bedName[]">
                                 <option value="" disabled selected>Please select a bed</option>
                                    ${response.beds.map(bed => `<option value="${bed.id}">${bed.bed_name}</option>`).join('')}
                                </select>
                            </div>
                        </div>
                    </div>
                    `;
                }

                // Construct information HTML inside an accordion with custom background
                let infoHtml = '';
                if (flag === 'cabin') {
                    infoHtml = `
                        <div class="accordion pb-3" id="infoAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Cabin Information
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#infoAccordion">
                                    <div class="accordion-body bg-light">
                                        <table class="table table-bordered table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th>Cabin Name</th>
                                                    <td>${response.cabininfo.cabin_name}</td>
                                                </tr>
                                                <tr>
                                                    <th>Cabin Type</th>
                                                    <td>${response.cabintype}</td>
                                                </tr>
                                                <tr>
                                                    <th>Floor</th>
                                                    <td>${response.floor}</td>
                                                </tr>
                                                <tr>
                                                    <th>Block</th>
                                                    <td>${response.block}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Occupancy</th>
                                                    <td>${response.cabininfo.total_occupancy}</td>
                                                </tr>
                                                <tr>
                                                    <th>Assigned</th>
                                                    <td>${response.cabininfo.assigned}</td>
                                                </tr>
                                                <tr>
                                                    <th>Available</th>
                                                    <td>${response.cabininfo.available}</td>
                                                </tr>
                                                <tr>
                                                    <th>Amenities</th>
                                                    <td>${response.cabininfo.amenities}</td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>${response.cabininfo.price}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else if (flag === 'ward') {
                    infoHtml = `
                        <div class="accordion pb-3" id="infoAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Ward Information
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#infoAccordion">
                                    <div class="accordion-body bg-light">
                                        <table class="table table-bordered table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th>Ward Name</th>
                                                    <td>${response.wardinfo.ward_name}</td>
                                                </tr>
                                                <tr>
                                                    <th>Ward Type</th>
                                                    <td>${response.wardtype}</td>
                                                </tr>
                                                <tr>
                                                    <th>Floor</th>
                                                    <td>${response.floor}</td>
                                                </tr>
                                                <tr>
                                                    <th>Block</th>
                                                    <td>${response.block}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Occupancy</th>
                                                    <td>${response.wardinfo.total_occupancy}</td>
                                                </tr>
                                                <tr>
                                                    <th>Assigned</th>
                                                    <td>${response.wardinfo.assigned}</td>
                                                </tr>
                                                <tr>
                                                    <th>Available</th>
                                                    <td>${response.wardinfo.available}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else if (flag === 'icu') {
                    infoHtml = `
                        <div class="accordion pb-3" id="infoAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        ICU Information
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#infoAccordion">
                                    <div class="accordion-body bg-light">
                                        <table class="table table-bordered table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th>ICU Name</th>
                                                    <td>${response.icuinfo.icu_name}</td>
                                                </tr>
                                                <tr>
                                                    <th>ICU Type</th>
                                                    <td>${response.icutype}</td>
                                                </tr>
                                                <tr>
                                                    <th>Floor</th>
                                                    <td>${response.floor}</td>
                                                </tr>
                                                <tr>
                                                    <th>Block</th>
                                                    <td>${response.block}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Occupancy</th>
                                                    <td>${response.icuinfo.total_occupancy}</td>
                                                </tr>
                                                <tr>
                                                    <th>Assigned</th>
                                                    <td>${response.icuinfo.assigned}</td>
                                                </tr>
                                                <tr>
                                                    <th>Available</th>
                                                    <td>${response.icuinfo.available}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                // Construct bed input fields inside an accordion with a custom background
                let bedInputHtml = `
                    <div class="accordion" id="bedInputAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Bed Assign Form
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#bedInputAccordion">
                                <div class="accordion-body">
                                    ${bedInputFields}
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 d-flex justify-content-center">
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <button class="btn btn-success" type="button">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Update modal body with constructed HTML
                $('.modal-body').html(bedsHtml + infoHtml + bedInputHtml);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
}




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

</style>




@endsection
