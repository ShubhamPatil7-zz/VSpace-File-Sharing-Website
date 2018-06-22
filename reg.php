<?
/*************************** REGISTRATION PAGE *****************************/

require_once "const.php";
require_once "session.php";

function reg_check() {
  if (ROOT_REGISTER && $_SESSION[USER_ATTR] != ROOT_USER) {
    show_error (ROOT_REGISTER_ERROR);
    die;
  }
  if (!isset ($_POST["login"]) || !isset ($_POST["pass1"]) || !isset ($_POST["pass2"])) 
    return 0;
  if (filesize (USERFILE) > MAX_USERFILE_SIZE) {
    show_error (USERS_LIMIT_ERROR);
    return 0;
  }
  if ($_POST["login"] == "") {
    show_error (LOGIN_ABSENT_ERROR);
    return 0;
  }
  if (strlen ($_POST["login"]) > MAX_LOGIN_LEN) {
    show_error (LOGIN_LARGE_ERROR);
    return 0;
  }
  if (!preg_match (LOGIN_PATTERN, $_POST["login"])) {
    show_error (LOGIN_SAFE_ERROR);
    return 0;
  }
  global $users;
  if (isset ($users[$_POST["login"]])) {
    show_error (LOGIN_EXIST_ERROR);
    return 0;
  }
  if (file_exists (UPLOAD_DIR . $_POST["login"])) {
    show_error (DIR_CREATE_ERROR);
    return 0;
  }
  if ($_POST["pass1"] != $_POST["pass2"]) {
    show_error (PASS_DIFFER_ERROR);
    return 0;
  }
  return 1;
}

if (reg_check()) {

  // register the user:
  // make file directory:

  mkdir (UPLOAD_DIR . $_POST["login"], 0766);
  
  // make account record:
 
  $f = fopen ("users.php", "a");
  fwrite ($f, "<? \$users['" . $_POST["login"] . "'] = '" 
    . md5 ($_POST["pass1"]) . "' ?>\n");
  fclose ($f); 

  // create anti-view index.php:

  $f = fopen (UPLOAD_DIR . $_POST["login"] . "/index.php", "w");
  fwrite ($f, "<? header ('Location: ../../index.php') ?>");
  fclose ($f);

// goto user area and authorize user
  require "auth.php";
  return;
}

?>

<html>
<head>
<title>Registration page</title>
<? require_once FUNC_DIR . "style.php" ?>
</head>

<body>

<? require_once FUNC_DIR."headfoot.php"; head ("reg"); ?>

<h1 class=caption>Registration</h1>

<form method=POST name="reg" action="reg.php">
<table class=txt>
<tr align=right><td>Login:</td>
 <td><input type=text name=login></td>
</tr>
<tr align=right><td>Pass:</td>
 <td><input type=password name=pass1></td>
</tr>
<tr align=right><td>Pass (again):</td>
 <td><input type=password name=pass2></td>
</tr>
<tr align=right>
 <td colspan=2><input type=submit value=Register></td>
</tr>
</table>
</form>

<script> reg.login.focus() </script>

<? foot() ?>

</body>

</html>
