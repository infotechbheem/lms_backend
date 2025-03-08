<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>400 - Bad Request</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #ffebee;
            color: #333;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            width: 90%;
            padding: 40px;
            background-color: #ffebee;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .container h1 {
            font-size: 100px;
            color: #d32f2f;
            margin-bottom: 10px;
        }

        .container h2 {
            font-size: 26px;
            margin: 15px 0;
            color: #555;
        }

        .container p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 16px;
            text-decoration: none;
            background-color: #d32f2f;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .container a:hover {
            background-color: #b71c1c;
            transform: translateY(-3px);
        }

        .illustration {
            font-size: 70px;
            color: #d32f2f;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {
            .container h1 {
                font-size: 70px;
            }
            .container h2 {
                font-size: 22px;
            }
            .container p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">❌</div>
        <h1>400</h1>
        <h2>Bad Request</h2>
        <p>Sorry, your request could not be processed.</p>
        <a href="javascript:history.back()">Return Back</a>
    </div>
</body>
</html>
