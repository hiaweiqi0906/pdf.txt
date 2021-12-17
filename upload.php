<?php

  $file_target_directory = "uploads/"; //this is directory for files to upload
  $temp = explode(".", $_FILES["fileToUpload"]["name"]); //to get file extension (pdf in this case)
  $new_file_name = "pdf_to_convert" . '.' . end($temp);//to get file name
  $target_file = $file_target_directory . $new_file_name; //to get full file name with extension (eg: test.pdf)

  $uploadFlag = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check the file size to see if exceeded
  if ($_FILES["fileToUpload"]["size"] > 1000000000) {
    echo "Hey! The file is too large.";
    $uploadFlag = 0;
  }

  // Allow certain file formats
  if($imageFileType != "pdf") {
    echo "Sorry, only PDF files are allowed.";
    $uploadFlag = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Hey! The file was already exists.";
    $uploadFlag = 0;
  }

  // Check if pdf file is a actual pdf or fake pdf
  if(isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is a pdf - " . $check["mime"] . ".";
      $uploadFlag = 1;
    } else {
      echo "File is not a pdf.";
      $uploadFlag = 0;
    }
  }

  // Check if $uploadFlag is set to 0 by an error
  if ($uploadFlag == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {

    //check if file was successfully uploaded
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //execute command cd, compile and run java program with java lib(pdfbox) to convert pdf to txt
      exec("cd /var/www/testphpandjava/java/src/com/example/helloworld/ && javac -cp \".:pdfbox-app-2.0.24.jar\" PDFConverter.java && java -cp \".:pdfbox-app-2.0.24.jar\" PDFConverter", $output);
      
      //after command line was executed, run 'finish.php' to show the output page for user to download
      include 'finish.php';
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
?>