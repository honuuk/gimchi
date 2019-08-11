<?php
require_once('top_view.php');
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$p_id = $_GET['p_id'];


	$conn = mysqli_connect($servername,$username,$password_db, $dbname);

	$result = mysqli_query($conn, "SELECT p_id, s_id, name, category1, category2, price, measure, start_time, content, img_dir FROM product where p_id = $p_id");

	if ($result->num_rows == 1){
    $row = $result->fetch_assoc();

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

		$num = 1;
	}
}
?>

<div class="wrap">
	<div class="pic">
		<img src="<?php echo $img_dir;?>" width="500px" height="400px" />
	</div>
	<div class="inform">
		<div class="tit">
			<strong><?php echo $name;?></strong>
		</div>
		<div class="item">
			<form name="buy" action="order.php" method="get">
			<input type="hidden" name ="pid" value="<?php echo $p_id;?>"/>
				<ul>
					<li>
						<strong>판매가</strong>
						<div >
							<strong><?php echo $price;?></strong><span>원 (1kg 당 가격)</span>
						</div>
					</li>
<br/>
					<li>
						<strong>단위</strong>
						<div >
							<select name="unit">
							<?php
								$a=(int)substr($measure,0,-2);
								for($i=1;$i<=$a;$i++){
									?><option value='<?php echo $i;?>'><?php echo $i;?>kg</option>
									<?php
								}
							?>
							</select>
						</div>
					</li>
					<br/>
					<li>
						<strong>수량</strong>
						<div >
							<input type="text" name="num" value="<?php echo $num; ?>">
						</div>
					</li>
					<br/>
				</ul>
				<div class="btn" style="float:left;">
      <input type="submit" class="order" value="주문하기">
    </div>
			</form>
		</div>
	</div>

</div>

<style>
.wrap{
width: 1200px;
margin:50px auto;
display:grid;
grid-template-columns: 1fr 2fr;
}
.inform{width: 100%;}
.tit{border-bottom: 1px solid #707070;}
.tit strong{font-size: 25px;}
.pic, .inform{
	float:left;
}
.pic{padding-right:40px;}
.item ul{list-style: none;padding-left: 5px;}
.item ul li {display: table;}
.item ul li > strong{width: 80px;}
.item ul li > strong, .item ul li div{display:table-cell;}



</style>
 <div id="footer">
	 <img src="./img_main/bottom.png" alt="">

 </div>
 <div id="footer">
		 <img src="./img_main/footer.png" alt="">
 </div>
			</body>
		</html>
