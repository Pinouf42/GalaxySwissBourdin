var id = 1;
function verif_date(input)
{
	reg = new RegExp(/^[0-3]{1}[0-9]{1}[\/][0-1]{1}[0-9]{1}[\/][0-9]{4}$/);
	if(!reg.test(input))
	{
		return false;
	}
	tabDate = input.split('/');
	dateTest = new Date(tabDate[2], tabDate[1] - 1, tabDate[0]);
	if(parseInt(tabDate[0], 10) != parseInt(dateTest.getDate(), 10)
			|| parseInt(tabDate[1], 10) != parseInt(dateTest.getMonth(), 10) + parseInt(1, 10)
			|| parseInt(tabDate[2], 10) != parseInt(dateTest.getFullYear(), 10) )
	{ // if exist
		return false;
	}
	return true;
}
 
function check_date(id)
{
	if(!verif_date(id.value))
	{
		// ERREUR
		$(id).animate({color: '#B30000', borderColor: '#B30000'}, 200)
		date_ok = false;
	}
    else
	{
		$(id).animate({color: '#2E8A0F', borderColor: '#2E8A0F'}, 200)
		date_ok = true;
		$("#infobulle_date").fadeOut(500);
	}
}

function check_number(id)
{
	var l_Number = id.value.replace(",",".");
	if(isNaN(l_Number) || l_Number == "")
	{
		// ERREUR
		$(id).animate({color: '#B30000', borderColor: '#B30000'}, 200)
		montant_ok = false;
	}
	else
	{
		// OK
		$(id).animate({color: '#2E8A0F', borderColor: '#2E8A0F'}, 200)
		montant_ok = true;
		$("#infobulle_montant").fadeOut(500);
	}
}

function suggestion(id)
{
	var tbx_TypeDepense = $("#tbx_type");
	var l_position = tbx_TypeDepense.position();
	$("#type_depense_suggestions").css({left:l_position.left+200,top:l_position.top});
	$("#type_depense_suggestions").fadeIn(200);
}

function suggestion_out(id)
{
	if(id.value != "")
	{
		//OK
		$("#type_depense_suggestions").fadeOut(200);
		$(id).animate({color: '#2E8A0F', borderColor: '#2E8A0F'}, 200)
	}
	else
	{
		// ERREUR
		$(id).animate({color: '#B30000', borderColor: '#B30000'}, 200)
	}
	
}

function type_item_selected(texte)
{
	document.getElementById("tbx_type").value = texte;
	$("#type_depense_suggestions").fadeOut(200);
	$("#tbx_type").animate({color: '#2E8A0F', borderColor: '#2E8A0F'}, 200) // OK
}

function back_step()
{
	step = 1;
	$("#content_step2").fadeOut(200, function()
	{
		$("#content_step1").fadeIn(200);
	});
	$("#step2_1").fadeOut(200, function()
	{
		$("#step2_0").fadeIn(200);
	});
}

function perform_step()
{
	if(step == 1)
	{
		step = 2;
		$("#content_step1").fadeOut(200, function()
		{
			$("#content_step2").fadeIn(200);
		});
		$("#step2_0").fadeOut(200, function()
		{
			$("#step2_1").fadeIn(200);
		});
	}
	else
	{
		if(step == 2)
		{
			if(montant_ok == false || date_ok == false)
				{
					if(montant_ok == false)
					{
						var tbx_Montant = $("#tbx_montant");
						var l_position = tbx_Montant.position();
						$("#infobulle_montant").css({left:l_position.left+200,top:l_position.top});
						$("#infobulle_montant").fadeIn(500);
					}
					if(date_ok == false)
					{
						var tbx_Date = $("#tbx_date");
						var l_position = tbx_Date.position();
						$("#infobulle_date").css({left:l_position.left+200,top:l_position.top});
						$("#infobulle_date").fadeIn(500);
					}
					//alert(champs_non_remplis);	
					
				}
				else
				{
					if($("#tbx_send").val() != "" 
					&& $("#tbx_montant").val() != "" 
					&& $("#tbx_date").val() != "" 
					&& $("#tbx_lieu").val() != "" 
					&& $("#tbx_type").val() != "" 
					&& $("#tbx_commentaire").val() != "")
					{
						lance_upload();
					}
					else
					{
						$("#black").fadeIn(500, function()
						{
							$("#confirm_box").fadeIn(500);
						});
					}
				}
		}
	}
}

function lance_upload()
{
	step = 1;
	$("#content_step2").fadeOut(200, function()
	{
		$("#content_step3").fadeIn(200);
	});
	$("#step3_0").fadeOut(200, function()
	{
		$("#step3_1").fadeIn(200);
	});
	$("#total_ticket").upload('upload.php', function(retour)
	{
		if(retour == '0')
		{
			$('#content_step3').html(upload_erreur);
			Cufon.replace("div#content_step3");
		}
		else
		{
			$('#content_step3').html(upload_reussi);
			Cufon.replace("div#content_step3");
                        $("#ticket_conteneur").animate({width:'+=185px'}, 500);
                        var elem = document.getElementById('t_Add');
                        elem.parentNode.removeChild(elem);
                        var l_Ticket = '<div id="t'+id+'" class="ticketItem_Note" onmouseout="showMenu(\'#suppr'+id+'\', \'#edit'+id+'\', true);"\n';
                            l_Ticket += 'onmouseover="showMenu(\'#suppr'+id+'\', \'#edit'+id+'\', false);"><img src="upload/'+retour+'" width="155px" height="105px"/><div id="ticket_pic">';
                            l_Ticket += '<a href="#"><div id="suppr'+id+'" class="ticket_supp" onclick="deleteTicket(\'#t'+id+'\', \'#suppr'+id+'\', \'#edit'+id+'\');"></div></a>';
                            l_Ticket += '<a href="#"><div id="edit'+id+'" class="ticket_edit"></div></a></div>    </div>';
                            
                            l_Ticket += '<div id="t_Add" class="ticketItem_NoteAdd" onmouseout="showAdd(\'#add\', true);"';
                            l_Ticket += 'onmouseover="showAdd(\'#add\', false);">';
                            l_Ticket += '<a href="#" onclick="open_add_ticket();">';
                            l_Ticket += '<div id="add" class="ticket_add"></div></a></div>';
                            document.getElementById("ticket_conteneur").innerHTML += l_Ticket;
                        setTimeout("close_add_ticket()", 2000);
                        id++;
		}
                    
	}, 'html');
}

function confirm_box(reponse)
{
	if(reponse == true)
	{
		lance_upload();
	}	
	$("#confirm_box").fadeOut(500, function()
	{
		$("#black").fadeOut(500);
	});
}

function close_add_ticket() // reinitialisation de l'affichage "Ajout d'un ticket"
{
    document.getElementById("tbx_send").value = "";
    document.getElementById("tbx_montant").value = "";
    document.getElementById("tbx_date").value = "";
    document.getElementById("tbx_lieu").value = "";
    document.getElementById("tbx_type").value = "";
    document.getElementById("tbx_commentaire").value = "";
    step = 1;
	
    $("#lightbox_body").fadeOut(500, function()
    {
        $("#content_step2").fadeOut(0);
        $("#content_step3").fadeOut(0, function()
        {
            $("#content_step1").fadeIn(0);
        });
        $("#tbx_montant").animate({color: '#666', borderColor: '#666'}, 200);
        $("#tbx_date").animate({color: '#666', borderColor: '#666'}, 200);
        $("#tbx_type").animate({color: '#666', borderColor: '#666'}, 200);
        $("#type_depense_suggestions").fadeOut(200);
        $("#infobulle_montant").fadeOut(200);
        $("#infobulle_date").fadeOut(200);
        $("#step2_1").fadeOut(0);
        $("#step3_1").fadeOut(0);
        $("#step2_0").fadeIn(0);
        $("#step3_0").fadeIn(0);
        date_ok = false;
        montant_ok = false;
        $("#lightbox_bg").fadeOut(500);
		$('#content_step3').html('<img src="images/loading.gif" />');
    });
}

function open_add_ticket()
{
    $("#lightbox_bg").fadeIn(200, function()
    {
        $("#lightbox_body").fadeIn(500);
    });
}

function showMenu(id_supp, id_edit, hide)
{
	if(hide == false)
	{
		$(id_supp).stop().animate({height:'32px'}, 500);
		$(id_edit).stop().animate({height:'32px', marginTop:'45px'}, 500);
	}
	else
	{
		$(id_supp).stop().animate({height:'0px'}, 500);
		$(id_edit).stop().animate({height:'0px', marginTop:'105px'}, 500);
	}
}

function showInfoNote(id_div, hide)
{
    if(hide == false)
    {
		$(id_div).stop().animate({height:'0px'}, 500);
	}
	else
	{
		$(id_div).stop().animate({height:'25px'}, 500);
	}
}

function showMenuNote(id_edit, hide)
{
    if(hide == false)
	{
		$(id_edit).stop().animate({height:'32px', marginTop:'45px'}, 500);
	}
	else
	{
		$(id_edit).stop().animate({height:'0px', marginTop:'105px'}, 500);
	}
}

function showAdd(id_add, hide)
{
	if(hide == false)
	{
		$(id_add).stop().animate({height:'32px', marginTop:'-28px'}, 500);
	}
	else
	{
		$(id_add).stop().animate({height:'0px', marginTop:'0px'}, 500);
	}
}

function deleteTicket(id_ticket, id_supp, id_edit)
{
        $.ajax({
            type: "POST",
            url: "delete_ticket.php",
            data: "justif="+id_ticket.replace('#t', ''),
        });
	$(id_supp).stop().fadeOut(100);
	$(id_edit).stop().fadeOut(100, function()
	{
		$(id_ticket).animate({opacity:'0'}, 500, function()
		{
			$("#ticket_conteneur").animate({width:'-=185px'}, 500);
			$(id_ticket).animate({width:'0px', marginLeft:'0px', marginRight:'0px', borderWidth:'0px'}, 500, function()
			{
				$(id_ticket).fadeOut(0);
			});
		});
	});
}