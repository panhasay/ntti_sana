<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTTI Portal</title>
    <link rel="icon" type="image/x-icon" href="https://www.ntti.edu.kh/assets/images/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Bayon&family=Moul&family=Noto+Serif+Khmer:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: "Noto Serif Khmer", serif;
             /* background-image: url('asset/NTTI/images/img_login.jpg'); */
            background: url('asset/NTTI/images/img_login.jpg') no-repeat center center/cover;
            background-image: url('asset/NTTI/images/img_login.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }

        /* Dark overlay */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .container-login {
            position: relative;
            z-index: 2;
            display: flex;
            /* flex-direction: column;
            justify-content: center; */
            align-items: center;
            min-height: 100vh;
            color: white;
            text-align: center;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 10px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .login-box h2 {
            font-family: "Bayon", sans-serif;
            color: #0f4e87;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0f4e87;
        }

        .btn-login {
            background-color: #0f4e87;
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            width: 100%;
            height: 45px;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #083963;
        }

        footer {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            font-size: 0.9rem;
            padding: 15px 0;
        }

        footer a {
            color: #ffb300;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-box {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="row container-login">
      <div class="col-md-6 col-sm-12">
          <div class="text-center mb-4">
            <h1 class="mt-3 fw-bold">The NTTI Portal</h1>
            <p class="px-3">
                សូមស្វាគមន៍មកកាន់ វិទ្យាស្ថានបច្ចេកទេសជាតិ  <br>
                បណ្តុះបណ្តាលបច្ចេកទេស (NTTI)
            </p>
        </div>
      </div>
     <div class="col-md-6 col-sm-12">
          <div class="login-box">
            <h2>ប្រព័ន្ធចូលគណនី</h2>
           <form class="mt-3" action="{{ route('login.post') }}" method="POST">
              @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="email" placeholder="ឈ្មោះអ្នកប្រើប្រាស់">
                </div>
                  @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="ពាក្យសម្ងាត់">
                </div>
                @if (session()->has('message'))
                    <span class="text-danger"> {{ session()->get('message') }}</span>
                @endif
                <button type="submit" class="btn btn-login">Login</button>
            </form>
            <div class="mt-3 text-end">
                <a href="#" style="color:#0f4e87;">ភ្លេចពាក្យសម្ងាត់?</a>
            </div>
        </div>
      </div>
    </div>
</body>
</html>
