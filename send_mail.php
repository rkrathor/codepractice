<?php

if($_SERVER['HTTP_ORIGIN']=='http://charlienoble.com')
{
	header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    

                $Legal_Business_Name=$_POST['Legal_Business_Name'];
                $Store_Phone_Number= $_POST['Store_Phone_Number'];
                $Email=$_POST['Email'];
                $Store_Address=$_POST['Store_Address'];
                $contact_name=$_POST['contact_name'];
                $Web_Site_or_Facebook_Address=$_POST['Web_Site_or_Facebook_Address'];
                $Comments=$_POST['Comments'];
                $FEIN=$_POST['FEIN'];
                $State_of_Incorporation_or_Formation=$_POST['State_of_Incorporation_or_Formation'];
                $multiple_locations=$_POST['multiple_locations'];
               
				$to = 'rajeshkrathor@gmail.com';
				$subject = 'Vendor Contact Information Form';
				$from = 'rajeshrathor@mobikasa.com';
				 
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				// Create email headers
				$headers .= 'From: '.$from."\r\n".
				    'Reply-To: '.$from."\r\n" .
				    'X-Mailer: PHP/' . phpversion();
				 
				// Compose a simple HTML email message
				
				$message = '<html><body>';
 
				$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';
				 
				$message .= "<tr><td valign='top' >Legal Business Name</td><td  valign='top' >$Legal_Business_Name</td></tr>";
				 
				$message .= "<tr><td valign='top'>FEIN</td><td  valign='top'>$FEIN</td></tr>";
				 
				$message .= "<tr><td valign='top'>State of Incorporation or Formation</td><td  valign='top' >$State_of_Incorporation_or_Formation</td></tr>"; 
				
				$message .= "<tr><td valign='top'>Web Site or Facebook Address</td><td  valign='top'>$Web_Site_or_Facebook_Address</td></tr>";

				$message .= "<tr><td valign='top'>Contact Name</td><td  valign='top'>$contact_name</td></tr>";

				$message .= "<tr><td valign='top'>Phone Number</td><td  valign='top'>$Store_Phone_Number</td></tr>";

				$message .= "<tr><td valign='top'>Email</td><td  valign='top'>$Email</td></tr>";

				$message .= "<tr><td valign='top' >Address</td><td  valign='top' >$Store_Address</td></tr>"; 
				$message .= "<tr><td colspan='2'>Thanks <br> Team Charlienoble</td></tr>"; 
				$message .= "</table>";
				 
				$message .= "</body></html>";
				// Sending email
				if(mail($to, $subject, $message, $headers)){
				    echo json_encode('Your mail has been sent successfully.');
				} else{
				    echo json_encode('Unable to send email. Please try again.');
				}
}
               
?>