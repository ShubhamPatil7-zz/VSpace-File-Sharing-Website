<?


require_once "writePublics.php";


// 
// function to add specified files to public list
// 

//
// does the following checks:
// - the PUBFILE must be less than MAX_PUBFILE_SIZE
// - the comments are cut by MAX_COMMENT_SIZE
// foreach filename:
// - must have valid filename
// - must be in user directory
// - file must exist
//

function addPublic() {

	if (!MODES_ENABLED) return;

	if(!$_POST[FILES_ATTR]) 
	  return 0;

	// check PUBFILE size

	if (filesize (PUBFILE) > MAX_PUBFILE_SIZE) {
	  show_error (PUBLICS_LIMIT_ERROR);
	  return 0;
	}

	require PUBFILE;
	if (!isset ($publist)) $publist = array ();

	global $filepath;

	// check comment length

	$comment = $_POST[COMMENT_ATTR];
	if (strlen ($comment) > MAX_COMMENT_SIZE) 
	  $comment = substr ($comment, 0, MAX_COMMENT_SIZE);

	foreach ($_POST[FILES_ATTR] as $filename) {
	  if (preg_match (FILENAME_PATTERN, $filename)
	  && UPLOAD_DIR . $_SESSION[USER_ATTR] == dirname ($filepath.$filename)
	  &&  file_exists ($filepath.$filename)) {
	    $publist[$filepath.$filename] = htmlspecialchars ($comment);
	  }
	}

	return writePublics ($publist);
}

?>
