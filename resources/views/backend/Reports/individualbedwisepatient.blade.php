@extends('masterlayout.masterlayout')

@section('content')
<div class="container-fluid p-3">
    <div class="card p-4">
        <h3 class="text-center pb-3">{{$bedname}}</h3>
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Registration No</th>
                    <th>Patient Name</th>
                    <th>Admission Date</th>
                    <th>Admission Time</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $sl = 1;
                @endphp
                @foreach($info as $x)
                <tr>
                    <td>{{$sl++}}</td>
                    <td>{{$x->patient->patient_regn_no}}</td>
                    <td>{{$x->patient->patient_name}}</td>
                    <td>{{ \Carbon\Carbon::parse($x->date_of_addmission)->format('d/m/Y') }}</td>
                    <td>{{\Carbon\Carbon::parse($x->time_of_addmission)->format('h:i A')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

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
         'excel', 'pdf',
        {
            extend: 'print',
            text: 'Print',
            messageTop: '{{$bedname}}',
            exportOptions: {
                columns: ':visible'
            },
            customize: function (win) {
                $(win.document.body)
                    .css('font-size', '10pt')
                    .prepend(
                        '<h3 class="text-center">' + '{{$bedname}}' + '</h3>'
                    );

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }
    ],
    initComplete: function() {
        table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    }
});
</script>
@endsection
