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
    $writer_id=$row['id'];
	if ($type != 'buyer')
	{
		echo '<script>alert("접근 권한이 없습니다.");location.href="notice.php";</script>';
		exit;
	}
}
else
{
	$login = false;

	echo '<script>alert("로그인 후 시도해주세요.");location.href="login.php";</script>';
	exit;
}

// post로 요청받은 데이터가 있을 경우
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$title = $_POST['title'];
	$content = $_POST['content'];

	// 날짜는 작성하는 현재 날짜로 설정
	$date = date('Y-m-d');

	if (empty($title) && !empty($content))
	{
		echo '<script>alert("제목을 입력하시오.");history.back(-1);</script>';
		exit;
	}
	else if (!empty($title) && empty($content))
	{
		echo '<script>alert("내용을 입력하시오.");history.back(-1);</script>';
		exit;
	}
	else if (empty($title) && empty($content))
	{
		echo '<script>alert("제목과 내용을 입력하시오.");history.back(-1);</script>';
		exit;
	}
	// 제목과 내용을 입력했을 경우
	else
	{
		$title = mysqli_real_escape_string($conn, trim($title));
		$content = mysqli_real_escape_string($conn, trim($content));

		$sql = 'INSERT INTO review (numbers, write_date, title, content, img_dir,writer_id) values(null, "'.$date.'", "'. $title.'", "'.$content.'", null,"'.$writer_id.'")';

		$result = $conn->query($sql);

		// query가 정상실행 되었다면,
		if($result)
		{
			// 자동 카운트된 숫자를 $no로 저장
			$no = $conn->insert_id;
			

			echo '<script>alert("정상적으로 글이 등록되었습니다.");location.href="review.php";</script>';
			exit;
		}
		else
		{
			echo '<script>alert("등록에 실패했습니다.");history.back(-1);</script>';
			exit;
		}

		// Close connection
		$conn->close();
	}
}

?>


    <div id="container">
			<div id="content">
				<div class="contents-inner cs-page">
					<div class="section">
    				<div class="section-header">
        			<h2 class="h2">후기</h2>
    				</div>
    				<div class="section-body">
	        		<div class="join-form">
	            	<form name="frmWrite" id="frmWrite" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="frmWrite">
	                
									<div class="table1 board-write">
										<table>
											<colgroup>
												<col style="width:133px;">
												<col>
											</colgroup>
											<tbody>
												<tr>
													<th class="ta-l">제목</th>
													<td>
														
															<input type="text" name="title" class="txt-field">
														
													</td>
												</tr>
												<tr>
													<th class="ta-l">본문</th>
													<td>
														<div class="txtarea">
															<textarea cols="30" name="content" rows="10" class="w100" id="editor"></textarea>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="btn">
										<input type="submit" class="save" value="저장">
									</div>
		            </form>
							</div>
						</div>
        	</div>
    		</div>
			</div>
		</div>
	</div>
</body>
</html>
