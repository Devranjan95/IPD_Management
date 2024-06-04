@extends('masterlayout.masterlayout')

@section('content')
    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <form enctype="multipart/form-data" name="blockform" id="blockform">
                                <input type="hidden" id="saveurl" value="{{ url('blocks/saveData') }}" />
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="mode" name="mode">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Blocks</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        style="color:rgb(250,235,215)" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color:black;font-weight:600">
                                    <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                    <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                    <div class="row pb-3">
                                        <div class="col-md-6">
                                            <label for="block" class="form-label">Block Name<span style="color:red" title="Mandatory">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Block Name." id="blockname" name="blockname">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Floor<span style="color:red" title="Mandatory">*</span></label>
                                            <select class="form-control" id="floorNo" name="floorNo">
                                                    <option value="" selected disabled>Please Select Floor</option>
                                                @foreach($floors as $key=>$value)
                                                    <option value={{$key}}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <label for="block" class="form-label">Block Code</label>
                                            <input type="text" class="form-control" placeholder="Enter Block Code." id="blockcode" name="blockcode">
                                        </div> -->
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Status<span style="color:red" title="Mandatory">*</span></label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="" selected disabled>Please select status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Narration</label>
                                            <textarea class="form-control" placeholder="Narration" id="narration" name="narration" rows="10"></textarea>
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
                                        <h3 class="headingcolor">Blocks</h3>
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
                                            <th>Block Name</th>
                                            <th>Block Code</th>
                                            <th>Floor No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $sl = 1;
                                            $c = 0;
                                        @endphp
                                        @foreach($blocks as $block)
                                            <tr>
                                                <td style="text-align:center">{{$sl++}}</td>
                                                <td>{{$block->block_name}}</td>
                                                <td>{{$block->block_code}}</td>
                                                <td>{{$floorno[$c]}}</td>
                                                <td>
                                                        @if($block->status=="Active")
                                                        <label class="badge badge-success">Active</label>
                                                        @else 
                                                        <label class="badge badge-danger">In Active</label>
                                                        @endif
                                                </td>
                                                <td>
                                                        <a href='#' class='editbtn'  onclick='showEdit({{ $block->id }})'
                                                            title='Edit'><img src='assets/previous/user.svg'
                                                                style='height:20px; width:20px' /></a>&nbsp&nbsp
                                                        <a href='javascript:void(0)'
                                                            onclick="deleteData('{{ url('blocks/deleteData') }}/{{ $block->id }}')"
                                                            title='Delete'><img src='assets/previous/delete.svg'
                                                                style='height:23px; width:23px' /></a>
                                                </td>
                                            </tr>
                                            @php 
                                                $c++;
                                            @endphp
                                        @endforeach
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
<!-- <script>
        $("#blockform").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(document.getElementById('blockform'));
            formData.append("_token", '{{ csrf_token() }}');
            $.ajax({
                type: "POST",
                url: $("#saveurl").val(),
                data: formData,
                contentType: false, //MUST
                processData: false, //MUST
                dataType: "json",
                success: function(response) {
                   
                if($('#mode').val()=='add'){
                    if(response.message == "Error!! Sorry Block already exists"){
                        $('#error').html(response.message).slideDown();
                        setTimeout(function() {
                        $('#error').slideUp();
                            }, 4000);
                    }else{
                        $('#success').html(response.message).slideDown();
                        document.getElementById('floorform').reset();
                        setTimeout(function() {
                            $('#success').slideUp();
                        }, 2000);
                    }
                }
                
                
                if($('#mode').val()=='edit'){
                    if(response.message == "Error!! Sorry Block already exists"){
                        $('#error').html(response.message).slideDown();
                        setTimeout(function() {
                        $('#error').slideUp();
                        }, 4000);
                    }else{
                            //location.reload();
                        $('#success').html(response.message).slideDown();
                        //document.getElementById('chamberform').reset();
                        setTimeout(function() {
                            $('#success').slideUp();
                        }, 2000);
                    }
                }
                },
                error: function() {
                    if (xhr.status === 422) {
                        alert(1);
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                        $('#error').html(errorMessage).slideDown();
                        setTimeout(function() {
                            $('#error').slideUp();
                        }, 4000);
                    } else {
                        alert("Error saving data.");
                    }
                }
            });
        });
        
        function showAdd() {
            document.getElementById("blockform").reset();
            document.getElementById("mode").value = "add";
            document.getElementById("recordid").value = "";
        }

        function showEdit(id) {
            document.getElementById("blockform").reset();
            document.getElementById("mode").value = "edit";
            document.getElementById("recordid").value = id;
            $.ajax({
                url: "{{ url('blocks/editData') }}/" + id,
                headers: {
                    '_token': '{{ csrf_token() }}'
                },
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                    myModal.show();
                    //alert(data.floor["floor_no"]);
                    document.getElementById("blockname").value = data.block['block_name'];
                    //document.getElementById("blockcode").value = data.block['block_code'];
                    document.getElementById("floorNo").value = data.block['floor_no'];
                    document.getElementById("status").value = data.block['status'];

                },
                error: function() {
                    return false;
                }
            });

        }
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script><script>
    $(document).ready(function() {
        // Add custom validation method for letters only
        // $.validator.addMethod("lettersonly", function(value, element) {
        //     return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
        // }, "Only letters and spaces are allowed.");
        // $.validator.addMethod("alphanumeric", function(value, element) {
        // return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value);
        // }, "Only letters, numbers, and spaces are allowed.");
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
        }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");


        // Form validation rules
        $("#blockform").validate({
            rules: {
                blockname: {
                    required: true,
                    alphanumeric: true
                },
                floorNo:{
                    required: true,
                },
                status: {
                    required: true
                }
            },
            messages: {
                blockname: {
                    required: "Block Name is required.",
                    alphanumeric: "Must be alphabets or alphanumeric"
                },
                floorNo:{
                    required: "Floor No is required.",
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
                            //alert(response.message);
                            $("#success").text(response.message).show();
                            $("#error").hide();
                            setTimeout(function() {
                                $('#success').slideUp();
                            }, 4000);
                            if ($("#mode").val() === 'add') {
                                form.reset(); // Reset the form
                            }else{
                                window.location.reload();
                            }
                            //$('#recordid').val(response.new_reg_no);
                        } else {
                            //alert(response.message);
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
        document.getElementById("blockform").reset();
        document.getElementById("mode").value = "add";
        document.getElementById("recordid").value = "";
    }

    function showEdit(id) {
        document.getElementById("blockform").reset();
        document.getElementById("mode").value = "edit";
        document.getElementById("recordid").value = id;
        $.ajax({
            url: "{{ url('blocks/editData') }}/" + id,
            headers: {
                '_token': '{{ csrf_token() }}'
            },
            type: "GET",
            dataType: "json",
            success: function(data) {
                let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                myModal.show();
                //alert(data.floor["floor_no"]);
                document.getElementById("blockname").value = data.block['block_name'];
                //document.getElementById("blockcode").value = data.block['block_code'];
                document.getElementById("floorNo").value = data.block['floor_id'];
                document.getElementById("status").value = data.block['status'];
                document.getElementById("narration").value = data.block['narration'];
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