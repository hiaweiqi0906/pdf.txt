<?php
$target_dir = "uploads/";
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = "pdf_to_convert" . '.' . end($temp);
$target_file = $target_dir . $newfilename;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf") {
  echo "Sorry, only PDF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    exec("cd /var/www/testphpandjava/java/src/com/example/helloworld/ && javac -cp \".:pdfbox-app-2.0.24.jar\" HelloWorld.java && java -cp \".:pdfbox-app-2.0.24.jar\" HelloWorld", $output);
    include 'download.php';
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>