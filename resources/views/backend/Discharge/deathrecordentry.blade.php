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
                                    <h3 class="headingcolor">Death Record Entry</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary">
                                                <a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Death Record Entry</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form enctype="multipart/form-data" name="deathRecordForm" id="deathRecordForm">
                                <input type="hidden" id="saveurl" value="{{ url('deathrecord/saveData') }}" />
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="mode" name="mode">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"></div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"></div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="regn" class="form-label">Patient Regn No<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="regn" name="regn" class="form-control select2" onchange="searchPatient()">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($regnvalues as $regn)
                                                <option value="{{$regn->patient_regn_no}}">{{$regn->patient_regn_no}}</option>
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
                                        <label for="adhr" class="form-label">Adhar No<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Adhar No" id="adhr" name="adhr" maxlength="12">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="aname" class="form-label">Attendant<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Attendant" id="aname" name="aname">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="deathdate" class="form-label">Date of Death<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="date" class="form-control" id="deathdate" name="deathdate">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="deathtime" class="form-label">Time of Death<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="time" class="form-control" id="deathtime" name="deathtime">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="placeofdeath" class="form-label">Place of Death<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Place of Death" id="placeofdeath" name="placeofdeath">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="causeofdeath" class="form-label">Cause of Death<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Cause of Death" id="causeofdeath" name="causeofdeath">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="age" class="form-label">Age<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="number" class="form-control" placeholder="Age" id="age" name="age">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="gender" class="form-label">Gender<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="gender" name="gender" class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="address" class="form-label">Address<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="maritalstatus" class="form-label">Marital Status<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="maritalstatus" name="maritalstatus" class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fathername" class="form-label">Father's Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Father's Name" id="fathername" name="fathername">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mothername" class="form-label">Mother's Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mother's Name" id="mothername" name="mothername">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="spousename" class="form-label">Spouse's Name (if applicable)</label>
                                        <input type="text" class="form-control" placeholder="Spouse's Name" id="spousename" name="spousename">
                                    </div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-md-3">
                                        <label for="imgfile" class="form-label">Upload Image Of Deadbody<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="file" class="form-control" id="imgfile" name="imgfile" accept=".jpg, .jpeg, .png, .webp, .svg">
                                    </div>
                                    <div class="col-md-3">
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
        return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
    }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");

    $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value >= 0);
    }, "Price must be a positive number.");

    $.validator.addMethod("validDate", function(value, element) {
        return this.optional(element) || new Date(value) <= new Date();
    }, "Date of death cannot be in the future.");

    $.validator.addMethod("validTime", function(value, element) {
        let deathDate = $('#deathdate').val();
        if (!deathDate) return false; // Ensure death date is set before validating time
        return this.optional(element) || new Date(`${deathDate}T${value}`) <= new Date();
    }, "Time of death cannot be in the future.");

    $.validator.addMethod("numericOnly", function(value, element) {
        return this.optional(element) || /^\d+$/.test(value);
    }, "Only numeric values are allowed.");

    $.validator.addMethod("fileSize", function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File must be less than 28KB.");

    $.validator.addMethod("imageType", function(value, element) {
        return this.optional(element) || (/\.(jpe?g|png|webp|svg)$/i).test(value);
    }, "Please upload a valid image file (jpg, jpeg, png, webp, svg).");

    // Form validation rules
    $("#deathRecordForm").validate({
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
            adhr: {
                required: true,
                numericOnly: true
            },
            aname: {
                required: true
            },
            deathdate: {
                required: true,
                validDate: true
            },
            deathtime: {
                required: true,
                validTime: true
            },
            placeofdeath: {
                required: true
            },
            causeofdeath: {
                required: true
            },
            age: {
                required: true,
                positiveNumber: true
            },
            gender: {
                required: true
            },
            address: {
                required: true
            },
            maritalstatus: {
                required: true
            },
            fathername: {
                required: true
            },
            mothername: {
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
                required: "Patient name is required.",
            },
            contact: {
                required: "Contact is required"
            },
            adhr: {
                required: "Adhar number is required",
                numericOnly: "Adhar number must be numeric"
            },
            aname: {
                required: "Attendant name is required."
            },
            deathdate: {
                required: "Please enter the date of death",
                validDate: "Date of death cannot be in the future."
            },
            deathtime: {
                required: "Please enter the time of death",
                validTime: "Time of death cannot be in the future."
            },
            placeofdeath: {
                required: "Please enter the place of death"
            },
            causeofdeath: {
                required: "Please enter the cause of death"
            },
            age: {
                required: "Age is required",
                positiveNumber: "Age must be a positive number"
            },
            gender: {
                required: "Please select gender"
            },
            address: {
                required: "Please enter the address"
            },
            maritalstatus: {
                required: "Please select marital status"
            },
            fathername: {
                required: "Please enter the father's name"
            },
            mothername: {
                required: "Please enter the mother's name"
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
                url: $("#saveurl").val(),
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
                            $("#deathRecordForm")[0].reset(); // Reset the form
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
                url:"{{url('deathrecord/searchPatient')}}",
                data:{_token:"{{csrf_token()}}",regn:regn},
                success:function(response){
                    alert(response.message)
                    if(response.patientInfo && response.tokenInfo){
                        document.getElementById("patname").value = response.patientInfo.patient_name;
                        document.getElementById("contact").value = response.patientInfo.patient_phone;
                        document.getElementById("aname").value = response.tokenInfo.attendant_name;
                        document.getElementById("issuedby").value = "Patcon Community Hospital";
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
