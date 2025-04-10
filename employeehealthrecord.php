<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Enter Employee Health Record Here</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
<head>
    <title>Employee Health Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 30px;
            background-color: #f4f7f6;
            color: #333;
            line-height: 1.6;
            background-image: linear-gradient(to bottom, #f0f4f8, #e0eaf5); /* Light background gradient */
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.08); /* Subtle text shadow */
        }

        form {
            width: 95%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); /* Slightly stronger shadow */
            background-image: linear-gradient(to bottom, #ffffff, #f8f8f8); /* Subtle form gradient */
        }

        fieldset {
            border: 1px solid #e0e0e0;
            margin-bottom: 25px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f8f8;
            background-image: linear-gradient(to bottom, #f8f8f8, #ffffff); /* Subtle fieldset gradient */
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #3498db;
            padding: 8px 15px;
            border: 1px solid #3498db;
            border-radius: 6px;
            background-color: #e0f7fa;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05); /* Small legend shadow */
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-row > div {
            width: 48%;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555; /* Slightly darker label color */
            font-weight: normal;
            font-size: 1.05em; /* Slightly larger label font */
            text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.3); /* Label text shadow */
        }

        input[type="text"],
        input[type="date"],
        select {
            width: calc(100% - 20px);
            padding: 12px;
            border: 1px solid #b0bec5; /* More muted border */
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Added box-shadow transition */
            background-color: #ffffff;
            color: #2c3e50;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.03); /* Subtle inset shadow */
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3), 0 2px 8px rgba(0, 0, 0, 0.1); /* Added focus shadow */
        }

        select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#7f8c8d" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 98%;
            background-position-y: 50%;
            padding-right: 30px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease; /* Added transform */
            display: block;
            width: 200px;
            margin: 25px auto 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Increased submit button shadow */
            background-image: linear-gradient(to bottom, #4CAF50, #388E3C); /* Darker green gradient */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Increased hover shadow */
            transform: translateY(-2px); /* Slight upward movement on hover */
        }

        .error {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
            text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.3);
        }

        .form-row > div:nth-child(odd) {
             padding-right: 10px;
        }
       .form-row > div:nth-child(even) {
            padding-left: 10px;
       }

        @media (max-width: 768px) {
            .form-row > div {
                width: 100%;
                padding: 0;
            }
             .form-row > div:nth-child(odd),
            .form-row > div:nth-child(even) {
                padding: 0;
            }
            form {
                width: 100%;
                padding: 15px;
            }
            input[type="submit"]{
               width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Employee Health Record</h1>
    <form action="process_add_record.php" method="post" >
        <fieldset>
            <legend>Personal Information</legend>
            <div class="form-row">
            <div><label>1. Employee No:</label> <input type="text" name="EmployeeNo" required></div>
            <div><label>2. Employee Name:</label> <input type="text" name="EmployeeName" required></div>
            <div><label>3. Date of Birth:</label> <input type="date" name="DateOfBirth" required></div>
            <div><label>4. Sex:</label><select name="Sex" required><option value="male">Male</option><option value="female">Female</option></select></div>
            <div><label>5. Identification Mark:</label> <input type="text" name="IdentificationMark" required></div>
            <div><label>6. Father's Name:</label> <input type="text" name="FathersName" required></div>
            <div><label>7. Marital Status:</label><select name="MaritalStatus" required><option value="married">Married</option><option value="unmarried">Unmarried</option></select></div>
            <div><label>8. Husband's Name:</label> <input type="text" name="HusbandsName" required></div>
            <div><label>9. Address:</label> <input type="text" name="Address" required></div>
            <div><label>10. Dependent:</label> <input type="text" name="Dependent" required></div>
            <div><label>11. Mobile:</label> <input type="text" name="Mobile" pattern="[0-9]{10}" title="Mobile number must be 10 digits." required></div>
            <div><label>12. Joining Date:</label> <input type="date" name="JoiningDate" required></div>
            <div><label>13. Date of Examination:</label> <input type="date" name="DateOfExamination" required></div>
            <div><label>14. Company:</label> <input type="text" name="Company" required></div>
            <div><label>15. Department:</label> <input type="text" name="Department" required></div>
            <div><label>16. Designation:</label> <input type="text" name="Designation" required></div>
            <div><label>17. H/O Habit:</label> <input type="text" name="H_OHabit" required></div>
            <div><label>18. Prev. Occ. History:</label> <input type="text" name="Prev_Occ_History" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Physical Examination</legend>
            <div class="form-row">
           <div><label>19. Temperature (F):</label> <input type="text" name="Temperature" required></div>
           <div><label>20. Height (cm):</label> <input type="text" name="Height" required></div>
            <div><label>21. Chest Before Breathing (cm):</label> <input type="text" name="ChestBeforeBreathing" required></div>
            <div><label>22. Pulse (per Minute):</label> <input type="text" name="Pulse" required></div>
            <div><label>23. Weight (kg):</label> <input type="text" name="Weight" required></div>
            <div><label>24. Chest After Breathing (cm):</label> <input type="text" name="ChestAfterBreathing" required></div>
            <div><label>25. BP (mmHg):</label> <input type="text" name="BP" required></div>
            <div><label>26. BMI:</label> <input type="text" name="BMI" required></div>
            <div><label>27. SpO2 (%):</label> <input type="text" name="SpO2" required></div>
            <div><label>28. Respiration Rate:</label> <input type="text" name="RespirationRate" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Vision</legend>
            <div class="form-row">
            <div><label>29. Right Eye Specs:</label> <input type="text" name="RightEyeSpecs" value="Normal" required></div>
            <div><label>30. Left Eye Specs:</label> <input type="text" name="LeftEyeSpecs" value="Normal" required></div>
            <div><label>31. Near Vision (Right):</label> <input type="text" name="NearVisionRight" value="N/6" required></div>
            <div><label>32. Near Vision (Left):</label> <input type="text" name="NearVisionLeft" value="N/6" required></div>
            <div><label>33. Distant Vision (Right):</label> <input type="text" name="DistantVisionRight" value="6/6" required></div>
            <div><label>34. Distant Vision (Left):</label> <input type="text" name="DistantVisionLeft" value="6/6" required></div>
            <div><label>35. Colour Vision:</label> <input type="text" name="ColourVision" value="Normal" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Local Examination</legend>
            <div class="form-row">
            <div><label>36. Eye:</label> <input type="text" name="Eye" value="Normal" required></div>
            <div><label>37. Nose:</label> <input type="text" name="Nose" value="Normal" required></div>
            <div><label>38. Conjunctiva:</label> <input type="text" name="Conjunctiva" value="Normal" required></div>
            <div><label>39. Ear:</label> <input type="text" name="Ear" value="Normal" required></div>
            <div><label>40. Tongue:</label> <input type="text" name="Tongue" value="Normal" required></div>
            <div><label>41. Nails:</label> <input type="text" name="Nails" value="Normal" required></div>
            <div><label>42. Throat:</label> <input type="text" name="Throat" value="Normal" required></div>
            <div><label>43. Skin:</label> <input type="text" name="Skin" value="Normal" required></div>
            <div><label>44. Teeth:</label> <input type="text" name="Teeth" value="Normal" required></div>
            <div><label>45. PEFR:</label> <input type="text" name="PEFR" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Skin & General</legend>
            <div class="form-row">
            <div><label>46. Eczema:</label> <input type="text" name="Eczema" value="No" required></div>
            <div><label>47. Cyanosis:</label> <input type="text" name="Cyanosis" value="No" required></div>
            <div><label>48. Jaundice:</label> <input type="text" name="Jaundice" value="No" required></div>
            <div><label>49. Anaemia:</label> <input type="text" name="Anaemia" value="No" required></div>
            <div><label>50. Oedema:</label> <input type="text" name="Oedema" value="No" required></div>
            <div><label>51. Clubbing:</label> <input type="text" name="Clubbing" value="No" required></div>
            <div><label>52. Allergy:</label> <input type="text" name="Allergy" value="No" required></div>
            <div><label>53. Lymphnode:</label> <input type="text" name="Lymphnode" value="No" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Medical History</legend>
            <div class="form-row">
            <div><label>54. Known Hypertension:</label> <input type="text" name="KnownHypertension" value="No" required></div>
            <div><label>55. Diabetes:</label> <input type="text" name="Diabetes" value="No" required></div>
            <div><label>56. Dyslipidemia:</label> <input type="text" name="Dyslipidemia" value="No" required></div>
            <div><label>57. Radiation Effect:</label> <input type="text" name="RadiationEffect" value="No" required></div>
            <div><label>58. Vertigo:</label> <input type="text" name="Vertigo" value="No" required></div>
            <div><label>59. Tuberculosis:</label> <input type="text" name="Tuberculosis" value="No" required></div>
            <div><label>60. Thyroid Disorder:</label> <input type="text" name="ThyroidDisorder" value="No" required></div>
            <div><label>61. Epilepsy:</label> <input type="text" name="Epilepsy" value="No" required></div>
            <div><label>62. Br. Asthma:</label> <input type="text" name="Br_Asthma" value="No" required></div>
            <div><label>63. Heart Disease:</label> <input type="text" name="HeartDisease" value="No" required></div>
            <div><label>64. Present Complain:</label> <input type="text" name="PresentComplain" value="No" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Family History</legend>
            <div class="form-row">
            <div><label>65. Father:</label> <input type="text" name="Father" value="NAD" required></div>
            <div><label>66. Mother:</label> <input type="text" name="Mother" value="NAD" required></div>
            <div><label>67. Brother:</label> <input type="text" name="Brother" value="NAD" required></div>
            <div><label>68. Sister:</label> <input type="text" name="Sister" value="NAD" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Systemic Examination</legend>
            <div class="form-row">
            <div><label>Respiration System:</label> <input type="text" name="RespirationSystem" value="Air Entry Bilateral Equal, No Creps/Rhonchi" required></div>
            <div><label>Genito Urinary:</label> <input type="text" name="GenitoUrinary" value="Normal" required></div>
            <div><label>CVS:</label> <input type="text" name="CVS" value="S1,S2-Normal,No Murmur" required></div>
            <div><label>CNS:</label> <input type="text" name="CNS" value="Normal" required></div>
            <div><label>Per Abdomen:</label> <input type="text" name="PerAbdomen" value="Soft Spleen,Liver, Not Palpable" required></div>
            <div><label>ENT:</label> <input type="text" name="ENT" value="NAD" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Investigation</legend>
            <div class="form-row">
            <div><label>PFT:</label> <input type="text" name="PFT" required></div>
            <div><label>X-ray Chest:</label> <input type="text" name="XRayChest" required></div>
            <div><label>Vertigo Test:</label> <input type="text" name="VertigoTest" required></div>
            <div><label>Audiometry:</label> <input type="text" name="Audiometry" required></div>
            <div><label>ECG:</label> <input type="text" name="ECG" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Laboratory Tests</legend>
            <div class="form-row">
            <div><label>HB:</label> <input type="text" name="HB" step="any" required></div>
            <div><label>WBC:</label> <input type="text" name="TC" required></div>
            <div><label>Paasite:</label> <input type="text" name="DC" required></div>
            <div><label>RBC:</label> <input type="text" name="RBC" step="any" required></div>
            <div><label>Platelet:</label> <input type="text" name="Platelet" required></div>
            <div><label>ESR:</label> <input type="text" name="ESR" required></div>
            <div><label>FBS:</label> <input type="text" name="FBS" step="any" required></div>
            <div><label>PP2BS:</label> <input type="text" name="PP2BS" step="any" required></div>
            <div><label>SGPT:</label> <input type="text" name="SGPT" required></div>
            <div><label>S. Creatintine:</label> <input type="text" name="SCreatintine" step="any" required></div>
            <div><label>RBS:</label> <input type="text" name="RBS" step="any" required></div>
            <div><label>S. Chol:</label> <input type="text" name="SChol" required></div>
            <div><label>S. TRG:</label> <input type="text" name="STRG" required></div>
            <div><label>S. HDL:</label> <input type="text" name="SHDL" required></div>
            <div><label>S. LDL:</label> <input type="text" name="SLDL" required></div>
            <div><label>C/H Ratio:</label> <input type="text" name="CHRatio" step="any" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Urine Report</legend>
            <div class="form-row">
            <div><label>Colour:</label> <input type="text" name="UrineColour" required></div>
            <div><label>Reaction:</label> <input type="text" name="UrineReaction" required></div>
            <div><label>Albumin:</label> <input type="text" name="UrineAlbumin" required></div>
            <div><label>Sugar:</label> <input type="text" name="UrineSugar" required></div>
            <div><label>Pus Cell:</label> <input type="text" name="UrinePusCell" required></div>
            <div><label>RBC:</label> <input type="text" name="UrineRBC" required></div>
            <div><label>Epi Cell:</label> <input type="text" name="UrineEpiCell" required></div>
            <div><label>Crystal:</label> <input type="text" name="UrineCrystal" required></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Doctor's Information</legend>
            <div class="form-row">
                <div><label>Health Status:</label> <input type="text" name="HealthStatus" required></div>
                <div><label>Name of Doctor:</label> <input type="text" name="NameOfDoctor" required></div>
                <div><label>Doctor Signature:</label> <input type="text" name="DoctorSignature"></div>
                <div><label>Job Restriction (if any):</label> <input type="text" name="JobRestriction" required></div>
                <div><label>Reviewed By:</label> <input type="text" name="ReviewedBy" required></div>
                <div></div>
                <div><label>Doctor's Remarks :</label> <input type="text" name="DoctorsRemarks" required></div>
            </div>
        </fieldset>

        <input type="submit" value="Submit">
        
    </form>
</body>

</html>
