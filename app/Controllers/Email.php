<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Message;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends BaseController {
    
    public function __construct() {
		
    }
    
    public function compose() {
    
        echo view('compose');
    
    }
    
    public function send_email() {
    
        
        $fname          = $this->request->getPost('fname');        
        $lname          = $this->request->getPost('lname');
        $email          = $this->request->getPost('emailAddress');
        $subject        = $this->request->getPost('Feedback');
        $message        = $this->request->getPost('message');
        echo $fname.'<br />';
        echo 'sending email...';
        die;
        $mail = new PHPMailer(true);  
		try {
		    
		    $mail->isSMTP();  
		    $mail->Host         = 'smtp.google.co'; //smtp.google.com /host
		    $mail->SMTPAuth     = true;     
		    $mail->Username     = 'mphaloemmanuel@gmail.com';  
		    $mail->Password     = 'Admin@Admin10!';
			$mail->SMTPSecure   = 'tls';  
			$mail->Port         = 587;  
			$mail->Subject      = $subject;
			$mail->Body         = $message;
			$mail->setFrom($email, $fname.''.$lname);
			
			$mail->addAddress($email);  
			$mail->isHTML(true);      
			
			if(!$mail->send()) {
			    echo "Something went wrong. Please try again.";
			}
		    else {
                // set message to success
                // update notification alert
                // imclude $message to view
			    echo "Email sent successfully.";
		    }
		    
		} catch (Exception $e) {
		    echo "Something went wrong. Please try again.";
		}
        
    }
    
}