<html>
    <head>
        
    </head>
    <body>
        <table width="100%" height="100%" border="1" align="center" valign="center">
            <tr><td colspan="2" height="6%"><h3>Chat Window</h3></td></tr>
			<tr><td colspan="2" height="6%"> Your Name or Id:&nbsp;&nbsp;<input type="text" name="sender" id="sender"><br></td></tr>
            <tr><td width='85%'>
                    <div id="chat_view" >
       
       &nbsp;
                    </div>
                </td>
                <td>
                    <div id="users" name="users">Online Users</div>
                </td>
            </tr>
        </table>
		<div id="chat_list"></div>
        <style type="text/css">
            .chat_box
			{
					border-style:solid;
					border-width:medium;
					width:200px;
					height:300px;
					float:left;
			}
			#msg
			{
					width:200px;
					height:200px;
					overflow:auto;
			}
			#new_msg_text
			{
					width:200px;
					height:50px;
			}
			#close_button
			{
					width:20px;
					height:20px;
			}
			.user_list:hover
			{
					background-color:green;
			}
        </style>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                window.setInterval(function() {
                   viewMsg();
                createNewChatBox();
                    
                },1000);
                
                 window.setInterval(function() {
                   viewOnlineUsers();	                   
                },4000);
            });
            
            function creatNewBox(receiver)
			{
            var newbox ="<div class='chat_box' id='chat_box_"+receiver+"'>"+
			"<div id='chat_header'><input type='text' name='receiver[]' READONLY value='"+
			receiver+"' id='receiver'><img id='close_button' src='images/close_button.jpg' alt='X' onclick='closeWindow($(this))'/></div>"+
            "<div  height='20%' id='msg' >"+
                "<br><br><br></div>"+
             "<div id='newmsg'><textarea rows='4' cols='10' id='new_msg_text'>&nbsp;</textarea></div>"+
             "<input type='button' id='btn' value='Send'onclick='saveMsg($(this))'>"+
        "</div>";
		
		return newbox;
            }
			
			function createNewChatBox()
			{
				var sender=$("#sender").val();
				$("#chat_list").load('back.php?opt=get_chat&sender='+sender);
				$("input[name='chat_users[]']").each(function(){
				viewBox($(this).val());
				});
			}
            
			function viewBox(receiver)
            {
                if($.trim($("#sender").val())==$.trim(receiver))
                return;
				$(document).ready(function()
				{
				var flag=false;
				$("input[name='receiver[]']").each(function()
				{
					if($(this).val()==receiver)
					{
					flag=true;
					}
				});
				if(flag==false)$("#chat_view").append(creatNewBox(receiver));           
               });
            }
            
            function viewOnlineUsers()
            {
                var sender=$("#sender").val();
                $("#users").load('back.php?opt=view_users&sender='+sender);
            }
            function closeWindow(obj)
			{
			obj.parent().parent().remove();
			}
            
            function viewMsg()
            {
                var sender=$("#sender").val();
				$("input[name='receiver[]']").each(function()
				{
					var receiver=$(this).val();
					$("#chat_box_"+receiver).find("#msg").load('back.php?opt=view_msg&sender='+sender+"&receiver="+receiver);
				});
			}
          
        function saveMsg(obj)
        {
            var receiver=obj.parent().find("#receiver").val();			   
            var sender=$("#sender").val();
            var msg=obj.parent().find("#new_msg_text").val();
			$.ajax({
			type: 'POST',
			url: 'back.php?opt=save',
			data: {"receiver":receiver,"sender":sender,"msg":msg},
				success: function()
				{   
				alert("success");
				}
				});
        }
        </script>        
    </body>
</html>