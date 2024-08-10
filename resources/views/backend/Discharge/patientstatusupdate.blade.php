@extends('masterlayout.masterlayout')
@section('content')


<section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">


                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdrop">Birth Record Entry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                          <div class="p-3">      
                            <form enctype="multipart/form-data" name="birthRecordForm" id="birthRecordForm">
    
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="mode" name="mode">


                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"></div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"></div>


                                <div class="row pb-2">
                                    <div class="col-md-3">
                                        <label for="regn" class="form-label">Registration No</label>
                                        <input type="text" class="form-control"  id="regnno" name="regnno" readonly>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="patname" class="form-label">Patient Name/Mother's Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Patient Name" id="patname" name="patname" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="contact" class="form-label">Contact No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Contact" id="contact" name="contact" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="addmission" class="form-label">Mother's Date of Addmission<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="date" class="form-control" id="addmissiondate" name="addmissiondate">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="time" class="form-label">Mother's Time of Addmission<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="time" class="form-control" id="addmissiontime" name="addmissiontime">
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="fathername" class="form-label">New Born's Father Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Father's Name" id="fathername" name="fathername">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fatheradhar" class="form-label">Father's Aadhar No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Father's Aadhar No" id="fatheradhar" name="fatheradhar" maxlength="12">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="motheradhar" class="form-label">Mother's Aadhar No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mother's Aadhar No" id="motheradhar" name="motheradhar" maxlength="12">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="address" class="form-label">Address<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    
                                    <div class="col-md-3">
                                        <label for="maritalstatus" class="form-label">Mother's Marital Status<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="maritalstatus" name="maritalstatus" class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label for="image_path" class="form-label">Upload Image<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="file" class="form-control" id="imgfile" name="imgfile[]" accept=".jpg, .jpeg, .png, .webp, .svg" multiple>
                                    </div> -->
                                    <div class="col-md-3">
                                        <label for="issuedby" class="form-label">Certificate Issued By<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Issued By" id="issuedby" name="issuedby">
                                    </div>
                                </div>
                                <hr style="color:green">
                                    <div class="row pb-3">
                                        <div class="col-md-3">
                                            <label for="repeatCount" class="form-label">Number of New Born Entries<span style="color:red" title="Mandatory">*</span></label>
                                            <input type="number" class="form-control" id="repeatCount" name="repeatCount" min="1" oninput="generateNewBornEntries()">
                                        </div>
                                    </div>
                                
                                    <div id="newBornEntriesContainer"></div>
                                <hr style="color:green">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-success" type="submit">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>          
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button> -->
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                        </div>
                    </div>
                </div>    
<!-- ********************************************************************* -->
<div id="success_tic" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body">
                <div class="head">  
                    <!-- <h3 style="margin-top:5px;"></h3> -->
                    <h4>Birth record saved successfully</h4>
                </div>

                <h1 style="text-align:center;">
                    <div class="checkmark-circle">
                        <div class="background"></div>
                        <div class="checkmark draw"></div>
                    </div>
                <h1>

            </div>
        </div>
    </div>
</div>
 <!-- *********************************************************************** -->
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
                                                <select id="regn" name="regn" class="form-control select2" oninput="searchPatient()">
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
/* ******************************************************* */
body{
  background-color: #e6e6e6;
  width: 100%;
  height: 100%;
}
 #success_tic .page-body{
  max-width:300px;
  background-color:#FFFFFF;
  margin:10% auto;
}
 #success_tic .page-body .head{
  text-align:center;
}
/* #success_tic .tic{
  font-size:186px;
} */
#success_tic .close{
      opacity: 1;
    position: absolute;
    right: 0px;
    font-size: 30px;
    padding: 3px 15px;
  margin-bottom: 10px;
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
  background: #1ab394;
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
  border-right: 15px solid #fff;
  border-top: 15px solid #fff;
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
/* ***************************************************** */
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('.select2').select2({
    //         placeholder: "Search existing patient",
    //         allowClear: true
    //     });
    // });

// ******************************************************************
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Search existing patient",
        allowClear: true
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Only letters and spaces are allowed.");

    $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value > 0);
    }, "Value must be a positive number.");

    $.validator.addMethod("validDate", function(value, element) {
        return this.optional(element) || new Date(value) <= new Date();
    }, "Date of birth cannot be in the future.");

    $.validator.addMethod("validBirthDate", function(value, element) {
        let admissionDate = $('#addmissiondate').val();
        if (!admissionDate) return true; // If admission date is not set, skip validation
        return this.optional(element) || new Date(value) >= new Date(admissionDate);
    }, "Date of birth cannot be before the date of admission.");

    $.validator.addMethod("validBirthTime", function(value, element) {
        let birthDate = $(element).closest('.new-born-entry').find('.birthdate').val();
        let admissionDate = $('#addmissiondate').val();
        let admissionTime = $('#addmissiontime').val();

        if (!birthDate || !admissionDate || !admissionTime) return true; // If any date/time is not set, skip validation

        let currentDateTime = new Date();
        let birthDateTime = new Date(`${birthDate}T${value}`);
        if (birthDateTime > currentDateTime) return false; // Birth time cannot be in the future

        if (new Date(birthDate) > new Date(admissionDate)) return true; // If birth date is after admission date, skip time validation
        if (new Date(birthDate) < new Date(admissionDate)) return false; // If birth date is before admission date, fail validation

        // If birth date is the same as admission date, compare times
        let admissionDateTime = new Date(`${admissionDate}T${admissionTime}`);
        return this.optional(element) || birthDateTime >= admissionDateTime;
    }, "Time of birth cannot be before the time of admission on the same day or in the future.");

    $.validator.addMethod("numericOnly", function(value, element) {
        return this.optional(element) || /^\d+$/.test(value);
    }, "Only numeric values are allowed.");

    $.validator.addMethod("fileSize", function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File must be less than 28KB.");

    $.validator.addMethod("imageType", function(value, element) {
        return this.optional(element) || (/\.(jpe?g|png|webp|svg)$/i).test(value);
    }, "Please upload a valid image file (jpg, jpeg, png, webp, svg).");

    $.validator.addMethod("float", function(value, element) {
        return this.optional(element) || /^(\d+(\.\d+)?)$/.test(value);
    }, "Please enter a valid number.");

    function applyValidationRules() {
        $("#birthRecordForm").validate({
            rules: {
                regn: { required: true },
                patname: { required: true },
                contact: { required: true },
                fathername: { required: true, alphanumeric: true },
                mothername: { required: true },
                fatheradhar: { required: true, numericOnly: true },
                motheradhar: { required: true, numericOnly: true },
                address: { required: true },
                maritalstatus: { required: true },
                imgfile: { required: true, imageType: true, fileSize: 28000 },
                issuedby: { required: true },
                repeatCount:{ required: true}
            },
            messages: {
                regn: { required: "Please select registration no" },
                patname: { required: "Patient name is required." },
                contact: { required: "Contact is required" },
                fathername: { required: "Please enter the father's name", alphanumeric: "Father's name must contain only letters and spaces" },
                mothername: { required: "Please enter the mother's name" },
                fatheradhar: { required: "Father's Aadhar number is required", numericOnly: "Father's Aadhar number must be numeric" },
                motheradhar: { required: "Mother's Aadhar number is required", numericOnly: "Mother's Aadhar number must be numeric" },
                address: { required: "Please enter the address" },
                maritalstatus: { required: "Please select marital status" },
                imgfile: { required: "Please upload an image", imageType: "Please upload a valid image file (jpg, jpeg, png, webp, svg)", fileSize: "File must be less than 28KB" },
                issuedby: { required: "Please enter the name of the person issuing the certificate" },
                repeatCount:{ required: "Please enter number of new born"}
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                if (element.hasClass('select2')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).hasClass('select2')) {
                    $(element).next('.select2-container').find('.select2-selection').addClass('is-invalid').removeClass('is-valid');
                } else {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                if ($(element).hasClass('select2')) {
                    $(element).next('.select2-container').find('.select2-selection').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            },
            submitHandler: function(form) {
                var formData = new FormData(form);
                formData.append('_token', '{{ csrf_token() }}');
                if(confirm('Do you want to save thr birth entry')){
                    $.ajax({
                        url: "{{ url('saveBorn/savedata') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status) {
                                
                                let myModal = new bootstrap.Modal(document.getElementById('success_tic'),{
                                    backdrop: 'static',
                                    keyboard: false
                                });
                                myModal.show();

                                $("#success").text(response.message).show();
                                $("#error").hide();
                                setTimeout(function() {
                                    $('#success').slideUp();
                                }, 4000);

                                if ($("#mode").val() === 'add') {
                                    $("#birthRecordForm")[0].reset(); // Reset the form
                                } 
                                else {
                                    window.location.reload();
                                // window.location.href = "{{url('patientstatusupdate')}}"
                                }
                            } else {
                                $("#error").text(response.message).show();
                                $("#success").hide();
                                setTimeout(function() {
                                    $('#error').slideUp();
                                }, 2000);
                            }
                        },
                        error: function(xhr) {
                            var response = JSON.parse(xhr.responseText);
                            $("#error").text("An error occurred: " + response.message).show();
                            $("#success").hide();
                            setTimeout(function() {
                                $('#error').slideUp();
                            }, 4000);
                        }
                    });
                }
            }
        });

        for (let i = 0; i < $('#repeatCount').val(); i++) {
            $(`#birthdate_${i}`).rules("add", { required: true, validDate: true, validBirthDate: true });
            $(`#birthtime_${i}`).rules("add", { required: true, validBirthTime: true });
            $(`#placeofbirth_${i}`).rules("add", { required: true });
            $(`#gender_${i}`).rules("add", { required: true });
            $(`#weight_${i}`).rules("add", { required: true, float: true, positiveNumber: true });
            $(`#length_${i}`).rules("add", { required: true, float: true, positiveNumber: true });
        }
    }

    applyValidationRules();

    $('#repeatCount').on('input', function() {
        generateNewBornEntries();
        applyValidationRules(); // Reapply validation rules after generating new entries
    });
});
// *****************************************************************

function searchPatient() {
    let regn = $('#regn').val();
    //alert(regn);
    if (regn) {
        $.ajax({
            url: "{{ url('searchPatient/status') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", regn: regn },
            success: function(response) {
                populatePatientDetails(response.patientInfo);
                //$('#regnno').val() = '1';
                //document.getElementById('regnno').value = patientInfo.patient_regn_no;
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
        $('#regnno').val(patientInfo.patient_regn_no);
        $('#patname').val(patientInfo.patient_name);
        $('#contact').val(patientInfo.patient_phone);
        $('#addmissiondate').val(patientInfo.tokens[0].date_of_addmission);
        $('#addmissiontime').val(patientInfo.tokens[0].time_of_addmission);
        // $('#addmissiondate').val(patientInfo.token.addmission_date);
        // $('#addmissiontime').val(patientInfo.addmission_time);
        // Check if any token has deceased_status of 'Y'
        //let addmissionDate = patientInfo.tokens.some(token => token.date_of_addmission)
        //console.log(patientInfo.tokens[0].date_of_addmission);
        let hasMaternityStatus = patientInfo.tokens.some(token => token.maternity_status === 'Successful-R');
        let hasDeceasedToken = patientInfo.tokens.some(token => token.deceased_status === 'Y' || token.deceased_status === 'Y-R');
        let firstTokenId = patientInfo.tokens.length > 0 ? patientInfo.tokens[0].id : null;

        let patientDetails = `
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Patient Information</h4>
                    <button class="btn btn-danger btn-sm" id="markAsDeceasedBtn" ${hasDeceasedToken ? 'disabled' : ''} onclick="updateStatusToDeceased(${firstTokenId})">Mark as Deceased</button>
                    <!--<button class="btn btn-info btn-sm ml-2" id="markAsBornBtn" onclick="updateStatusToBorn(${firstTokenId})">Parturition Successful</button>-->
                    <button class="btn btn-info btn-sm ml-2" id="markAsBornBtn" ${hasMaternityStatus ? 'disabled' : ''} data-bs-toggle="modal" data-bs-target="#staticBackdrop">Labour Delivery Successful</button>
                    <button class="btn btn-primary btn-sm ml-2" onclick="updateStatusDischargeProcess(${firstTokenId})">Proceed for Discharge</button>
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
                                <th>Deceased Status</th>
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
                    <td>${token.deceased_status || 'N/A'}</td>
                </tr>
            `;
        });

        patientDetails += `</tbody></table></div></div>`;
        $('#patientDetails').append(patientDetails);
    }
}



function updateStatusToDeceased(tokenId) {
    //alert(tokenId);
    if (confirm("Are you sure you want to mark this patient as deceased?")) {
        $.ajax({
            url: "{{ url('updateTokenStatus') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", tokenId: tokenId },
            success: function(response) {
                if(response.status){
                    alert(response.message);
                    $('#markAsDeceasedBtn').prop('disabled', true);
                    //window.location.reload();
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


// function updateStatusToBorn(tokenId) {
//     let id = tokenId;
//     alert(id);
//     if (confirm("Are you sure you want to mark this patient as New born?")) {
//         $.ajax({
//             url: "{{ url('updateStatusBorn') }}/"+id, // Use template literals for URL
//             type: "GET",
//             headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }, // Send CSRF token as query parameter
//             success: function(response) {
//                 if (response.status) {
//                     alert(1);
//                     let token = response.token;
//                     let patient = token.patient;

//                     // if (response.tokenInfo.maternity_status === "Successful-R") {
//                     //     $('#markAsBornBtn').prop('disabled', true);
//                     // }
                    
//                     // Construct the URL with query parameters
//                     let urlloc = `{{ url('birthentry') }}?tokenId=${token.id}&patientId=${patient.id}&regn=${token.patient_regn_no}&adddate=${token.date_of_addmission}&addtime=${token.time_of_addmission}&patientName=${patient.patient_name}&patientPhone=${patient.patient_phone}`;
//                     window.location.href = urlloc;
                    
//                 } else {
//                     alert(response.message);
//                 }
//             },
//             error: function(response) {
//                 alert("Error!!!");
//             }
//         });
//     }
// }
function getQueryParams() {
    let params = {};
    let queryString = window.location.search.substring(1);
    let queryArray = queryString.split("&");
    for (let i = 0; i < queryArray.length; i++) {
        let pair = queryArray[i].split("=");
        params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
    }
    return params;
}

       
    
function generateNewBornEntries() {

    const container = document.getElementById('newBornEntriesContainer');
    container.innerHTML = ''; // Clear previous entries
    const count = parseInt(document.getElementById('repeatCount').value, 10);

    for (let i = 0; i < count; i++) {
        container.innerHTML += `
            <div class="new-born-entry">
                <h5>New Born Entry ${i + 1}</h5>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <label for="birthdate_${i}" class="form-label">New Born's Date of Birth<span style="color:red" title="Mandatory">*</span></label>
                        <input type="date" class="form-control birthdate" id="birthdate_${i}" name="birthdate_${i}">
                    </div>
                    <div class="col-md-3">
                        <label for="birthtime_${i}" class="form-label">New Born's Time of Birth<span style="color:red" title="Mandatory">*</span></label>
                        <input type="time" class="form-control" id="birthtime_${i}" name="birthtime_${i}">
                    </div>
                    <div class="col-md-3">
                        <label for="placeofbirth_${i}" class="form-label">New Born's Place of Birth<span style="color:red" title="Mandatory">*</span></label>
                        <input type="text" class="form-control" id="placeofbirth_${i}" name="placeofbirth_${i}">
                    </div>
                    <div class="col-md-3">
                        <label for="gender_${i}" class="form-label">New Born's Gender<span style="color:red" title="Mandatory">*</span></label>
                        <select class="form-control" id="gender_${i}" name="gender_${i}">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="weight_${i}" class="form-label">Weight (in kg)<span style="color:red" title="Mandatory">*</span></label>
                        <input type="text" class="form-control" id="weight_${i}" name="weight_${i}">
                    </div>
                    <div class="col-md-3">
                        <label for="length_${i}" class="form-label">Length (in cm)<span style="color:red" title="Mandatory">*</span></label>
                        <input type="text" class="form-control" id="length_${i}" name="length_${i}">
                    </div>
                     <div class="col-md-3">
                        <label for="image_path" class="form-label">Upload Image<span style="color:red" title="Mandatory">*</span></label>
                        <input type="file" class="form-control" id="imgfile_${i}" name="imgfile_${i}" accept=".jpg, .jpeg, .png, .webp, .svg">
                    </div>
                </div>
            </div>
        `;
    }
}

function updateStatusToBorn(tokenId) {
    // let id = tokenId;
    // alert(id);
    // if (confirm("Are you sure you want to mark this patient as New born?")) {
    //     $.ajax({
    //         url: "{{ url('updateStatusBorn') }}/"+id, // Use template literals for URL
    //         type: "GET",
    //         headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }, // Send CSRF token as query parameter
    //         success: function(response) {
    //             if (response.status) {
    //                 alert(1);
    //                 let token = response.token;
    //                 let patient = token.patient;

    //                 // if (response.tokenInfo.maternity_status === "Successful-R") {
    //                 //     $('#markAsBornBtn').prop('disabled', true);
    //                 // }
                    
    //                 // Construct the URL with query parameters
    //                 let urlloc = `{{ url('birthentry') }}?tokenId=${token.id}&patientId=${patient.id}&regn=${token.patient_regn_no}&adddate=${token.date_of_addmission}&addtime=${token.time_of_addmission}&patientName=${patient.patient_name}&patientPhone=${patient.patient_phone}`;
    //                 window.location.href = urlloc;
                    
    //             } else {
    //                 alert(response.message);
    //             }
    //         },
    //         error: function(response) {
    //             alert("Error!!!");
    //         }
    //     });
    // }
}


// function updateStatusToBorn(tokenId) {
//     //alert(tokenId);
//     if (confirm("Are you sure you want to mark this patient as New born?")) {
//         $.ajax({
//             url: "{{ url('updateStatusBorn') }}",
//             type: "POST",
//             data: { _token: "{{ csrf_token() }}", tokenId: tokenId },
//             success: function(response) {
//                 if(response.status){
//                     alert(response.message);
//                     $('#markAsBornBtn').prop('disabled', true);
//                     //window.location.reload();
//                 }else{
//                     alert(response.message);
//                 }
                
//             },
//             error: function(response) {
//                 alert("Error!!!");
//             }
//         });
//     }
// }


function updateStatusDischargeProcess(tokenId) {
    //alert(tokenId);
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