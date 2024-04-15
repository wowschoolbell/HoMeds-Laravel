<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student ID Card</title>
<style>
    body {
        background: rgb(204,204,204);
        font-family:Arial;
        font-size:14px;
        text-transform:uppercase;
        padding: 0px;
        margin: 0px;
    }
    .card-container{
        width: 100%;
        float: left;
        height:224px;
    }
    .card-front {
        width:321px;
        margin:20px 20px;
        padding:10px;
        height:224px;
        border:#b40c1f solid 2px;
        background-image:url(images/bg.png);
        background-repeat: no-repeat;
        background-position: center;
        background-color: #fce4e7;
        background-size:40%;
        padding-top:5px;
        float: left;
        margin-top: 0px;
    }
    .school-name {
        font-size:100%;
        text-align:center;
        text-transform:uppercase;
        font-weight:bold;
        padding-top:5px;
    }
    .school-name h6 {
        font-size:14px;
        padding-bottom: 25px;
    }
    .card-footer {
        font-size: 12px;
        margin-top: 15px;
    }
    .card-footer .signature
    {
        text-transform:uppercase;
    }
    .student-details1 {
        font-size:11px;
        margin-top:20px;
        margin-bottom:20px;
        text-transform:capitalize;
    }
    .card-heading
    {
        padding:3px 5px;
        background-color:#b40c1f;
        font-weight:bold;
        border-radius:5px;
        color:#ffffff;
        display: block;
        text-transform: uppercase;
    }
    .card-heading-table
    {
        margin:7px auto;
    }
    @page {
        header: page-header;
        footer: page-footer;
    }
</style>
</head>

<body>
    @yield('content')
</body>
</html>
