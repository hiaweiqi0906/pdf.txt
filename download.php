<?php
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('download/out.txt'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('download/out.txt'));
    readfile('download/out.txt');

    $files = array_merge(glob('uploads/*'), glob('download/*')); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
}
    exit;
?>