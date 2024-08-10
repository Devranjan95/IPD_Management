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
                                        <h3 class="headingcolor">Patient Reports</h3>
                                        <nav>
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item text-primary"><a class="text-decoration-none text-primary" href="{{url('dashboard')}}">Dashboard</a></li>
                                                <li class="breadcrumb-item active text-warning" aria-current="page">Patient Reports</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-12'>
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Sl</th>
                                                <th>Regn No</th>
                                                <th>Patient Name</th>
                                                <th style="text-align:center">Patient Contact</th>
                                                <th>Patient Email</th>
                                                <th style="text-align:center">Total visits</th>
                                                <th class="no-print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                                $sl = 1;
                                            @endphp 
                                            @foreach($patientInfos as $patient)
                                                <tr>
                                                    <td style="text-align:center">{{$sl++}}</td>
                                                    <td>{{$patient->patient_regn_no}}</td>
                                                    <td>{{$patient->patient_name}}</td>
                                                    <td style="text-align:center">{{$patient->patient_phone}}</td>
                                                    @if(isset($patient->patient_email))
                                                        <td>{{$patient->patient_email}}</td>
                                                    @else
                                                        <td>Email not provided</td>
                                                    @endif
                                                    <td style="text-align:center">{{$patient->total_visits}}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-success no-print" onclick="callPatient('{{$patient->patient_regn_no}}')">
                                                            View Details
                                                        </a>
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
<style>
    @media print {
        .no-print {
            display: none;
        }
    }
    .dt-buttons {
        float: left;
        margin-bottom: 10px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>
<script>

// var table = new DataTable('#example', {
//     dom: 'lBfrtip',
//     buttons: [
//          'excel', 'pdf', 'print'
//     ],
//     initComplete: function() {
//         table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
//     }
// });

var table = new DataTable('#example', {
    dom: 'lBfrtip',
    buttons: [
        'excel',
        {
            extend: 'pdf',
            text: 'PDF',
            orientation: 'landscape',
            action: function (e, dt, button, config) {
                // Open the PDF in a new window instead of downloading directly
                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, $.extend({}, config, {
                    download: 'open'
                }));
            },
            customize: function (doc) {
                doc.content[1].margin = [10, 0, 10, 0]; // Adjust margins
                // Additional customization can be added here if needed
            }
        },
        'print'
    ],
    initComplete: function() {
        table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    }
});



function callPatient(regn) {
    regn = regn.replace(/\//g, '-');
    //alert(regn);

    if (regn) {
        $.ajax({
            type: "GET",
            url: "{{ url('patientreports/record') }}/" + regn,
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            success: function(response) {
                // Redirect to the patient report URL
                window.location.href = "{{ url('patientreports/record') }}/" + regn;
            },
            error: function() {
                alert('Something went wrong');
            }
        });
    }
}
</script>
@endsection
