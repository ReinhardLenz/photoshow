<?php
include '../templates/header.php';
include '../photoalbum/connect_DB.php';
include '../photoalbum/utility.php';

//read picture info from database
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="SELECT * FROM sketches";
$stmt=$pdo->prepare($query);
$stmt->execute();
$results=$stmt->fetchAll();
$PictureInformations = objectToArray($results);
$pdo=null;
/*
print_r($PictureInformations);
*/
echo("<br>");
$photo_number=count($PictureInformations);


/*
echo("<br>");
echo($photo_number);
echo("<br>");
*/
//print all the texts from database in normal order
/*
for($e=0;$e<$photo_number;$e++){
  echo("<br>");
  echo($PictureInformations[$e]['text']);
}


$serverpath = "/opt/lampp/htdocs";

$datapath   = "/photoalbum_data/";
$datadir    = "$serverpath" . "$datapath";
*/

$serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
$datapath   =  "/www/photoalbum_data/";
$datadir    = "$serverpath" . "$datapath";
$datapath_in_web   =  "/photoalbum_data/";



//subtract the php files in same directory from picture and create new array
$files = array_diff(scandir($datadir), array('.', '..',  '.vscode' , 'photoshow1.php','who.php'));
$imagesTemp = array();
$counter=0;
/*
echo("<br>");
echo("filesvariable");
echo("<br>");

print_r($files);
echo("<br>");
*/
//create new array
foreach($files as $file)
{       $imagesTemp[$counter] = $file;
        $counter+=1;
}


$images=array();

//"dirty way" to sort images, so that the names are corresponding

for($i=0;$i<$photo_number;$i++)
  {
    /*
    echo("<br>");
    echo($i);
    echo("<br>");
    echo($PictureInformations[$i]['file']);
    echo("<br>");
    */
      for($j=0;$j<$photo_number;$j++)
        {
          /*
          echo("<br>");
          echo("----".$j);
          echo("<br>");
          echo("----".$imagesTemp[$j]);
          */
          if($PictureInformations[$i]['file']==$imagesTemp[$j])
            {
              $images[$i]=$imagesTemp[$j];
              //$GLOBALS['$i']=$imagesTemp[$j];
            }
        }
  }

/*
echo("<br>");
echo("imagesvariable");
echo("<br>");

print_r( $images);
echo("<br>");


echo("<br>");
*/
//
// link to add or delete sketch 
//
echo("<a href='https://raikkulenz.kapsi.fi/photoalbum/sketchadmin.php'>aministration page</a>");
//echo("<a href='http://100.115.92.199:8000/photoalbum/sketchadmin.php'>administration page</a>");

echo("<br>");
echo("<br>");
echo("<br>");
echo("<br>");

//i want that the last picture is on top, so reverse order

$images_reverse=array_reverse($images);
$text_reverse=array_reverse($PictureInformations);
//show pictures together with titles adn rotate correctly

for($u=$photo_number-1;$u>=0;$u--)
  {
    //echo("Index: ".$u);
    //echo("<br>");
    //echo("name of image file: ".$PictureInformations[$u]['file']);
    //echo("<br>");
    echo($PictureInformations[$u]['text']);
    echo("<br>");
    //echo($PictureInformations[$u]['rotate']);
    //echo("<br>");
    //echo("<br>");

    //echo('<div class="sketch">');
    echo "<img src='{$datapath_in_web}".$PictureInformations[$u]['file']."' style='position:relative; z-index:-2; height:auto; width:300px; transform: rotate(".$PictureInformations[$u]['rotate']."deg)' >";
    //echo('</div>');

    echo("<br>");
    echo("<hr>");

  }

/*

foreach($images_reverse as $key=>$image){
    echo("Index: ".$key);
    echo("<br>");
    echo("name of image file: ".$images_reverse[$key]);
    echo("<br>");
    echo("text field:".$text_reverse[$key]['text']);
    echo("<br>");
    echo($text_reverse[$key]['rotate']);
    echo("<br>");
    echo "<img src='{$datapath}{$image}' style='height:auto;width:300px; transform: rotate(".$text_reverse[$key]['rotate']."deg)' >";
    echo("<br>");
  }
*/

include '../templates/footer.php';

?>

</body>
</html>