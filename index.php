<?php
require_once('top_view.php');
?>

	<!-- Slideshow container -->





	<div id="main-good-list" style="margin-top:80px;">
		<!-- <h2><img src="./img_main/main-title01.png"></h2> -->
		<h2>안전하고 믿을 수 있는 <span>맛과 정성이 가득한 돌재농원 </span>입니다.</h2>
            <ul style="width:1200px">
			<?php

//echo "start";

$conn = mysqli_connect($servername,$username,$password_db, $dbname);

if (mysqli_connect_errno($conn))
{
	echo "실패";
}
else
{

	$result = mysqli_query($conn, "select * From product Order by p_id");
	$i=0;
		while ($row = mysqli_fetch_array($result))
		{
			$i++;
			$p_id = $row['p_id'];
		  $s_id = $row['s_id'];
		  $name = $row['name'];
			$category1 = $row['category1'];
			$category2 = $row['category2'];
			$price = $row['price'];
			$measure = $row['measure'];
			$start_time = $row['start_time'];
			$content = $row['content'];
			$img_dir = $row['img_dir'];

if($i%2==0){ ?> 
<li class="left"><a href="./product_page.php?p_id=<?php echo $p_id;?>"><img src="./<?php echo $img_dir;?>"></a></li>
 <?php  } else{  ?>
<li class="right"><a href="./product_page.php?p_id=<?php echo $p_id;?>"><img src="./<?php echo $img_dir;?>"></a></li>
  <?php } }  }?>         
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
