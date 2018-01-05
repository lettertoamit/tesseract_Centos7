<?php

    set_time_limit(0);
    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, urldecode($_REQUEST['link'] ) );
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    $image = curl_exec($curlSession);
    curl_close($curlSession);
    $ext = pathinfo($_REQUEST['link'] , PATHINFO_EXTENSION);
     $filenametxt = rand();
    $filename = $filenametxt.".".$ext;

    $myfile = fopen("{$filename}", "w") or die("Unable to open file!");
   fwrite($myfile, $image);
   fclose($myfile);
    $cmd = "export PATH=$PATH:/usr/local/bin/;export TESSDATA_PREFIX=/home/snvdev1/leptonica-1.73/tesseract-3.04.01/tesseract-ocr;tesseract $filename $filenametxt -l eng > debug.log  2>&1";
    //echo $cmd;
    system($cmd,$xyz);
    $a = shell_exec("wc -w $filenametxt.txt" ); //{$_GET['link']}  stdout 
    //die;
    unlink($filename);
    unlink("$filenametxt.txt");
    $a = explode(" ",trim($a)) ;
    echo $a[0];
?>
