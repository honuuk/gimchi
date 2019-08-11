<?php
require_once("dbdata.php");
session_start();

// If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['user_data']))
{
	if (isset($_COOKIE['user_data']))
	{
		$_SESSION['user_data'] = $_COOKIE['user_data'];
	}
}

if (isset($_SESSION['user_data']))
{
	//echo "logining";
	$login = true;
}
else
{
	$login = false;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script src="./scriptaculous/lib/prototype.js" type="text/javascript"></script>
		<script src="./scriptaculous/src/scriptaculous.js" type="text/javascript"></script>
		<script src="./slide.js" type="text/javascript"></script>
		<link type="text/css" rel="stylesheet" href="./main.css">
	<link type="text/css" rel="stylesheet" href="./notice.css">
	<link type="text/css" rel="stylesheet" href="./notice_view.css">
	<link type="text/css" rel="stylesheet" href="./order.css">
	<link type="text/css" rel="stylesheet" href="./join.css">
  <link type="text/css" rel="stylesheet" href="./mp_update.css">
 

		<title>8조</title>
</head>
<style>
#top_menu, #header {
    width: 1200px;
	margin: 20px auto;
	height:0;
	padding: 0 0;
}
#top_menu .slogan {
    float: left;
    height: 0px;
}

#main-good-list ul{
	padding-left: 0;
	margin: 0 auto;
}
#main-good-list ul li.right {
    float: right;
    padding-right: 0px;
}

#main-good-list ul li.left {
    padding-left: 0px;
}
#main-good-list h2 {
    height: 68px;
	text-align: center;
	width: 100%;
    min-width: 1200px;
}

</style>
<body>
	<div id="frame">
	<div id="top_menu">
		<span class="slogan">
			<img src="./img_main/slogan.png">
		</span>
		<ul>
			<?php
			if ($login == false)
			{
				echo '<li><a href="./login.php">로그인</a></li>';
				echo '<li><a href="./join.php">회원가입</a></li>';
			}
			else if ($login == true)
			{
				echo '<li><a href="./logout.php">로그아웃</a></li>';
				echo '<li><a href="./mypage_order.php">주문조회</a></li>';
			}
			?>
			
			<li><a href="./mypage_personal.php">마이페이지</a></li>
		</ul>
	</div>


	<div id="header">
	<div class="ad-left">
            <img src="./img_main/cstime1.jpg">
        </div>
		<h1>
			<a href="./index.php"><img src="./img_main/main.png" alt="메인사진"></a>
		</h1>
		<div class="ad">
            <img src="./img_main/top-delivery.png">
        </div>
	</div>


	<div id="menu1" style="width:100%; min-width:1200px;">
		<ul>
			<li><a href="./product_list.php">상품 (Product)</a></li>
			<li><a href="./notice.php">공지사항 (Notice)</a></li>
			<li><a href="./review.php">후기 (Review)</a></li>
		</ul>
	</div>
	