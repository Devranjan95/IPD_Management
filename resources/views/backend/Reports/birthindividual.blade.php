@extends('masterlayout.masterlayout')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <!-- BirthRecord Details -->
        @foreach($datas as $birthRecord)
        <div class="mb-4">
            <h3 class="pb-2">Birth Record Details</h3>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Registration No:</strong> {{ $birthRecord->regn }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Mother's Name:</strong> {{ $birthRecord->mothername }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Father's Name:</strong> {{ $birthRecord->fathername }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Date of Admission:</strong> {{ \Carbon\Carbon::parse($birthRecord->addmission_date)->format('d/m/Y') }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;"><strong>Time of Admission:</strong> {{ \Carbon\Carbon::parse($birthRecord->addmission_time)->format('h:i A') }}</td>
                </tr>
            </table>
        </div>



        <!-- NewBorn Details Table -->
        <h3 class="pb-2">Newborn Details</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">#</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Birth Date</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Birth Time</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Place of Birth</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Gender</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Weight</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Length</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Image</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $sl = 1;
                @endphp
                @foreach($birthRecord->newborn as $newBorn)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $sl++ }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($newBorn->birthdate)->format('d/m/Y')  }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ \Carbon\Carbon::parse($newBorn->birthtime)->format('h:i A') }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->placeofbirth }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        @if($newBorn->gender === 'Male')
                            <i class="fa fa-male" style="color:rgb(141,182,0)"></i> {{ $newBorn->gender }}
                        @else
                            <i class="fa fa-female" style="color:rgb(141,182,0)"></i> {{ $newBorn->gender }}
                        @endif
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->weight }} kg</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->length }} cm</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <img src="{{ asset($newBorn->image_path) }}" style="width:100px;height:100px">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach

        <!-- Print Button -->
        <div class="text-center mb-4 pt-3">
            <button class="btn btn-warning" onclick="printContent('print-area')">Print Details</button>
        </div>

        <!-- Print Area -->
        <div id="print-area" style="display: none;">

            <!-- BirthRecord Details for Print -->
            @foreach($datas as $birthRecord)
            <div class="mb-4">
                <h3 class="pb-2">Birth Record Details</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;"><strong>Registration No:</strong> {{ $birthRecord->regn }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;"><strong>Mother's Name:</strong> {{ $birthRecord->mothername }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;"><strong>Father's Name:</strong> {{ $birthRecord->fathername }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;"><strong>Date of Admission:</strong> {{ \Carbon\Carbon::parse($birthRecord->addmission_date)->format('d/m/Y') }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;"><strong>Time of Admission:</strong> {{ \Carbon\Carbon::parse($birthRecord->addmission_time)->format('h:i A') }}</td>
                    </tr>
                </table>
            </div>
            <!-- Add more BirthRecord details here as needed -->

            <!-- NewBorn Details Table for Print -->
            <h3>Newborn Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">#</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Birth Date</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Birth Time</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Place of Birth</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Gender</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Weight</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Length</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left;">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $sl = 1;
                    @endphp
                    @foreach($birthRecord->newborn as $newBorn)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $sl++ }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->birthdate }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->birthtime }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->placeofbirth }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->gender }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->weight }} kg</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $newBorn->length }} cm</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            <img src="{{ asset($newBorn->image_path) }}" style="max-width: 100px; height: auto;">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function printContent(el) {
    var printWindow = window.open('', '', 'height=600,width=800');
    var content = document.getElementById(el).innerHTML;
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; text-align: left; } th { background-color: #f4f4f4; } img { max-width: 100px; height: auto; } </style>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}
</script>
@endsection
