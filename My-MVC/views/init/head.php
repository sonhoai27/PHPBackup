<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="google-site-verification" content="XZdyn6Ez8VfQhnoEuZdeU8OIe49W8zZsk1lpsb5Gj0g" />

    <base href="<?=BASE_URL?>">
    <?php
    if(isset($_GET['url']) && $_GET['url'][0] == "chi-tiet"){
        echo "fb";
    }
    ?>
    <?php
    echo "<title>".$TITLE_PAGE."</title>";
    ?>
    <link rel="shortcut icon" href="<?=BASE_URL?>public/images/cdn/icon/logo.ico">
    <link rel="stylesheet" href="<?=BASE_URL?>public/styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=BASE_URL?>public/styles/css/bootstrap-grid.min.css">
    <link rel="stylesheet" media="all" href="<?=BASE_URL?>public/styles/css/main.v2.css"/>
    <link rel="stylesheet" media="all" href="<?=BASE_URL?>public/styles/css/cdn.css"/>
	<link rel="stylesheet" media="all" href="<?=BASE_URL?>public/styles/css/error.css"/>
	<script src="<?=BASE_URL?>public/styles/js/aes.js"></script>
    <script src="<?=BASE_URL?>public/styles/js/jquery.min.js"></script>
	<!--<script src="<?=BASE_URL?>public/styles/js/script.v2.js"></script> -->
    <link href="<?=BASE_URL?>public/styles/css/font-awesome.css" rel="stylesheet">
    <link href="<?=BASE_URL?>public/styles/css/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=vietnamese" rel="stylesheet">
</head>
<body>