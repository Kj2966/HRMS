<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TeamSync!</title>
    <style>
        /* Basic styling for email */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to TeamSync!</h1>
        </div>
        <div class="content">
            <p>Dear <?php echo $recipientName; ?>,</p>
            <p>Congratulations on your successful registration on TeamSync. We're excited to have you with us.</p>
            <p>Here are some next steps:</p>
            <ul>
                <li>Complete your profile details.</li>
                <li>Explore our services and resources.</li>
                <li>Connect with your team members.</li>
            </ul>
            <p>Feel free to reach out to us if you have any questions or need assistance.</p>
            <p>Best regards,<br>TeamSync HR Services</p>
        </div>
        <div class="footer">
            <p>Follow us on <a href="#">LinkedIn</a> | <a href="#">Twitter</a> | <a href="#">Facebook</a></p>
        </div>
    </div>
</body>
</html>
