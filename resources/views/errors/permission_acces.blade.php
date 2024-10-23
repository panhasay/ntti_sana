<!DOCTYPE html>
<html>
<head>
    <title>Access denied</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
    <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/hover-min.css" rel="stylesheet" type="text/css" />
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: white;
            background-color: #368ee0;
            /*background: linear-gradient(141deg, #337ab7 -25%, rgb(68, 163, 244) 51%, #39acf4 75%);*/
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            margin-top: -100px;
        }

        .title {
            font-size: 125px;
            margin-bottom: 25px;
        }
        .title > .icon {
            font-size: 100px;
            margin-bottom: 25px;
        }

        .description {
            font-size: 25px;
            margin-bottom: 25px;
        }

        .sm_description {
            font-size: 20px;
            margin-top: 45px;
        }

        .sm_description> a > i{
            color: white;
            text-decoration: none;
            /*border: 1px solid white;*/
            text-align: center;
            padding: 6px 12px;
            background: rgba(255,255,255,.1);
            margin: 0 5px;
        }
        .sm_description > span{
            font-weight: bold;
            padding-bottom: 2px;
            border-bottom: 1px solid white;
        }
        .btn {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            padding: 10px 20px;
        }

        .footer{
            position: absolute;

        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title"><i class="icon fa fa-warning"></i></div>
        <h1>{{ $name ?? ''}}</h1>
        <div class="description">User Don't have Permission </div>
        <a href="/" class="btn hvr-bounce-in"><i class="fa fa-home"></i> Home</a>
        <div class="sm_description">{{ date('Y') }} &copy;NTTI</div>
    </div>
</div>
</body>
</html>