@extends('masterlayout.masterlayout')

@section('content')

<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" name="icuform" id="icuform">
                            <input type="hidden" id="saveurl" value="{{ url('icu/saveData') }}" />
                            <input type="hidden" id="recordid" name="recordid" value="" />
                            <input type="hidden" id="mode" name="mode">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage ICU</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;font-weight:600">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">ICU Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter ICU Name" id="icuname" name="icuname">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">ICU Type<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="icutype" name="icutype">
                                            <option value="" selected disabled>Please select ICU type</option>
                                            @foreach($icutypes as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach  
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">Floor<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="floor" name="floor" onchange="showBlock(this)">
                                            <option value="" selected disabled>Please select floor</option>
                                            @foreach($floors as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">Block<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="block" name="block"></select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">Occupancy<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter cabin capacity." id="occupancy" name="occupancy">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="amenities" class="form-label">Amenities<span style="color:red" title="Mandatory">*</span></label>
                                        <select id="amenities" name="amenities[]" class="form-control select2" multiple="multiple">
                                            @foreach ($amenities as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">Price<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter price" id="icuprice" name="icuprice">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">Status<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="status" name="status">
                                        <option value="" selected disabled>Please select status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="floor" class="form-label">Narration</label>
                                        <textarea class="form-control" id="narration" name="narration" rows="3"></textarea>
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
                                    <h3 class="headingcolor">ICU's</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('masters')}}">Masters</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">ICU's</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class='col-lg-6 pb-2'>
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add New</button>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-12'>
                            <div class="table-responsive" style="height: 400px; overflow-y: auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">Sl</th>
                                            <th>ICU</th>
                                            <th>ICU Type</th>
                                            <th>Floor</th>
                                            <th>Block</th>
                                            <th style="text-align:center">Occupancy</th>
                                            <th style="text-align:center">Beds Assigned</th>
                                            <th style="text-align:center">Beds Available</th>
                                            <th>Amenities</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $sl = 1;
                                        @endphp
                                        @foreach($icus as $index => $icu)
                                            @php 
                                                $available = $icu->total_occupancy - $icu->assigned;
                                            @endphp
                                            <tr>
                                                <td style="text-align:center">{{ $sl++ }}</td>
                                                <td>{{ $icu->icu_name }}</td>
                                                <td>{{ $icuDetails[$index]['icu_type'] }}</td>
                                                <td>{{ $icuDetails[$index]['floor_no'] }}</td>
                                                <td>{{ $icuDetails[$index]['block_name'] }}</td>
                                                <td style="text-align:center">{{ $icu->total_occupancy }}</td>
                                                <td style="text-align:center">{{ $icu->assigned }}</td>
                                                <td style="text-align:center">{{ $available }}</td>
                                                <td>{{ $icu->amenities }}</td>
                                                <td style="text-align:center">{{ $icu->price }}</td> 
                                                <td>
                                                    @if($icu->status == "Active")
                                                        <label class="badge badge-success">Active</label>
                                                    @else 
                                                        <label class="badge badge-danger">Inactive</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($icuDetails[$index]['floor_status'] == 'Active' && $icuDetails[$index]['block_status'] == 'Active'  && $icuDetails[$index]['icutype_status'] == 'Active')
                                                        <a href='#' class='editbtn' onclick='showEdit({{ $icu->id }})' title='Edit'>
                                                            <img src='assets/previous/user.svg' style='height:20px; width:20px' />
                                                        </a>&nbsp&nbsp
                                                        <a href='javascript:void(0)' onclick="deleteData('{{ url('icus/deleteData') }}/{{ $icu->id }}')" title='Delete'>
                                                            <img src='assets/previous/delete.svg' style='height:23px; width:23px' />
                                                        </a>
                                                    @else
                                                        Sorry, Parent Inactive
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2 when the modal is shown
    $('#staticBackdrop').on('shown.bs.modal', function () {
        initializeSelect2();
    });

    function initializeSelect2() {
        $('.select2').each(function() {
            $(this).select2({
                placeholder: "Enter Amenities",
                allowClear: true,
                dropdownParent: $('#staticBackdrop')
            });
        });
    }

    // Add custom validation method for alphanumeric
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
    }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");

    $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value >= 0);
    }, "Price must be a positive number.");

    // Form validation rules
    $("#icuform").validate({
        rules: {
            icuname: {
                required: true,
                alphanumeric: true
            },
            icutype: {
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
            amenities: {
                required: true
            },
            icuprice: {
                required: true,
                number: true,
                positiveNumber:true
            },
            status: {
                required: true
            }
        },
        messages: {
            icuname: {
                required: "ICU name is required.",
                alphanumeric: "Must be alphabets or alphanumeric"
            },
            icutype: {
                required: "ICU type is required."
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
            amenities: {
                required: "Amenities Required"
            },
            icuprice: {
                required: "Price is required.",
                number: "Please enter a valid price",
                positiveNumber:"Price cannot be -ve"
            },
            status: {
                required: "Status is required."
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
                        }, 2000);
                        if ($("#mode").val() === 'add') {
                            form.reset(); // Reset the form
                            $('.select2').val(null).trigger('change');
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
});

// function showBlock(floorElement) {
//     let floor = $(floorElement).val();
//     if (floor) {
//         $.ajax({
//             type: "POST",
//             url: "{{ url('cabin/loadblocks') }}",
//             data: { _token: "{{ csrf_token() }}", floor: floor },
//             success: function(response) {
//                 let blockSelect = $('#block');
//                 blockSelect.empty();
//                 blockSelect.append('<option value="" selected disabled>Please select block</option>');
//                 $.each(response.blocks, function(key, value) {
//                     blockSelect.append('<option value="' + key + '">' + value + '</option>');
//                 });
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error:', error);
//                 alert('Error fetching blocks');
//             }
//         });
//     }
// }
function showBlock(floors, selectedBlock = null) {
    let floor = $(floors).val();
    //alert(floor);
    if (floor) {
        $.ajax({
            type: "POST",
            url: "{{ url('ward/loadblocks') }}",
            data: { _token: "{{ csrf_token() }}", floor: floor },
            success: function(response) {
                let blockSelect = $('#block');
                blockSelect.empty();
                blockSelect.append('<option value="" selected disabled>Please select block</option>');
                $.each(response.blocks, function(key, value) {
                    blockSelect.append('<option value="' + key + '">' + value + '</option>');
                });

                // If there's a selected block, set it as selected
                if (selectedBlock) {
                    blockSelect.val(selectedBlock);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error fetching blocks');
            }
        });
    }
}


function showAdd() {
    document.getElementById("icuform").reset();
    document.getElementById("mode").value = "add";
    document.getElementById("recordid").value = "";
}

function showEdit(id) {
    document.getElementById("icuform").reset();
    document.getElementById("mode").value = "edit";
    document.getElementById("recordid").value = id;
    $.ajax({
        url: "{{ url('icu/editData') }}/" + id,
        type: "GET",
        dataType: "json",
        success: function(data) {
            let myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();
            document.getElementById("icuname").value = data.icu['icu_name'];
            document.getElementById("icutype").value = data.icu['icu_type_id'];
            document.getElementById("floor").value = data.icu['floor_count'];
            showBlock($('#floor'), data.icu['block_id']);
            document.getElementById("occupancy").value = data.icu['total_occupancy'];
            document.getElementById("icuprice").value = data.icu['price'];
             // Pre-select amenities
             let selectedAmenities = data.icu['amenities'].split(','); // Assuming amenities are stored as comma-separated values
            $('#amenities').val(selectedAmenities).trigger('change');
            document.getElementById("status").value = data.icu['status'];
            document.getElementById("narration").value = data.icu['narration'];
        },
        error: function() {
            alert('Error fetching data');
        }
    });
}

function deleteData(url) {
    alert(1);
    if (confirm('Are you sure you want to delete this record?')) {
        window.location.href = url;
    }
}

</script>

@endsection
