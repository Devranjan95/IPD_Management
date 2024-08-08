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
                                        <h3 class="headingcolor">Birth Reports</h3>
                                        <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-warning" aria-current="page">Birth Reports</li>
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
                            <div class='col-lg-12'>
                                <div class="table-responsive">
                                <table id="example" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">Sl</th>
                                            <th>Regn No</th>
                                            <th>Mother's Name</th>
                                            <th>Father's Name</th>
                                            <th>Contact</th>
                                            <th>Addmission Date</th>
                                            <th>Addmission Time</th>
                                            <!-- <th>Birth Date</th>
                                            <th>Birth Time</th> -->
                                            <!-- <th>New Born Image</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @php
                                            $sl = 1;
                                       @endphp
                                       @foreach($birthData as $birth)
                                            <tr>
                                                <td style="text-align:center">{{$sl++}}</td>
                                                <td>{{$birth->regn}}</td>
                                                <td>{{$birth->patname}}</td>
                                                <td>{{$birth->fathername}}</td>
                                                <td>{{$birth->contact}}</td>
                                                <td>{{ \Carbon\Carbon::parse($birth->addmission_date)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($birth->addmission_time)->format('h:i A') }}</td>
                                                <!-- <td>{{--{{ \Carbon\Carbon::parse($birth->birthdate)->format('d/m/Y') }}--}}</td>
                                                <td>{{--{{ \Carbon\Carbon::parse($birth->birthtime)->format('h:i A') }}--}}</td> -->
                                                
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-success" onclick = "getNewBorn({{$birth->id}})">View Details</a>
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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>
<script>

var table = new DataTable('#example', {
    dom: 'lBfrtip',
    buttons: [
         'excel', 'pdf', 'print'
    ],
    initComplete: function() {
        table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    }
});

function getNewBorn(id){
    //alert(id);
    $.ajax({
        url:"{{url('getnewborn')}}/"+id,
        type:"GET",
        data:{_token:"{{csrf_token()}}"},
        success:function(response){
            //alert(1);
            window.location.href="{{url('getnewborn')}}/"+id;
        },
        error:function(){
            alert("Error!!");
        }
    });
}
</script>
@endsection