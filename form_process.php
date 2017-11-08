<?php

// define variables and set to empty values
$firstName_error = $email_error = $phone_error = "";
$firstName = $lastName = $email = $phone = $message = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $firstName_error = "First name is required";
  } else {
    $firstName = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstName_error = "Only letters and white space allowed"; 
    }
  }

    if (empty($_POST["email"])) {
    $email_error = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format"; 
    }
  }
  
  if (empty($_POST["phone"])) {
    $phone_error = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)) {
      $phone_error = "Invalid phone number"; 
    }
  }

  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }
  
  if ($firstName_error == '' and $email_error == '' and $phone_error == '' ){
      $message_body = '';
      unset($_POST['submit']);
      foreach ($_POST as $key => $value){
          $message_body .=  "$key: $value\n";
      }
      
      $to = 'J_goris@live.com';
      $subject = 'Potential Client/Employer-JorgeGoris';
      if (mail($to, $subject, $message_body)){
          $success = "Message sent, I'll get back to you shortly!";
          $firstName = $email = $phone = $message = '';
          echo "<h1>Got it! I'll get back to you shortly!</h1><a href='index.html'><button class='button'>Go Back!</button></a>";
      }
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>