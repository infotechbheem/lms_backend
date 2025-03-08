<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
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
            background-color: #ffebee; /* Light red background */
            color: #333;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            width: 90%;
            padding: 40px;
            background-color: #ffebee; /* Matches body background */
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
            color: #d32f2f; /* Dark red color for the main error code */
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

        /* Responsive Design */
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
        <div class="illustration">🛠️</div>
        <h1>500</h1>
        <h2>Internal Server Error</h2>
        <p>Oops! Something went wrong on our end. Please try again later.</p>
        <a href="javascript:history.back()">Return Back</a>
    </div>
</body>
</html>
