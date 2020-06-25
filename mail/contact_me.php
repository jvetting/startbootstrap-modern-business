
<?php
// Check for empty fields
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

// Create the email and send the message
$to = 'jvetting@iastate.edu'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\n
Address line 1: $address_line1\n\n
City: $city\n\n
Region: $region\n\n
Zip code: $postal_code\n\n
Service type: $type\n\n
State of service: $exists\n\n
Message:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
return true;
?>
