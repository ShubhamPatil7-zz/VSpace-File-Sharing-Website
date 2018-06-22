<? 

/***************************** USER AREA PAGE ******************************/

require_once "const.php";
require_once "session.php";

if (!authorized()) 
  exit (header ("Location: auth.php"));

// 
// checks, if the filename is not restricted
// 
function checkExtension ($filename) {
  global $restrict;
  foreach ($restrict as $bad) {
    if (preg_match ($bad, $filename)) 
      return 0;
  }
  return 1;
}

if (MODES_ENABLED) {
 function history() {
   echo "<table width=300 border=1 bordercolor=0><tr><td>" .
        "<table width=100% border=0><tr>" .
        "<td align=center class=caption> colours: </td>" .
        "<td align=center class=private> private file </td>" .
        "<td align=center class=public> public file </td>" .
        "</tr></td></tr></table></table>";
 }
}

// path to user directory

$filepath = UPLOAD_DIR . $_SESSION[USER_ATTR] . "/" ;

// check the FILES_ATTR size

$allowed = false;

if ($_POST[ACTION_ATTR] == "add") 
  $allowed = true;

if (isset ($_POST[FILES_ATTR])) 
{
if (count ($_POST[FILES_ATTR]) <= MAX_FILES_ARRAY_SIZE) 
{

// restrict changes to index.php:

  $keys = array_keys ($_POST[FILES_ATTR], "index.php");
  foreach ($keys as $key) 
    unset ($_POST[FILES_ATTR][$key]);
  unset ($keys);
  unset ($key);

  $allowed = true;

} // if (count (FILES_ATTR) < MAX)
else {
  show_error (FILES_ARRAY_TOOLONG);
}

}

// do the action
if ($allowed 
&& $_POST[ACTID_ATTR] == $_SESSION[ACTID_ATTR]) 
{
  $_SESSION[ACTID_ATTR]++;
  switch ($_POST[ACTION_ATTR]) {
    case "add": case "delete": case "public": case "private":
    case "rename": 
    {
      $func = $funcs[$_POST[ACTION_ATTR]]; 
      require_once FUNC_DIR . "$func.php";
      $func(); 
      break;
    }
    default: $_SESSION[ACTID_ATTR]--;
  }
}


?>

<html>
<head>
<title>User area</title>
<? require_once FUNC_DIR . "style.php" ?>
</head>


<script>

function selectAll() {
  for (i = file_form.length; i--; ) {
    x = file_form.elements[i];
    if (x.name == "<? echo FILES_ATTR ?>[]")
      x.checked = file_form.elements[0].checked
  }
}

function act_confirm() {
  for (i = file_form.length; i--; ) {
    x = file_form.elements[i];
    if (x.name == "<? echo FILES_ATTR ?>[]"
    && x.checked == true)
      if (confirm ("Are you sure?")) 
      {
        file_form.action = "user.php";
        file_form.submit();
        return;
      }
  }
}

</script>


<body>

<? require_once FUNC_DIR."headfoot.php"; head ("user"); ?>

<? // table of files

$files = glob ("$filepath*");
if ($files == false)
  die (NOUSERDIR_ERROR);
$filecount = count ($files);
$max_files = $filecount >= MAX_USER_FILES

?>

<? 
  if ($max_files) {
    show_error (TOO_MANY_FILES_WARNING);
  } else {
?>

<form name=upform enctype="multipart/form-data" method=POST>
 <input type=submit value="Upload a file">
 <input type=file name=upfile>
 <span class=txt>Rename: </span>
  <input type=text name=<? echo RENAME_ATTR ?>>
 <input type=hidden <? echo "name=" . ACTID_ATTR . " value=" . $_SESSION[ACTID_ATTR] ?>>
 <input type=hidden <? echo "name=" . ACTION_ATTR . " value=add" ?>>
</form>

<? } ?>

<? if (MODES_ENABLED) require PUBFILE ?>

<? 
 if ($filecount) {
   history();
?>

<form name=file_form method=POST action="javascript:act_confirm()">
<table border=1 class=txt>
<tr class=caption>
<td><input type=checkbox onClick='javascript:selectAll()'></td>
<td>Name</td>
<td>Size</td>
<? if (MODES_ENABLED) echo "<td>Comment</td>" ?>
</tr>

<?
  foreach ($files as $filename) {
    if (is_dir ($filename)) continue;
    $basename = basename ($filename);
    $filename = $filepath.$basename;
    echo "<tr";
    if (MODES_ENABLED && isset ($publist[$filename])) echo " class=public";
    else echo " class=private";
    echo ">\n<td><input type=checkbox name=". FILES_ATTR . "[] value=$basename></td>\n" 
       . "<td width=300><a href='$filename'>$basename</a></td>\n"
       . "<td>" . filesize ($filename) . "</td>\n";
    if (MODES_ENABLED && isset ($publist[$filename])) echo "<td>" . $publist[$filename] . "</td>";
  }

?>

</tr>
</table>

<p class=txt>
 Select action and  <input type=submit value="do it">
 <br><input type=radio name="<? echo ACTION_ATTR ?>" value="rename"> Rename to: 
  <input type=text name=<? echo RENAME_ATTR ?>> 
 <br><input type=radio name="<? echo ACTION_ATTR ?>" value="delete"> Delete 
 <? if (MODES_ENABLED) { ?>
 <br><input type=radio name="<? echo ACTION_ATTR ?>" value="public"> Make public with comment: 
  <input type=text name=<? echo COMMENT_ATTR ?>> 
 <br><input type=radio name="<? echo ACTION_ATTR ?>" value="private"> Make private 
 <? } ?>
 <input type=hidden <? echo "name=" . ACTID_ATTR . " value=" . $_SESSION[ACTID_ATTR] ?>>
</form>
</p>

<?

} else { 
  show_error (NOFILES_WARNING);
} 

?>

<? foot() ?>

</body>
</html>
