

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
        class PDF extends FPDF
        {
            function Header()
            {
                // Arial bold 14
                $this->SetFont('Arial', 'B', 12);
                // Title
                $this->Cell(0, 10, 'FORM NO. 32', 0, 1, 'C');
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, '(Prescribed under Rule 68-T and 102)', 0, 1, 'C');
                // Line break
                $this->Ln(5);
                $this->SetFont('Arial', 'B', 11);
                $this->Cell(0, 5, 'Health Register', 0, 1, 'C');
        
            }

            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-20);
                // Arial italic 8
                $this->SetFont('Arial', 'I', 8);
                // Page number
                $this->Cell(0, 10, 'Note : Age & Date Of Joining is as Declared by a person, it can not be produced as a proof of age and date of joining.', 0, 1,'C');
                $this->Cell(0, 10, 'Page ' . $this->PageNo() . '', 0, 0, 'C');
            }

            function FancyTable($header, $data)
            {
                // Colors, line width and bold font
                $this->SetFillColor(245, 245, 245); // Light gray fill
                $this->SetTextColor(0);
                $this->SetLineWidth(0.3);
                $this->SetFont('Arial', 'B', 9);

                // Header
                $w = array(40, 40, 40, 40); // Increased width of columns
                for ($i = 0; $i < count($header); $i++)
                    $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
                $this->Ln();
                // Color and font restoration
                $this->SetFillColor(255);
                $this->SetTextColor(0);
                $this->SetFont('Arial', '', 9);
                // Data
                $fill = 0;
                foreach ($data as $row) {
                    $this->Cell($w[0], 6, $row['label'], 1, 0, 'L', $fill);
                    $this->Cell($w[1], 6, $row['value1'], 1, 0, 'L', $fill);
                    $this->Cell($w[2], 6, $row['value2'], 1, 0, 'L', $fill);
                    $this->Cell($w[3], 6, $row['value3'], 1, 0, 'L', $fill);
                    $this->Ln();
                    $fill = !$fill;
                }
                // Closing line
                $this->Cell(array_sum($w), 0, '', 'T');
            }
            function ImprovedTable($header, $data)
            {
                // Column widths
                $w = array(60, 120);
                // Header
                for ($i = 0; $i < count($header); $i++)
                    $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
                $this->Ln();
                // Data
                foreach ($data as $row) {
                    $this->Cell($w[0], 6, $row['label'], 1);
                    $this->Cell($w[1], 6, $row['value'], 1);
                    $this->Ln();
                }
            }
        }


        
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->SetMargins(15, 15, 15);
        $pdf->AddPage();


       
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(80, 5, '1. Serial number in the register of adult workers:', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, isset($employee_data['EmployeeNo']) ? $employee_data['EmployeeNo'] : '', 0, 1); // '1' moves to the next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(80, 5, '2. Name of Worker:', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, isset($employee_data['EmployeeName']) ? $employee_data['EmployeeName'] : '', 0, 1); // '1' moves to the next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(80, 5, '3. Sex:', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, isset($employee_data['Sex']) ? $employee_data['Sex'] : '', 0, 1); // '1' moves to the next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(80, 5, '4. Date Of Birth / Age::', 0, 0); // '1' moves to the next line
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 5, isset($employee_data['DateOfBirth']) ? $employee_data['DateOfBirth'] : '', 0, 1); // '1' moves to the next line


$pdf->Ln(5);





// Text cell
$pdf->Cell(15, 7, 'i examined', 'LTR', 0, 'L');

// Get the current x and y coordinates after the cell
$x = $pdf->GetX();
$y = $pdf->GetY();

// Calculate the starting and ending points for the vertical line
$x_line = $x; // Same x-coordinate as the right edge of the cell
$y_start = $y - 7; // Top of the cell
$y_end = $y;     // Bottom of the cell

// Set the line color (optional)
$pdf->SetDrawColor(0, 0, 0); // Black color

// Draw the vertical line
$pdf->Line($x_line, $y_start, $x_line, $y_end);

// Move the cursor to the next position after the cell and the line
$pdf->SetX($x); // Keep the x-coordinate for potential subsequent elements

// Example of adding more content after
$pdf->Cell(10, 7, '', 0, 1);



// Table Header
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 7, 'i examined', 'LTR', 0, 'L');
$pdf->Cell(15, 7, 'i examined', 'LTR', 0, 'L');
$pdf->Cell(15, 7, 'i examined', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 1, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(15, 7, '', 'LTR' , 0, 'L');
$pdf->Cell(10, 7, '', 'LTR' , 0, 'L');


$pdf->Cell(40, 7, 'i examined the person', 'LR' , 0, 'L');
$pdf->Cell(60, 7, 'certificate is not extended the, period', 'LR' , 0, 'L');
$pdf->Cell(40, 7, 'observed during', 'LR' , 0, 'L');
$pdf->Cell(40, 7, 'Factory Medical Officer', 'LR' , 1, 'L');


$pdf->Cell(40, 7, 'mentioned abouve on', 'LR' , 0, 'L');
$pdf->Cell(60, 7, 'for which the worker is considered', 'LR' , 0, 'L');
$pdf->Cell(40, 7, 'examination', 'LR', 0, 'L');
$pdf->Cell(40, 7, 'with date', 'LR', 1, 'L');


$pdf->Cell(40, 7, '', 'LBR', 0, 'L');
$pdf->Cell(60, 7, 'unfit for work is to be mentioned', 'LRB' , 0, 'L');
$pdf->Cell(40, 7, '', 'LRB' , 0, 'L');
$pdf->Cell(40, 7, '', 'LRB' , 1, 'L');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(40, 7, isset($employee_data['DateOfExamination']) ? $employee_data['DateOfExamination'] : '', '1', 0, 'L'); // Changed $doctor to $employee and added line break
$pdf->Cell(60, 7, isset($employee_data['DateOfExamination']) ? $employee_data['DateOfExamination'] : '', '1', 0, 'L'); // Changed $doctor to $employee and added line break
$pdf->Cell(40, 7, isset($employee_data['DateOfExamination']) ? $employee_data['DateOfExamination'] : '', '1', 0, 'L'); // Changed $doctor to $employee and added line break
$pdf->Cell(40, 7, isset($employee_data['NameOfDoctor']) ? $employee_data['NameOfDoctor'] : '', '1', 1, 'L'); // Changed $doctor to $employee and added line break





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
