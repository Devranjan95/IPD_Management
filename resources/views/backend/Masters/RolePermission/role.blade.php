@extends('masterlayout.masterlayout')
@section("content")

<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <form enctype="multipart/form-data" name="roleform" id="roleform">
                            <input type="hidden" id="saveurl" value="{{ url('role/saveData') }}" />
                            <input type="hidden" id="recordid" name="recordid" value="" />
                            <input type="hidden" id="mode" name="mode">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Roles</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;font-weight:600">
                                <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <label for="block" class="form-label">Role Name<span style="color:red" title="Mandatory">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Role Name" id="rolename" name="rolename">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">Status<span style="color:red" title="Mandatory">*</span></label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="" selected disabled>Please select status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Screens</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="select_all_permissions" />
                                                <label class="form-check-label" for="select_all_permissions">
                                                    Select All
                                                </label>
                                            </div>
                                            <div class="row">
                                                @foreach($permissions as $permission)
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-checkbox" type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Actions</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="select_all_actions" />
                                                <label class="form-check-label" for="select_all_actions">
                                                    Select All
                                                </label>
                                            </div>
                                            <div class="row">
                                                @foreach($actions as $act)
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input action-checkbox" type="checkbox" id="action_{{ $act->id }}" name="actions[]" value="{{ $act->id }}">
                                                            <label class="form-check-label" for="action_{{ $act->id }}">
                                                                {{ $act->action_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
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
                                    <h3 class="headingcolor">Roles</h3>
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('masters')}}">Masters</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Roles</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class='col-lg-6 pb-2'>
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- *********** -->
                        <div class="row">
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                        <!-- ************ -->
                        <div class='col-lg-12'>
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Sl</th>
                                        <th>Role</th>
                                        <th>Screens</th>
                                        <th>Works</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                       $sl = 1;
                                    @endphp 
                                    @foreach($roleData as $data)
                                        @if($data['role']->id != 1)
                                        <tr>
                                            
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $data['role']->name }}</td>
                                            <td>{{--{{ implode(', ', $data['pernames']) }}--}}
                                                @if(count($data['pernames'])==14)
                                                    <p>All</p>
                                                @else 
                                                <ul>
                                                  @foreach($data['pernames'] as $screen)
                                                   <li>{{$screen}}</li>
                                                  @endforeach
                                                </ul>
                                                @endif
                                            </td>
                                            <td>{{--{{ implode(', ', $data['actionnames']) }}--}}
                                                @if(count($data['actionnames'])==14)
                                                    <p>All</p>
                                                @else
                                                <ul>
                                                    @foreach($data['actionnames'] as $action)
                                                    <li>{{$action}}</li>
                                                    @endforeach
                                                </ul>
                                                @endif 
                                            </td>
                                            <td>
                                                @if($data['role']->status == "Active")
                                                <label class="badge badge-success">Active</label>
                                                @else 
                                                <label class="badge badge-danger">In Active</label>
                                                @endif
                                            </td>                                         
                                            <td>
                                                <div class="btn-group">
                                                @if (in_array(2, session('actions')))
                                                    <a href='#' class='editbtn'  onclick='showEdit({{ $data["role"]->id }})'
                                                        title='Edit'><img src='assets/previous/user.svg'
                                                            style='height:20px; width:20px' /></a>&nbsp&nbsp
                                                @endif
                                                @if (in_array(4, session('actions')))
                                                    <a href='javascript:void(0)'
                                                        onclick="deleteData('{{ url('role/deleteData') }}/{{ $data['role']->id }}')"
                                                        title='Delete'><img src='assets/previous/delete.svg'
                                                            style='height:23px; width:23px' /></a>
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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
    // Initialize Select2 when the modal is shown
    

    // Add custom validation method for alphanumeric
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^(?=.*[a-zA-Z])[a-zA-Z0-9\s]+$/.test(value);
    }, "Only letters, numbers, and spaces are allowed, and must contain at least one letter.");

    $.validator.addMethod("positiveNumber", function(value, element) {
        return this.optional(element) || (value >= 0);
    }, "Price must be a positive number.");

    // Form validation rules
    $("#roleform").validate({
        rules: {
            rolename: {
                required: true,
                alphanumeric: true
            },
           
        },
        messages: {
            rolename: {
                required: "Role name is required.",
                alphanumeric: "Must be alphabets or alphanumeric"
            },
            
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
                            $("#roleform")[0].reset(); // Reset the form
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
        document.getElementById("roleform").reset();
        document.getElementById("mode").value = "add";
        document.getElementById("recordid").value = "";
}

// function showEdit(id) {
//     document.getElementById("roleform").reset();
//     document.getElementById("mode").value = "edit";
//     document.getElementById("recordid").value = id;
    
//     $.ajax({
//         url: "{{ url('role/editData') }}/" + id,
//         headers: {
//             '_token': '{{ csrf_token() }}'
//         },
//         type: "GET",
//         dataType: "json",
//         success: function(data) {
//             if (data.permission) {
//                 let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
//                 myModal.show();
//                 //document.getElementById("permissionname").value = data.permission.name;

//             } else {
//                 console.error('Role data not found');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error:', error);
//         }
//     });
// }

function showEdit(id) {
    document.getElementById("roleform").reset();
    document.getElementById("mode").value = "edit";
    document.getElementById("recordid").value = id;
    
    $.ajax({
        url: "{{ url('role/editData') }}/" + id,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type: "GET",
        dataType: "json",
        success: function(data) {
            if (data.role) {
                let role = data.role;
                let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('staticBackdrop'));
                myModal.show();

                // Populate form fields
                document.getElementById("rolename").value = role.name;
                document.getElementById("status").value = role.status;
                document.getElementById("narration").value = role.narration;

                // Clear all checkboxes
                $('.permission-checkbox, .action-checkbox').prop('checked', false);

                // Check the appropriate permissions
                let permissions = role.permission.split(',');
                permissions.forEach(function(permission) {
                    $('#permission_' + permission).prop('checked', true);
                });

                // Check the appropriate actions
                let actions = role.action.split(',');
                actions.forEach(function(action) {
                    $('#action_' + action).prop('checked', true);
                });

            } else {
                console.error('Role data not found');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
function deleteData(url) {
        if (confirm('Are you sure you want to delete this record?')) {
            window.location.href = url;
        }
    }
</script>
<script>
    document.getElementById('select_all_permissions').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('.permission-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });

    document.getElementById('select_all_actions').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('.action-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>
@endsection