<?php

echo("<html><head><title>File upload</title></head><body><p>Input form new sketch</p><p>Do not upload a file which is already here with same name!</p><form action='sketchupload.php' method='POST' enctype='multipart/form-data'><input type='text' name='text' value='write description of picture'><br><br><input type='number' name='rotate' value='270'><br> <br><input type='file' name='userfile'accept='image/png, image/jpeg'><br><br> <br><input type='submit' value='Upload File'></form></body></html>");

include'connect_DB.php';
//utility to transform the sql result into array variable
include '../photoalbum/utility.php';


//read picture info from database
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="SELECT * FROM sketches";
$stmt=$pdo->prepare($query);
$stmt->execute();
$results=$stmt->fetchAll();
$PictureInformations = objectToArray($results);
$pdo=null;

echo("<br>");
$photo_number=count($PictureInformations);
echo($photo_number);
echo("<br>");

$filenameTemp=array();
$complete_path=array();
//XAMPP puoli
//$serverpath = "/opt/lampp/htdocs";
//$datapath   = "/photoalbum_data/";
// kapsi puoli
$serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
$datapath   =  "/www/photoalbum_data/";
$datadir    = "$serverpath" . "$datapath";


$files = scandir($datadir);
$files = array_diff(scandir($datadir), array('.', '..', '.vscode','photoshow.php','photoshow1.php','who.php'));

$counter=0;
//create an array with pictures


foreach($files as $file)
{       $filenameTemp[$counter] = $file;
        $counter+=1;
}

$filename=array();

// sort images, so that the names are corresponding

for($i=0;$i<$photo_number;$i++)
  {

      for($j=0;$j<$photo_number;$j++)
        {
          if($PictureInformations[$i]['file']==$filenameTemp[$j])
            {
              $filename[$i]=$filenameTemp[$j];
            }
        }
  }


  echo("<form action='".$_SERVER['PHP_SELF']."' method='post'>");



//<!--  write out file list is also a form -->
//<!--  each line has a delete button -->
/*<form action=<?php echo ($_SERVER['PHP_SELF'])?> method="post">*/

//Administration page, each picture has a button to delete the respective picture



for($u=0;$u<$photo_number;$u++)
    {
        echo("<input id='");
        echo($PictureInformations[$u]['id']);
        echo("' name='submit' type='submit' value='");
        echo($u);
        echo("'>"); 
        echo('<p>');
        echo($PictureInformations[$u]['id']);
        echo(": ");
        echo($PictureInformations[$u]['file']."</p>");
    }

//localhost XAMPP
//echo("<a href='http://100.115.92.199:8000/photoalbum_data/photoshow1.php'>goto show</a>");
// kapsi puoli
echo("<a href='https://raikkulenz.kapsi.fi/photoalbum_data/photoshow1.php'>goto show</a>");

// main program to delete a file with the index $ID


if(isset($_POST['submit']))
    {
    $ID =  intval($_POST['submit']);

    //delete_file($PictureInformations[$ID]['file']);

    //XAMPP puoli
    //$serverpath = "/opt/lampp/htdocs";
    //$datapath   = "/photoalbum_data/";
    // kapsi puoli
    $serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
    $datapath   =  "/www/photoalbum_data/";
    $datadir    = "$serverpath" . "$datapath";
    //print_r($filename);
    $old = getcwd(); 
    chdir($datadir); 
   // chmod($filename,777);
   echo("<br>");

   echo($PictureInformations[$ID]['id']);
   echo("<br>");
   var_dump($ID);
   echo("<br>");
   $query="DELETE FROM `sketches` WHERE `sketches`.`id` = ".$PictureInformations[$ID]['id'];
   var_dump($query);
   echo("<br>");
   echo($PictureInformations[$ID]['file']);
   echo("<br>");


    if (!unlink($PictureInformations[$ID]['file'])) {
        echo ("File cant be deleted!");
     } else {
        echo ("File deleted!");
     }
     chdir($old);


    include'connect_DB.php';
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    //$query="SELECT * FROM sketches";
    //$query="DELETE FROM `sketches` WHERE `sketches`.`id` = ".$ID;
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $results=$stmt->fetchAll();
    $pdo=null;
    //XAMPP localhost
    //echo "<script>window.location='http://100.115.92.199:8000/photoalbum/sketchadmin.php'</script>";
     //kapsi
     echo "<script>window.location='https://raikkulenz.kapsi.fi/photoalbum/sketchadmin.php'</script>";

}


?>    


