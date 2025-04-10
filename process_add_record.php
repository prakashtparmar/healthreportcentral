<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $EmployeeNo = $conn->real_escape_string($_POST['EmployeeNo']);
        $EmployeeName = $conn->real_escape_string($_POST['EmployeeName']);
        $DateOfBirth = $conn->real_escape_string($_POST['DateOfBirth']);
        $Sex = $conn->real_escape_string($_POST['Sex']);
        $IdentificationMark = $conn->real_escape_string($_POST['IdentificationMark']);
        $FathersName = $conn->real_escape_string($_POST['FathersName']);
        $MaritalStatus = $conn->real_escape_string($_POST['MaritalStatus']);
        $HusbandsName = $conn->real_escape_string($_POST['HusbandsName']);
        $Address = $conn->real_escape_string($_POST['Address']);
        $Dependent = $conn->real_escape_string($_POST['Dependent']);
        $Mobile = $conn->real_escape_string($_POST['Mobile']);
        $JoiningDate = $conn->real_escape_string($_POST['JoiningDate']);
        $DateOfExamination = $conn->real_escape_string($_POST['DateOfExamination']);
        $Company = $conn->real_escape_string($_POST['Company']);
        $Department = $conn->real_escape_string($_POST['Department']);
        $Designation = $conn->real_escape_string($_POST['Designation']);
        $H_OHabit = $conn->real_escape_string($_POST['H_OHabit']);
        $Prev_Occ_History = $conn->real_escape_string($_POST['Prev_Occ_History']);
        $Temperature = $conn->real_escape_string($_POST['Temperature']);
        $Height = $conn->real_escape_string($_POST['Height']);
        $ChestBeforeBreathing = $conn->real_escape_string($_POST['ChestBeforeBreathing']);
        $Pulse = $conn->real_escape_string($_POST['Pulse']);
        $Weight = $conn->real_escape_string($_POST['Weight']);
        $ChestAfterBreathing = $conn->real_escape_string($_POST['ChestAfterBreathing']);
        $BP = $conn->real_escape_string($_POST['BP']);
        $BMI = $conn->real_escape_string($_POST['BMI']);
        $SpO2 = $conn->real_escape_string($_POST['SpO2']);
        $RespirationRate = $conn->real_escape_string($_POST['RespirationRate']);
        $RightEyeSpecs = $conn->real_escape_string($_POST['RightEyeSpecs']);
        $LeftEyeSpecs = $conn->real_escape_string($_POST['LeftEyeSpecs']);
        $NearVisionRight = $conn->real_escape_string($_POST['NearVisionRight']);
        $NearVisionLeft = $conn->real_escape_string($_POST['NearVisionLeft']);
        $DistantVisionRight = $conn->real_escape_string($_POST['DistantVisionRight']);
        $DistantVisionLeft = $conn->real_escape_string($_POST['DistantVisionLeft']);
        $ColourVision = $conn->real_escape_string($_POST['ColourVision']);
        $Eye = $conn->real_escape_string($_POST['Eye']);
        $Nose = $conn->real_escape_string($_POST['Nose']);
        $Conjunctiva = $conn->real_escape_string($_POST['Conjunctiva']);
        $Ear = $conn->real_escape_string($_POST['Ear']);
        $Tongue = $conn->real_escape_string($_POST['Tongue']);
        $Nails = $conn->real_escape_string($_POST['Nails']);
        $Throat = $conn->real_escape_string($_POST['Throat']);
        $Skin = $conn->real_escape_string($_POST['Skin']);
        $Teeth = $conn->real_escape_string($_POST['Teeth']);
        $PEFR = $conn->real_escape_string($_POST['PEFR']);
        $Eczema = $conn->real_escape_string($_POST['Eczema']);
        $Cyanosis = $conn->real_escape_string($_POST['Cyanosis']);
        $Jaundice = $conn->real_escape_string($_POST['Jaundice']);
        $Anaemia = $conn->real_escape_string($_POST['Anaemia']);
        $Oedema = $conn->real_escape_string($_POST['Oedema']);
        $Clubbing = $conn->real_escape_string($_POST['Clubbing']);
        $Allergy = $conn->real_escape_string($_POST['Allergy']);
        $Lymphnode = $conn->real_escape_string($_POST['Lymphnode']);
        $KnownHypertension = $conn->real_escape_string($_POST['KnownHypertension']);
        $Diabetes = $conn->real_escape_string($_POST['Diabetes']);
        $Dyslipidemia = $conn->real_escape_string($_POST['Dyslipidemia']);
        $RadiationEffect = $conn->real_escape_string($_POST['RadiationEffect']);
        $Vertigo = $conn->real_escape_string($_POST['Vertigo']);
        $Tuberculosis = $conn->real_escape_string($_POST['Tuberculosis']);
        $ThyroidDisorder = $conn->real_escape_string($_POST['ThyroidDisorder']);
        $Epilepsy = $conn->real_escape_string($_POST['Epilepsy']);
        $Br_Asthma = $conn->real_escape_string($_POST['Br_Asthma']);
        $HeartDisease = $conn->real_escape_string($_POST['HeartDisease']);
        $PresentComplain = $conn->real_escape_string($_POST['PresentComplain']);
        $Father = $conn->real_escape_string($_POST['Father']);
        $Mother = $conn->real_escape_string($_POST['Mother']);
        $Brother = $conn->real_escape_string($_POST['Brother']);
        $Sister = $conn->real_escape_string($_POST['Sister']);
        $RespirationSystem = $conn->real_escape_string($_POST['RespirationSystem']);
        $GenitoUrinary = $conn->real_escape_string($_POST['GenitoUrinary']);
        $CVS = $conn->real_escape_string($_POST['CVS']);
        $CNS = $conn->real_escape_string($_POST['CNS']);
        $PerAbdomen = $conn->real_escape_string($_POST['PerAbdomen']);
        $ENT = $conn->real_escape_string($_POST['ENT']);
        $PFT = $conn->real_escape_string($_POST['PFT']);
        $XRayChest = $conn->real_escape_string($_POST['XRayChest']);
        $VertigoTest = $conn->real_escape_string($_POST['VertigoTest']);
        $Audiometry = $conn->real_escape_string($_POST['Audiometry']);
        $ECG = $conn->real_escape_string($_POST['ECG']);
        $HB = $conn->real_escape_string($_POST['HB']);
        $TC = $conn->real_escape_string($_POST['TC']);
        $DC = $conn->real_escape_string($_POST['DC']);
        $RBC = $conn->real_escape_string($_POST['RBC']);
        $Platelet = $conn->real_escape_string($_POST['Platelet']);
        $ESR = $conn->real_escape_string($_POST['ESR']);
        $FBS = $conn->real_escape_string($_POST['FBS']);
        $PP2BS = $conn->real_escape_string($_POST['PP2BS']);
        $SGPT = $conn->real_escape_string($_POST['SGPT']);
        $SCreatintine = $conn->real_escape_string($_POST['SCreatintine']);
        $RBS = $conn->real_escape_string($_POST['RBS']);
        $SChol = $conn->real_escape_string($_POST['SChol']);
        $STRG = $conn->real_escape_string($_POST['STRG']);
        $SHDL = $conn->real_escape_string($_POST['SHDL']);
        $SLDL = $conn->real_escape_string($_POST['SLDL']);
        $CHRatio = $conn->real_escape_string($_POST['CHRatio']);
        $UrineColour = $conn->real_escape_string($_POST['UrineColour']);
        $UrineReaction = $conn->real_escape_string($_POST['UrineReaction']);
        $UrineAlbumin = $conn->real_escape_string($_POST['UrineAlbumin']);
        $UrineSugar = $conn->real_escape_string($_POST['UrineSugar']);
        $UrinePusCell = $conn->real_escape_string($_POST['UrinePusCell']);
        $UrineRBC = $conn->real_escape_string($_POST['UrineRBC']);
        $UrineEpiCell = $conn->real_escape_string($_POST['UrineEpiCell']);
        $UrineCrystal = $conn->real_escape_string($_POST['UrineCrystal']);
        $HealthStatus = $conn->real_escape_string($_POST['HealthStatus']);
        $NameOfDoctor = $conn->real_escape_string($_POST['NameOfDoctor']);
        $DoctorSignature = $conn->real_escape_string($_POST['DoctorSignature']);
        $JobRestriction = $conn->real_escape_string($_POST['JobRestriction']);
        $ReviewedBy = $conn->real_escape_string($_POST['ReviewedBy']);
        $DoctorsRemarks = $conn->real_escape_string($_POST['DoctorsRemarks']);

        
        $sql = "INSERT INTO employeehealthrecord (
            EmployeeNo, EmployeeName, DateOfBirth, Sex, IdentificationMark, FathersName, 
            MaritalStatus, HusbandsName, Address, Dependent, Mobile, JoiningDate, DateOfExamination, 
            Company, Department, Designation, H_OHabit, Prev_Occ_History, Temperature, Height, 
            ChestBeforeBreathing, Pulse, Weight, ChestAfterBreathing, BP, BMI, SpO2, RespirationRate, 
            RightEyeSpecs, LeftEyeSpecs, NearVisionRight, NearVisionLeft, DistantVisionRight, DistantVisionLeft, 
            ColourVision, Eye, Nose, Conjunctiva, Ear, Tongue, Nails, Throat, Skin, Teeth, PEFR, Eczema, Cyanosis, 
            Jaundice, Anaemia, Oedema, Clubbing, Allergy, Lymphnode, KnownHypertension, Diabetes, Dyslipidemia, 
            RadiationEffect, Vertigo, Tuberculosis, ThyroidDisorder, Epilepsy, Br_Asthma, HeartDisease, PresentComplain, 
            Father, Mother, Brother, Sister, RespirationSystem, GenitoUrinary, CVS, CNS, PerAbdomen, ENT, PFT, XRayChest, 
            VertigoTest, Audiometry, ECG, HB, TC, DC, RBC, Platelet, ESR, FBS, PP2BS, SGPT, SCreatintine, RBS, SChol, 
            STRG, SHDL, SLDL, CHRatio, UrineColour, UrineReaction, UrineAlbumin, UrineSugar, UrinePusCell, UrineRBC, 
            UrineEpiCell, UrineCrystal, HealthStatus, NameOfDoctor, DoctorSignature, JobRestriction, ReviewedBy, DoctorsRemarks)
         VALUES (
            '$EmployeeNo', '$EmployeeName', '$DateOfBirth', '$Sex', '$IdentificationMark', '$FathersName', 
            '$MaritalStatus', '$HusbandsName', '$Address', '$Dependent', '$Mobile', '$JoiningDate', '$DateOfExamination', 
            '$Company', '$Department', '$Designation', '$H_OHabit', '$Prev_Occ_History', '$Temperature', '$Height', 
            '$ChestBeforeBreathing', '$Pulse', '$Weight', '$ChestAfterBreathing', '$BP', '$BMI', '$SpO2', '$RespirationRate', 
            '$RightEyeSpecs', '$LeftEyeSpecs', '$NearVisionRight', '$NearVisionLeft', '$DistantVisionRight', '$DistantVisionLeft', 
            '$ColourVision', '$Eye', '$Nose', '$Conjunctiva', '$Ear', '$Tongue', '$Nails', '$Throat', '$Skin', '$Teeth', '$PEFR', '$Eczema', '$Cyanosis', 
            '$Jaundice', '$Anaemia', '$Oedema', '$Clubbing', '$Allergy', '$Lymphnode', '$KnownHypertension', '$Diabetes', '$Dyslipidemia', 
            '$RadiationEffect', '$Vertigo', '$Tuberculosis', '$ThyroidDisorder', '$Epilepsy', '$Br_Asthma', '$HeartDisease', '$PresentComplain', 
            '$Father', '$Mother', '$Brother', '$Sister', '$RespirationSystem', '$GenitoUrinary', '$CVS', '$CNS', '$PerAbdomen', '$ENT', '$PFT', '$XRayChest', 
            '$VertigoTest', '$Audiometry', '$ECG', '$HB', '$TC', '$DC', '$RBC', '$Platelet', '$ESR', '$FBS', '$PP2BS', '$SGPT', '$SCreatintine', '$RBS', '$SChol', 
            '$STRG', '$SHDL', '$SLDL', '$CHRatio', '$UrineColour', '$UrineReaction', '$UrineAlbumin', '$UrineSugar', '$UrinePusCell', '$UrineRBC', 
            '$UrineEpiCell', '$UrineCrystal', '$HealthStatus', '$NameOfDoctor', '$DoctorSignature', '$JobRestriction', '$ReviewedBy', '$DoctorsRemarks'
        )";
    
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Employee Health Record Added Successfully</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <p><a href="employeehealthrecord.php">Go Back To Add Employee Health Record Page</a></p>
    </div>
</body>
</html>