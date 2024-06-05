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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
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
                                        <label for="block" class="form-label">Block</label>
                                        <select class="form-control" id="block" name="block"></select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">Occupancy</label>
                                        <input type="text" class="form-control" placeholder="Enter cabin capacity." id="occupancy" name="occupancy">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amenities" class="form-label">Amenities</label>
                                        <select id="amenities" name="amenities[]" class="form-control select2" multiple="multiple">
                                            @foreach ($amenities as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add New</button>
                                </div>
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
                                        <!-- Content dynamically loaded here -->
                                    </tbody>
                                </table>
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
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Select2 JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#amenities').select2({
        placeholder: "Enter Amenities",
        allowClear: true
    });

    // Add custom validation method for letters only
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Only letters and spaces are allowed.");

    // Form validation rules
    $("#cabinform").validate({
        rules: {
            cabinname: {
                required: true,
                lettersonly: true
            },
            cabintype: {
                required: true
            },
            floor: {
                required: true
            },
            block: {
                required: true
            },
            occupancy: {
                required: true
            },
            cabinprice: {
                required: true,
                number: true
            },
            status: {
                required: true
            }
        },
        messages: {
            cabinname: {
                required: "Cabin name is required.",
                lettersonly: "Only letters and spaces are allowed."
            },
            cabintype: {
                required: "Cabin type is required."
            },
            floor: {
                required: "Floor is required."
            },
            block: {
                required: "Block is required."
            },
            occupancy: {
                required: "Occupancy is required."
            },
            cabinprice: {
                required: "Price is required.",
                number: "Please enter a valid number."
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
                        }, 2000);
                        if ($("#mode").val() === 'add') {
                            form.reset(); // Reset the form
                        } else {
                            window.location.reload();
                        }
                    } else {
                        $("#error").text(response.message).show();
                        $("#success").hide();
                        setTimeout(function() {
                            $('#error').slideUp();
                        }, 4000);
                    }
                },
                error: function(xhr) {
                    $("#error").text("An error occurred: " + xhr.responseText).show();
                    $("#success").hide();
                }
            });
        }
    });

    $('#staticBackdrop').on('hidden.bs.modal', function () {
        $("#error").hide();
        $("#success").hide();
    });
});

function showBlock(floorElement) {
    let floor = $(floorElement).val();
    if (floor) {
        $.ajax({
            type: "POST",
            url: "{{ url('cabin/loadblocks') }}",
            data: { _token: "{{ csrf_token() }}", floor: floor },
            success: function(response) {
                let blockSelect = $('#block');
                blockSelect.empty();
                blockSelect.append('<option value="" selected disabled>Please select block</option>');
                $.each(response.blocks, function(key, value) {
                    blockSelect.append('<option value="' + key + '">' + value + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error fetching blocks');
            }
        });
    }
}

function showAdd() {
    document.getElementById("cabinform").reset();
    document.getElementById("mode").value = "add";
    document.getElementById("recordid").value = "";
}

function showEdit(id) {
    document.getElementById("cabinform").reset();
    document.getElementById("mode").value = "edit";
    document.getElementById("recordid").value = id;
    $.ajax({
        url: "{{ url('cabintypes/editData') }}/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {
            let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();
            document.getElementById("cabinname").value = data.cabinname;
            document.getElementById("cabintype").value = data.cabintype;
            document.getElementById("floor").value = data.floor;
            document.getElementById("block").value = data.block;
            document.getElementById("occupancy").value = data.occupancy;
            document.getElementById("cabinprice").value = data.cabinprice;
            document.getElementById("status").value = data.status;
        },
        error: function() {
            alert('Error fetching data');
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
