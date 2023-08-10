<?php
//  define owner of a directory
// sudo chown -R daemon /opt/lampp/htdocs/photoalbum_data
// give right to everyone 
// chmod 777 /opt/lampp/htdocs/photoalbum_data
// 
//
$serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
$datapath   = "/www/photoalbum_data/";
$targetDirectory= "$serverpath" . "$datapath";
//$targetDirectory= "/opt/lampp/htdocs/photoalbum_data/";
$targetFile= $targetDirectory.basename($_FILES['userfile']['name']);
$uploadSuccess= move_uploaded_file($_FILES['userfile']['tmp_name'],$targetFile);
if($uploadSuccess){
    echo "upload successful";
    echo "<script>window.location='https://raikkulenz.kapsi.fi/photoalbum/delete1.php'</script>";
}
else{
    echo "failed";
}

?>
