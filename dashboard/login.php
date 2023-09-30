<form method="post" action="login.php">
	<p><label>ID : <input type="text" name="id"></label></p>
	<p><label>PW : <input type="password" name="pw"></label></p>
	<p><input type="submit" value="Login :)"></p>
	<input type="radio" style="display:none" name="type" value="login" checked="checked">

</form>
<br>
<form method="post" action="login.php">
	<p><label>ID : <input type="text" name="id"></label></p>
	<p><label>PW : <input type="password" name="pw"></label></p>
	<p><label>PW : <input type="password" name="pw2"></label></p>
	<p><input type="submit" value="Sign UP :)"></p>
	<input type="radio" style="display:none" name="type" value="signup" checked="checked">
</form>
<?php
	$id = "asdf";
	$pw = "qwer";
   
	$fileName = "LoginLog.txt";
	$is_file_exist = file_exists($fileName);

	if (!$is_file_exist) {
		$file = fopen($fileName,"w");
		fwrite($file, "LoginLog");
		fclose($file);
		}
	if($_POST['type']==="login"){

		$input_id = $_POST['id'];
		$input_pw = $_POST['pw'];
		$ip = $_SERVER['REMOTE_ADDR'];
   
		$conn = mysqli_connect('localhost', 'root', '', 'test');
		if (mysqli_connect_errno()) { exit; }
		else{
			echo "youngmin babo<br>";
			$sql = "SELECT * FROM users WHERE id= '". $_POST['id']."' AND pw = '".md5($_POST['pw'])."'" ;
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			if (!isset($row)){echo "<script>alert('로그인 실패');</script>"; 
 				$file4 = fopen($fileName,"a");
 				fwrite($file4, "\r\n[".$ip."] input_id: ".$input_id." input_pw: ".$input_pw);
 				fclose($file4);
				return;}
			else {echo "로그인 성공 ㅊㅊ";}
 		}
		
	}
	if($_POST['type']==="signup"){
		$conn = mysqli_connect('localhost', 'root', '', 'test');
		if (mysqli_connect_errno()) { exit; }
		else{
			echo "youngmin babo<br>";
			if($_POST['id']==='') {echo "<script>alert('아이디를 입력해주세요.');</script>"; return;} 									if($_POST['pw']==='') {echo "<script>alert('비밀번호를 입력해주세요.');</script>"; return;}
			if($_POST['pw2']==='') {echo "<script>alert('hihi.');</script>"; return;}
		
			if(!($_POST['pw']===$_POST['pw2'])) {echo "<script>alert('different');</script>"; return;}
			$sql = "INSERT INTO users (id, pw) VALUES ('".$_POST['id']."' , '".md5($_POST['pw'])."')";
			mysqli_query($conn, $sql);
 		}

	}
?>