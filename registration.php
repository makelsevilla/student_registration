<?php require_once './config/database.php'?>
<?php

  // get options value for the form
  $schools = mysqli_fetch_all(mysqli_query($conn, 'SELECT id, name FROM schools ORDER BY name'), MYSQLI_ASSOC);
  $programs = mysqli_fetch_all(mysqli_query($conn, 'SELECT id, name FROM programs ORDER BY name'), MYSQLI_ASSOC);

  /* Global Variables */
  // Basic Information
  $schoolId = $studentNo = $programId = $lastName = $firstName = $middleName = $birthDate = $gender = $barangay = $municipality = $province = $contactNo = $email = '';
  // Supporting Documents
  $schoolRegForm = $schoolId = $proofOfRes = $birthCert = '';

  // Error Variables
  $schoolIdErr = $studentNoErr = $programIdErr = $lastNameErr = $firstNameErr = $middleNameErr = $birthDateErr = $genderErr = $barangayErr = $municipalityErr = $provinceErr = $contactNoErr = $emailErr = '';
  $schoolRegFormErr = $schoolIdErr = $proofOfResErr = $birthCertErr = '';

  // Handle Registration
  if (isset($_POST['register'])) {
    // Assign and sanitize variables value from $_POST
    $schoolId = sanitizeInput($_POST['schoolId']);
    $studentNo = sanitizeInput($_POST['studentNo']);
    $programId = sanitizeInput($_POST['programId']);
    $lastName = sanitizeInput($_POST['lastName']);
    $firstName = sanitizeInput($_POST['firstName']);
    $middleName = sanitizeInput($_POST['middleName']);
    $birthDate = sanitizeInput($_POST['birthDate']); // String
    $gender = sanitizeInput($_POST['gender']);
    $barangay = sanitizeInput($_POST['barangay']);
    $municipality = sanitizeInput($_POST['municipality']);
    $province = sanitizeInput($_POST['province']);
    $contactNo = sanitizeInput($_POST['contactNo']);
    $email = sanitizeInput($_POST['email']);

    /* Validate Inputs */
    // Validate schoolId
    $inSchools = false;
    foreach($schools as $school) {
      if ($school['id'] == $schoolId) {
        $inSchools = true;
      }
    }
    if (! $inSchools) {
      $schoolIdErr = 'Invalid School. Please select a valid one.';
    }

    // Validate programId
    $inPrograms = false;
    foreach($programs as $program) {
      if ($program['id'] == $programId) {
        $inPrograms = true;
      }
    }
    if (! $inPrograms) {
      $schoolIdErr = 'Invalid Course Program. Please select a valid one.';
    }

    // validate birthDate
    $validBirthDate = validateDate($birthDate);
    if (! $validBirthDate) {
      $birthDateErr = 'Invalid Birthdate. Please Choose a valid one.';
    }

    // Validate gender
    if (($gender == 'F' || $gender == 'M')) {
      $genderErr = 'Invalid Gender. Choose F or M only.';
    }

    // Validate phone no
    if (! preg_match("/^09[0-9]{9}$/", $contactNo)) {
      $contactNoErr = 'Invalid Mobile Number. Please input a valid one.';
    }

    // Validate email
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'Invalid email address.';
    }

  }

  function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
  }

  function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    
    return $input;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
</head>
<body>
  <h1>Register</h1>
  <br>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p>Student Information</p>
    <label for="school">School Name</label>
    <select name="schoolId" id="school">
      <option value="" default></option>  
      <?php foreach($schools as $school): ?>
        <option value="<?php echo $school['id']; ?>"><?php echo $school['name']; ?></option>
      <?php endforeach; ?>
    </select>

    <label for="studentNo">Student No.</label>
    <input type="text" name="studentNo" id="studentNo" />

    <label for="program">Program Name</label>
    <select name="programId" id="program">
      <option value="" default></option>
      <?php foreach($programs as $program): ?>
        <option value="<?php echo $program['id']; ?>"><?php echo $program['name']; ?></option>
      <?php endforeach; ?>
    </select>

    <label>Full Name</label>
    <input type="text" name="lastName" placeholder="Last" />
    <input type="text" name="firstName" placeholder="First" />
    <input type="text" name="middleName" placeholder="Middle" />
    
    <label for="birthDate">Birth Date</label>
    <input type="date" name="birthDate" id="birthDate" />

    <label>Gender</label>
    <input type="radio" name="gender" id="male" value="M" checked/>
    <label for="male">Male</label>
    <input type="radio" name="gender" id="female" value="F"/>
    <label for="female">Female</label>

    <label>Complete Address</label>
    <input type="text" name="barangay" placeholder="Barangay" />
    <input type="text" name="municipality" placeholder="Municipality" />
    <input type="text" name="province" placeholder="Province" />

    <label>Contact No.</label>
    <input type="tel" name="contactNo" placeholder="+63 912 352 8388" />

    <label for="email">Email</label>
    <input type="email" name="email" id="email" />
    
    <p>Supporting Documents</p>
    <label>School Registration Form</label>
    <input type="file" name="schoolRegForm" enctype="multipart/form-data" />
    
    <label>School ID</label>
    <input type="file" name="schoolId" enctype="multipart/form-data" />

    <label>Proof of Residence</label>
    <input type="file" name="proofOfRes" enctype="multipart/form-data" />

    <label for="">Birth Certificate</label>
    <input type="file" name="birthCert" enctype="multipart/form-data" />
    
    <input type="submit" name="register" value="Register" />
  </form>
</body>
</html>