<?php 
require_once("jsdb/jsdb-conn.php");

$jsdb = new Jsdb();

$username = "kanish_ravikumar";
$fullname = "Kanish Ravikumar";
$email = "kanish.ravikumar@email.com";
$passhash = "e41106b2829dbb3e333aa42c3d0ca6ed65c0955e9873291a567f8405f9eca722";
$userid="4pmBXdStmU5SAysj1kfi";
//$jsdb->remove_row("jsdb/databases/users", "{`username`:`$username`, `fullname`:`$fullname`, `email`:`$email`, `password`:`$passhash`, `userId`: `$userid` }");

?>

<?php 
$userid = "6IiguhxYRepY76nCNMYY";
$imgid = "6tzYBkib0Y9SjQcBINxiFgOAkgOJ7VggSZ5GyGca";
$encstr = "uX53M7Pjz1Lx9hHr5ngmaKvoaYZFMOK661mE7l5baKvoaYZFMOK661mE7l5bIkyr";
//$jsdb->add_row('jsdb/databases/encfiles', "{`userId`:`$userid`, `imgId`:`$imgid`, `EncStr`:`$encstr`}");
?>
<?php 
$uuu = $jsdb->get_row('jsdb/databases/encfiles', "{`userId`:`jwQWxQlGvuFha281p8z5`}");
foreach($uuu as $img){
    $imgloc = "EncFiles/".$img['imgId'].".enc";
    $fcode = file_get_contents($imgloc);
    echo "<div class='allim'><center><img src='$fcode'></center><br>
<button class='master' onclick='showDocument(\"$fcode\")'>View</button>
</div>";
  }
?>
<?php 

//$jsdb->remove_row('jsdb/databases/encfiles', "{`userId`:`jwQWxQlGvuFha281p8z5`}");
?>