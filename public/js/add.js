        $(document).ready(function(){
	  $("#addmsg").click(function(){
    $("#response").html('wait...');
    $.post("./send.php",
    {
     user_id:<?=$user_id;?>,
     contact_id:<?=$contact_id;?>,
     login:'testlogin',
     msg:$('#messagetext').val()	
    },
    function(data,status){
      //alert("Status: " + status);
 
      $("#searchresult").html(data);
      $("#response").html(" Follow the rabbit.... ");
    });
  });
});
