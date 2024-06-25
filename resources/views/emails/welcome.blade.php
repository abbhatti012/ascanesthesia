<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Confirmation</title>
  <style>
    /* Style your email here */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #333333;
      text-align: center;
    }
    p {
      color: #666666;
      font-size: 16px;
      line-height: 1.5;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #ffffff;
      text-decoration: none;
      border-radius: 5px;
    }
    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Payment Confirmation</h1>
    <p>Dear {{ $name }},</p>
    <p>We are pleased to inform you that your payment has been successfully processed.</p>
    <p>Our team will review your payment and get back to you shortly with any further details or updates.</p>
    <p>If you have any questions or concerns, feel free to contact us at naveed.mohammad@pioneertech.academy.</p>
    <p>Thank you for choosing our service!</p>
    <p>Sincerely,</p>
    <p>The Anesthesia Team</p>
    <div style="text-align: center;">
      <a href="/" class="btn">Visit Our Website</a>
    </div>
  </div>
</body>
</html>
