<?php

if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
   
 
    $email_to = "shyamsapate1@gmail.com, projects.viren@gmail.com";
 
    $email_subject = "New inquiry received from shyamsapate,in";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted.";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['name']) ||
        
        !isset($_POST['email']) ||
        
        !isset($_POST['subject']) ||
 
        !isset($_POST['message'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $name = $_POST['name']; // required
 
    $mobile = $_POST['mobile']; // Not - required
    
    $email_from = $_POST['email']; //required
 
    $subject = $_POST['subject']; // required
 
    $message = $_POST['message']; // not required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
     
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
  	/*
    $mob="/^[789][0-9]{9}$/";

	if(!preg_match($mob, $mobile))
	{ 
    		$error_message .='The Mobile Number you entered does not appear to be valid. <br />';
        
	}   
    */
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name) && strlen($name)<2) {
 
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
 
  }
 
 
  if(!preg_match($string_exp,$subject) && strlen($subject)<2) {
 
    $error_message .= 'Subject you entered do not appear to be valid.<br />';
 
  }
  
  if(strlen($message) < 4) {
 
    $error_message .= 'Message you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }


/* Old Message Body for Email ***********
 
    $email_message = "Form details below.\n\n";
 
************/
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }


// New Message Body Starts

$email_message = '<html><body>';
$email_message .= '<img src="http://www.mindfulmandalacards.com/images/logo.png" alt="Mindful Mandala Cards" />  <h1> Shyam Sapate </h1> <br /> <br />';
$email_message .= '<table rules="all" style="border-color: #333;" cellpadding="20">';
$email_message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
$email_message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
$email_message .= "<tr><td><strong>Subject:</strong> </td><td>" . strip_tags($_POST['subject']) . "</td></tr>";
$email_message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
$email_message .= "<tr><td><strong>Contact:</strong> </td><td>" . $_POST['mobile'] . "</td></tr>";
$email_message .= "</table>";
$email_message .= "</body></html>";

// New Message Body Ends here.


 
/* Old Message Body for Email ***********     
 
    $email_message .= "Client Name : ".clean_string($name)."\n";
 
    $email_message .= "Mobile No : ".clean_string($mobile)."\n";
    
    $email_message .= "Emain ID : ".clean_string($email_from)."\n";
 
    $email_message .= "Subject : ".clean_string($subject)."\n";
 
    $email_message .= "Message : ".clean_string($message)."\n";
 
************/
 
     
 
// create email headers

$headers = "From: " . strip_tags($_POST['email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
$headers .= "CC: shyamsapate1@gmail.com, projects.viren@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
/* This was older header *****


$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();


***** Older Header Ends */ 
 
@mail($email_to, $email_subject, $email_message, $headers);  

echo "<script type='text/javascript'>alert('Your Enquiry Successfully Submitted!')</script>";
 
echo "<script>setTimeout(\"location.href = 'index.php';\");</script>";

}

?>