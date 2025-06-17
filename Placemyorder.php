 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UPI Payment QR Code</title>
  <style>
    /* General Styling */
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: linear-gradient(135deg, #f0f4ff, #d0e1ff);
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .container {
      background: #ffffff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .container:hover {
      transform: translateY(-5px);
    }

    h1 {
      font-size: 28px;
      color: #1a73e8;
      margin-bottom: 20px;
      font-weight: 600;
    }

    /* Input Styling */
    input, button {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      border-color: #1a73e8;
      box-shadow: 0 0 8px rgba(26, 115, 232, 0.2);
      outline: none;
    }

    /* Button Styling */
    button {
      background-color: #1a73e8;
      color: white;
      font-weight: 500;
      cursor: pointer;
      border: none;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #155cb0;
      transform: translateY(-2px);
    }

    /* QR Code Styling */
    .qr-code {
      margin-top: 20px;
      display: inline-block;
      padding: 12px;
      background-color: #fff;
      border: 2px solid #1a73e8;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .qr-code img {
      max-width: 100%;
      border-radius: 8px;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
      h1 {
        font-size: 24px;
      }

      input, button {
        font-size: 14px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h1>UPI Payment QR Code Generator</h1>
  
  <form method="POST" action="">
    <input type="text" name="upiId" placeholder="Enter UPI ID (e.g., abc@upi)" required /><br />
    <input type="text" name="payeeName" placeholder="Enter Payee Name" required /><br />
    <input type="number" name="amount" placeholder="Enter Amount (Optional)" /><br />
    <button type="submit" name="generate">Generate QR Code</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["generate"])) {
      $upiId = trim($_POST["upiId"]);
      $payeeName = trim($_POST["payeeName"]);
      $amount = isset($_POST["amount"]) ? trim($_POST["amount"]) : '';

      if (!empty($upiId)) {
          // Construct UPI URI
          $upiUri = "upi://pay?pa=" . urlencode($upiId) . "&pn=" . urlencode($payeeName);
          if (!empty($amount)) {
              $upiUri .= "&am=" . urlencode($amount) . "&cu=INR";
          }

          // Generate QR code using qrserver.com API
          $qrCodeURL = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($upiUri);

          echo "<div class='qr-code'>";
          echo "<img src='$qrCodeURL' alt='QR Code' />";
          echo "</div>";
      } else {
          echo "<script>alert('Please enter a valid UPI ID');</script>";
      }
  }
  ?>

</div>

</body>
</html>