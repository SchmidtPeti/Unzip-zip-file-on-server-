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
<h2>Zipper for extracting your files free</h2>
<form method="post">
  <div class="form-group">
    <label for="zip_folder">Zip folder:</label>
    <select multiple class="form-control" name="zip_name" id="zip_folder">
	<?php
	 $files = glob('*.zip');
	 for($i=0;$i<count($files);$i++){
		 echo '<option>'.$files[$i].'</option>';
	 }
	?>
    </select>
  </div>
  <div class="form-group">
    <label for="folder_name">Folder in the zip file:</label>
	<input id="folder_name" type="text" class="form-control" name="folder_name" placeholder="Folder in the zip or leave empty" value="">
  </div>
  <div class="form-group">
  <input type="submit" name="extract" class="btn btn-success" value="Extract">
  </div>
<?php
if(isset($_POST["extract"])){
 //$dirname = '';
 $zip = new ZipArchive();
 $res = $zip->open($_POST["zip_name"]);
 if($res==true){
	 $zip->extractTo($_SERVER['DOCUMENT_ROOT']);
	 $zip->close();
	 echo '<div class="alert alert-success">
  <strong>Success!</strong> Zip is extracted.
</div>';
 }
 //$dir = glob($dirname.'*',GLOB_ONLYDIR);
 //print_r($dir);
 $dst = $_SERVER['DOCUMENT_ROOT'];
 if($_POST["folder_name"]!=""){
	echo'<div class="alert alert-info">
  <strong>info!</strong> Waitinf for copying....
</div>';
 recurse_copy($_POST["folder_name"],$dst);
 echo '<div class="alert alert-success">
  <strong>Success!</strong> Copy all file from folder is done!.
</div>';
 }
 else{
	echo '<div class="alert alert-success">
  <strong>Success!</strong> Copy all file from folder is done!.
</div>'; 
 }
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
}
?>
</form>
</div>