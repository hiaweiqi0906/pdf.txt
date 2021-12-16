<?php
    //code block below is to prepare and download the 'out.txt' from 'download' folder
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('download/out.txt'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('download/out.txt'));
    readfile('download/out.txt');

    //code block below is to delete everything inside 'upload' and 'download' folder
    $files = array_merge(glob('uploads/*'), glob('download/*')); 

    foreach($files as $file){
      if(is_file($file)) {
        //delete the folder using unlink()
        unlink($file);
      }
    }
    exit;
?>