<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

//  define owner of a directory
// sudo chown -R daemon /opt/lampp/htdocs/photoalbum_data
// give right to everyone 
// chmod 777 /opt/lampp/htdocs/photoalbum_data
// 
//
//connect to database
include'connect_DB.php';
//utility to transform the sql result into array variable
include '../photoalbum/utility.php';
/*$temporaryDebug = objectToArray($_FILES);
print_r($_FILES);
echo("<br>");

$_FILES= array("userfile"=>array
               ( "name" => "IMG_20230606_090434.jpg" ,
                "full_path" => "IMG_20230606_090434.jpg" ,
                "type" => "image/jpeg" ,
                "tmp_name" => "/opt/lampp/temp/phpVhmV5U" ,
                "error" => "0",
                 "size" => "80769"));

print_r($_FILES);
echo("<br>");
$temporaryDebug = objectToArray($_POST);
print_r($temporaryDebug);
*/
echo("<br>");
/*
$_POST=array
     (
          "text"=>"description of picture",
          "rotate"=>"270",
          "submit"=>"1"
     );
print_r($_POST);
echo("<br>");
*/

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="SELECT id FROM sketches";
$stmt=$pdo->prepare($query);
$stmt->execute();
$results=$stmt->fetchAll();
$idArray = objectToArray($results);
$pdo=null;

$maxValue=(max($idArray));
$valueImplode=intval(implode("",$maxValue));


var_dump($valueImplode);



$TempName=$_POST['text'];
$TempRotate=$_POST['rotate'];
$TempFile=$_FILES["userfile"]['name'];

echo '<pre>' . var_dump($_FILES) . '</pre>';
echo '<pre>' . var_dump($_FILES["userfile"]['name']) . '</pre>';

//echo '<pre>' . var_dump($_FILES['name']) . '</pre>';


//----------
$path = $_FILES["userfile"]['full_path'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

echo '<pre>' . var_dump($_FILES) . '</pre><br>';
echo '<pre>' . var_dump($_FILES["userfile"]['name']) . '</pre><br>';
echo '<pre>' . var_dump($path) . '</pre><br>';
echo '<pre>' . var_dump($ext) . '</pre><br>';


//exit();


/*
echo($temporaryDebug['userfile']['tmp_name']);
echo("/");
echo($_FILES['userfile']['name']);
*/
include'connect_DB.php';
//connect to database read row number 
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="SELECT COUNT('id') FROM `sketches`";
$stmt=$pdo->prepare($query);
$stmt->execute();
$results=$stmt->fetchColumn();
$n=$results;

if($valueImplode>=$n)
    {$n=$valueImplode+1;}


//$query="INSERT INTO `sketches` (`id`, `rotate`, `file`) VALUES ('6', '270', 'test', '0', '0', '0', '0')";


$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="INSERT INTO `sketches` (`id`, `rotate`, `text`, `file`) VALUES ('".$n."', '".$TempRotate."', '".$TempName."', '".$TempFile."')";

//$query="INSERT INTO `sketches` (`id`, `rotate`, `text`, `file`) VALUES ('".$n."', '".$TempRotate."', '".$TempName."', '".$path."')";


$stmt=$pdo->prepare($query);
$stmt->execute();
//$results=$stmt->fetchAll();
//$PictureInformations = objectToArray($results);
$pdo=null;
$serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
$datapath   = "/www/photoalbum_data/";
$targetDirectory= "$serverpath" . "$datapath";
//$targetDirectory= "/opt/lampp/htdocs/photoalbum_data/";

$targetFile= $targetDirectory.basename($_FILES['userfile']['name']);
$uploadSuccess= move_uploaded_file($_FILES['userfile']['tmp_name'],$targetFile);
if($uploadSuccess){
    echo "upload successful";
    echo "<script>window.location='https://raikkulenz.kapsi.fi/photoalbum/sketchadmin.php'</script>";
    //echo "<script>window.location='http://100.115.92.199:8000/photoalbum/sketchadmin.php'</script>";
}
else{
    echo "failed";
}

?>
