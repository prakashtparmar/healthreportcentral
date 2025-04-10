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
                $this->SetFont('Arial', 'B', 14);
                // Title
                $this->Cell(0, 10, 'Divit Hospital', 0, 1, 'C');
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, 'Medical Check-up Report', 0, 1, 'C');
                // Line break
                $this->Ln(5);
            }

            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-20);
                // Arial italic 8
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Note : Age & Date Of Joining is as Declared by a person, it can not be produced as a proof of age and date of joining.', 0, 1,'C');
                
                // Page number
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


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 6, 'Employee Information', 1, 1);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetLineWidth(0.2);


        $pdf->SetLineWidth(0.2);
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());

        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Employee No:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['EmployeeNo']) ? $employee_data['EmployeeNo'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Date of Examination:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['DateOfExamination']) ? $employee_data['DateOfExamination'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Name of Employee:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['EmployeeName']) ? $employee_data['EmployeeName'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Father\'s Name:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['FathersName']) ? $employee_data['FathersName'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Date Of Birth / Age::', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['DateOfBirth']) ? $employee_data['DateOfBirth'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Address:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Address']) ? $employee_data['Address'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Designation:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Designation']) ? $employee_data['Designation'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Husband\'s Name:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['HusbandsName']) ? $employee_data['HusbandsName'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Department:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, (isset($employee_data['Department']) ? $employee_data['Department'] : '') . ' / ' . (isset($employee_data['Age']) ? $employee_data['Age'] : ''), 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Marital Status:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['MaritalStatus']) ? $employee_data['MaritalStatus'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Joining Date:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['JoiningDate']) ? $employee_data['JoiningDate'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Dependents:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Dependent']) ? $employee_data['Dependent'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Identification Mark:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['IdentificationMark']) ? $employee_data['IdentificationMark'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'H/O Habit:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['H_OHabit']) ? $employee_data['H_OHabit'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Company:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Company']) ? $employee_data['Company'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Mobile Number:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Mobile']) ? $employee_data['Mobile'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Prev. Occ. History:', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Prev_Occ_History']) ? $employee_data['Prev_Occ_History'] : '', 0, 1);
        $pdf->Ln(2);
        
        //$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
        
        
        // --- Physical Examination ---
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 6, 'Physical Examination', 1, 1);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetLineWidth(0.2);
       
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
        $pdf->Ln(2);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Temperature :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Temperature']) ? $employee_data['Temperature'] . ' F' : 'F', 0, 0);
        

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Height :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Height']) ? $employee_data['Height'] . ' cm' : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'ChestBeforeBreathing :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['ChestBeforeBreathing']) ? $employee_data['ChestBeforeBreathing'] . ' cm' : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Pulse :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Pulse']) ? $employee_data['Pulse'] . ' Per Minute' : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Weight :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Weight']) ? $employee_data['Weight'] . ' Kg': '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Chest Before Breathing : ', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['ChestBeforeBreathing']) ? $employee_data['ChestBeforeBreathing'] . ' cm' : '', 0, 1);


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'BP :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['BP']) ? $employee_data['BP'] . '/66 mmHg' : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'BMI :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['BMI']) ? $employee_data['BMI'] : '22.8', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'SpO2 :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['SpO2']) ? $employee_data['SpO2'] . '%' : '99', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Respiration Rate :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['RespirationRate']) ? $employee_data['RespirationRate'] : '18', 0, 1);

        $pdf->Ln(2);
        //$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
        //$pdf->Ln(2);

        



// --- Vision ---
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(0, 6, 'Vision ', 1, 1);

$pdf->SetFont('Arial', '', 9);



// Table Header
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 7, '', 1, 0, 'C');
$pdf->Cell(70, 7, 'Right Eye', 1, 0, 'C');
$pdf->Cell(70, 7, 'Left Eye', 1, 1, 'C'); // Move to the next row

$pdf->SetFont('Arial', '', 9);

// Row 1: Specs
$pdf->Cell(40, 7, 'Specs :', 1, 0, 'L');
$pdf->Cell(70, 7, isset($employee_data['RightEyeSpecs']) ? $employee_data['RightEyeSpecs'] : '', 1, 0, 'C');
$pdf->Cell(70, 7, isset($employee_data['LeftEyeSpecs']) ? $employee_data['LeftEyeSpecs'] : '', 1, 1, 'C'); // Move to the next row

// Row 2: Near Vision
$pdf->Cell(40, 7, 'Near Vision', 1, 0, 'L');
$pdf->Cell(70, 7, isset($employee_data['NearVisionRight']) ? $employee_data['NearVisionRight'] : '', 1, 0, 'C');
$pdf->Cell(70, 7, isset($employee_data['NearVisionLeft']) ? $employee_data['NearVisionLeft'] : '', 1, 1, 'C'); // Move to the next row

// Row 3: Distant Vision
$pdf->Cell(40, 7, 'Distant Vision', 1, 0, 'L');
$pdf->Cell(70, 7, isset($employee_data['DistantVisionRight']) ? $employee_data['DistantVisionRight'] : '', 1, 0, 'C');
$pdf->Cell(70, 7, isset($employee_data['DistantVisionLeft']) ? $employee_data['DistantVisionLeft'] : '', 1, 1, 'C'); // Move to the next row

// Row 4: Colour Vision
$pdf->Cell(40, 7, 'Colour Vision', 1, 0, 'L');
$pdf->Cell(70, 7, isset($employee_data['ColourVision']) ? $employee_data['ColourVision'] : '', 'LTB', 0, 'R');
$pdf->Cell(70, 7, isset($employee_data['']) ? $employee_data[''] : '', 'RB', 1, 'C'); // Move to the next row

$pdf->Ln(2);


// --- Local Examination ---
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Local Examination', 1, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->SetLineWidth(0.2);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Eye :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Eye']) ? $employee_data['Eye'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Nose :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Nose']) ? $employee_data['Nose'] : '', 0, 0); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Ear :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Ear']) ? $employee_data['Ear'] : '', 0, 1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Conjunctiva :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Conjunctiva']) ? $employee_data['Conjunctiva'] : '', 0, 0); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Tongue :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Tongue']) ? $employee_data['Tongue'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Nails :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Nails']) ? $employee_data['Nails'] : '', 0, 1); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Throat :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Throat']) ? $employee_data['Throat'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Skin :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Skin']) ? $employee_data['Skin'] : '', 0, 0); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Teeth :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Teeth']) ? $employee_data['Teeth'] : '', 0, 1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'PEFR :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['PEFR']) ? $employee_data['PEFR'] : '', 0, 0); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Eczema :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Eczema']) ? $employee_data['Eczema'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Cyanosis :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Cyanosis']) ? $employee_data['Cyanosis'] : '', 0, 1); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Jaundice :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Jaundice']) ? $employee_data['Jaundice'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Anaemia :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Anaemia']) ? $employee_data['Anaemia'] : '', 0, 0); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Oedema :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Oedema']) ? $employee_data['Oedema'] : '', 0, 1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Clubbing :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Clubbing']) ? $employee_data['Clubbing'] : '', 0, 0); // Move to next line

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Allergy :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Allergy']) ? $employee_data['Allergy'] : '', 0, 0); // Move to next line

$pdf->Ln(2);
//$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());


$pdf->Ln(2);
// --- Medical History Examination ---
$pdf->Ln(2);        
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Medical History Examination', 1, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->SetLineWidth(0.2);

$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Ln(2);




$pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Hypertension :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['KnownHypertension']) ? $employee_data['KnownHypertension'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Diabetes :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Diabetes']) ? $employee_data['Diabetes'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Dyslipidemia :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Dyslipidemia']) ? $employee_data['Dyslipidemia'] : '', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'RadiationEffect :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['RadiationEffect']) ? $employee_data['RadiationEffect'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Vertigo :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Vertigo']) ? $employee_data['Vertigo'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Tuberculosis : ', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Tuberculosis']) ? $employee_data['Tuberculosis'] : '', 0, 1);


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'ThyroidDisorder :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['ThyroidDisorder']) ? $employee_data['ThyroidDisorder'] : '', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(30, 5, 'Epilepsy :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(30, 5, isset($employee_data['Epilepsy']) ? $employee_data['Epilepsy'] : '22.8', 0, 0);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'Br_Asthma :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['Br_Asthma']) ? $employee_data['Br_Asthma'] : '99', 0, 1);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(40, 5, 'HeartDisease :', 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40, 5, isset($employee_data['HeartDisease']) ? $employee_data['HeartDisease'] : '18', 0, 1);


$pdf->Ln(2);





// --- Systemic Examination ---
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Systemic Examination', 1, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->SetLineWidth(0.2);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'Respiration System :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 5, isset($employee_data['RespirationRate']) ? $employee_data['RespirationRate'] : '18', 0, 0); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'Genito Urinary :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['GenitoUrinary']) ? $employee_data['GenitoUrinary'] : '18', 0, 1); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'CVS :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 5, isset($employee_data['CVS']) ? $employee_data['CVS'] : '18', 0, 0); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'CNS :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 5, isset($employee_data['CNS']) ? $employee_data['CNS'] : '18', 0, 1); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'PerAbdomen :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 5, isset($employee_data['PerAbdomen']) ? $employee_data['PerAbdomen'] : '18', 0, 0); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'ENT :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['ENT']) ? $employee_data['ENT'] : '18', 0, 1); // Data not available
$pdf->Ln(2);



// --- Investigation ---
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Investigation', 1, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->SetLineWidth(0.2);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'PFT :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['PFT']) ? $employee_data['PFT'] : '18', 0, 0); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'X-Ray Chest :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['XRayChest']) ? $employee_data['XRayChest'] : '18', 0, 0); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'VertigoTest :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['VertigoTest']) ? $employee_data['VertigoTest'] : '18', 0, 1); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'Audiometry :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['Audiometry']) ? $employee_data['Audiometry'] : '18', 0, 0); // Data not available

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 5, 'ECG :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(25, 5, isset($employee_data['ECG']) ? $employee_data['ECG'] : '18', 0, 0); // Data not available

$pdf->Ln(6);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());


 // --- Laboratory Tests ---
 $pdf->SetFont('Arial', 'B', 10);
 $pdf->Cell(0, 6, 'Laboratory Tests', 1, 1, 'C'); // Centered title
 $pdf->SetFont('Arial', '', 9);
 $pdf->SetLineWidth(0.2);
 $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
 $pdf->Ln(2);

 // Table formatting (3 columns)
 $cellWidthLabel = 30; // Width for the label column
 $cellWidthValue = 30; // Width for the value column
 $rowHeight = 5;

 // Row 1
 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'HB :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['HB']) ? $employee_data['HB'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'WBC :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['TC']) ? $employee_data['TC'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'Paasite :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['DC']) ? $employee_data['DC'] : '', 0, 1); // End of row

 // Row 2
 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'RBC :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['RBC']) ? $employee_data['RBC'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'Platelet :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['Platelet']) ? $employee_data['Platelet'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'S. ESR :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['ESR']) ? $employee_data['ESR'] : '', 0, 1); // End of row

 // Row 3
 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'FBS :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['FBS']) ? $employee_data['FBS'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'PP2BS :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['PP2BS']) ? $employee_data['PP2BS'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'SGPT :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['SGPT']) ? $employee_data['SGPT'] : '', 0, 1); // End of row

 // Row 4
 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'S. Creatintine :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['SCreatintine']) ? $employee_data['SCreatintine'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'RBS :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['RBS']) ? $employee_data['RBS'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'S. Chol :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['SChol']) ? $employee_data['SChol'] : '', 0, 1); // End of row

 // Row 5
 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'S. TRG :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['STRG']) ? $employee_data['STRG'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'S. HDL :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['SHDL']) ? $employee_data['SHDL'] : '', 0, 0);

 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'S. LDL :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['SLDL']) ? $employee_data['SLDL'] : '', 0, 1); // End of row

 // Row 6 (Optional - if you want to include C/H Ratio in the table)
 $pdf->SetFont('Arial', 'B', 9);
 $pdf->Cell($cellWidthLabel, $rowHeight, 'C/H Ratio :', 0, 0);
 $pdf->SetFont('Arial', '', 9);
 $pdf->Cell($cellWidthValue, $rowHeight, isset($employee_data['CHRatio']) ? $employee_data['CHRatio'] : '', 0, 1); // End of row

 $pdf->Ln(2);


// --- Urine Report ---
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Urine Report', 1, 1, 'C'); // Centered title
$pdf->SetFont('Arial', '', 9);
$pdf->SetLineWidth(0.2);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Ln(2);

// Table formatting
$cellWidth = 45; // Approximate width for each cell in a 4-column layout

// Row 1
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'Colour :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineColour']) ? $employee_data['UrineColour'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'Reaction :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineReaction']) ? $employee_data['UrineReaction'] : '', 0, 1); // End of row

// Row 2
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'Albumin :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineAlbumin']) ? $employee_data['UrineAlbumin'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'Sugar :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineSugar']) ? $employee_data['UrineSugar'] : '', 0, 1); // End of row

// Row 3
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'PusCell :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrinePusCell']) ? $employee_data['UrinePusCell'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'UrineRBC :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineRBC']) ? $employee_data['UrineRBC'] : '', 0, 1); // End of row

// Row 4
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'EpiCell :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineEpiCell']) ? $employee_data['UrineEpiCell'] : '', 0, 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell($cellWidth, 5, 'Crystal :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell($cellWidth, 5, isset($employee_data['UrineCrystal']) ? $employee_data['UrineCrystal'] : '', 0, 1); // End of row

$pdf->Ln(3);

    $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 5, 'Health Status :', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(60, 5, isset($employee_data['HealthStatus']) ? $employee_data['HealthStatus'] : '', 0, 1); // Changed '18' to '' and added line break
    $pdf->Ln(3);

    // --- Doctor Information ---
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 5, 'Doctor Name :', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(25, 5, isset($employee_data['NameOfDoctor']) ? $employee_data['NameOfDoctor'] : '', 0, 1); // Changed $doctor to $employee and added line break
    $pdf->Ln(3);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 5, 'Doctor Signature :', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(60, 5, isset($employee_data['DoctorSignature']) ? $employee_data['DoctorSignature'] : '', 0, 0); // Changed $doctor to $employee

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 5, 'Seal of Doctor :', 0, 0);
    

    $pdf->Ln(8);

    //$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
    $pdf->Ln(6);


// --- Job Restriction ---
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 5, 'Job Restriction (if any) :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 5, isset($employee_data['JobRestriction']) ? $employee_data['JobRestriction'] : '', 0, 1);
$pdf->Ln(3);


// --- Doctor Remarks ---
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 5, 'Doctor Remarks :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 5, isset($employee_data['DoctorsRemarks']) ? $employee_data['DoctorsRemarks'] : '', 0, 1); // Changed $doctor to $employee
$pdf->Ln(3);


// --- Reviewed By ---
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 5, 'Reviewed By :', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 5, isset($employee_data['ReviewedBy']) ? $employee_data['ReviewedBy'] : '', 0, 1); // Changed $doctor to $employee
$pdf->Ln(3);


$pdf->Ln(6);
//$pdf->SetFont('Arial', '', 9);
//$pdf->Cell(40, 5, 'Age & Date Of Joining is as Declared by a person, it can not be produced as a proof of age and date of joining.', 0, 0);





// --- Testing Code Below ---




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
