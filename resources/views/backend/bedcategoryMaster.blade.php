@extends('masterlayout.masterlayout')

@section('content')
<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" name="bedcategoryform" id="bedcategoryform">
                            <input type="hidden" id="saveurl" value="{{ url('bedcategories/saveData') }}" />
                            <input type="hidden" id="recordid" name="recordid" value="" />
                            <input type="hidden" id="mode" name="mode">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Bed Categories</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;font-weight:600">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="bed_type" class="form-label">Bed Category Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Bed Category" id="bedcategory" name="bedcategory">
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
                                        <textarea class="form-control" placeholder="Narration" id="narration" name="narration" rows="10"></textarea>
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
                                    <h3 class="headingcolor">Bed Categories</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-secondary"><a href="{{url('masters')}}">Masters</a></li>
                                            <li class="breadcrumb-item active text-primary" aria-current="page">Bed Categories</li>
                                        </ol>
                                    </nav>
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
                                            <th>Bed Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @php 
                                        $sl = 1;
                                       @endphp 
                                       @foreach($bedcategories as $bedcategory) 
                                            <tr>
                                                <td style="text-align:center">{{$sl++}}</td>
                                                <td>{{$bedcategory->bed_category}}</td>
                                                <td>
                                                        @if($bedcategory->status=="Active")
                                                        <label class="badge badge-success">Active</label>
                                                        @else 
                                                        <label class="badge badge-danger">In Active</label>
                                                        @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                    
                                                        <a href='#' class='editbtn'  onclick='showEdit({{ $bedcategory->id }})'
                                                            title='Edit'><img src='assets/previous/user.svg'
                                                                style='height:20px; width:20px' /></a>&nbsp&nbsp
                                                        <a href='javascript:void(0)'
                                                            onclick="deleteData('{{ url('bedcategories/deleteData') }}/{{ $bedcategory->id }}')"
                                                            title='Delete'><img src='assets/previous/delete.svg'
                                                                style='height:23px; width:23px' /></a>
                
                                                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
        }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");

        $("#bedcategoryform").validate({
            rules: {
                bedcategory: {
                    required: true,
                    alphanumeric: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                bedcategory: {
                    required: "Bed Type Name is required.",
                    alphanumeric: "Must be alphabets or alphanumeric"
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
                var status = $("#status").val();
                if (status == 'Inactive') {
                    if (!confirm('Changing the status to inactive will affect beds, Do you still want to proceed ?')) {
                        return false;
                    }
                }
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
        document.getElementById("bedcategoryform").reset();
        document.getElementById("mode").value = "add";
        document.getElementById("recordid").value = "";
    }

    function showEdit(id) {
        document.getElementById("bedcategoryform").reset();
        document.getElementById("mode").value = "edit";
        document.getElementById("recordid").value = id;
        $.ajax({
            url: "{{ url('bedcategories/editData') }}/" + id,
            headers: {
                '_token': '{{ csrf_token() }}'
            },
            type: "GET",
            dataType: "json",
            success: function(data) {
                let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                myModal.show();
                document.getElementById("bedcategory").value = data.bedcategory['bed_category'];
                document.getElementById("status").value = data.bedcategory['status'];
                document.getElementById("narration").value = data.bedcategory['narration'];
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
