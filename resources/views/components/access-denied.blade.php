<style>
    .container {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
        //margin-top: 10px;
    }

    .content {
        text-align: center;
        background-color: #368ee0 !important;
    }

    .title {
        font-size: 125px;
        margin-bottom: 25px;
    }

    .title>.icon {
        font-size: 100px;
        margin-bottom: 25px;
        margin-top: 10px;
    }

    .description {
        font-size: 25px;
        margin-bottom: 25px;
    }

    .sm_description {
        font-size: 20px;
        margin-top: 45px;
    }

    .sm_description>a>i {
        color: white;
        text-decoration: none;
        text-align: center;
        padding: 6px 12px;
        background: rgba(255, 255, 255, .1);
        margin: 0 5px;
    }

    .sm_description>span {
        font-weight: bold;
        padding-bottom: 2px;
        border-bottom: 1px solid white;
    }

    .btn {
        color: white;
        text-decoration: none;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-align: center;
        padding: 10px 20px;
    }
</style>
<div class="container">
    <div class="content">
        <div class="title"><i class="icon fa fa-warning"></i></div>
        <h1>{{ $name ?? '' }}</h1>
        <div class="description">User Doesn't Have Permission</div>
        <a href="/" class="btn hvr-bounce-in"><i class="fa fa-home"></i> Home</a>
        <div class="sm_description">{{ date('Y') }} &copy; NTTI</div>
    </div>
</div>
