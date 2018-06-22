<?


//
// function that writes an array to the PUBFILE
//

	function writePublics ($publist) {
	  $f = fopen (PUBFILE, "w");
	  foreach ($publist as $pub => $value)
	    fwrite ($f, "<? \$publist['$pub'] = '$value' ?>\n");
	  fclose ($f);
	  return 1;
}

