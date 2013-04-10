<?php
include('include/language.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css">
<title><?php echo $lang['titre_page']; ?></title>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript"  src="js/Segoe_UI_Light_300.font.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/lang.js"></script>
<script>
Cufon.replace('div#menu_2_items');
Cufon.replace('div#menu_1_item');
Cufon.replace('div#accueil');

var g_Pays = false;
function Accueil()
{
	$("#accueil").fadeIn(1000, function()
	{
		$("#accueil").fadeOut(500, function()
		{
			document.getElementById("accueil").innerHTML = "<h4><?php echo $lang['texte_accueil2']; ?></h4>";
			Cufon.replace('div#accueil');
			$("#accueil").fadeIn(1000, function()
			{
				$("#accueil").fadeOut(500, function()
				{
					
					$("#base").fadeIn(500, function()
					{
						$("#sep").animate({opacity:'0.3'}, 500, function()
						{
							$("#login_button").animate({opacity:'1'}, 500);
						});
					});
					
					
				});
			});
		});
	});
}

function tbx_LoginEmpty(id)
{
	if(id.value == "Login")
	{
		id.value = "";
	}
	else
	{
		if(id.value == "")
		{
			id.value = "Login";
		}
	}
}

function tbx_PasswordEmpty(id)
{
	if(id.value == "password1234")
	{
		id.value = "";
	}
	else
	{
		if(id.value == "")
		{
			id.value = "password1234";
		}
	}
}
</script>
</head>

<body onload="Accueil()">
<div id="accueil"><?php echo $lang['texte_accueil1']; ?></div>
<div id="base">
<div id="loginbox">
<form method="post" action="verif_login.php">
<div id="tbx_login"><input type="text" id="tbx_login" name="tbx_login" value="Login" onfocus="tbx_LoginEmpty(this)" onblur="tbx_LoginEmpty(this)" /></div>
<div id="tbx_password"><input type="password" id="tbx_password" name="tbx_password" value="password1234" onfocus="tbx_PasswordEmpty(this)" onblur="tbx_PasswordEmpty(this)"/></div>
<div id="sep"></div>
<div id="login_button"><input type="submit" id="btn_submit" name="btn_submit" value="" /></div>
</form>
</div>
</div>
</body>
</html>