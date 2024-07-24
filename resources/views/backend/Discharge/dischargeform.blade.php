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
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('masters')}}">Main</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Discharge Patient</li>
                                        </ol>
                                    </nav>
                                    </div>
                                    <!-- <div class='col-lg-6 pb-2'>
                                        <button type="button" class="btn btn-rounded btn-fw btn-success" style="float:right"
                                            data-bs-toggle="modal" onclick="showAdd()" data-bs-target="#staticBackdrop">Add
                                            New</button>
                                    </div> -->
                                    <!-- <hr style="color:#030d04"> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="col-md-6">
                                        <select id="regn" name="regn" class="form-control select2" onchange="searchPatient()">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($regnvalues as $regn)
                                                <option value="{{$regn->patient_regn_no}}">{{$regn->patient_regn_no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <button class="btn btn-inverse-warning btn-fw w-100" onclick="searchPatient()">Search</button>
                                    </div> -->
                            </div>
                            <div class="col-md-12">
                                <form enctype="multipart/form-data" name="dischargeform" id="dischargeform">
                                    <input type="hidden" id="saveurl" value="{{ url('discharge/saveData') }}" />
                                    <input type="hidden" id="recordid" name="recordid" value="" />
                                    <!-- <input type="hidden" id="dischargecount" name="dischargecount" value="" /> -->
                                    <input type="hidden" id="mode" name="mode">
                                        <div class="col-lg-12 text-center pb-3" style="color:red;font-weight:600" id="error"> </div>
                                        <div class="col-lg-12 text-center pb-3" style="color:green;font-weight:600" id="success"> </div>
                                        <div class="row pb-3">
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Patient Name<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="Patient Name" id="patname" name="patname" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Contact No<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="contact" id="contact" name="contact" readonly>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Advance Paid<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="Advance amount" id="advamount" name="advamount" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Payment Due<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="text" class="form-control" placeholder="Payment due" id="dueamount" name="dueamount" readonly>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Discharge Date<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="date" class="form-control" placeholder="Date" id="disdate" name="disdate" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="discharge" class="form-label">Discharge Time<span style="color:red" title="Mandatory">*</span></label>
                                                <input type="time" class="form-control" placeholder="Time" id="distime" name="disttime" readonly>
                                            </div>
                                        </div>
                                        <div class="row pb-3">
                                            <div class="col-md-12">
                                                <label for="discharge" class="form-label">Discharge Summary</label>
                                                <textarea class="form-control" placeholder="Summary" id="summary" name="summary" rows="10"></textarea>
                                            </div>
                                        </div>
                                    
                                    
                                        <button type="submit" class="btn btn-success">Save</button>
                                    
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Search existing patient",
            allowClear: true
        });
    });

    function searchPatient(){
        let regn = $("#regn").val();
        alert(regn);
        if(regn){
            $.ajax({
                type:"POST",
                url:"{{url()}}"
            })
        }
    }
</script>
@endsection