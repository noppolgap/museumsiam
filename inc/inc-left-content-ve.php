<div class="part-left-title-page">
	<div class="box-title-page">
		<a href="ve.php"><img src="images/th/title-ve.png"/></a>
	</div>
</div>

<?
	$MID = "";
	if ((!isset($_GET['MID'])) OR ($_GET['MID'] == '')){
		$MID = $visual_exhibition;
	}else{
		$MID = $_GET['MID'];
	}

	$MID_S = "&MID=".$MID;

 ?>

<form name="search" action="?search<?=$MID_S?>" method="post">
	<div class="part-left-search">
		<div class="box-search">
			<input type="text" name="str_search" value="<?=$_SESSION['text'] ?>"  placeholder="ค้นหา">
		</div>
	</div>
</form>

<div class="part-menu-left">
	<div class="box-menu-left">
		<ul class="menu-left">
			<li class="menu1"><a href="ve.php?MID=<?=$MID?>"><?=$mainPageCap?></a></li>
			<li class="menu2 sub"><a href="ve-exhibition.php?MID=<?=$MID?>">นิทรรศการ</a>
				<ul class="submenu-left">
					<li class="submenu1"><a href="ve-permanent.php?MID=<?=$MID?>">นิทรรศการถาวร</a></li>
					<li class="submenu2"><a href="ve-temporary.php?MID=<?=$MID?>">นิทรรศการชั่วคราว</a></li>
				</ul>
			</li>
			<li class="menu3"><a href="ve-category.php?c=19">นิทรรศการเสมือนจริง</a></li>
			<li class="menu4"><a href="ve-category.php?c=18">เยี่ยมชมพิพิธภัณฑ์</a></li>
		</ul>
	</div>
</div>
