<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        // Input data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $url = $_POST['url'];
        $subject_input = $_POST['subject'];
        $message = $_POST['message'];

        // Attachments
        // $attachments = $_FILES['attachment'];

        /* Add styles for the email template */
        $style = "<style>
            .container {
                background-color: #eee;
                padding: 30px;
                margin: 50px;
            }
            h1 {
                font-size: 24px;
                color: #000;
                margin-bottom: 20px;
            }
            p {
                font-size: 14px;
                color: #000;
                line-height: 1.5;
                margin-bottom: 20px;
            }
        </style>";

        $email_template = "
            <html>
            <head>
                $style
            </head>
            <body>
                <div class='container'>
                    <h1>Subject: $subject_input</h1>
                    <p>Name: $name</p>
                    <p>Email: $email</p>
                    <p>Phone: $phone</p>
                    <p>Website: $url</p>
                    <p>Message: $message</p>
                </div>
            </body>
            </html>
        ";

        // Server settings
       //$mail->SMTPDebug = SMTP::DEBUG_SERVER;        //Enable verbose debug output
        $mail->isSMTP();                               //Send using SMTP   
        $mail->Host = 'smtp.gmail.com';                //Set the SMTP server to send through
        $mail->SMTPAuth = true;                        //Enable SMTP authentication
        $mail->Username = 'arundeltait@gmail.com';     //SMTP username
        $mail->Password = 'uhvrvfzkvucctvle';           //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
        $mail->Port = 465;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('arundeltait@gmail.com', 'Mailer Sender');    //Add a Sender
        $mail->addAddress('arundeltait@gmail.com', 'Mail Receiver');  //Add a Receiver

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Welcome To Our Email";
        $mail->Body = $email_template;

        //Add attachments
        // Specify the target folder where you want to save the attachment
        $targetFolder = "uploads/";
        // Check if the 'attachment' file input is set and not empty
        if (isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) {
            $attachment = $_FILES['attachment'];
        
            // Extract the file name
            $fileName = $attachment['name'];
        
            // Generate a unique file name to avoid conflicts
            $uniqueFileName = uniqid() . '_' . $fileName;
        
            // Specify the path where the file will be saved
            $targetFilePath = $targetFolder . $uniqueFileName;
        
            // Move the uploaded file to the target folder
            if (move_uploaded_file($attachment['tmp_name'], $targetFilePath)) {
                // File uploaded successfully
            }
        }
        
        $mail->addAttachment('uploads/'.$uniqueFileName, $uniqueFileName);  //Add attachments

        $mail->send();
        echo 'Your form was submitted successfully!';
        // echo "<pre>";
        // print_r($_FILES['attachment']);
        // echo "<pre>";
        // print_r($_POST);
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
