@extends('masterlayout.masterlayout')

@section('content')
    <section class="table-components">
        <div class="container-fluid" id="fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="container-wrapper pt-30">
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <form enctype="multipart/form-data" name="floorform" id="floorform">
                                <input type="hidden" id="saveurl" value="{{ url('floors/saveData') }}" />
                                <input type="hidden" id="recordid" name="recordid" value="" />
                                <input type="hidden" id="mode" name="mode">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Floors</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        style="color:rgb(250,235,215)" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color:black;font-weight:600">
                                    <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                    <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                    <div class="row pb-3">
                                        <div class="col-md-6">
                                            <label for="floor" class="form-label">Insert Floor No.</label>
                                            <input type="number" class="form-control" placeholder="Mention Floor No." id="floorNo" name="floorNo">
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
                                        <h3 class="headingcolor">Floors</h3>
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
                                            <th style="text-align:center">Floor No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sl = 1; 
                                        @endphp
                                        @foreach($floordata as $floor)
                                            <tr>
                                                <td style="text-align:center">{{$sl++}}</td>
                                                <td style="text-align:center">{{$floor->floor_no}}</td>
                                                <td>
                                                        @if($floor->status=="Active")
                                                        <label class="badge badge-success">Active</label>
                                                        @else 
                                                        <label class="badge badge-danger">In Active</label>
                                                        @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                   
                                                        <a href='#' class='editbtn'  onclick='showEdit({{ $floor->id }})'
                                                            title='Edit'><img src='assets/previous/user.svg'
                                                                style='height:20px; width:20px' /></a>&nbsp&nbsp
                                                        <a href='javascript:void(0)'
                                                            onclick="deleteData('{{ url('floors/deleteData') }}/{{ $floor->id }}')"
                                                            title='Delete'><img src='assets/previous/delete.svg'
                                                                style='height:23px; width:23px' /></a>
                                  
                                                    </div>
                                                </td>
                                            </tr>
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
<script>
        $("#floorform").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(document.getElementById('floorform'));
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
                    if(response.message == "Error!! Sorry Floor already exists"){
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
                    if(response.message == "Error!! Sorry Floor already exists"){
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
            document.getElementById("floorform").reset();
            document.getElementById("mode").value = "add";
            document.getElementById("recordid").value = "";
        }

        function showEdit(id) {
            document.getElementById("floorform").reset();
            document.getElementById("mode").value = "edit";
            document.getElementById("recordid").value = id;
            $.ajax({
                url: "{{ url('floors/editData') }}/" + id,
                headers: {
                    '_token': '{{ csrf_token() }}'
                },
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                    myModal.show();
                    //alert(data.floor["floor_no"]);
                    document.getElementById("floorNo").value = data.floor['floor_no'];
                    document.getElementById("status").value = data.floor['status'];

                },
                error: function() {
                    return false;
                }
            });

        }
    </script>

@endsection