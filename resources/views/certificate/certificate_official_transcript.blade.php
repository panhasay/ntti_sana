<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Transcript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Battambang-Bold';
            src: url('{{ public_path('fonts/Battambang-Bold.ttf') }}') format('truetype');
        }

        .transcript-header,
        .transcript-footer {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .remarks-table th,
        .remarks-table td {
            border: 1px solid #000;
            padding: 4px;
        }

        .logo {
            width: 80px;
        }

        .no-border {
            border: none !important;
        }

        @font-face {
            font-family: "KhmerOSBattambang";
            src: url('/fonts/Khmer OS Battambang Regular.ttf') format("truetype");
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="transcript-header">
            <h5>Ministry of Labour and Vocational Training</h5>
            <h6>National Technical Training Institute</h6>
            <h4><strong style="font-family: 'Khmer OS Battambang'">ប្រតិចារិកផ្លូវការ</strong></h4>
        </div>

        <table class="table table-bordered mt-4">
            <tr>
                <td><strong>Student:</strong> ICH POR CHAY</td>
                <td><strong>Sex:</strong> Male</td>
                <td><strong>Nationality:</strong> Khmer</td>
            </tr>
            <tr>
                <td><strong>Date of Birth:</strong> May 8, 2001</td>
                <td><strong>Place of Birth:</strong> Phnom Penh</td>
                <td><strong>Date of Graduation:</strong> January 22, 2024</td>
            </tr>
        </table>

        <h5 class="text-center">Subjects and Grades</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="border: 2px solid #000;">No</th>
                    <th style="border: 2px solid #000;">Subject</th>
                    <th style="border: 2px solid #000;">Hour</th>
                    <th style="border: 2px solid #000;">Score (100)</th>
                    <th style="border: 2px solid #000;">Grade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mathematics for Computing</td>
                    <td>102</td>
                    <td>56.00</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Social and Morality</td>
                    <td>102</td>
                    <td>50.00</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>English for Computing</td>
                    <td>51</td>
                    <td>69.00</td>
                    <td>C+</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Microsoft Office</td>
                    <td>102</td>
                    <td>50.00</td>
                    <td>C</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Beginner Web Programming</td>
                    <td>102</td>
                    <td>74.50</td>
                    <td>B</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>PC Troubleshooting and Maintenance</td>
                    <td>102</td>
                    <td>73.00</td>
                    <td>B</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Computer Ethics</td>
                    <td>51</td>
                    <td>80.00</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Computer Design and Publishing</td>
                    <td>51</td>
                    <td>67.00</td>
                    <td>C+</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Programming Development and Software</td>
                    <td>102</td>
                    <td>80.00</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Interactive Multimedia Design</td>
                    <td>102</td>
                    <td>69.50</td>
                    <td>C+</td>
                </tr>
            </tbody>
        </table>

        <h5 class="text-center">State Exam Results</h5>
        <table class="table table-bordered">
            <tr>
                <td>Computer Networking</td>
                <td>51</td>
                <td>70.00</td>
                <td>B</td>
            </tr>
            <tr>
                <td>Data Structure and Algorithm</td>
                <td>51</td>
                <td>84.00</td>
                <td>B+</td>
            </tr>
            <tr>
                <td>Software Project Development</td>
                <td>51</td>
                <td>90.00</td>
                <td>A</td>
            </tr>
        </table>

        <div class="remarks-table mt-4">
            <h6>Remarks:</h6>
            <table>
                <tr>
                    <th>Mark Obtained</th>
                    <th>Grade</th>
                    <th>Meaning</th>
                    <th>Grade Point</th>
                </tr>
                <tr>
                    <td>85-100</td>
                    <td>A</td>
                    <td>Excellent</td>
                    <td>4.00</td>
                </tr>
                <tr>
                    <td>80-84</td>
                    <td>B+</td>
                    <td>Very Good</td>
                    <td>3.50</td>
                </tr>
                <tr>
                    <td>70-79</td>
                    <td>B</td>
                    <td>Good</td>
                    <td>3.00</td>
                </tr>
                <tr>
                    <td>65-69</td>
                    <td>C+</td>
                    <td>Fairly Good</td>
                    <td>2.50</td>
                </tr>
                <tr>
                    <td>60-64</td>
                    <td>C</td>
                    <td>Fair</td>
                    <td>2.00</td>
                </tr>
                <tr>
                    <td>Less than 50</td>
                    <td>F</td>
                    <td>Fail</td>
                    <td>1.50</td>
                </tr>
            </table>
        </div>

        <div class="transcript-footer mt-5 text-end">
            <p>Phnom Penh, ____________</p>
            <p><strong>Deputy Director</strong></p>
        </div>
    </div>
</body>

</html>
