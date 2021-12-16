<?php

    //code block below will delete everything inside 'upload' and 'download' folder, everytime when index.php loads
    $files = array_merge(glob('uploads/*'), glob('download/*'));  //this line will get all files inside 'upload' and 'download' folder
    foreach ($files as $file) {
        if (is_file($file)) {
            //delete all files if have any
            unlink($file);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>PDF.TXT - Online Pdf to Txt Converter</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Carter+One&family=Dosis:wght@600&family=Lato&family=Roboto:wght@500&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/b30c3ea7ee.js" crossorigin="anonymous"></script>
        <style>

            .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
            }

            .loader-dialog{
                width: 136px;
                margin: auto;
                text-align: center;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            body {
                width: 100%;
                padding-top: 60px;
                margin: 0px;
            }

            .fixed-header {
                width: 100%;
                height: 54px;
                position: fixed;
                background: #0059ff;
                padding: 5px 0;
                padding-left: 0px;
                z-index: 1;
                color: #fff;
            }

            .fixed-footer {
                width: 100%;
                position: relative;
                background: #0059ff;
                padding: 20px 0;
                padding-left: 0px;
                color: #fff;
            }

            .fixed-header {
                top: 0;
            }

            .fixed-footer {
                text-align: center;
                bottom: 0;
            }

            .container {
                text-align: center;
                width: 80%;
                margin: 0 auto;
            }

            .container .box {
                width: 100%;
                background: #fff;
                border: 5px solid #b2cdff;
                padding: 50px 0 30px;
                border-radius: 35px;
                color: #333;
                font-family: Lato;
            }

            .container .box2 {
                width: 100%;
                padding: 30px 0;
                /* border-radius: 10px; */
                color: #333;
                /* border: 2px solid #333; */
                margin-bottom: 50px;
                margin-top: 20px;
            }

            .container .title {
                text-align: center;
                width: 100%;
                padding: 50px 0;
                font-family: Dosis;
                font-style: normal;
                font-weight: 600;
                font-size: 30px;
                text-align: center;
            }

            nav a {
                color: #fff;
                text-decoration: none;
                padding: 7px 25px;
                display: inline-block;
            }

            nav a.scroll {
                color: #fff;
                float: right;
                text-align: right;
                font-family: 'ROBOTO', sans-serif;
                font-style: normal;
                font-weight: 500;
                font-size: 16px;
                line-height: 63px;
                padding: 0px;
            }

            nav a.active {
                color: #fff;
                float: left;
                text-align: left;
                padding: 0px;
                font-family: 'Carter One', cursive;
                font-style: normal;
                font-weight: normal;
                font-size: 36px;
            }

            .upload {
                margin-top: 30px;
            }

            .submit {
                margin-top: 30px;
            }

            input[type="file"] {
                display: none;
            }

            .custom-file-upload {
                margin-top: 30px;
                background-color: #0059ff;
                color: #fff;
                border: none;
                border-radius: 10px;
                display: inline-block;
                padding: 12px 24px;
                cursor: pointer;
            }

            .submit .button {
                background-color: #0059ff;
                padding: 15px 62px;
                border-radius: 25px;
                text-align: center;
                color: #fff;
                border: none;
            }

            .column {
                width: 33.33%;
                float: left;
                font-family: Lato;
                font-style: normal;
                font-weight: normal;
                font-size: 24px;
            }

            .col-2 {
                width: 24px;
                height: 24px;
                float: left;
                margin-right: 10px;
                font-family: Lato;
                font-style: normal;
                font-weight: normal;
                background-color: #0059FF;
                border-radius: 50%;
                font-size: 20px;
                color: #fff;
            }

            .col-10 {
                width: 83.33%;
                float: left;
                font-family: Lato;
                font-style: normal;
                font-weight: normal;
                font-size: 20px;
                text-align: left;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
                margin-bottom: 50px;
            }

            .image {
                border-radius: 50%;
            }

            h1 {
                /* h1 */
                margin: 0px;
                font-family: Dosis;
                font-style: normal;
                font-weight: 600;
                font-size: 36px;
                line-height: 50px;
                text-align: center;
                color: #000000;
            }

            .how {
                display: block;
                margin: 40px 0 40px;
                font-family: Dosis;
                font-style: normal;
                font-weight: 600;
                font-size: 36px;
            }

            .semi-transparent {
                font-family: Lato;
                font-style: normal;
                font-weight: normal;
                font-size: 24px;
                line-height: 29px;
                color: #8C8C8C;
            }

            .small-h3 {
                font-family: 'Lato', sans-serif;
                font-style: normal;
                font-weight: 400;
                font-size: 24px;
                line-height: 29px;
            }
        </style>
        <script>
            function getName(){
                var fu1 = document.getElementById("fileToUpload").value;
                document.getElementById('filenametitle').innerHTML = fu1.split("\\").pop();
            }

            function showLoader(){

                document.getElementById('upload-dialog').style.display = 'none';
                document.getElementById('loader-dialog').style.display = 'block';
            }
        </script>
    </head>

    <body>
        <section id="navbar">
            <div class="fixed-header">
                <div class="container">
                    <nav>
                        <a class="active" href="/"><i class="fas fa-cloud-upload-alt"></i> PDF.TXT</a>
                        <a class="scroll" href="#how-to-convert">HOW TO CONVERT?</a>
                    </nav>
                </div>
            </div>
        </section>

        <section id="main-body">
            <div class="container">
                <section id="app-title">
                    <div class="title">
                        <h1><i class="fas fa-cloud-upload-alt" style="color: #0059FF"></i> Online Free PDF to TXT</h1>
                        <h1>Converter</h1>
                    </div>
                </section>
                <section id="hidden-loader">
                    <div class="loader-box">
                        
                    </div>
                    
                </section>
                <section id="upload-file-part">
                    <form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="showLoader()">
                        <div class="box">
                            <div id="upload-dialog">

                                <b class="semi-transparent" id="filenametitle">Choose File To Upload</b><br>
                                <label for="fileToUpload" class="custom-file-upload"><i class="far fa-folder-open"></i> Upload File</label>
                                <div class="upload">
                                    <input type="file" name="fileToUpload" id="fileToUpload" onchange="getName()"/>
                                </div>
                            </div>
                            <div class="loader-dialog" id="loader-dialog" style="display: none;">
                                <div class="loader">

                                </div>
                                <div class="loader-text">
                                    <p class="semi-transparent">Please wait while we converting...</p>
                                </div>
                            </div>
                        </div>

                        <div class="submit">
                            <input type="submit" class="button small-h3" value="Convert To TXT!">
                        </div>
                    </form>
                </section>

                <section id="how-to-convert">
                    <div class="box2">
                        <hr>
                        <b class="how">How to Convert Pdf to Txt file?</b><br>
                        <p></p>
                        <p></p>
                        <div class="row">
                            <div class="column">
                                <div class="col-2">
                                    1
                                </div>
                                <div class="col-10">

                                    Upload your selected PDF File
                                </div>
                            </div>
                            <div class="column">
                                <div class="col-2">
                                    2
                                </div>
                                <div class="col-10">
                                    Click on the "Convert" Button
                                </div>
                            </div>
                            <div class="column">
                                <div class="col-2">
                                    3
                                </div>
                                <div class="col-10">

                                    Your converted TXT file is ready!
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
                </section>
            </div>
        </section>

        <section id="footer">
            <div class="fixed-footer">
                <div class="container">Copyright &copy; 2021 PDF.TXT</div>
            </div>
        </section>
        
    </body>

</html>