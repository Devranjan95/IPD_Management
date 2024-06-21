@extends('masterlayout.masterlayout')

@section('content')

<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" name="bedform" id="bedform">
                            <input type="hidden" id="saveurl" value="{{ url('beds/saveData') }}" />
                            <input type="hidden" id="recordid" name="recordid" value="" />
                            <input type="hidden" id="mode" name="mode">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Bed</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;font-weight:600">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="bed_name" class="form-label">Bed Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Bed Name" id="bedname" name="bedname">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bed_category_id" class="form-label">Bed Category<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="bed_category_id" name="bed_category_id">
                                            <option value="" selected disabled>Please select bed category</option>
                                            @foreach($bedcategory as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row pb-3">     
                                    <div class="col-md-6">
                                        <label for="bed_count" class="form-label">No. of beds<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter no of beds" id="no_of_beds" name="no_of_beds">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="" selected disabled>Please select status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    
                                    <div class="col-md-12">
                                        <label for="narration" class="form-label">Narration</label>
                                        <textarea class="form-control" placeholder="Narration" id="narration" name="narration" rows="4"></textarea>
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
            <!--**** Assign Modal***** -->
            <div class="modal fade" id="assignmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form enctype="multipart/form-data" name="assignbedform" id="assignbedform">
                    <input type="hidden" id="saveurl" value="{{ url('assignbeds/saveData') }}" />
                    <input type="hidden" id="recordid" name="recordid" value="" />
                    <input type="hidden" id="mode" name="mode">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Assign Bed</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color:black;font-weight:600">
                        <div class="row" id='bed_details'></div>
                       
                        <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                        <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="floor" class="form-label">Floor<span style="color:red" title="Mandatory">*</span></label>
                                <select class="form-control" id="floor" name="floor" onchange="showBlock(this)">
                                    <option value="" selected disabled>Please select floor</option>
                                    @foreach($floors as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="block" class="form-label">Block<span style="color:red" title="Mandatory">*</span></label>
                                <select class="form-control" id="block" name="block"></select>
                            </div>
                        </div>
                        <div class="row pb-3"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
             <!-- **************** -->

            <!-- ========== tables-wrapper start ========== -->
            <div class="card mb-30">
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class='row pb-2'>
                                <div class='col-lg-6'>
                                    <h3 class="headingcolor">Beds</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-secondary"><a href="{{url('masters')}}">Masters</a></li>
                                            <li class="breadcrumb-item active text-primary" aria-current="page">Beds</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class='col-lg-6 pb-2'>
                                    <a type="button" href="{{url('bedassignvisual')}}" class="btn btn-rounded btn-fw btn-info" style="float:right;">Assign Bed</a>
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right;margin-right:10px;" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add New</button>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">SL</th>
                                            <th>Bed Name</th>
                                            <th>Bed Category</th>
                                            <th style="text-align:center">No. Of Beds</th>
                                            <th style="text-align:center">Assigned</th>
                                            <th style="text-align:center">Available</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php 
                                            $sl = 1;
                                        @endphp
                                        @foreach($beds as $bed)
                                        @php 
                                            $available = $bed->no_of_beds - $bed->assigned_no;
                                        @endphp
                                        <tr>
                                            <td style="text-align:center">{{ $sl++ }}</td>
                                            <td>{{ $bed->bed_name }}</td>
                                            <td>{{ $bedcategoryname[$loop->index] }}</td>
                                            <td style="text-align:center">{{ $bed->no_of_beds }}</td>
                                            <td style="text-align:center">{{ $bed->assigned_no }}</td>
                                            <td style="text-align:center">{{ $available }}</td>
                                            <td>
                                                @if($bed->status == 'Active')
                                                    <label class="badge badge-success">Active</label>
                                                @else
                                                    <label class="badge badge-danger">Inactive</label>
                                                @endif
                                            </td>
                                            <td>
                                                @if($bedcategorystatus[$loop->index] == 'Active')
                                                    <div class="btn-group">
                                                        <a href='#' class='editbtn' onclick='showEdit({{ $bed->id }})' title='Edit'>
                                                            <img src='assets/previous/user.svg' style='height:20px; width:20px' />
                                                        </a>&nbsp;&nbsp;
                                                        <a href='javascript:void(0)' onclick="deleteData('{{ url('beds/deleteData') }}/{{ $bed->id }}')" title='Delete'>
                                                            <img src='assets/previous/delete.svg' style='height:23px; width:23px' />
                                                        </a>
                                                    </div>
                                                @else
                                                    <div>
                                                        Sorry, Parent Inactive
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
    </div>
</section>
@endsection

@section('scripts')
<style>
        .card-custom {
            border: 1px solid #007bff;
            transition: all 0.5s;
            height: 100%;
            margin-bottom: 1rem;
            padding: 10px;
        }
        .card-custom:hover {
            transform: scale(1.05);
            border-color: #0056b3;
        }
        .card-title {
            font-size: 1rem;
            font-weight: bold;
        }
        .card-body-custom {
            padding: 0.75rem;
            font-size: 0.875rem;
        }
        .modal-xl {
            max-width: 90%;
        }
        .modal-header, .modal-body, .modal-footer {
            padding: 1rem 2rem;
        }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
        }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");

        $.validator.addMethod("numsonly", function(value, element) {
            return this.optional(element) || /^[0-9]+$/.test(value);
        }, "Only numbers are allowed.");

        $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value > 0);
        }, "Price must be a positive number.");

        $("#bedform").validate({
            rules: {
                bedname: {
                    required: true,
                    alphanumeric: true
                },
                bed_type_id: {
                    required: true
                },
                bed_category_id: {
                    required: true
                },
                no_of_beds:{
                    required: true,
                    numsonly:true,
                    positiveNumber:true,
                },
                status: {
                    required: true
                }
            },
            messages: {
                bedname: {
                    required: "Bed Name is required.",
                    alphanumeric: "Must be alphabets or alphanumeric"
                },
                bed_type_id: {
                    required: "Bed Type is required."
                },
                bed_category_id: {
                    required: "Bed Category is required."
                },
                no_of_beds:{
                    required:"Please enter number of beds",
                    numsonly:"Please enter a valid number",
                    positiveNumber:"No cannot be -ve or 0"
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
                            }, 4000);
                            if ($("#mode").val() === 'add') {
                                form.reset();
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
                    }
                });
            }
        });
    });
    
    function showAdd() {
        document.getElementById("bedform").reset();
        document.getElementById("mode").value = "add";
        document.getElementById("recordid").value = "";
    }

    function showEdit(id) {
        document.getElementById("bedform").reset();
        document.getElementById("mode").value = "edit";
        document.getElementById("recordid").value = id;
        $.ajax({
            url: "{{ url('beds/editData') }}/" + id,
            headers: {
                '_token': '{{ csrf_token() }}'
            },
            type: "GET",
            dataType: "json",
            success: function(data) {
                let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                myModal.show();
                document.getElementById("bedname").value = data.bed['bed_name'];
                document.getElementById("bed_category_id").value = data.bed['bed_category_id'];
                document.getElementById("no_of_beds").value = data.bed['no_of_beds'];
                document.getElementById("status").value = data.bed['status'];
                document.getElementById("narration").value = data.bed['narration'];
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
    
    function showBlock(floors, selectedBlock = null) {
    let floor = $(floors).val();
    //alert(floor);
    if (floor) {
        $.ajax({
            type: "POST",
            url: "{{ url('beds/loadblocks') }}",
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



</script>
@endsection
