<?


require_once "writePublics.php";

// 
// function to remove public entry
// 

//
// does the following checks:
// foreach filename:
// - must be valid filename
// - the directory of file must be user directory
// - file must exist
// - file must be public
//

function removePublic() {

	if (!MODES_ENABLED) return;

	if(!$_POST[FILES_ATTR]) 
	  return 0;

	require PUBFILE;
	if (!isset ($publist)) {
	  $publist = array ();
	  return 1; // nothing to unset
	}

	global $filepath;

	foreach ($_POST[FILES_ATTR] as $filename) {
	  if (preg_match (FILENAME_PATTERN, $filename)
	  && UPLOAD_DIR . $_SESSION[USER_ATTR] == dirname ($filepath.$filename)
	  && file_exists ($filepath.$filename)
	  && isset ($publist[$filepath.$filename]))
	    unset ($publist[$filepath.$filename]);
	}

	return writePublics($publist);
}

?>
