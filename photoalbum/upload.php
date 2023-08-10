<title>Tallenna tiedosto Webiin</title>
<h2>Tallenna tiedosto Webiin</h2>

<?php
// upskripti-v2.php
#echo exec('whoami');
// Kohdehakemistojen määrittelyt
//include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php');

//$serverpath = dirname($_SERVER['DOCUMENT_ROOT'])."/htdocs";
//$urlpath    = dirname($_SERVER['DOCUMENT_ROOT'])."/htdocs";
$serverpath = dirname($_SERVER['DOCUMENT_ROOT']);
$urlpath    = dirname("");
$datapath   = "/www/photoalbum_data/";
$datapath1   = "/photoalbum_data/";
$datadir    = "$serverpath" . "$datapath";
$urldir     =  "$urlpath" . "$datapath";
//$tmp_dir = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
//die($tmp_dir);

// Demonstration visible:

echo "serverpath: $serverpath <br>";
echo "urlpath: $urlpath <br>";
echo "datapath: $datapath <br>";
echo "datadir: $datadir <br>";
echo "urldir: $urldir <br>";


$path    = $datadir;
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));

foreach($files as $file){
  
  echo "<a href='{$datapath1}{$file}'>$file</a><br>";
}



// main program
if (isset($_FILES['filetto']['tmp_name'])) {
  tallenna($datadir, $urldir);
} else {
  lomake();
}

// file send form
function lomake()
{
  ?>
  <form enctype="multipart/form-data"
  action="<?php echo ($_SERVER['PHP_SELF'])?>" method="post">
  Tallennettava tiedosto:<br>
  <br>
 
  <div class="file-input">
   <input name="filetto" type="file"  accept="image/png, image/jpeg">
 </div>
 
 <!-- <input name="filetto" style="display: none" type="file"><br> -->
 <br>

  <input type="submit" value="Tallenna">
 <br> 
 </form>
  <?php
}

// Funktio tiedoston tallentamiseen
function tallenna($datadir, $webdir)
{ 
 $uploadfile = $datadir . $_FILES['filetto']['name'];
 print "<pre>";
 if (move_uploaded_file($_FILES['filetto']['tmp_name'], $uploadfile)) {
   echo "Kopioitiin tiedosto: {$_FILES['filetto']['name']}\n";
   /*echo "nimelle: $uploadfile\n\n";
   echo "Tiedosto näkyy Web-hakemistossa: ";
   echo "<a href=\"$webdir\">$webdir</a><br>\n";
   print "Muuta informaatiota:\n";*/
 } else {
   print "Tiedoston kopioiminen epäonnistui, Muuta informaatiota:\n";
 }
 #print_r($_FILES);
 print "</pre>";
}

?>