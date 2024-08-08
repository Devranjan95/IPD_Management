@extends('masterlayout.masterlayout')

@section('content')

<div class="container-fluid p-3">
    <div class="card p-3">
        <h3 class="text-center pb-3">Discharge Summary</h3>
        <table id="mainTable" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Patient Registration No</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->patient->patient_regn_no }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Patient Name</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->patient->patient_name }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Attendant Name</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->attendant_name }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Attendant Phone</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->attendant_phone }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Bed Number</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->bednumber }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Admission Date</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->date_of_addmission)->format('d/m/Y') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Admission Time</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->time_of_addmission)->format('h:i A') }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Discharge Date</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->date_of_discharge)->format('d/m/Y') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Discharge Time</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->time_of_discharge)->format('h:i A') }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Total Stay (in hours)</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->total_stay_hr }} hrs</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Discharge Summary</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->discharge_summary }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Total Price</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->total_price }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Advance Paid</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->adv_amount }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Final Price</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->total_priceAfterAdvance }}</td>
            </tr>
        </table>
        <div style="text-align: center;">
            <button onclick="copyAndPrint()" class="btn btn-warning">Print</button>
        </div>
    </div>
</div>

<div id="printArea" style="display:none;">
    <h3 class="text-center pb-3">Discharge Summary</h3>
    <table id="printTable" style="width: 100%; border-collapse: collapse;">
    <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Patient Registration No</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->patient->patient_regn_no }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Patient Name</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->patient->patient_name }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Attendant Name</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->attendant_name }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Attendant Phone</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->attendant_phone }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Bed Number</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->bednumber }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Admission Date</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->date_of_addmission)->format('d/m/Y') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Admission Time</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->time_of_addmission)->format('h:i A') }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Discharge Date</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->date_of_discharge)->format('d/m/Y') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Discharge Time</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($infos[0]->time_of_discharge)->format('h:i A') }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Total Stay (in hours)</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->total_stay_hr }} hrs</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Discharge Summary</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->discharge_summary }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Total Price</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->total_price }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Advance Paid</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->adv_amount }}</td>
            </tr>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Final Price</th>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $infos[0]->total_priceAfterAdvance }}</td>
            </tr>
    </table>
</div>

@endsection

@section('scripts')
<script>
    function copyAndPrint() {
        // Copy the contents of the mainTable to printTable
        var mainTable = document.getElementById('mainTable').innerHTML;
        document.getElementById('printTable').innerHTML = mainTable;
        
        // Trigger the print
        var printContent = document.getElementById('printArea').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
@endsection
