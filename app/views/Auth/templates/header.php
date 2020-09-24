<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style.css -->
    <link rel="stylesheet" href="<?=BASEURL; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/sweetalert2.min.css">
    <style>
        /* .form-control:focus{
            border-color: #cccccc;
            -webkit-box-shadow: none;
            box-shadow: none;
        } */

        textarea:hover, 
        input:hover, 
        textarea:active, 
        input:active, 
        textarea:focus, 
        input:focus,
        button:focus,
        button:active,
        button:hover,
        label:focus,
        .btn:active,
        .btn.active
        {
            outline:0px !important;
            -webkit-appearance:none;
            box-shadow: none !important;
        }
        .form-group label {
            font-size: 1.1em;
        }
        input.form-control{
            box-sizing: border-box!important;
            color: #cfcdc8!important;
            font-size: .8em;
            padding: .7em;
            letter-spacing: 1.2px;
            background-clip: padding-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            display: block;
        }

        input.form-control:not(:focus), body.dark-layout textarea.form-control:not(:focus) {
             border: 0!important;
        }
    </style>
    <title>Register Page</title>
</head>
