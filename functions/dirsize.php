<?
// directory size 
function dirsize ($dir) {
  $size = 0;
  if (is_dir ($dir)) {
    $files = glob ("$dir*");
    foreach ($files as $filename) {
      $size += dirsize ($filename);
    }
  } else $size = filesize ($dir);
  return $size;
}

?>
