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
                                        <h3 class="headingcolor">Discharge Patient</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Discharge Patient</li>
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
                                                    @foreach($regnvalues as $regn)
                                                        <option value="{{$regn->patient_regn_no}}">{{$regn->patient_regn_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                            <div>
                                                <label class="form-label">Clearance<span style="color:red" title="Mandatory">*</span></label>
                                                <select  id="multi_option" multiple name="native-select" placeholder="Native Select" data-silent-initial-value-set="false">
                                                    <option value="Accounts">Accounts</option>
                                                    <option value="Bed">Bed</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Surgery">Surgery</option>
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Patient Name<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="Patient Name" id="patname" name="patname" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Contact No<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="contact" id="contact" name="contact" readonly>
                                            </div>
                                            <!-- <div class="col-md-4">
                                                <label for="discharge" class="form-label">Advance Paid<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="Advance amount" id="advamount" name="advamount" readonly>
                                            </div> -->
                                            
                                        </div>
                                        
                                        <div class="row pb-3">
                                            <div class="col-md-4">
                                                <label for="discharge" class="form-label">Expected Discharge Date<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="date" class="form-control"  id="disdate" name="disdate">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="discharge" class="form-label">Expected Discharge Time<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="time" class="form-control"  id="distime" name="distime">
                                            </div>
                                            <div class="col-md-4">
                                            <label for="discharge" class="form-label">Patient Status<span style="color:red" title="Mandatory">*</span></label>
                                                <select id="pstatus" name="pstatus" class="form-control">
                                                    <option value="" selected disabled>Select</option>
                                                    <!-- <option value="Born" >Born</option> -->
                                                    <option value="Living" >Living</option>
                                                    <option value="Deceased" >Deceased</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col-md-12">
                                                <label for="discharge" class="form-label">Discharge Summary<span style="color:red" title="Mandatory">*</span></label>
                                                <textarea class="form-control" placeholder="Summary" id="summary" name="summary" rows="50"></textarea>
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

    VirtualSelect.init({ 
        ele: '#multi_option',
        showSelectAll: true
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
    }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");

    $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value >= 0);
    }, "Price must be a positive number.");

    // Custom method to check if date is not in the past
    $.validator.addMethod("notPastDate", function(value, element) {
        var dateVal = $('#disdate').val();
        if (!dateVal) {
            return false;
        }

        var selectedDate = new Date(dateVal);
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Set current date time to midnight to compare only the date part

        return selectedDate >= currentDate;
    }, "Discharge date cannot be in the past.");

    // Custom method to check if time is not in the past for today
    $.validator.addMethod("notPastTime", function(value, element) {
        var dateVal = $('#disdate').val();
        var timeVal = $('#distime').val();

        if (!dateVal || !timeVal) {
            return false;
        }

        var selectedDateTime = new Date(dateVal + 'T' + timeVal);
        var currentDateTime = new Date();

        // If the selected date is today, validate the time
        if (selectedDateTime.toDateString() === currentDateTime.toDateString()) {
            return selectedDateTime >= currentDateTime;
        }

        return true; // If the date is not today, the time can be anything
    }, "Discharge time cannot be in the past.");

    // Form validation rules
    $("#dischargeform").validate({
        rules: {
            regn: {
                required: true
            },
            'native-select': {
                required: true
            },
            patname: {
                required: true
            },
            contact: {
                required: true
            },
            disdate: {
                required: true,
                notPastDate: true // Adding custom validation for date
            },
            distime: {
                required: true,
                notPastTime: true // Adding custom validation for time
            },
            pstatus: {
                required: true
            },
            summary: {
                required: true
            }
        },
        messages: {
            regn: {
                required: "Please select registration no"
            },
            'native-select': {
                required: "Please select a clearance"
            },
            patname: {
                required: "Patient name is required."
            },
            contact: {
                required: "Contact is required"
            },
            disdate: {
                required: "Please enter discharge date"
            },
            distime: {
                required: "Please enter discharge time"
            },
            pstatus: {
                required: "Please select patient status"
            },
            summary: {
                required: "Please fill the discharge summary"
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
                    if(response.status) {
                        $("#success").text(response.message).show();
                        $("#error").hide();
                        setTimeout(function() {
                            $('#success').slideUp();
                        }, 4000);

                        if ($("#mode").val() === 'add') {
                            $("#userform")[0].reset(); // Reset the form
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
                    $("#error").text("An error occurred: " + xhr.responseText).show();
                    $("#success").hide();
                }
            });
        }
    });
});



    

    function searchPatient(){
        let regn = $("#regn").val();
        //alert(regn);
        if(regn){
            $.ajax({
                type:"POST",
                url:"{{url('discharge/searchPatient')}}",
                data:{_token:"{{csrf_token()}}",regn:regn},
                success:function(response){
                    alert(response.message);
                    if(response.patientinfo){
                        document.getElementById("patname").value = response.patientinfo.patient_name;
                        document.getElementById("contact").value = response.patientinfo.patient_phone;
                    }
                },
                error:function(){
                    alert("Error!!!")
                }
            })
        }
    }
</script>
@endsection