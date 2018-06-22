<?php

extract($_POST);
extract($_GET);
$con = mysql_connect('localhost', 'root', '');
mysql_select_db('sukesh');
switch ($opt) {
    case "save":
        $query = "INSERT INTO chat (sender,receiver,msg,time) values('" . $sender . "','" . $receiver . "','" . $msg . "',NOW()" . ")";
        mysql_query($query, $con) or die("Error...");

        break;

    case "view_msg":
        
        $query = "SELECT * FROM chat WHERE receiver='" . $sender. "' AND sender='".$receiver."'";
        
        $r = mysql_query($query, $con) or die("Error...");
        while ($row = mysql_fetch_array($r)) {
            echo "<table><tr>";
            echo "<td>".$row['msg']."</td>";

            echo "</tr></table>";
        }
        break;
        
		case "get_chat":
		$query = "SELECT DISTINCT  sender from chat ".
		"  WHERE receiver='$sender' AND AddTime(time, '00:00:15')>=NOW()";
		//echo $query ;
           $r = mysql_query($query, $con) or die("Error...3");
        while ($row = mysql_fetch_array($r)) {
		
		echo "<input type='text' name='chat_users[]' value='".$row['sender']."'>";
		}
		break;
        case "view_users":
            $query = "SELECT count(*) as count FROM users WHERE user_id='".$sender."'";
            $r=mysql_query($query, $con) or die("Error...1");
            $row = mysql_fetch_array($r);
            if($row['count']>0)
                $query = "UPDATE users SET last_visit=NOW() WHERE user_id='".$sender."'";
                else
            $query = "INSERT INTO users (user_id,last_visit) values('".$sender."',NOW())";
              
            mysql_query($query, $con) or die("Error...2");
        
            $query = "SELECT * FROM users WHERE AddTime(last_visit, '00:00:15')>=NOW()";
            
      
        $r = mysql_query($query, $con) or die("Error...3");
        echo "Online Users";
        while ($row = mysql_fetch_array($r)) {
            echo "<table><tr>";
        
            echo "<td><a  class='user_list' onclick=\"viewBox('".$row['user_id']."')\">".$row['user_id']."</a></td>";

            echo "</tr></table>";
        }
            break;
}
?>
