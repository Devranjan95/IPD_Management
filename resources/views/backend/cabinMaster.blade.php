@extends('masterlayout.masterlayout')

@section('content')
    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <form enctype="multipart/form-data" name="cabinform" id="cabinform">
                                <input type="hidden" id="saveurl" value="{{ url('cabin/saveData') }}" />
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="mode" name="mode">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Cabins</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        style="color:rgb(250,235,215)" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color:black;font-weight:600">
                                    <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                    <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                    <div class="row pb-3">
                                        <div class="col-md-6">
                                            <label for="block" class="form-label">Cabin Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Cabin Name" id="cabinname" name="cabinname">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Cabin Type</label>
                                            <select class="form-control" id="cabintype" name="cabintype">
                                                    <option value="" selected disabled>Please select cabin type</option>
                                                @foreach($cabintypes as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach    
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Floor</label>
                                            <select class="form-control" id="floor" name="floor" onchange="showBlock(this)">
                                                <option value="" selected disabled>Please select floor</option>
                                                @foreach($floors as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach    
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Block</label>
                                            <select class="form-control" id="block" name="block">
                                                
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="block" class="form-label">Occupancy</label>
                                            <input type="text" class="form-control" placeholder="Enter cabin capacity." id="occupancy" name="occupancy">
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label for="amenities" class="form-label">Amenities</label>
                                            <select class="form-control select2 form-select" id="amenities" name="amenities[]" multiple="multiple">
                                                <option value="">Select an option</option>
                                                @foreach ($amenities as $key => $item)
                                                    <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div> -->
                                        <div class="col-md-6">
                                            <label for="block" class="form-label">Amenities</label>
                                            <input type="text" class="form-control" placeholder="Enter Amenities" id="amenities" name="amenities">
                                        </div>
<!-- <div class="form-group">
                      <label>Multiple select using select 2</label>
                      <select class="js-example-basic-multiple w-100" multiple="multiple">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                        <option value="AM">America</option>
                        <option value="CA">Canada</option>
                        <option value="RU">Russia</option>
                      </select>
                    </div> -->
                                        <div class="col-md-6">
                                            <label for="block" class="form-label">Price</label>
                                            <input type="text" class="form-control" placeholder="Enter price" id="cabinprice" name="cabinprice">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            onclick = "reload()">Close</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- =================================================== -->
                <!-- ========== tables-wrapper start ========== -->
                <div class="card mb-30">
                    <div class="tables-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='row pb-2'>
                                    <div class='col-lg-6'>
                                        <h3 class="headingcolor">Cabin Types</h3>
                                    </div>
                                    <div class='col-lg-6 pb-2'>
                                        <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right"
                                            data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add
                                            New</button>
                                    </div>
                                    <!-- <hr style="color:#030d04"> -->
                                </div>
                            </div>
                            <div class='col-lg-12'>
                                <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">Sl</th>
                                            <th>Cabin Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                </div>
                                
                                <!-- </div> -->
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
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    function showBlock(floorElement){
        let floor = $(floorElement).val();
        //alert(floor);
        if(floor){
            $.ajax({
                type:"POST",
                url:"{{ url('cabin/loadblocks') }}",
                data:{_token:"{{csrf_token()}}",floor:floor},
                success:function(response){
                    if (response.blocks) {
                        let blockSelect = $('#block');
                        blockSelect.empty();
                        blockSelect.append('<option value="" selected disabled>Please select block</option>');
                        $.each(response.blocks, function(key, value) {
                            blockSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Status:', status);
                    console.log('Error:', error);
                    console.log('Response:', xhr.responseText);
                    alert('Error');
                }
            })
        }
    }
    $(document).ready(function() {
        // Add custom validation method for letters only
        $.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        }, "Only letters and spaces are allowed.");

        // Form validation rules
        $("#cabintypeform").validate({
            rules: {
                cabintype: {
                    required: true,
                    lettersonly: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                cabintype: {
                    required: "CabinType is required.",
                    lettersonly: "Only letters and spaces are allowed."
                },
                status: {
                    required: "Status is required."
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
                // Form submission via AJAX
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
                                $('#error').slideUp();
                            }, 2000);
                            if ($("#mode").val() === 'add') {
                                form.reset(); // Reset the form
                            }else{
                                window.location.reload();
                            }
                           
                        } else {
                            $("#success").text(response.message).show();
                            $("#error").hide();
                            setTimeout(function() {
                                $('#success').slideUp();
                            }, 4000);
                           
                            //$('#recordid').val(response.new_reg_no);
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

    function showAdd() {
        document.getElementById("cabintypeform").reset();
        document.getElementById("mode").value = "add";
        document.getElementById("recordid").value = "";
    }

    function showEdit(id) {
        document.getElementById("cabintypeform").reset();
        document.getElementById("mode").value = "edit";
        document.getElementById("recordid").value = id;
        $.ajax({
            url: "{{ url('cabintypes/editData') }}/" + id,
            headers: {
                '_token': '{{ csrf_token() }}'
            },
            type: "GET",
            dataType: "json",
            
            success: function(data) {
                let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                myModal.show();
                document.getElementById("cabintype").value = data.cabintype['cabin_type'];
                document.getElementById("status").value = data.cabintype['status'];
                
            },
            error: function() {
                return false;
            }
        });
    }

    function deleteData(url) {
        if (confirm('Are you sure you want to delete this record?')) {
            window.location.href = url;
        }
    }
</script>

@endsection