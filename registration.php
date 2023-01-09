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

  // Handle Registration
  if (isset($_POST['register'])) {
    
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
    <select name="school" id="school">
      <option value="" default></option>  
      <?php foreach($schools as $school): ?>
        <option value="<?php echo $school['id']; ?>"><?php echo $school['name']; ?></option>
      <?php endforeach; ?>
    </select>

    <label for="studentNo">Student No.</label>
    <input type="text" name="studentNo" id="studentNo" />

    <label for="program">Program Name</label>
    <select name="program" id="program">
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
    <input type="radio" name="gender" id="male" value="M"/>
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
    <input type="file" name="schoolRegForm" />
    
    <label>School ID</label>
    <input type="file" name="schoolId" />

    <label>Proof of Residence</label>
    <input type="file" name="proofOfRes" />

    <label for="">Birth Certificate</label>
    <input type="file" name="birthCert" />
    
    <input type="submit" name="register" value="Register" />
  </form>
</body>
</html>