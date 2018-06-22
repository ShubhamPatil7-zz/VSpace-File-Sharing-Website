<?     
/*************************** SESSION FUNCTIONS *****************************/
session_start();

require_once "const.php";
$users = array();
require_once USERFILE;
require_once FUNC_DIR . "error.php"; 

function authorized() {
  global $users;
  return isset ($_SESSION[PASS_ATTR])
      && isset ($_SESSION[USER_ATTR])
      && isset ($users[$_SESSION[USER_ATTR]]) 
      && $_SESSION[PASS_ATTR] == $users[$_SESSION[USER_ATTR]];
}

function logout() {
  unset ($_SESSION[USER_ATTR]);
  unset ($_SESSION[PASS_ATTR]);
}

function logged_as() {
  if (isset ($_SESSION[USER_ATTR]))
    echo "Logged&nbsp;as&nbsp;" . $_SESSION[USER_ATTR];
}

?>
