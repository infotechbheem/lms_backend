<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            background-color: #ffffff;
            margin: 0 auto;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
            height: auto;
        }

        .content {
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            margin-bottom: 30px;
        }

        .content h1 {
            color: #5a67d8;
        }

        .content p {
            margin-bottom: 15px;
        }

        .button {
            background-color: #5a67d8;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #a0aec0;
            margin-top: 30px;
        }

    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="https://www.iskcon.org/img/Iskconlogo.png" alt="ISKCON LMS Logo">
        </div>

        <div class="content">
            <h1>Welcome, {{ $details['student_name'] }}!</h1>
            <p>Congratulations! Your registration has been successfully completed. We are excited to have you as part of the ISKCON LMS community.</p>

            <h3>Your Account Details:</h3>
            <ul>
                <li><strong>Student ID:</strong> {{ $details['student_id'] }}</li>
                <li><strong>Full Name:</strong> {{ $details['student_name']}}</li>
                <li><strong>Email:</strong> {{ $details['email'] }}</li>
                <li><strong>Password:</strong> {{ $details['password'] }}</li> <!-- Securely include password here -->
            </ul>

            <p>You can now log in to your student portal and explore the courses available to you. We highly encourage you to update your password after logging in for better security.</p>

            <p>If you have any questions or need assistance, feel free to reach out to our support team at <a href="mailto:support@iskconlms.com">support@iskconlms.com</a>.</p>

            <a href="" class="button">Go to Dashboard</a>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} ISKCON LMS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
