<head>
  <title>Unzipper->unzip your files</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<div class="container">
<h2>Wordpress, Drupal and oxwall unzipper</h2>
<?php
highlight_string('A root mappának teljesen üresnek kell lenni a zipelés során');
 $files = glob('*.zip');
 print_r($files);
 $dirname = '';
 $zip = new ZipArchive();
 $res = $zip->open($files[0]);
 if($res==true){
	 $zip->extractTo($_SERVER['DOCUMENT_ROOT']);
	 $zip->close();
	 echo "királyság";
 }
  $dir = glob($dirname.'*',GLOB_ONLYDIR);
  print_r($dir);
 function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
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
</div>