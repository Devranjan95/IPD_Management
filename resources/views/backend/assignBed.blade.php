@extends('masterlayout.masterlayout')

@section('content')

<section class="table-components">
    <div class="container-fluid" id="fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="container-wrapper pt-30">
            <form enctype="multipart/form-data" name="bedform" id="bedform">
                <input type="hidden" id="saveurl" value="{{ url('beds/saveData') }}" />
                <input type="hidden" id="recordid" name="recordid" value="" />
                <input type="hidden" id="mode" name="mode">
                
                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Manage Bed</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:rgb(250,235,215)" aria-label="Close"></button>
                </div>
                
                    <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                    <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                    <div class="row pb-3">
                        <div class="col-md-6">
                            <label for="bed_name" class="form-label">Bed Name<span style="color:red" title="Mandatory">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Bed Name" id="bedname" name="bedname">
                        </div>
                        <div class="col-md-6">
                            <label for="bed_type_id" class="form-label">Bed Type<span style="color:red" title="Mandatory">*</span></label>
                            <select class="form-control" id="bed_type_id" name="bed_type_id">
                                <option value="" selected disabled>Please select bed type</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-md-6">
                            <label for="bed_category_id" class="form-label">Bed Category<span style="color:red" title="Mandatory">*</span></label>
                            <select class="form-control" id="bed_category_id" name="bed_category_id">
                                <option value="" selected disabled>Please select bed category</option>
                                
                            </select>
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
                
                
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="reload()">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                
            </form>

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
                                            <li class="breadcrumb-item text-secondary"><a href="{{url('beds')}}">Beds</a></li>
                                            <li class="breadcrumb-item active text-primary" aria-current="page">Assign Bed</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class='col-lg-6 pb-2'>
                                    <button type="button" class="btn btn-rounded btn-fw btn-info" style="float:right;">Assign Bed</button>
                                    <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right;margin-right:10px;" data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add New</button>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Bed Name</th>
                                            <th>Bed Type</th>
                                            <th>Bed Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                       
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

@endsection
