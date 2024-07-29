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
                                        <h3 class="headingcolor">Patient Status</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Patient Status</li>
                                        </ol>
                                    </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form enctype="multipart/form-data" name="dischargeform" id="dischargeform">
                                    <input type="hidden" id="saveurl" value="{{ url('discharge/saveData') }}" />
                                    <input type="hidden" id="recordid" name="recordid" value="" />
                                    <!-- <input type="hidden" id="dischargecount" name="dischargecount" value="" /> -->
                                    <input type="hidden" id="mode" name="mode">
                                        <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                        <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                        <div class="row pb-5">
                                            <div class="col-md-6">
                                                <select id="regn" name="regn" class="form-control select2" onchange="searchPatient()">
                                                        <option value="" selected disabled>Select</option>
                                                    @foreach($regns as $regn)
                                                        <option value="{{$regn->patient_regn_no}}">{{$regn->patient_regn_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </form>
                                <div class="col-md-12">
                                    <div id="patientDetails"></div>
                                </div>
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
<style>
    .token-details {
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
}

.token-details p {
    margin: 0;
}

.token-details hr {
    margin: 10px 0;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Search existing patient",
            allowClear: true
        });
    });

    function searchPatient(){
    let regn = $('#regn').val();
    if (regn) {
        $.ajax({
            url: "{{ url('searchPatient/status') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", regn: regn },
            success: function(response) {
                populatePatientDetails(response.patientInfo);
            },
            error: function(response) {
                alert("Error!!!");
            }
        });
    }
}

function populatePatientDetails(patientInfo) {
    if (patientInfo) {
        $('#patientDetails').empty();

        let patientDetails = `
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Patient Information</h4>
                    <button class="btn btn-danger btn-sm" onclick="updateStatusToDeceased(${patientInfo.id})">Mark as Deceased</button>
                    <button class="btn btn-info btn-sm ml-2" onclick="updateStatusToBorn(${patientInfo.id})">Parturition Successful</button>
                    <button class="btn btn-primary btn-sm ml-2" onclick="updateStatusDischargeProcess(${patientInfo.id})">Proceed for Discharge</button>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> ${patientInfo.patient_name}</p>
                    <p><strong>Phone:</strong> ${patientInfo.patient_phone}</p>
                    <p><strong>Email:</strong> ${patientInfo.patient_email}</p>
                    <p><strong>Address:</strong> ${patientInfo.patient_address}</p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Token Information</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Token No</th>
                                <th>Attendant Name</th>
                                <th>Bed Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        patientInfo.tokens.forEach(token => {
            patientDetails += `
                <tr>
                    <td>${token.token_no}</td>
                    <td>${token.attendant_name}</td>
                    <td>${token.bednumber}</td>
                    <td>${token.status}</td>
                </tr>
            `;
        });

        patientDetails += `</tbody></table></div></div>`;
        $('#patientDetails').append(patientDetails);
    }
}


function updateStatusToDeceased(tokenId) {
    alert(tokenId);
    if (confirm("Are you sure you want to mark this patient as deceased?")) {
        $.ajax({
            url: "{{ url('updateTokenStatus') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", tokenId: tokenId },
            success: function(response) {
                if(response.status){
                    alert(response.message);
                    window.location.reload();
                }else{
                    alert(response.message);
                }
                
            },
            error: function(response) {
                alert("Error!!!");
            }
        });
    }
}

function updateStatusToBorn(tokenId) {
    alert(tokenId);
    if (confirm("Are you sure you want to mark this patient as New born?")) {
        $.ajax({
            url: "{{ url('updateStatusBorn') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", tokenId: tokenId },
            success: function(response) {
                if(response.status){
                    alert(response.message);
                    window.location.reload();
                }else{
                    alert(response.message);
                }
                
            },
            error: function(response) {
                alert("Error!!!");
            }
        });
    }
}


function updateStatusDischargeProcess(tokenId) {
    alert(tokenId);
    if (confirm("Are you sure you want to process this patient to discharge?")) {
        $.ajax({
            url: "{{ url('updateStatusdischargeprocess') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", tokenId: tokenId },
            success: function(response) {
                if(response.status){
                    alert(response.message);
                    window.location.reload();
                }else{
                    alert(response.message);
                }
                
            },
            error: function(response) {
                alert("Error!!!");
            }
        });
    }
}

</script>

@endsection