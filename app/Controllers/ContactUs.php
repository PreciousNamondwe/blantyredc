<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactUs extends BaseController {
	public function __construct() {
		helper('form');
	}
    
	public function index()
    {
		$data = [];
		$data['pageTitle'] = 'Contact Us';
		$data['validation'] = null;
		$session = \CodeIgniter\Config\Services::session();
		$mail = new PHPMailer(true); 
		$rules = [
			'name'=>'required|min_length[3]|min_length[3]',
			'email'=>'required|valid_email',
			'message'=>'required'
		];

		if ($this->request->getMethod() == 'post') {
			$name          = $this->request->getPost('name');        
			$email          = $this->request->getPost('email');
			$subject        = $this->request->getPost('subject');
			$message        = $this->request->getPost('message');
	
			$mail ='';
			$mail = new PHPMailer(true);
			$blantyredc_email='emmanuel.mphalo@blantyredc.gov.mw';
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
			$mail->SMTPDebug = SMTP::DEBUG_OFF;		    
		    $mail->isSMTP();  
		    $mail->Host         = 'mail.malawi.gov.mw'; //host
		    $mail->SMTPAuth     = true;     
		    $mail->Username     = 'emmanuel.mphalo@blantyredc.gov.mw';  
		    $mail->Password     = 'Admin@Admin10!';
			$mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;   
			$mail->Port         = 587;  

			//receipient
			$mail->setFrom('emmanuel.mphalo@blantyredc.gov.mw', $name);
			$mail->addAddress($blantyredc_email);  

			$mail->isHTML(true); 
			$mail->Subject      = $subject;
			$mail->Body         = '<p >from <span class="fw-bold">'.$name.'<span> @<span>'.$email.'</span> :'.$message.'</p>';

			// echo 'validated';
			// 	die;
			if ($mail->send()) {
					$session->setTempdata('success','Thanks, we have received your message',3);
					return redirect()->to(current_url());
				} else {
					$session->setTempdata('error','Sorry, try again',3);
					return redirect()->to(current_url());
					die;
				}
			
		}
		
        return view('contact-us/index',$data);
    }
    public function send_email() {
    
        
        $name          = $this->request->getPost('name');        
        $email          = $this->request->getPost('email');
        $subject        = $this->request->getPost('subject');
        $message        = $this->request->getPost('message');

		$mail ='';
		$mail = new PHPMailer(true);
		$blantyredc_email='emmanuel.mphalo@blantyredc.gov.mw';
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
			$mail->SMTPDebug = SMTP::DEBUG_OFF;		    
		    $mail->isSMTP();  
		    $mail->Host         = 'mail.malawi.gov.mw'; //host
		    $mail->SMTPAuth     = true;     
		    $mail->Username     = 'emmanuel.mphalo@blantyredc.gov.mw';  
		    $mail->Password     = 'Admin@Admin10!';
			$mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;   
			$mail->Port         = 587;  

			//receipient
			$mail->setFrom('emmanuel.mphalo@blantyredc.gov.mw', $name);
			$mail->addAddress($blantyredc_email);  

			$mail->isHTML(true); 
			$mail->Subject      = $subject;
			$mail->Body         = '<p ><span style="font-weight: bold; font-size: 27px;">'.$email.'</span> has the following to say:'.$message.'</p>';

			if(!$mail->send()) {
			    echo "Something went wrong. Please try again.";
				die;
			}
		    else {
                // set message to success
                // update notification alert
                // imclude $message to view
			    echo "Email sent successfully.";
				die;
		    }
		    
		} catch (Exception $e) {
		    echo "Something went wrong. Please try again.";
		}
        
    }
}