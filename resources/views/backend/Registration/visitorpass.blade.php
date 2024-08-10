<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass Cards</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }

        .pass-card {
            width: 3.5in;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .pass-card-header {
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .visitor-card-header {
            background: #4CAF50;
        }

        .attendant-card-header {
            background: #FF9800;
        }

        .pass-card-body {
            flex: 1;
            padding: 5px;
            text-align: center;
        }

        .pass-details {
            margin: 10px 0;
        }

        .pass-details h5 {
            margin: 5px 0;
            font-size: 16px;
        }

        .visitor-details h5 {
            color: #4CAF50;
        }

        .attendant-details h5 {
            color: #FF9800;
        }

        .pass-details p {
            margin: 0;
            font-size: 12px;
            color: #777;
        }

        .pass-details table {
            width: 100%;
            font-size: 12px;
            margin-top: 10px;
        }

        .pass-details table th, .pass-details table td {
            text-align: left;
            padding: 2px;
        }

        .pass-card-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .print-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center flex-column align-items-center">
            @if($info)
                <!-- Visitor Pass Card -->
                <div class="pass-card">
                    <div class="pass-card-header visitor-card-header">
                        Visitor Pass
                    </div>
                    <div class="pass-card-body">
                        <div class="pass-details visitor-details">
                            <table>
                                <tr>
                                    <th>Patient Name:</th>
                                    <td>{{ $info->patient->patient_name }}</td>
                                </tr>
                                <tr>
                                    <th>Registration No:</th>
                                    <td>{{ $info->patient_regn_no }}</td>
                                </tr>
                                <tr>
                                    <th>Attendant Name:</th>
                                    <td>{{ $info->attendant_name }}</td>
                                </tr>
                                <tr>
                                    <th>Attendant Phone:</th>
                                    <td>{{ $info->attendant_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Bed Number:</th>
                                    <td>{{ $info->bednumber }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Admission:</th>
                                    <td>{{ $info->date_of_addmission }}</td>
                                </tr>
                                <tr>
                                    <th>Time of Admission:</th>
                                    <td>{{ $info->time_of_addmission }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="pass-card-footer">
                        Thank you for visiting us!
                    </div>
                </div>

                <!-- Attendant Pass Card -->
                <div class="pass-card">
                    <div class="pass-card-header attendant-card-header">
                        Attendant Pass
                    </div>
                    <div class="pass-card-body">
                        <div class="pass-details attendant-details">
                            <h5>{{ $info->attendant_name }}</h5>
                            <table>
                                <tr>
                                    <th>Patient Name:</th>
                                    <td>{{ $info->patient->patient_name }}</td>
                                </tr>
                                <tr>
                                    <th>Registration No:</th>
                                    <td>{{ $info->patient_regn_no }}</td>
                                </tr>
                                <tr>
                                    <th>Bed Number:</th>
                                    <td>{{ $info->bednumber }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Admission:</th>
                                    <td>{{ $info->date_of_addmission }}</td>
                                </tr>
                                <tr>
                                    <th>Time of Admission:</th>
                                    <td>{{ $info->time_of_addmission }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="pass-card-footer">
                        Thank you for your service!
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    No information found for the given registration number and date.
                </div>
            @endif

            <!-- Print Button -->
            <div class="print-button no-print">
                <button onclick="window.print()" class="btn btn-primary">Print Passes</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
