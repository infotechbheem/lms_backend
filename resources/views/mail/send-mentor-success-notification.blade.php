<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Update Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header img {
            width: 150px;
            height: auto;
        }

        .email-body {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .email-body p {
            margin-bottom: 20px;
        }

        .email-body .bold {
            font-weight: bold;
        }

        .button {
            background-color: #1c74b8;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #1c74b8;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <img src="https://www.iskcon.org/img/Iskconlogo.png" alt="ISKCON LMS Logo">
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>Hello <span class="bold">{{ $details['student_name'] }}</span>,</p>
            <p>We are pleased to inform you that your account has been successfully upgraded! You are now also a <span class="bold">mentor</span> in addition to your existing student role.</p>
            <p>This means that you now have access to the mentor panel, where you can manage your mentoring activities, track mentee progress, and engage with other mentors.</p>
            <p>Your existing username and password will continue to work, so you can simply log in to the platform using your current credentials.</p>

            <p>If you have any questions or need assistance, feel free to reach out to us at <a href="mailto:support@iskconlms.com">support@iskconlms.com</a>.</p>

            <a href="https://yourplatform.com/login" class="button">Log In to Your Account</a>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; 2025 ISKCON Learning Management System. All rights reserved.</p>
            <p><a href="https://yourplatform.com/privacy-policy">Privacy Policy</a> | <a href="https://yourplatform.com/terms-of-service">Terms of Service</a></p>
        </div>
    </div>
</body>
</html>
