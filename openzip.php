<?php
if(isset($_GET["submit"])){
	$zip_name = basename($_FILES["zip_file_name"]["name"]);
}
//without (wordpress)basename do nothing
if(!isset($zip_name)){
//unpack to a dir called sth for example(wordpress,drupal)
$zip = new ZipArchive;
if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/wordpress-4.9-hu_HU.zip') === TRUE) {
 
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
 <!--ask the version of wordpress-->
<form method="get" enctype="multipart/form-data">
	<label for="verzio">zip place(to decide the version)</label>
	<input type="file" name="zip_file_name">
    <input type="submit" value="Send zip file name" name="submit">
</form> 