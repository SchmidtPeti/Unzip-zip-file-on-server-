<html>
<head>
  <title>Zip your files</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?php
    if(isset($_POST["extract"])){
        //$dirname = '';
        $zip = new ZipArchive();
        $res = $zip->open($_POST["zip_name"]);
        $dst = './';
        $was_Extracion = false;

        if($res==true){
            $zip->extractTo($dst);
            $zip->close();
            echo '<div class="alert alert-success">
            <strong>Success!</strong> Zip is extracted.
            </div>';
            $was_Extracion = true;
        }
        else{
            echo '<h2>Zip extraction is failed!</h2>';
        }


        if($_POST["folder_name"]!=""&&$was_Extracion){
            echo'<div class="alert alert-info">
                <strong>info!</strong> Waiting for copying all the files here from that specified folder...
            </div>';
            try {
                rcopy($_POST["folder_name"], $dst);
            }
            catch (Exception $exception){
                echo '<div class="alert alert-danger"><strong>Error</strong>You gave me folder which was not in the zip folder</div>';
            }
            echo '<div class="alert alert-success">
                    <strong>Success!</strong> Move out all of the files here from the folder!.
            </div>';
        }
        function rcopy($src, $dst) {
            if (file_exists ( $dst ))
                rrmdir ( $dst );
            if (is_dir ( $src )) {
                mkdir ( $dst );
                $files = scandir ( $src );
                foreach ( $files as $file )
                    if ($file != "." && $file != "..")
                        rcopy ( "$src/$file", "$dst/$file" );
            } else if (file_exists ( $src ))
                copy ( $src, $dst );
        }    }
    ?>
<h2>Extract your zip file from server</h2>
<p>Place the "openzip.php" file to the root folder and move your zip file there</p>
<p>You can set a folder name(which is in the zip file) and all of its content will be put here</p>
<form method="post">
  <div class="form-group">
    <label for="zip_folder">Found zip files in this folder:</label>

    <select multiple class="form-control" name="zip_name" id="zip_folder">
	<?php
	 $files = glob('*.zip');
	 if(!$files!==null) {
         if (count($files) < 1) {
             echo '<option value="" disabled>Place your zip file in the folder where this file is</option>';
         } else {
             for ($i = 0; $i < count($files); $i++) {
                 echo '<option value="' . $files[$i] . '">' . $files[$i] . '</option>';
             }
         }
     }
	?>
    </select>
  </div>
  <div class="form-group">
    <label for="folder_name">Folder in the zip file:</label>
	<input id="folder_name" type="text" class="form-control" name="folder_name" placeholder="You use this when there is a folder in your zip.file(input the name of this folder) or leave it empty" value="">
  </div>
  <div class="form-group">
  <input type="submit" name="extract" class="btn btn-success" value="Extract">
  </div>
</form>
</div>
</body>
</html>