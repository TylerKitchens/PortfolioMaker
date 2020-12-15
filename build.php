<?php


$myJSON->name= $_POST["fullName"];
$myJSON->headShotSrc = $_FILES["headShot"]["name"];
$myJSON->aboutMe = $_POST["about"];
$myJSON->projects = [];
$myJSON->code = $_POST["code"];
$myJSON->resumeSrc = $_FILES["resume"]["name"];
$imgArr = [];

//Adding to arry for zipping
array_push($imgArr, $myJSON->headShotSrc);
imgUpload("headShot", $myJSON->code);
pdfUpload("resume", $myJSON->code);
for($x = 1; $x <= $_POST["projectCount"]; $x++){
    $project = new stdClass();
    $project->title = $_POST["title" . $x];
    imgUpload("coverImg" . $x, $myJSON->code);
    $project->coverImg = $_FILES["coverImg" . $x]["name"];
    array_push($imgArr, $_FILES["coverImg" . $x]["name"]);
    $project->slogan = $_POST["slogan" . $x];
    $project->year = $_POST["date" . $x];
    $project->platforms = explode(',', $_POST["platforms" . $x]);
    $project->tools = explode(',', $_POST["tools" . $x]);
    $project->descr = $_POST["about" . $x];

    array_push($myJSON->projects, $project);

}



$zip = new ZipArchive;
$zip->open('zips/' . $myJSON->code . '.zip', ZipArchive::CREATE);
for($i = 0; $i < count($imgArr); $i++){
  //Add images to zip folder
    $zip->addFile("uploads/" . $myJSON->code .  $imgArr[$i], 'img/' . $imgArr[$i] );
}
$JSON = json_encode($myJSON);
$infoFile = "data/" . $myJSON->code . ".JSON";
file_put_contents($infoFile, $JSON);
$zip -> addFile("pdfs/" . $myJSON->code . $myJSON->resumeSrc, $myJSON->resumeSrc);
$zip -> addFile($infoFile, "info.JSON");
$zip -> addFile("template1.html", 'index.html');
$zip -> addFile("template1.js");


$zip->close();


header('Content-disposition: attachment; filename=files.zip');
header("Content-Transfer-Encoding: Binary");
header('Content-type: application/zip');
readfile('zips/' . $myJSON->code . '.zip');


ob_clean();
ob_end_flush();

//Uploading Resumes
function pdfUpload($name, $code){
  //make it unique
  $target_dir = "pdfs/" . $code;
  $target_file = $target_dir . basename( $_FILES[$name]["name"]) ;
  $ok=1;
  $file_type= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  move_uploaded_file($_FILES[$name]["tmp_name"], $target_file);
 
}

function imgUpload($name, $code){
    $target_dir = "uploads/" . $code;
    $target_file = $target_dir . basename($_FILES[$name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
  $check = getimagesize($_FILES[$name]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}



// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES[$name]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?>