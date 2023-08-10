
<html>
    <head>
        <title>File uplad</title>
    </head>
    <body>
    <br>
    <br>

        <form action="upload-tut-upload_1.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="userfile"  accept="image/png, image/jpeg"> <br>
            <br>
            <br>
            <input type="submit" value="Upload File">
        </form>
    </body>
</html>

<?php
// test
function delete_file($filename){
    $serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
    $datapath   =  "/www/photoalbum_data/";
    $datadir    = "$serverpath" . "$datapath";
    echo($filename);
    $old = getcwd(); 
    chdir($datadir); 
   // chmod($filename,777);

    if (!unlink($filename)) {
        echo ("File cant be deleted!");
     } else {
        echo ("File deleted!");
     }
     chdir($old);
     
}

$filename=array();
$complete_path=array();

$serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
$datapath   =  "/www/photoalbum_data/";
$datadir    = "$serverpath" . "$datapath";

$files = scandir($datadir);
$files = array_diff(scandir($datadir), array('.', '..', '.vscode','photoshow.php','who.php'));

$filename = array();
$counter=0;

foreach($files as $file)
{       $filename[$counter] = $file;
        $counter+=1;
}
?>
<!--  write out file list is also a form -->
<!--  each line has a delete button -->
<form action=<?php echo ($_SERVER['PHP_SELF'])?> method="post">
<?php
foreach($filename as $key=>$file){
    echo("<input id='");
    echo($key);
    echo("' name='submit' type='submit' value='");
    echo($key);
    echo("'>"); 
    echo('<p>');
    echo($key);
    echo(": ");
    echo("{$datadir}{$file}</p>");
}

// Main program


if(isset($_POST['submit']))
    {
    $ID = $_POST['submit'];
    delete_file($filename[$ID]);
    echo "<script>window.location='https://raikkulenz.kapsi.fi/photoalbum/delete1.php'</script>";
  }
?>    


