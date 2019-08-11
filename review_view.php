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

	// 로그인한 계정의 타입, 아이디 저장
    $type = $row['mtype'];
    $current_id=$row['id'];
}
else
{
	$login = false;
}

//$_GET['no']이 있을 때만 $no 선언
if(isset($_GET['no']))
{
	$no = $_GET['no'];

  if (!empty($no))
  {
		$no = mysqli_real_escape_string($conn, trim($no));

    $sql = 'SELECT title, content, write_date, writer_id FROM review where numbers = '.$no;
    $result = $conn->query($sql);

    // numbers가 기본키이므로 존재하면 1개
    if ($result->num_rows == 1)
    {
      $row = $result->fetch_assoc();

      $title = $row['title'];
      $content = $row['content'];
      $date = $row['write_date'];
      $writer_id=$row['writer_id'];
    }
    else
    {
      echo '<script>alert("존재하지 않는 게시물입니다.");location.href="notice.php";</script>';
			exit;
    }

    // Close connection
    $conn->close();
  }
  else
  {
    echo '<script>alert("잘못된 접근입니다.");location.href="notice.php";</script>';
		exit;
  }
}
// get 방식으로 전달받지 못했다면
else
{
  echo '<script>alert("잘못된 접근입니다.");location.href="notice.php";</script>';
	exit;
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
        			<div class="board-view">
            		<div class="board-view-head">
                	<div class="board-view-title">
                    <h2>
                    	<?php echo $title; ?>
                    </h2>
                	</div>
                	<div class="board-view-info">
                    <div class="author">
											<span class="text1"><strong><?php echo $writer_id?></strong>
											</span>
											<span class="divide-bar">&nbsp;</span>
											<span class="text2"><?php echo $date; ?></span>
										</div>
									</div>
            			<div class="board-view-body">
		                <div class="textfield">
											<?php echo $content; ?>
		                </div>
			            </div>
								</div>
								<br/>
								<hr/>
								<div class="board-ctrl-btn">
									<?php
									if ($current_id == $writer_id)
									{
									?>
									<a class="boardview-list" href="review_update.php?no=<?php echo $no; ?>">
										<em>수정</em>
									</a>
					      	<a class="boardview-list" href="review_delete.php?no=<?php echo $no; ?>">
										<em>삭제</em>
									</a>
									<?php
									}
									?>
									<a class="boardview-list" href="review.php"><em>목록</em></a>
								</div>
								<br/>
    					</div>
						</div>
					</div>
					<div id="footer">
						<img src="./img_main/footer.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
