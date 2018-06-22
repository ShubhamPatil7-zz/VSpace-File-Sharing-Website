<?


// 
// function to rename files
// 

//
// thus rename can be made over some files 
//  all warnings/errors don't echo
// 
// does the following checks:
// - see whether rename pattern is too long (and echo an error)
// foreach filename:
// - if filename too long : no actions
// - if the destination path not a user directory : no actions
// - if newname too long : no actions
// - if specified file doesn't exist : no actions
// - if a new file name exists : no actions
// - then if a new file name isn't restricted : rename
// 


function renameFiles() {

  if(!$_POST[FILES_ATTR]
  || !$_POST[RENAME_ATTR])
    return 0;

  if (strlen ($_POST[RENAME_ATTR]) > MAX_RENAME_LEN) {
    show_error (RENAME_LEN_ERROR);
    return 0;
  }

  foreach ($_POST[FILES_ATTR] as $filename) {
    global $filepath;

    if (strlen ($filename) > MAX_FILENAME_LEN) 
      continue;

    if (dirname (realpath ($filepath.$filename))
    !=  realpath ($filepath)) 
      continue;

    $str = "/(" 
      . str_replace ( "." , ")\\.(" , $filename) 
      . ")/i";

    $newname = preg_replace ($str, $_POST[RENAME_ATTR], $filename);

    if (strlen ($newname) > MAX_FILENAME_LEN) 
      continue;

    if (MODES_ENABLED) {
      require PUBFILE;
      $pubmodified = false;
    }

    if (preg_match (FILENAME_PATTERN, $newname)) {
      if (file_exists ($filepath.$filename)
      && !file_exists ($filepath.$newname)
      && checkExtension ($newname)) 
      {
        // check the mode
        if (MODES_ENABLED
        && isset ($publist[$filepath.$filename])) 
        {
          $publist[$filepath.$newname] = $publist[$filepath.$filename];
          unset ($publist[$filepath.$filename]);
          $pubmodified = true;
        }

        rename ($filepath.$filename, $filepath.$newname);
      }
    }

    // write modified publics file
    if (MODES_ENABLED && $pubmodified) {
      require_once FUNC_DIR . "writePublics.php";
      writePublics($publist);
    }

  }

}

?>
