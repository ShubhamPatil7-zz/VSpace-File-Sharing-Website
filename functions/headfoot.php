<?
  function head ($page) {

  ?>
  <pre>  ______________________
  	  |Advanced Secure System|
  </pre>

  <p class=menu>

  <? 

  $sep = " -&nbsp;|&nbsp;- ";

  $main_page = "Main&nbsp;page";
  $reg_page = "Register";
  $auth_page = "Log&nbsp;in";
  $user_page = "User&nbsp;area";
  $logout = "Log&nbsp;out";

  echo "-&nbsp;";
  echo $page == "main"
    ? "<span class=menu_sel>$main_page</span>"
    : "<a href=index.php>$main_page</a>";
  echo $sep;
  echo $page == "reg"
    ? "<span class=menu_sel>$reg_page</span>"
    : "<a href=reg.php>$reg_page</a>";
  echo $sep;
  echo $page == "auth"
    ? "<span class=menu_sel>$auth_page</span>"
    : "<a href=auth.php>$auth_page</a>";
  if (authorized()) {
    echo $sep;
    echo $page == "user"
      ? "<span class=menu_sel>$user_page</span>"
      : "<a href=user.php>$user_page</a>";
    echo $sep;
    logged_as();
    echo $sep;
    echo "<a href=logout.php>$logout</a>";
    echo "&nbsp;-";
    echo "<a href=openchat/index.php> Chat </a> -|";
  }

  ?>

  </p>

  <? } ?>

  <? function foot() {
  	echo '<br /> <br /> <br /><div id = "footer" style = "height : 50%; width : 200px;";>All rights reserved by Shubham Patil</div>';

   ?>

<? } ?>