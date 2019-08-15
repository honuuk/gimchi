<?php

require_once("top_view.php");

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error)
{
	die("DB Connection failed: " . $conn->connect_error);
}



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

	$user_id = $_SESSION['user_data'];
	$user_id = mysqli_real_escape_string($conn, trim($user_id));

	$sql = 'SELECT * FROM member WHERE id="'.$user_id.'"';
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	// 로그인한 계정의 타입 저장
	$type = $row['mtype'];
}
else
{
	$login = false;

	echo '<script>alert("로그인 후 시도해주세요.");location.href="login.php";</script>';
	exit;
}

if ($type == 'buyer')
{
	// post로 받았으면
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$user_name = $_POST['username'];
		$user_phone = $_POST['userphone'];
		$user_address = $_POST['useraddress'];

		// 유효성 검사
		// but order.php 에서처럼 오류가 날 수 있다.

		// 유효성 검사 통과시
		$user_name = mysqli_real_escape_string($conn, trim($user_name));
		$user_phone = mysqli_real_escape_string($conn, trim($user_phone));
		$user_address = mysqli_real_escape_string($conn, trim($user_address));

		$sql = "UPDATE buyer SET name='".$user_name."', phone='".$user_phone."', address='".$user_address."' WHERE b_id='".$user_id."'";
		$result = $conn->query($sql);

		if ($result)
		{
			// 성공
			echo '<script>alert("성공적으로 수정되었습니다.");location.href="mypage_personal.php";</script>';
			exit;
		}
		else
		{
			// 실패
			echo '<script>alert("수정 실패.");history.back(-1);</script>';
			exit;
		}
	}
	// 처음 페이지에 접속했으면
	else
	{
		$sql = "SELECT * FROM buyer WHERE b_id='".$user_id."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$user_name = $row['name'];
		$user_phone = $row['phone'];
		$user_address = $row['address'];
	}
}
else if ($type == 'seller')
{
	// post로 받았으면
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$user_name = $_POST['username'];
		$user_phone = $_POST['userphone'];
		$user_bank = $_POST['userbank'];
		$user_account = $_POST['useraccount'];

		// 유효성 검사
		// but order.php 에서처럼 오류가 날 수 있다.

		// 유효성 검사 통과시
		$user_name = mysqli_real_escape_string($conn, trim($user_name));
		$user_phone = mysqli_real_escape_string($conn, trim($user_phone));
		$user_bank = mysqli_real_escape_string($conn, trim($user_bank));
		$user_account = mysqli_real_escape_string($conn, trim($user_account));

		$sql = "UPDATE seller SET name='".$user_name."', phone='".$user_phone."', bank='".$user_bank."', account='".$user_account."' WHERE b_id='".$user_id."'";
		$result = $conn->query($sql);

		if ($result)
		{
			// 성공
			echo '<script>alert("성공적으로 수정되었습니다.");location.href="mypage_personal.php";</script>';
			exit;
		}
		else
		{
			// 실패
			echo '<script>alert("수정 실패.");history.back(-1);</script>';
			exit;
		}
	}
	// 처음 페이지에 접속했으면
	else
	{
		$sql = "SELECT * FROM seller where s_id='".$user_id."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$user_name = $row['name'];
		$user_phone = $row['phone'];
		$user_bank = $row['bank'];
		$user_account = $row['account'];
	}
}
else if ($type == 'admin')
{
	header('Location: admin.php');
	exit;
}

?>

<style>

</style>
    <form id="joinForm" name="joinForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >
      <div id="join" style="background-color:white;">
        <div class="top">
          <h2>마이페이지</h2>
					<?php
					if ($type == 'seller')
					{
					?>
          <button type="button" class="mp-menu"><a href="mypage_product.php" style="color:black;">등록상품조회</a></button>
					<?php
					}
					?>
          <button type="button" class="mp-menu"><a href="mypage_order.php" style="color:black;">주문배송조회</a></button>
          <button type="button" class="mp-menu"><a href="mypage_personal.php" style="color:black;">개인정보수정</a></button>
        </div>
        <div id="join-form">
    			<div id="tit">
    				<h3>개인정보수정</h3>
    			</div>
          <div id="form_inner">
            <div>
    					<table border="0" summary="">
    						<caption></caption>
    						<colgroup>
    							<col style="width:163px;"/>
    							<col style="width:auto;"/>
    						</colgroup>
    						<tbody>
    							<tr>
    								<th scope="row">아이디</th>
    								<td>
    								  <span><?php echo $user_id; ?></span>
    								</td>
    							</tr>
    							<tr>
    								<th scope="row">이름</th>
    								<td>
    									<input id="passwd_confirm" class="txtfield" name="username" value="<?php echo $user_name; ?>" type="text"  /> <span id="pwConfirmMsg"></span>
    								</td>
    							</tr>
    							<tr>
    								<th scope="row" id="nameTitle">전화번호</th>
    								<td>
    									<input id="name" class="txtfield" name="userphone" value="<?php echo $user_phone; ?>" type="text"  />
    								</td>
    							</tr>
                  <?php

            				if ($type == 'seller')
            				{

            			?>
            			<tr>
            				<th scope="row">입금은행</th>
            				<td><input id="address" class="txtfield" type="text" name="userbank" value="<?php echo $user_bank; ?>"></td>
            			</tr>
            			<?php

            				}

            			?>
            			<tr>
            				<?php

            					if ($type == 'buyer')
            					{
            				?>
            				<th scope="row">주소</th>
            				<td><input id="address" class="txtfield" type="text" name="useraddress" value="<?php echo $user_address; ?>"></td>
            				<?php
            					}
            					else if ($type == 'seller')
            					{

            				?>
            				<th scope="row">계좌번호</th>
            				<td><input id="address" class="txtfield" type="text" name="useraccount" value="<?php echo $user_account; ?>"></td>
            				<?php
            					}
            				?>
            			</tr>
    						</tbody>
    					</table>
    				</div>
            <br/><br/>
            <div class="btn">
              <input type="submit" class="gaip" value="수정">
              <button type="button" class="cancel"><a href="./index.php">취소</a></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
	<div id="footer">
		<img src="./img_main/footer.png" alt="">
	</div>
</body>
</html>
