<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Assignment - ISKCON</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .header {
            padding: 20px;
            text-align: center;
        }

        .header img {
            width: 120px;
            /* Adjust based on logo size */
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .body-content {
            padding: 20px;
            text-align: left;
            color: #333;
        }

        .body-content p {
            line-height: 1.6;
        }

        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .footer {
            background-color: #f4f4f9;
            color: #888;
            padding: 15px;
            text-align: center;
            font-size: 12px;
        }

        .important-info {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
        }

        .important-info h3 {
            margin-top: 0;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://www.iskcon.org/img/Iskconlogo.png" alt="ISKCON Logo">
            <h1>Volunteer Assignment - ISKCON</h1>
        </div>
        <div class="body-content">
            <p>Dear {{ $details['student_name'] }},</p>
            <p>We are pleased to inform you that you have been selected to serve as a volunteer with ISKCON. This is an
                exciting opportunity to contribute to our mission of spreading peace and devotion across the world, and
                we are grateful for your willingness to get involved.</p>

            <p>Your role as a volunteer will involve various activities, including assisting with event organization,
                supporting devotional activities, and helping with community outreach efforts. Through this experience,
                you will not only serve but also grow and connect with others who share your dedication.</p>

            <div class="important-info">
                <h3>Your Volunteer Role Includes:</h3>
                <ul>
                    <li>Assisting with event and program organization.</li>
                    <li>Helping to manage devotional activities and services.</li>
                    <li>Participating in community outreach programs.</li>
                    <li>Collaborating with fellow volunteers to achieve ISKCON's mission.</li>
                </ul>
            </div>

            <p>We encourage you to review the additional resources available in the volunteer portal to get acquainted
                with the guidelines and expectations for your role.</p>

            <p>Please note, your username and password for accessing the volunteer portal will be the same as your
                student login credentials. This makes it easier for you to get started without the need for creating new
                login details.</p>

            <p>To confirm your assignment and learn more about your volunteer responsibilities, please click the button
                below:</p>
            <a href="[Volunteer Portal URL]" class="cta-button">View Volunteer Dashboard</a>

            <div class="important-info">
                <h3>Important Information for Volunteers:</h3>
                <ul>
                    <li>Review the volunteer guidelines available on the portal.</li>
                    <li>Attend any training sessions or orientation briefings as required.</li>
                    <li>Engage with other volunteers through our communication channels.</li>
                    <li>Log and report your volunteer hours and contributions as needed.</li>
                </ul>
            </div>

            <p>Thank you again for your commitment to ISKCON. We look forward to your contributions and working with you
                in this important role. If you have any questions or need further assistance, please feel free to
                contact our volunteer support team at iskcon@gmail.com/+91 7854568956.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 ISKCON. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>
