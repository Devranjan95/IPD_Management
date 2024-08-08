@extends('masterlayout.masterlayout')

@section('content')
    <section class="report-section p-3">
        <div class="container-fluid">
            <div class="certificate mb-30 p-4" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);">
                <div class="certificate-header text-center mb-4" style="margin-bottom: 20px;">
                    <h1 class="certificate-title" style="font-size: 2.5rem; margin-bottom: 0.5rem;">Death Report</h1>
                    <h2 class="certificate-subtitle" style="font-size: 1.5rem; margin-bottom: 1.5rem;">{{$individualdeath->patient_name}}</h2>
                </div>
                <div class="certificate-body" style="font-size: 1rem;">
                    <table class="" style="width: 100%; border-collapse: collapse; margin-bottom: 1rem;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center; background-color: #f2f2f2; font-weight: bold;">Levels</th>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center; background-color: #f2f2f2; font-weight: bold;">Values</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Image:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">
                                    @if($individualdeath->image_path)
                                        <img src="{{ asset($individualdeath->image_path) }}" alt="Dead Body Image" class="certificate-image" style="width: 100px; height: 100px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Registration No:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->patient_regn_no }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Patient Name:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->patient_name }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Admission Date:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ \Carbon\Carbon::parse($individualdeath->date_of_addmission)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Admission Time:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ \Carbon\Carbon::parse($individualdeath->time_of_addmission)->format('h:i A') }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Death Date:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ \Carbon\Carbon::parse($individualdeath->date_of_death)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Death Time:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ \Carbon\Carbon::parse($individualdeath->time_of_death)->format('h:i A') }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Place of Death:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->place_of_death }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Cause of Death:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->cause_of_death }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Age:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->age }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Gender:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->gender }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Address:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->address }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Marital Status:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->marital_status }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Father's Name:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->father_name }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Mother's Name:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->mother_name }}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">Issued By:</th>
                                <td style="border: 1px solid #dee2e6; padding: 8px; text-align: center;">{{ $individualdeath->issued_by }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-warning" onclick="printReport()" style="margin-top: 20px;">Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
function printReport() {
    var originalContents = document.body.innerHTML;
    var printContents = document.querySelector('.report-section').innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
@endsection
