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
}

/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if(isset($_GET['page']))
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}

/* 검색 시작 */
if(isset($_GET['searchColumn']))
{
	$searchColumn = $_GET['searchColumn'];
	$subString = '&amp;searchColumn=' . $searchColumn;
}
if(isset($_GET['searchText']))
{
	$searchText = $_GET['searchText'];
	$subString .= '&amp;searchText=' . $searchText;
}

if(isset($searchColumn) && isset($searchText))
{
	$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
}
else
{
	$searchSql = '';
}
/* 검색 끝 */

//$sql = 'SELECT count(*) as cnt FROM notice ORDER BY numbers DESC';
$sql = 'SELECT count(*) as cnt FROM review'.$searchSql;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$allPost = $row['cnt']; //전체 게시글의 수

if(empty($allPost))
{
	$emptyData = '<tr><td colspan="5">글이 존재하지 않습니다.</td></tr>';
	$paging='';
}
else
{
  $onePage = 15; // 한 페이지에 보여줄 게시글의 수.
  $allPage = ceil($allPost / $onePage); //전체 페이지의 수

  // 0번 페이지거나 최대 페이지를 넘어갔을 경우
	if ($page < 1 || ($allPage && $page > $allPage))
	{
		echo '<script>alert("존재하지않는 페이지입니다.");location.href="notice.php";</script>';
		exit;
	}

  

  $paging = '<ul class="pagination">'; 

  

  for($i = 1; $i <= $allPage; $i++)
  {
  	if($i == $page)
    {
  		$paging .= '<li class="active">' . $i . '</li>';
  	}
    else
    {
  		$paging .= '<li class="active"><a href="review.php?page=' . $i . $subString . '">' . $i . '</a></li>';
  	}
  }

  $paging .= '</ul>';

  /* 페이징 끝 */
  $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
  $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

   //원하는 개수만큼 가져온다. (0번째부터 20번째까지
  //$sql = 'SELECT * FROM notice ORDER BY numbers DESC'.$sqlLimit;
  $sql = 'SELECT * FROM review '.$searchSql.' ORDER BY numbers DESC '.$sqlLimit;
  $result = $conn->query($sql);
}

?>

	 	<div id="container">
      <div id="content">
				<div class="contents-inner cs-page">
					<div class="section">
				    <div class="section-header">
							<h2 class="h2">후기</h2>
							<?php
							if ($type == 'buyer')
							{
							?>
							<a class="write" href="review_write.php"><em>글쓰기</em></a>
							<?php
							}
							?>
				    </div>
				    <div class="section-body">
			        <div class="table1" text-align="center">
		            <table style="width:100%" >
					<colgroup>
					<col style="width:72px">
                    <col>
                    <col style="width:100px">
	                </colgroup>
	                <thead>
		                <tr>
	                    <th scope="col" class="no">번호</th>
	                    <th scope="col" class="title">제목</th>
	                    <th scope="col" class="date">날짜</th>
		                </tr>
	                </thead>
	                <tbody>
										<?php
											if(isset($emptyData))
											{
												echo $emptyData;
											}
											else
											{
												// 모든 게시물 출력
												while ($row = $result->fetch_assoc())
												{
													$no = $row['numbers'];
													$title = $row['title'];
													$date = $row['write_date'];
										?>
										<tr style="height:10px">
											<td class="no"><?php echo $no; ?></td>
											<td class="title">
												<a href="review_view.php?no=<?php echo $no; ?>">
													<?php echo $title; ?>
												</a>
											</td>
											<td class="date"><?php echo $date; ?></td>
										</tr>
										<?php
												}
											}
										?>
	                </tbody>
		            </table>
			        </div>

							<div class="paging">
								<?php echo $paging; ?>
							</div>
					    <div class="searchBox">
								<form action="notice.php" method="get">
									<select name="searchColumn">
										<option value="title">제목</option>
										<option value="content">내용</option>
									</select>
									<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
									<button type="submit">검색</button>
								</form>
							</div>
				    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<img src="./img_main/footer.png" style="width:100%">
	</div>
</body>
</html>
