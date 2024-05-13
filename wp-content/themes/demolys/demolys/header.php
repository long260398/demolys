<!DOCTYPE html>
<html lang="en">
<head>
	<?php wp_head(); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css"
          href="<?= get_template_directory_uri() ?>/dist/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?= get_template_directory_uri() ?>/dist/lib/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?= get_template_directory_uri() ?>/dist/lib/swiper/swiper-bundle.min.css">
		  <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri() ?>/dist/scss/custom.css">
		  <script type="text/javascript" src="<?= get_template_directory_uri() ?>/dist/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= get_template_directory_uri() ?>/dist/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= get_template_directory_uri() ?>/dist/lib/fancybox/jquery.fancybox.min.js"></script>
		  <script type="text/javascript" src="<?= get_template_directory_uri() ?>/dist/lib/swiper/swiper-bundle.min.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <div class="header-wrapper">
        <div class="content">
			<div class="logo">
                <a href="<?= home_url() ?>">
                    <figure>
                        <img src="<?= get_template_directory_uri() ?>/dist/img/logo.png" alt=""><?//= getimage(get_field('logo_header', 'option')) ?>
                    </figure>
                </a>
        	</div>
			<nav class="menu">
                    <ul>
                 	    <li><a href="#">Trang chủ</a></li>
						<li><a href="#">đặt mua</a></li>
						<li><a href="#">công dụng</a></li>
						<li><a href="#">thành phần</a></li>
						<li><a href="#">tác dụng</a></li>
						<li><a href="#">ý kiến khách hàng</a></li>
                    </ul>
			</nav>
		</div>
	</div>
</header>

