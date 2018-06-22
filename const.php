<?
   define ("ROOT_USER", "root");


   define ("UPLOAD_DIR", "files/"); 


	define ("ROOT_REGISTER", 0);


   define ("FILENAME_PATTERN", "/^[_\\.,0-9A-Z]+$/i");


   $filename_replace = array ( 
     array ("/[^_.,0-9A-Z]/i", "_") 
   );

   define ("LOGIN_PATTERN", "/^[_0-9a-z]+$/i");


   define ("MAX_LOGIN_LEN", 20);


   define ("MIN_PASS_LEN", 5);



   define ("MAX_USERFILE_SIZE", 1500);



   define ("DIR_MAX_SIZE", 30*1024*1024);



   define ("MAX_USER_FILES", 200);



   define ("MAX_FILENAME_LEN", 20);


   define ("NAMEBASE", "sfs_");

   $restrict = array ( 
     ".*\\.php.?", 
     ".*\\..?htm.?", 
     ".*\\.pl", 
     ".*\\.js", 
     ".*\\.cgi", 
     ".*\\.asp",
	 ".*\\.exe",
     ".*\\.sql"
   );


   define ("MAX_FILES_ARRAY_SIZE", 2000);


   define ("MAX_RENAME_LEN", 30);


   define ("MODES_ENABLED", true);


   define ("PUBFILE", "publist.php");


   define ("MAX_PUBFILE_SIZE", 5000);



   define ("MAX_COMMENT_SIZE", 100);


   define ("USERFILE", "users.php");


   define ("USER_ATTR", "sfss_user");
   define ("PASS_ATTR", "sfss_pass");
   define ("ACTID_ATTR", "sfss_actid");
   define ("ACTION_ATTR", "sfss_action");
   define ("RENAME_ATTR", "rename");
   define ("FILES_ATTR", "files");
   define ("COMMENT_ATTR", "comment");


   define ("FUNC_DIR", "functions/");


  $funcs = array ( 
     "add" => "addFile",
     "delete" => "deleteFiles",
     "rename" => "renameFiles",
     "public" => "addPublic",
     "private" => "removePublic"
  );


define ("PASS_LENGTH_ERROR", "Password must be " . MIN_PASS_LEN . " or more symbols length!");
define ("PASSWORDS_DONT_MATCH", "Passwords don't match!");
define ("LOGIN_SAFE_ERROR", "Login should contain only letters, numbers and underscore symbol ('_')!");
define ("LOGIN_EXIST_ERROR", "Sorry, this login also exists");
define ("LOGIN_ABSENT_ERROR", "Login must be set");
define ("DIR_CREATE_ERROR", "Sorry, can't create directory for you. Please choose another login");
define ("LOGIN_LARGE_ERROR", "Login should be " . MAX_LOGIN_LEN . " or less characters length");
define ("USERS_LIMIT_ERROR", "Sorry too much users registered");
define ("PASS_DIFFER_ERROR", "Passwords are different, try it again carefully");
define ("ROOT_REGISTER_ERROR", "Only root can register users");

// for user authentification

define ("AUTH_FAILED", "Authentification failed. Try again.");
define ("PASS_FORMAT_ERROR", "Illegal password format");

// for file upload

define ("UPLOAD_UNAUTHORIZED_ERROR", "Only authorized users can upload files.");
define ("FILE_TOOBIG_ERROR", "The size of file exceeds the total permitted size of your directory. It cannot be uploaded.");
define ("FREE_SPACE_ERROR", "Not enough free space for your account. Remove other files if any");
define ("RESTRICTED_FILE_TYPE_ERROR", "This file extension is restricted. Please rename file or make an archive.");
define ("PATH_CHANGING_ERROR", "You can write files only to your directory.");
define ("FILE_LOAD_ERROR", "Error while loading file occured. Please try loading again.");
define ("TOO_MANY_FILES_ERROR", "Too many files on your account");
define ("TOO_MANY_FILES_WARNING", "Too many files on your account. You can not upload files");

// rename errors:

define ("RENAME_LEN_ERROR", "Rename pattern too long");

// file operations:

define ("FILES_ARRAY_TOOLONG", "The specified amount of files is too large. Please do this gradually.");
define ("PUBLICS_LIMIT_ERROR", "Sorry, too much public files");


define ("NOFILES_WARNING", "No files in your directory");
define ("NOUSERDIR_ERROR", "No user directory found!");
?>
