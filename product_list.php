<?php
require_once('top_view.php');
?>
		
<div id="grid">
<?php

	//echo "start";

	$conn = mysqli_connect($servername,$username,$password_db, $dbname);

	if (mysqli_connect_errno($conn))
	{
		echo "실패";
	}
	else
	{

		$result = mysqli_query($conn, "select * From product Order by p_id Desc");
		$i = 0;
			while ($row = mysqli_fetch_array($result))
			{
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


?>

	<div style="margin:10px 10px;">
		<a href ="./product_page.php?p_id=<?php echo $p_id;?>" style="text-decoration:none; ">
			<div class="thumbnail" >
				<img src="<?php echo $img_dir;?>"  style="width:100%; height : 300px"/>
			</div>
</a>
			<div class ="description">
				<a href ="./product_page.php?p_id=<?php echo $p_id;?>" >
	      <strong style="font-size:18px;color:#000000; margin-left: 10px;"><?php echo $name;?></strong>
			</a>
			<style>
				#grid{
					display:grid;
					grid-template-columns: 1fr 1fr 1fr;
					width:1200px;
					margin:0 auto;
				}
			.description a:link{
				text-decoration: none;
				color: black;
				}
				.description a:visited{
					text-decoration: none;
					color: black;
					}
			.description a:hover{
				text-decoration: underline;
				color: black;
				}</style>
			</div>
			<div class="element" style="margin-top:8px; margin-left: 10px;">
	      <span style="font-size:14px;color:#000000; "><?php echo $price;?> 원</span>
			</div>

	</div>




<?php
			}
	}
?>
</div>
<!--  판매자인지 검사  -->

<?php
if (isset($_SESSION['user_data']))
{
	//echo "logining";
	$login = true;

	$user_id = $_SESSION['user_data'];

	$sql = 'SELECT * FROM member WHERE id="'.$user_id.'"';
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	// 로그인한 계정의 타입 저장
	$type = $row['mtype'];

	if ($type == 'seller')
	{

?>

<div class="list_control">
	<p class="list_update" style="border: 30px solid #FFFFFF;float: right;">
		<a href ="./product_new.php">
			<input type="submit" style="width: 100px;height: 30px;" value=" 상품추가 " />
		</a>
	</p>
</div>

<?php
	}
}
?>


  	<div id="footer">
			<img src="./img_main/bottom.png" alt="">
		</div>
		<div id="footer">
			<img src="./img_main/footer.png" alt="">
		</div>
	</body>
</html>
