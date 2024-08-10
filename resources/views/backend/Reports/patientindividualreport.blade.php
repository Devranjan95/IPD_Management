@extends('masterlayout.masterlayout')

@section('content')

<div class="container mt-4">
    <!-- Patient Details -->
    @foreach($individual as $patient)
    <div class="card mb-4">
        <div class="card-header" style="background: rgb(240,255,240)">
            <h4 class="card-title">Patient Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 pb-1">
                    <h5><i class="fa fa-id-card" style="color:rgb(141,182,0)"></i><span class="patient-detail">{{ $patient->patient_regn_no }}</span></h5>
                </div>
                <div class="col-md-6 pb-1" style="color:rgb(141,182,0)">
                    <h5><i class="fa fa-user"></i> <span class="patient-detail">{{ $patient->patient_name }}</span></h5>
                </div>
                <div class="col-md-6 pb-1" style="color:rgb(141,182,0)">
                    <h5><i class="fa fa-phone"></i> <span class="patient-detail">{{ $patient->patient_phone }}</span></h5>
                </div>
                <div class="col-md-6 pb-1" style="color:rgb(141,182,0)">
                    @if(isset($patient->patient_email))
                    <h5><i class="fa fa-envelope"></i> <span class="patient-detail">{{ $patient->patient_email }}</span></h5>
                    @else
                    <h5><i class="fa fa-envelope"></i> <span class="patient-detail">Not Provided</span></h5>
                    @endif
                </div>
                <div class="col-md-6 pb-1" style="color:rgb(141,182,0)">
                    <h5><i class="fa fa-address-book"></i> <span class="patient-detail">{{ $patient->patient_address }}</span></h5>
                </div>
                <div class="col-md-6 pb-1" style="color:rgb(141,182,0)">
                    <h5><i class="fa fa-id-badge"></i> <span class="patient-detail">{{ $patient->idproof_no }}</span></h5>
                </div>
                <div class="col-md-6 pb-1">
                    <h5><i class="fa fa-history" style="color:rgb(65,105,225)"></i> Total Visits: <span class="patient-detail">{{ $patient->total_visits }}</span></h5>
                </div>
                <div class="col-md-6 pb-1">
                    @if($patient->deceased_status === 'Y')
                        <h5><i class="fa fa-times" style="color:rgb(220,20,60)"></i> Deceased Status: <span class="patient-detail" style="color:red">Dead</span></h5>
                    @else
                        <h5><i class="fa fa-times" style="color:rgb(220,20,60)"></i> Deceased Status: <span class="patient-detail" style="color:green">Active</span></h5>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tokens -->
    @if($patient->tokens->isNotEmpty())
    <div class="card mb-4">
        <div class="card-header" style="background: rgb(255,250,240)">
            <h4 class="card-title">Token Information</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Registration No</th>
                            <th>Token No</th>
                            <th>Attendant Name</th>
                            <th>Attendant Phone</th>
                            <th>Bed Number</th>
                            <th>Type</th>
                            <th>Price (24hr)</th>
                            <th>Adv Amount</th>
                            <th>Date of Admission</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->tokens as $token)
                        <tr>
                            <td>{{$token->patient_regn_no}}</td>
                            <td>{{ $token->token_no }}</td>
                            <td>{{ $token->attendant_name }}</td>
                            <td>{{ $token->attendant_phone }}</td>
                            <td>{{ $token->bednumber }}</td>
                            <td>{{ $token->flag }}</td>
                            <td>₹{{ $token->type_price_24hr }}</td>
                            <td>₹{{ $token->adv_amount }}</td>
                            <td>{{ $token->date_of_addmission }} / {{ $token->time_of_addmission }}</td>
                            <td>{{ $token->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> No token information available for this patient.
    </div>
    @endif
    @endforeach
</div>

@endsection

@section('scripts')
<style>
    .patient-detail {
        font-weight: bold;
        color: #333; /* Or any color that matches your design */
        display: inline-block;
        margin-left: 5px;
        font-size: 12px;
    }
</style>
<!-- Include required CDN scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>
<script>
    $('#example').DataTable({
        dom: 'Blfrtip',
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
            {
                extend: 'print',
                text: 'Print',
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            `<div style="text-align: center; margin-bottom: 20px;">
                                <h4>Patient Details</h4>
                                <div style="display: flex; flex-wrap: wrap; justify-content: center; font-size: 12pt; border: 1px solid #ddd; border-collapse: collapse;">
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>Name:</strong><br>
                                        {{ $patient->patient_name }}
                                    </div>
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>Phone:</strong><br>
                                        {{ $patient->patient_phone }}
                                    </div>
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>Email:</strong><br>
                                        {{ $patient->patient_email }}
                                    </div>
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>Address:</strong><br>
                                        {{ $patient->patient_address }}
                                    </div>
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>ID Proof:</strong><br>
                                        {{ $patient->idproof_no }}
                                    </div>
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>Total Visits:</strong><br>
                                        {{ $patient->total_visits }}
                                    </div>
                                    <div style="flex: 1; min-width: 150px; padding: 8px; border: 1px solid #ddd; box-sizing: border-box;">
                                        <strong>Deceased Status:</strong><br>
                                        {{ $patient->deceased_status ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>`
                        );

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ]
    });
</script>
@endsection
