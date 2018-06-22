<?

require_once "session.php";
require USERFILE;

function auth_check () {
  if (!isset ($_POST["login"]) || !isset ($_POST["pass"])) 
    return 0;
  global $users;
  if ($users[$_POST["login"]] != md5 ($_POST["pass"])) {
    show_error (AUTH_FAILED);
    return 0;
  }
  return 1;
}

if (auth_check()) {
  $_SESSION[USER_ATTR] = $_POST["login"];
  $_SESSION[PASS_ATTR] = $users[$_POST["login"]];
  $_SESSION[ACTID_ATTR] = 1;
  exit (header ("Location: user.php"));
} 

?>

<html>
<head>
<title>Authentification page</title>
<? require_once FUNC_DIR . "style.php" ?>
</head>

<body>

<? require_once FUNC_DIR."headfoot.php"; head ("auth"); ?>

<h1 class=caption>Authorization</h1>

<form name=auth method=POST action="auth.php">
<table class=txt>
<tr align=right><td>Login: </td> 
 <td><input type=text name=login></td>
</tr>
<tr align=right><td>Pass: </td>
 <td><input type=password name=pass></td>
</td>
<tr align=right>
 <td colspan=2><input type=submit value=Enter></td>
</tr>
</table>
</form>

<script> auth.login.focus() </script>

<? foot() ?>

</body>

</html>
