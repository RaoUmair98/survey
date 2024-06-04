<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        /* Reset styles */
        body,
        h1,
        p {
            margin: 0;
            padding: 0;
        }

        /* Inline styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header img {
            max-width: 200px;
            /* Adjust as needed */
        }

        .footer {
            text-align: center;
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('logo/logo.png') }}" alt="Company Logo">
            <h1>New User Created!</h1>
        </div>

        <!-- Content -->
        <p>Hello {{ $user->name }},</p>
        <p>Your account has been created successfully. Here are your login credentials:</p>
        <ul>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Password:</strong> {{ $temporaryPassword }}</li>
        </ul>
        <p>Please log in to the system using the provided credentials.</p>

        <hr>

        <!-- Login Button -->
        <p style="text-align: center;">
            <a href="{{url('/login')}}" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; margin: 20px; border-radius: 5px;">
                Login
            </a>
        </p>

        <!-- Troubleshooting -->
        {{-- <small>If you're having trouble clicking the "Login" button, copy and paste the URL below into your web browser: {{ $loginUrl }}</small> --}}

        <!-- Footer -->
        <div class="footer">
            <p>Contact us at <a href="mailto:woodviewhr@woodview.ca">woodviewhr@woodview.ca</a></p>
        </div>
    </div>
</body>

</html>
