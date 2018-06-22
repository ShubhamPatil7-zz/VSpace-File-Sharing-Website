<?

// 
// returns the valid filename
// 

// does the following:
// - if filename too long - crops the ending
// - leaves only basename (removes directory name)
// - makes the specified replacements (see const.php: $filename_replace)

function makeValid ($filename) {

    // check name length

    if (strlen ($filename) > MAX_FILENAME_LEN) 
      $filename = substr ($filename, -20);

    // extract only basename - for security issues

    $filename = basename ($filename); 

    // escape symbols:

    global $filename_replace;
    foreach ($filename_replace as $pat) {
      $filename = preg_replace (
        $pat[0], 
        $pat[1], 
        $filename);
    }
    
    return $filename;
}

?>
