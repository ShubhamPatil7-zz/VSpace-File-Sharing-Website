<?

require_once "makeValid.php";
require_once "dirsize.php";

// 
// adds an uploaded file
// 

//
// does the following checks:
// - upload error
// - tries to make a valid filename from the specified (see makeValid)
// - checks the extension permissions
// - see whether file with new file's name exists and rename to unique name
// - checks whether there is free space on user account for the file
// - checks whether the destination path is user directory (for names like "../wow")
// - checks whether number of user files less than MAX_USER_FILES
// - see whether the file is really an uploaded one (via move_uploaded_file)
//

function addFile() {

  global $filepath; // it must be secure

  // check for real arguments

  if (!isset ($_FILES["upfile"]["name"]) 
  || !isset ($_FILES["upfile"]["tmp_name"]) 
  || !isset ($_FILES["upfile"]["size"]))
    return 0;

  // check for upload error

  if ($_FILES["upfile"]["error"]) {
    show_error (FILE_LOAD_ERROR);
    return 0;
  }

  // see whether it's needed to rename

  $filename = $_POST[RENAME_ATTR] != ""
    ? $_POST[RENAME_ATTR]
    : $_FILES["upfile"]["name"];

  // make filename really shine ;)

  $filename = makeValid ($filename);

  // check permissions:

  if (!checkExtension ($filename)) {
    show_error (RESTRICTED_FILE_TYPE_ERROR);
    return 0;
  }

  // generate a non-existing name

  if (file_exists ($filepath . $filename)) {
    $newname = basename (tempnam (realpath ($filepath), NAMEBASE));
    echo "File '$filename' already exists, the uploaded file will be saved as '$newname'.<br>";
    $filename = $newname;
    unset ($newname);
  }

  // check for free space:
  if ($_FILES["upfile"]["size"] > DIR_MAX_SIZE) {
    show_error (FILE_TOOBIG_ERROR);
    return 0;
  }

  if (dirsize ($filepath) 
      + $_FILES["upfile"]["size"] 
      > DIR_MAX_SIZE) 
  {
    show_error (FREE_SPACE_ERROR);
    return 0;
  }

  if (count (glob ("$filepath*")) >= MAX_USER_FILES) {
    show_error (TOO_MANY_FILES_ERROR);
    return 0;
  }

  // check path:
  if (UPLOAD_DIR . $_SESSION[USER_ATTR] != dirname ($filepath.$filename)) {
    show_error (PATH_CHANGING_ERROR);
    return 0;
  }

  if (move_uploaded_file ($_FILES["upfile"]["tmp_name"], $filepath . $filename)) {
    // not error, but... convinient ;)
    show_error ("uploaded successfully as '$filename'");
  } else {
    show_error ("upload failed");
  }

  return 1;

} 

?>
