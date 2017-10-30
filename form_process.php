<?php

if (isset($_POST['name']) && isset($_POST['email'])) {

    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $number = $_POST['number'];
    $security = $_POST['security'];
    $message = $_POST['message'];

    $to = 'j_goris@live.com';
    $subject = 'JorgeGoris.com Form Submission';
    $text = "Name: ".$firstname.",".$lastname."\n"."Email: ".$email."\n"."Phone: ".$number. "Wrote the following: "."\n\n".$message;

    if($security !== 7){
    	echo 'Sorry your security answer was incorrect!';
    }
    else {

    	if(mail($to, $subject, $text)){
        echo '<h1>Thanks! I will get back to you shortly.</h1>';
    	}
    	else {
        echo 'Sorry there was an error! Please try again.';
    	}
    }
}

?>