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
                                    <h3 class="headingcolor">Birth Record Entry</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary">
                                                <a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Birth Record Entry</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form enctype="multipart/form-data" name="birthRecordForm" id="birthRecordForm">
    
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="mode" name="mode">

                                <!-- Display error and success messages -->
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"></div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"></div>

                                <!-- Form fields -->
                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="regn" class="form-label">Registration No</label>
                                        <select id="regn" name="regn" class="form-control select2" onchange="searchPatient()">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($regnvalues as $regn)
                                                <option value="{{ $regn->patient_regn_no }}">{{ $regn->patient_regn_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="patname" class="form-label">Patient Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Patient Name" id="patname" name="patname" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="contact" class="form-label">Contact No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Contact" id="contact" name="contact" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="birthdate" class="form-label">New Born's Date of Birth<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="birthtime" class="form-label">New Born's Time of Birth<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="time" class="form-control" id="birthtime" name="birthtime">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="placeofbirth" class="form-label">New Born's Place of Birth<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Place of Birth" id="placeofbirth" name="placeofbirth">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="gender" class="form-label">New Born's Gender<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="gender" name="gender" class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="weight" class="form-label">New Born's Weight (kg)<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="number" step="0.01" class="form-control" placeholder="Weight" id="weight" name="weight">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="length" class="form-label">New Born's Length (cm)<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="number" step="0.1" class="form-control" placeholder="Length" id="length" name="length">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fathername" class="form-label">New Born's Father Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Father's Name" id="fathername" name="fathername">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mothername" class="form-label">New Born's Mother's Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mother's Name" id="mothername" name="mothername" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fatheradhar" class="form-label">Father's Aadhar No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Father's Aadhar No" id="fatheradhar" name="fatheradhar" maxlength="12">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="motheradhar" class="form-label">Mother's Aadhar No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mother's Aadhar No" id="motheradhar" name="motheradhar" maxlength="12">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="address" class="form-label">Address<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                                    </div>
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
                                    <div class="col-md-3">
                                        <label for="image_path" class="form-label">Upload Image<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="file" class="form-control" id="imgfile" name="imgfile" accept=".jpg, .jpeg, .png, .webp, .svg">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="issuedby" class="form-label">Certificate Issued By<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Issued By" id="issuedby" name="issuedby">
                                    </div>
                                </div>

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
                    <!-- end col -->
                </div>
                <!-- ========== tables-wrapper end ========== -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
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

    $.validator.addMethod("validTime", function(value, element) {
        let birthDate = $('#birthdate').val();
        if (!birthDate) return false; // Ensure birth date is set before validating time
        return this.optional(element) || new Date(`${birthDate}T${value}`) <= new Date();
    }, "Time of birth cannot be in the future.");

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

    // Form validation rules
    $("#birthRecordForm").validate({
        rules: {
            regn: {
                required: true
            },
            patname: {
                required: true,
            },
            contact: {
                required: true
            },
            birthdate: {
                required: true,
                validDate: true
            },
            birthtime: {
                required: true,
                validTime: true
            },
            placeofbirth: {
                required: true
            },
            gender: {
                required: true
            },
            weight: {
                required: true,
                float: true,
                positiveNumber: true
            },
            length: {
                required: true,
                float: true,
                positiveNumber: true
            },
            fathername: {
                required: true,
                alphanumeric: true
            },
            mothername: {
                required: true
            },
            fatheradhar: {
                required: true,
                numericOnly: true
            },
            motheradhar: {
                required: true,
                numericOnly: true
            },
            address: {
                required: true
            },
            maritalstatus: {
                required: true
            },
            imgfile: {
                required: true,
                imageType: true,
                fileSize: 28000 // 28KB in bytes
            },
            issuedby: {
                required: true
            }
        },
        messages: {
            regn: {
                required: "Please select registration no"
            },
            patname: {
                required: "Patient name is required."
            },
            contact: {
                required: "Contact is required"
            },
            birthdate: {
                required: "Please enter the date of birth",
                validDate: "Date of birth cannot be in the future."
            },
            birthtime: {
                required: "Please enter the time of birth",
                validTime: "Time of birth cannot be in the future."
            },
            placeofbirth: {
                required: "Please enter the place of birth"
            },
            gender: {
                required: "Please select gender"
            },
            weight: {
                required: "Weight is required",
                float: "Please enter a valid weight",
                positiveNumber: "Weight must be a positive number"
            },
            length: {
                required: "Length is required",
                float: "Please enter a valid length",
                positiveNumber: "Length must be a positive number"
            },
            fathername: {
                required: "Please enter the father's name",
                alphanumeric: "Father's name must contain only letters and spaces"
            },
            mothername: {
                required: "Please enter the mother's name"
            },
            fatheradhar: {
                required: "Father's Aadhar number is required",
                numericOnly: "Father's Aadhar number must be numeric"
            },
            motheradhar: {
                required: "Mother's Aadhar number is required",
                numericOnly: "Mother's Aadhar number must be numeric"
            },
            address: {
                required: "Please enter the address"
            },
            maritalstatus: {
                required: "Please select marital status"
            },
            imgfile: {
                required: "Please upload an image",
                imageType: "Please upload a valid image file (jpg, jpeg, png, webp, svg)",
                fileSize: "File must be less than 28KB"
            },
            issuedby: {
                required: "Please enter the name of the person issuing the certificate"
            }
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

            $.ajax({
                url: "{{ url('birthrecord/saveData') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status) {
                        $("#success").text(response.message).show();
                        $("#error").hide();
                        setTimeout(function() {
                            $('#success').slideUp();
                        }, 4000);

                        if ($("#mode").val() === 'add') {
                            $("#birthRecordForm")[0].reset(); // Reset the form
                        } else {
                            window.location.reload();
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
    });
});


    function searchPatient() {
        // Your searchPatient function implementation
        regn = $('#regn').val();
        if(regn){
            $.ajax({
                type:"POST",
                url:"{{url('birthrecord/searchPatient')}}",
                data:{_token:"{{csrf_token()}}",regn:regn},
                success:function(response){
                    alert(response.message);
                    if(response.patientInfo){
                        document.getElementById('patname').value = response.patientInfo.patient_name;
                        document.getElementById('contact').value = response.patientInfo.patient_phone;
                        document.getElementById('mothername').value = response.patientInfo.patient_name;
                        document.getElementById('issuedby').value = "Patcon community healthcare";
                    }else{
                        alert(0);
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseText);
                        // $("#error").text("An error occurred: " + xhr.responseText).show();
                        // $("#success").hide();
                }
            })
        }
    }
</script>
@endsection
