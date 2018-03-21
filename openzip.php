<?php
$zip_name ="";
if(isset($_GET["submit"])){
	$zip_name = $_GET["zip_file_name"];
}
//without (wordpress)basename do nothing
if(!isset($zip_name)){
//unpack to a dir called sth for example(wordpress,drupal)
$zip = new ZipArchive;
if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/'.$zip_name) === TRUE) {
 
    $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/');
 
    $zip->close();
 
    echo 'ok';
 
} else {
 
    echo 'failed';
 
}
//move file from default dir to root dir
$files = scandir($_SERVER['DOCUMENT_ROOT']."/wordpress");
$source = $_SERVER['DOCUMENT_ROOT']."/wordpress/";
$destination = $_SERVER['DOCUMENT_ROOT']."/";
foreach ($files as $file) {
  if (in_array($file, array(".",".."))) continue;
  if (copy($source.$file, $destination.$file)) {
    $delete[] = $source.$file;
  }
	}
	foreach ($delete as $file) {
 		 unlink($file);
	}
}
?>
 <!--ask for file name-->
 <h2>Place put this file into that folder where your file is waiting for be extracted work for wordpress website</h2>
<form method="get">
	<input type="name" name="zip_file_name" placeholder="file name:">
    <input type="submit" value="Send zip file name" name="Extract">
</form> 