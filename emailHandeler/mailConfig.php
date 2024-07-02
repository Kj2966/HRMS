<?php
function sendMail($filename,$email){
    include('../includes/config.php');
    date_default_timezone_set("Asia/Kolkata");

    // Fetch user data
    $qry = mysqli_query($con, "SELECT * FROM users WHERE Email = '$email'");
    $row = mysqli_fetch_assoc($qry);
    
    if (!$row) {
        return "User not found.";
    }

    if (!isset($row['UserName'])) {
        return "User 'Name' not found in the database.";
    }
    require '../vendor/autoload.php';

    $subject = "Congratulations on your successful registration on TeamSync";
    $bodyMessage = file_get_contents($filename);
    $bodyMessage = str_replace('[Name]', htmlspecialchars($row['UserName']), $bodyMessage); // Replace [Name] placeholder with user's name
    $recipientEmail = $email;
    $recipientName = $row['UserName'];

  
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info.teamsync@gmail.com';
    $mail->Password = 'sfifkdowekuwjnak'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

   
    $mail->setFrom('info.teamsync@gmail.com', 'TeamSync HR Services');
    $mail->addAddress($recipientEmail, $recipientName);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $bodyMessage;

    
    if (!$mail->send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "Email Sent";
    }
}

?>
