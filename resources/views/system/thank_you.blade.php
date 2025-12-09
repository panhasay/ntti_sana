<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f3f3fb;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 100%;
      max-width: 700px;
      padding: 20px;
    }

    .card {
      background: #ffffff;
      border-radius: 10px;
      padding: 50px 30px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      animation: fadeIn 0.5s ease-in-out;
    }

    .icon-box {
      margin-bottom: 25px;
    }

    .envelope {
      position: relative;
      width: 90px;
      height: 98px;
      margin: 0 auto;
      background: #e4e7ec;
      border-radius: 6px;
      overflow: hidden;
    }

    .envelope::before {
      content: '';
      position: absolute;
      top: -45px;
      left: 0;
      width: 100%;
      height: 90px;
      background: #d8dce2;
      transform: rotate(45deg);
    }

    .checkmark {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background: #21c55d;
      color: #fff;
      font-size: 28px;
      border-radius: 6px;
      width: 60px;
      height: 60px;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: pop 0.5s ease-in-out;
    }

    h1 {
      font-size: 36px;
      font-weight: 700;
      color: #2d3348;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
      color: #666;
      margin-bottom: 10px;
    }

    .sub-text {
      color: #999;
      margin-top: 5px;
      margin-bottom: 20px;
    }

    .link {
      color: #2563eb;
      text-decoration: none;
      word-break: break-all;
    }

    .link:hover {
      text-decoration: underline;
    }

    @keyframes pop {
      0% { transform: translateX(-50%) scale(0.5); opacity: 0; }
      100% { transform: translateX(-50%) scale(1); opacity: 1; }
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="icon-box">
        <div class="envelope">
          <div class="checkmark">✔</div>
        </div>
      </div>
      <h1>Thank You!</h1>
      <p>Your submission has been received.</p>
      <p class="sub-text">
      </p>
    </div>
  </div>
</body>
</html>
