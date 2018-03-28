<?php
$zip_name ="";
if(isset($_GET["Extract"])){
	$zip_name ="";
	$zip_name = $_GET["zip_file_name"];
}
//without (wordpress)basename do nothing
if(isset($zip_name)&&$zip_name !=""){
//unpack to a dir called sth for example(wordpress,drupal)
$zip = new ZipArchive;
echo $_SERVER['DOCUMENT_ROOT'].'/'.$zip_name;
if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/'.$zip_name) === TRUE) {
 
    $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/');
 
    $zip->close();
 
    echo 'ok';
 
} else {
 
    echo 'failed';
 
}
$file_name = explode(".",$zip_name)[0];
//move file from default dir to root dir
if(is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$file_name)){
$files = scandir($_SERVER['DOCUMENT_ROOT'].'/'.$file_name);
$source = $_SERVER['DOCUMENT_ROOT'].'/'.$file_name;
$destination = $_SERVER['DOCUMENT_ROOT']."/";
foreach ($files as $file) {
  if (in_array($file, array(".",".."))) continue;
  if(is_dir($source.$file)){
      recurse_copy($source.$file,$destination.$file);
  }
  else{
  if(copy($source.$file, $destination.$file)) {
    $delete[] = $source.$file;
  }
	}
	foreach ($delete as $file) {
 		 unlink($file);
	}
  }
}
}
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
?>
 <!--ask for file name-->
 <h2>Place put this file into that folder where your file is waiting for be extracted work for wordpress website</h2>
<form method="get">
	<input type="name" name="zip_file_name" placeholder="file name:">
    <input type="submit" value="Send zip file name" name="Extract">
</form> 