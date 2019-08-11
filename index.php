<?php
require_once('top_view.php');
?>

	<!-- Slideshow container -->
<div class="slideshow-container" style="min-width:1200px;" >

	<!-- Full-width images with number and caption text -->
	<div class="mySlides fade" style="display:block;">
	  <img src="./img_main/b_1.jpg" >
	  <div class="text">돌재농원의 대표김치!!<br/>포기김치</div>
	</div>

	<div class="mySlides fade">
	  <img src="./img_main/b_2.jpg" >
	  <div class="text">남녀노소가 모두 좋아하는 <br/>아삭아삭 깍두기</div>
	</div>

	<div class="mySlides fade">
	  <img src="./img_main/b_3.jpg" >
	  <div class="text">깔끔한 맛으로 텁텁함을 날려버리는 <br/>백김치</div>
	</div>

	<!-- Next and previous buttons -->
	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>
	
	<br>

	<!-- The dots/circles -->
	<div style="text-align:center">
	<span class="dot" onclick="currentSlide(1)"></span>
	<span class="dot" onclick="currentSlide(2)"></span>
	<span class="dot" onclick="currentSlide(3)"></span>
	</div>
	<br>
	<br>
	</div>





	<div id="main-good-list" style="margin-top:80px;">
		<!-- <h2><img src="./img_main/main-title01.png"></h2> -->
		<h2>안전하고 믿을 수 있는 <span>맛과 정성이 가득한 돌재농원 </span>입니다.</h2>
            <ul style="width:1200px">

            <li class="right"><a href="./index.php"><img src="./img_main/main-good02.png"></a></li>
            <li class="left"><a href="./index.php"><img src="./img_main/main-good03.png"></a></li>
            <li class="right"><a href="./index.php"><img src="./img_main/main-good04.png"></a></li>
            <li class="left"><a href="./index.php"><img src="./img_main/main-good05.png"></a></li>
            <li class="right"><a href="./index.php"><img src="./img_main/main-good06.png"></a></li>
            <li class="left"><a href="./index.php"><img src="./img_main/main-good07.png"></a></li>
            <li class="right"><a href="./index.php"><img src="./img_main/main-good10.png"></a></li>
            <li class="left"><a href="./index.php"><img src="./img_main/main-good11.png"></a></li>

			<!-- 열무김치 <li><a href="/goods/goods_view.php?goodsNo=1000000013"><img src="/data/skin/front/kimchi/img/etc/main-good08.png" /></a></li>
            <li class="right"><a href="/goods/goods_view.php?goodsNo=1000000014"><img src="/data/skin/front/kimchi/img/etc/main-good09.png" /></a></li>-->
            </ul>
	</div>

	<div id="footer" style="min-width:1200px">
		<img src="./img_main/bottom.png" alt="">

	</div>
	<div id="footer" style="min-width:1200px">
    	<img src="./img_main/footer.png" alt="">
	</div>
</div>
</body>
</html>
