<?

require_once "removePublic.php";


// 
// function to delete specified file
// from user directory
// 

// 
// does the following checks:
// - removes files from public list (see removePublic)
// foreach filename:
// - file must exist
// - file must not be a directory
// - directory name of file must be user directory
//


function deleteFiles() {

	global $filepath; // it must be secure

	if (!$_POST[FILES_ATTR]) return 0;

	// remove file entries from list
	removePublic();

	foreach ($_POST[FILES_ATTR] as $filename) {
	  $filename = $filepath.$filename;
	  if(file_exists ($filename) 
	  && !is_dir ($filename)
	  && UPLOAD_DIR . $_SESSION[USER_ATTR] == dirname ($filename))
	  {
	    unlink ($filename);
	  }
	}

	return 1;
}

?>
