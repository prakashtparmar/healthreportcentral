<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['employee_data'])) {
    // Buffer all upcoming output
    ob_start();

    require('fpdf/fpdf.php'); // Ensure the path to fpdf.php is correct

    $employee_data_json = $_POST['employee_data'];
    $employee_data = json_decode($employee_data_json, true);

    if ($employee_data) {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Employee Health Record', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);

        foreach ($employee_data as $key => $value) {
            $label = str_replace('_', ' ', $key);
            $pdf->Cell(60, 6, $label . ':', 0, 0);
            $pdf->Cell(0, 6, $value, 0, 1);
        }

        $pdf_filename = 'employee_health_record_' . $employee_data['EmployeeNo'] . '.pdf';

        // Output the PDF to the browser with the correct headers for download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdf_filename . '"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        ini_set('zlib.output_compression', '0'); // Disable compression to avoid issues

        $pdf->Output();

        // Clean the output buffer and exit
        ob_end_flush();
        exit();
    } else {
        echo '<p class="error-message">Error: Could not decode employee data for PDF generation.</p>';
        ob_end_flush();
    }
} else {
    echo '<p class="error-message">Error: No employee data received for PDF generation.</p>';
}
?>