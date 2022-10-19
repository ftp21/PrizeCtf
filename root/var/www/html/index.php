<?php
$logged=0;
if(isset($_GET['act']) && isset($_GET['dir'])){
        if ($_GET['act']=='backup'){
		if(str_starts_with($_GET['dir'], '/var/www/html')){
			echo shell_exec("/bin/setuid /opt/backup.sh ".$_GET['dir']." 2>&1");
		}else{
			echo "Now allowed directory, directory must be in /var/www/html";
		}
        }
}


if (isset($_POST['uname']) && isset($_POST['psw'])){
	$login=file_get_contents("login.txt");
	if (trim($login)==$_POST['uname'].':'.$_POST['psw']){
		$logged=1;
	}else{
		$logged=-1;
	}
}


if($logged==0 || $logged==-1){
	if($logged==-1){
		echo '<div><h2>INVALID LOGIN</h2></div>';
	}
?>

<form action="index.php" method="post">
	<label for="uname"><b>Username</b></label>
	<input type="text" placeholder="Enter Username" name="uname" required>

    	<label for="psw"><b>Password</b></label>
	<input type="password" placeholder="Enter Password" name="psw" required>
	<button type="submit">Login</button>
</form>
<?php 
}else{ 
	echo "Backup list:";


$arrFiles = array();
$handle = opendir('backup/');
 
if ($handle) {
    echo "<br>";
    while (($entry = readdir($handle)) !== FALSE) {
	echo $entry."<br>";
    }
}
 
closedir($handle);

?>
<form action="index.php" method="get">
        <label for="backup"><b>Backup directory</b></label>
        <input type="text" placeholder="Enter directory" name="dir" required>
	<input type="hidden" name="act" value="backup"/>

        <button type="submit">Backup</button>
</form>
<?php } ?>
