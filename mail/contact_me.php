<?php
if(empty($_POST['form'])){echo "Form";}
if(empty($_POST['email'])){echo "Email";}
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){echo "Email !valid";}
if(empty($_POST['message'])){echo "Message";}
else
{
   /**
    * Contact email
    */
   $form = strip_tags(htmlspecialchars($_POST['form']));
   if($form == "contact"){
      // Check for empty fields
      if(empty($_POST['name'])){echo "Name";}
      if(empty($_POST['phone'])){echo "Phone";}
      //if(empty($_POST['email'])){echo "Email";}
      //if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){echo "Email !valid";}
      if(empty($_POST['address_line1'])){echo "Address line 1";}
      if(empty($_POST['city'])){echo "City";}
      if(empty($_POST['region'])){echo "Region";}
      if(empty($_POST['postal_code'])){echo "Postal code";}
      if(empty($_POST['type'])){echo "Type";}
      if(empty($_POST['exists'])){echo "Exists";}
      //if(empty($_POST['message'])){echo "Message";}
      if(empty($_POST['ticket'])){echo "Ticket";}
      if(empty($_POST['reply'])){echo "Reply";}

      if(empty($_POST['form'])      ||
          empty($_POST['name'])      ||
          empty($_POST['phone'])     ||
          empty($_POST['email'])     ||
          empty($_POST['address_line1']) ||
          empty($_POST['city']) ||
          empty($_POST['region']) ||
          empty($_POST['postal_code']) ||
          empty($_POST['type']) ||
          empty($_POST['exists']) ||
          empty($_POST['message'])   ||
          empty($_POST['ticket'])   ||
          empty($_POST['reply'])   ||
          !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
      {
         echo "No arguments Provided!";
         return false;
      }

      $name = strip_tags(htmlspecialchars($_POST['name']));
      $email_address = strip_tags(htmlspecialchars($_POST['email']));
      $phone = strip_tags(htmlspecialchars($_POST['phone']));
      $address_line1 = strip_tags(htmlspecialchars($_POST['address_line1']));
      $address_line2 = "";
      if(!empty($_POST['address_line2'])){$address_line2 = strip_tags(htmlspecialchars($_POST['address_line2']));}
      $city = strip_tags(htmlspecialchars($_POST['city']));
      $region = strip_tags(htmlspecialchars($_POST['region']));
      $postal_code = strip_tags(htmlspecialchars($_POST['postal_code']));
      $type = strip_tags(htmlspecialchars($_POST['type']));
      $exists = strip_tags(htmlspecialchars($_POST['exists']));
      $message = strip_tags(htmlspecialchars($_POST['message']));
      $ticket = strip_tags(htmlspecialchars($_POST['ticket']));
       $reply = strip_tags(htmlspecialchars($_POST['reply']));

// Create the email and send the message
      $to = 'jvetting@iastate.edu'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
      $email_subject = "Online Appointment Request: #$ticket";
      $email_body = "A client has requested a service.\n\n"."Here are the details:\n\n
Name: $name\n
Email: $email_address\n
Phone: $phone\n
Address line 1: $address_line1\n
Address line 2: $address_line2\n
City: $city\n
Region: $region\n
Zip code: $postal_code\n
Service type: $type\n
State of service: $exists\n
Preferred contact method: $reply\n
Message:\n$message";
      $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $headers .= "Reply-To: $email_address";
      mail($to,$email_subject,$email_body,$headers);


      /**---------------------------------------------------------------------------------------------------------------
       * Confirmation email sent to client
       */
      // Create and send a confirmation email to client
      $to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
      $email_subject = "Calvert Exterminators: Online Appointment Request Confirmation";
      $email_body = "Your service request has been sent! We will reply within 2 business days!\n\n"."Here are the details:\n\n
Ticket#: $ticket\n
Name: $name\n
Email: $email_address\n
Phone: $phone\n
Address line 1: $address_line1\n
Address line 2: $address_line2\n
City: $city\n
Region: $region\n
Zip code: $postal_code\n
Service type: $type\n
State of service: $exists\n
Message:\n$message";
      $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $headers .= "Reply-To: jvetting@iastate.edu";
      mail($to,$email_subject,$email_body,$headers);
   }
   /**
    * else, form==feedback
    */
   else{
      /**
       * Feedback email
       */
      // Check for empty fields
      //if(empty($_POST['name'])){echo "Name";}
      //if(empty($_POST['email'])){echo "Email";}
      //if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){echo "Email !valid";}
      //if(empty($_POST['message'])){echo "Message";}
      if(empty($_POST['rating'])){echo "Rating";}

      if(empty($_POST['form'])      ||
          //empty($_POST['name'])      ||
          empty($_POST['email'])     ||
          empty($_POST['message'])   ||
          empty($_POST['rating'])   ||
          !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
      {
         echo "No arguments Provided!";
         return false;
      }

      $name = strip_tags(htmlspecialchars($_POST['name']));
      $email_address = strip_tags(htmlspecialchars($_POST['email']));
      $message = strip_tags(htmlspecialchars($_POST['message']));
      $rating = strip_tags(htmlspecialchars($_POST['rating']));

// Create the email and send the message
      $to = 'jvetting@iastate.edu'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
      $email_subject = "Website Feedback Form";
      $email_body = "A user has left feedback on the website.\n\n"."Here are the details:\n\n
Email: $email_address\n
Rating: $rating stars\n
Message:\n$message";
      $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $headers .= "Reply-To: $email_address";
      mail($to,$email_subject,$email_body,$headers);

      /**------------------------------------------------------------------------------------------------------------
       * Confirmation email sent to user
       * Don't really need to send one though
       */
      // Create and send a confirmation email to client
      /*
      $to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
      $email_subject = "Calvert Exterminators: Online Feedback Confirmation";
      $email_body = "Your feedback has been sent! We will reply within 2 business days!\n\n"."Here are the details:\n\n
Name: $name\n
Email: $email_address\n
Rating: $rating\n
Message:\n$message";
      $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $headers .= "Reply-To: jvetting@iastate.edu";
      mail($to,$email_subject,$email_body,$headers);
      */
   }
}
// Check for empty fields
/*
if(empty($_POST['name'])){echo "Name";}
if(empty($_POST['phone'])){echo "Phone";}
if(empty($_POST['email'])){echo "Email";}
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){echo "Email !valid";}
if(empty($_POST['address_line1'])){echo "Address line 1";}
if(empty($_POST['city'])){echo "City";}
if(empty($_POST['region'])){echo "Region";}
if(empty($_POST['postal_code'])){echo "Postal code";}
if(empty($_POST['type'])){echo "Type";}
if(empty($_POST['exists'])){echo "Exists";}
if(empty($_POST['message'])){echo "Message";}
if(empty($_POST['ticket'])){echo "Ticket";}

if(empty($_POST['name'])      ||
   empty($_POST['phone'])     ||
   empty($_POST['email'])     ||
   empty($_POST['address_line1']) ||
   empty($_POST['city']) ||
   empty($_POST['region']) ||
   empty($_POST['postal_code']) ||
   empty($_POST['type']) ||
   empty($_POST['exists']) ||
   empty($_POST['message'])   ||
    empty($_POST['ticket'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$address_line1 = strip_tags(htmlspecialchars($_POST['address_line1']));
//$address_line2 = strip_tags(htmlspecialchars($_POST['address_line2']));
$city = strip_tags(htmlspecialchars($_POST['city']));
$region = strip_tags(htmlspecialchars($_POST['region']));
$postal_code = strip_tags(htmlspecialchars($_POST['postal_code']));
$type = strip_tags(htmlspecialchars($_POST['type']));
$exists = strip_tags(htmlspecialchars($_POST['exists']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$ticket = strip_tags(htmlspecialchars($_POST['ticket']));

// Create the email and send the message
$to = 'jvetting@iastate.edu'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Online Appointment Request: #$ticket";
$email_body = "A client has requested a service.\n\n"."Here are the details:\n\n
Name: $name\n
Email: $email_address\n
Phone: $phone\n
Address line 1: $address_line1\n
City: $city\n
Region: $region\n
Zip code: $postal_code\n
Service type: $type\n
State of service: $exists\n
Message:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
*/

// Create and send a confirmation email to client
/*
$to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Calvert Exterminators: Online Appointment Request Confirmation";
$email_body = "Your service request has been sent! We will reply within 2 business days!\n\n"."Here are the details:\n\n
Ticket#: $ticket\n
Name: $name\n
Email: $email_address\n
Phone: $phone\n
Address line 1: $address_line1\n
City: $city\n
Region: $region\n
Zip code: $postal_code\n
Service type: $type\n
State of service: $exists\n
Message:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: jvetting@iastate.edu";
mail($to,$email_subject,$email_body,$headers);

return true;
*/
?>
