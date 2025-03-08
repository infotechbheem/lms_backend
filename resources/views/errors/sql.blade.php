<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Error - Application</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .error-header {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
        }
        .error-details {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .error-code {
            font-family: monospace;
            color: #555;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container error-container">
        <h1 class="error-header">Oops! Database Error</h1>
        <p class="text-center text-muted">
            We encountered an issue while processing your request. Please try again later.
        </p>
        <hr>

        <h4 class="text-danger">Error Message:</h4>
        <p class="error-code">{{ $errorMessage ?? 'Unknown error occurred.' }}</p>

        <h4 class="text-danger mt-4">SQL Query:</h4>
        <div class="error-details">
            <pre class="error-code">{{ $sqlQuery ?? 'No SQL query available.' }}</pre>
        </div>

        <h4 class="text-danger mt-4">Possible Cause:</h4>
        <p class="text-muted">
            This error might occur if there is a missing column in the database or if there is an issue with the query syntax. Please check your database structure or consult support.
        </p>

        <div class="text-center mt-4">`
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Go Back</a>
            <a href="" class="btn btn-primary">Return to Homepage</a>
        </div>
    </div>

    <!-- Optional: Bootstrap and jQuery JS for functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
