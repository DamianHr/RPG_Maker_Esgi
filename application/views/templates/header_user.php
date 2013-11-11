<?php
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-theme.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/main.css">

    <script src="<?php echo base_url() ?>js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo base_url() ?>js/main.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url()?>js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
</head>
<body style="height: 100%">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url("home_user"); ?>">RPG Maker</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url("home_user"); ?>">Home</a></li>
                <?php if (IceBreaker::is_change_allowed(site_url("creater"))) { ?>
                <li><a href="<?php if (!IceBreaker::is_change_allowed(site_url("creater"))) { echo site_url("create"); } ?>">Create a game</a></li>
                <?php } ?>
                <?php if (IceBreaker::is_change_allowed(site_url("list"))) { ?>
                    <li><a href="<?php if (IceBreaker::is_change_allowed(site_url("list"))) { echo site_url("list"); } ?>">Game list</a></li>
                <?php } ?>
            </ul>
            <div class="navbar-right" style="padding: 10px 15px;">
                <a class="btn btn-danger" href="<?php echo site_url("signout"); ?>">Sign out</a>
            </div>
        </div>
    </div>
</div>