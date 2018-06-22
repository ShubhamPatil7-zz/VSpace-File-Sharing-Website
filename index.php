<?
require_once "session.php";
if (MODES_ENABLED) require PUBFILE;
?>

<html>
<head>
<title>ASS Main page</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<? require_once FUNC_DIR."headfoot.php"; head ("main"); ?>

<? 

if (MODES_ENABLED) {
if (count ($publist)) {

?>

<h1 class=caption>Public files shared: </h1>

<table border=1 class=txt>
<tr>
<td>Name</td><td>Size</td><td>Comment</td>
</tr>
<?
  foreach ($publist as $filename => $comment) {
    $basename = basename ($filename);
?>
<tr>
<td width=300><? echo "<a href='$filename'>$basename</a>" ?></td>
<td><? echo filesize ($filename) ?></td>
<td><? echo $comment ?></td>
</tr>

<?

  } // foreach
  echo "</table>\n";
} // if (count ($publist))
} // if (MODES_ENABLED)

?>

<? foot() ?>
<video width="320" 
Your browser does not support the video tag.
</video>

</body>
</html>
