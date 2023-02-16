<?php
	$page_title = 'TFCI | Acceuil';
	$thisPage='home';
	include ('../includes/header.html');
?>

<?php 
   session_start();
   include "../db_conn.php";
   if (isset($_SESSION['ID_Utilisateur']) && isset($_SESSION['Email'])) {   ?>

<!-- Content starts -->
	<link rel="stylesheet" href="fullcalendar.css" />
	<link rel="stylesheet" href="fullcalendarBootstrap.css" />
	<!-- <link rel="stylesheet" href="../bootstrap.min.css" /> -->
<style>
	body
	{
		margin: 0;
		padding: 0;
		background-color: #f1f1f1;
	}
	.box
	{
		width: 100%;
		padding: 20px;
		margin-top: 10px;
	}
	#cat1{
		background-color: #ffff00;
	}
	#cat2{
		background-color: #f97c25;
	}
	#cat3{
		background-color: rgb(135, 251, 255);
	}
	#cat4{
		background-color: rgb(255, 53, 147);
	}
	#cat5{
		background-color: rgb(18, 226, 139);
	}
	#cat6{
		background-color: rgb(182, 72, 255);
	}
	#cat7{
		background-color: greenyellow;
	}
	#cat8{
		background-color: rgb(255, 0, 0);
	}
	#cat9{
		background-color: #2FB4B9;
	}
	#cat10{
		background-color: rgb(143, 235, 120);
	}
	#cat11{
		background-color: rgb(255, 140, 194);
	}
	#cat12{
		background-color: #ffcb7d;
	}
	#cat13{
		background-color: rgb(255, 96, 96);
	}
	#cat14{
		background-color: rgb(145, 255, 0);
	}
	#cat15{
		background-color: rgb(38, 226, 170);
	}
</style>
  <script src="jquery.min.js"></script>
  <script src="jquery-ui.min.js"></script>
  <script src="moment.min.js"></script>
  <script src="fullcalendar.min.js"></script>
<script>

$(document).ready(function() {
   	var calendar = $('#calendar').fullCalendar({
    editable:true,
    buttonText: {
					today: `Aujourd'hui`,
					month: 'Mois',
					week: 'Semaine',
					day: 'Jour',
					listMonth : `Liste événements`              
              	},
	monthNames:['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
	monthNamesShort:['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
	dayNames:['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
	dayNamesShort:['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    header:{
		left:'prev, next today',
		center:'title',
		right:'month, agendaWeek, agendaDay, listMonth'
    },
    minTime: '08:00:00',
    maxTime: '18:00:00',
    slotDuration: '00:15:00',
	timeFormat: 'H:mm',
	titleFormat: 'dddd D MMMM YYYY',
	allDaySlot: false,
	slotLabelFormat: 'HH:mm',
    events: 'load.php', 
    selectable:true,
    selectHelper:true,
    select: function(start, end){
		$('#event_form')[0].reset();
		$("#startevent").val($.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss"));
		$("#endevent").val($.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss"));
		$("#eventModal").modal("show");
		$("#op").val('add');
		$("#eventModal").find('.is-valid').removeClass("is-valid");
	    $("#eventModal").find('.is-invalid').removeClass("is-invalid");
    },
    editable:true,
    eventResize:function(event){
		var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
		var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
		var id = event.id;
		var nomcomplet = event.nomcomplet;
		var categorie =event.categorie;
		var telephone = event.telephone;
		var description = event.description;
		var backgroundColor = event.backgroundColor;
		$.ajax({
			url:"update.php",
			type:"POST",
			data:{nomcomplet:nomcomplet,telephone:telephone,start:start, end:end, categorie:categorie,   description:description,backgroundColor:backgroundColor, id:id},
			success:function(){
				calendar.fullCalendar('refetchEvents');
				alert("Événement modifié avec succès !");	
			}
		});
    },
    eventDrop:function(event){
		var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
		var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
		var id = event.id;
		var nomcomplet = event.nomcomplet;
		var categorie =event.categorie;
		var telephone = event.telephone;
		var description = event.description;
		var backgroundColor = event.backgroundColor;
		$.ajax({
			url:"update.php",
			type:"POST",
			data:{nomcomplet:nomcomplet,telephone:telephone,start:start, end:end, categorie:categorie,   description:description,backgroundColor:backgroundColor, id:id},
			success:function(){
				calendar.fullCalendar('refetchEvents');
				alert("Événement modifié avec succès !");	
			}
		});
    },
    eventClick:function(event, jsEvent, view){
		$("#eventModal").modal("show");
		$("#op").val('update');
		$("#eventModalLabel").text("Gérer votre événement");
		$("#nomcomplet").val(event.nomcomplet);
		$("input[name=categories][value='" + event.categorie + "']").prop('checked', true);
		$("#telephone").val(event.telephone);
		$("#description").val(event.description);
		$("#startevent").val($.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss"));
		$("#endevent").val($.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss"));
		$("#ID_Event").val(event.id);
		$("#eventModal").find('.is-valid').removeClass("is-valid");
	    $("#eventModal").find('.is-invalid').removeClass("is-invalid");
    },
	});
 
	$("#btnSave").click(function(){
		var nomcomplet = $("#nomcomplet").val();
		var categorie =$("input[name = 'categories']:checked").val();
		var telephone =$("#telephone").val();
		var description =$("#description").val();
		var start =  $("#startevent").val();
		var end = $("#endevent").val();
		var backgroundColor = $("input[name = 'categories']:checked").parent().css("background-color");
		
		if($("#op").val()=='add'){
			$.ajax({
			url:"insert.php",
			type:"POST",
			data:{nomcomplet:nomcomplet, categorie:categorie, telephone:telephone, start:start, end:end, description:description,backgroundColor:backgroundColor },
			success: function(){
				calendar.fullCalendar('refetchEvents');
				$("#nomcomplet").val('');
				$("input[name=categories]").prop('checked', false);
				$("#telephone").val('');
				$("#description").val('');
				$("#startevent").val('');
				$("#endevent").val('');
				$("#eventModal").modal('hide');
				$("#eventModal").find('.is-valid').removeClass("is-valid");
	    		$("#eventModal").find('.is-invalid').removeClass("is-invalid");
				alert("Événement ajouter avec succès !");
			}
			});  
		}
		else if($("#op").val()=='update'){		
			var id = $("#ID_Event").val();
			$.ajax({
				url:"update.php",
				type:"POST",
				data:{nomcomplet:nomcomplet,telephone:telephone,start:start, end:end, categorie:categorie,   description:description,backgroundColor:backgroundColor, id:id},
				success:function(){
					calendar.fullCalendar('refetchEvents');
					$("#nomcomplet").val('');
					$("input[name=categories]").prop('checked', false);
					$("#telephone").val('');
					$("#description").val('');
					$("#startevent").val('');
					$("#endevent").val('');
					$("#eventModal").modal('hide');
					$("#eventModal").find('.is-valid').removeClass("is-valid");
	    			$("#eventModal").find('.is-invalid').removeClass("is-invalid");
					alert("Événement modifié avec succès !");
				}
			});
		}
	});

	$("#btnDelete").click(function(){
		var id = $("#ID_Event").val();
		if(confirm("Voulez-vous vraiment supprimer cet événement ?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id:id},
				success:function()
				{
					calendar.fullCalendar('refetchEvents');
					$("#nomcomplet").val('');
					$("input[name=categories]").prop('checked', false);
					$("#telephone").val('');
					$("#description").val('');
					$("#startevent").val('');
					$("#endevent").val('');
					$("#eventModal").modal('hide');
					alert("Événement supprimer avec succès !");
				}
			});
		}
		else
		{
			return false;
		}
	});
	
	$("#nomcomplet").keyup(function () { validateRegex(this.value, '#nomcomplet', /^[A-Za-z]+ [A-Za-z]|[A-Za-z]+ [A-Za-z]+ [A-Za-z]+$/); });
	$("#telephone").keyup(function () { validateRegex(this.value, '#telephone', /^0[0-9]{9}.*$/); });

	function validateRegex(value, inputID, regex) {
		if(value == ""){
			$(inputID).removeClass('is-invalid');
			$(inputID).removeClass('is-valid');
		}else if (regex.test(value)) {
			$(inputID).removeClass('is-invalid');
			$(inputID).addClass('is-valid');
		} else{
			$(inputID).removeClass('is-valid');
			$(inputID).addClass('is-invalid');
		}
	}
});
  </script>
<!-- Content start -->
<div class="container box shadow">
	<div class="container">
  		<button type="button" hidden id="btnmodal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal"></button>
    
		<!-- start modal -->
		<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content">
					<form method="post" id="event_form" enctype="multipart/form-data">
						<div class="modal-header bg-secondary text-light">
							<h1 class="modal-title fs-5" id="eventModalLabel">Ajouter événement</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-6">
									<div class="">
										<label for="recipient-name" class="col-form-label">De :</label>
										<input type="text" name="startevent" id="startevent" class="form-control" readonly>
									</div>
								</div>
								<div class="col-6">
									<div class="">
										<label for="recipient-name" class="col-form-label">À :</label>
										<input type="textdatetime-local" name="endevent" id="endevent" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-6">
									<div class="">
										<label for="recipient-name" class="col-form-label">Nom complet :</label>
										<input type="text" name="nomcomplet" id="nomcomplet" class="form-control" placeholder="exemple : Nom Prénom">
									</div>
									<div class="">
										<label for="recipient-name" class="col-form-label">Téléphone :</label>
										<input type="text" name="telephone" id="telephone" class="form-control" id="recipient-name" placeholder="exemple : 0661000000">
									</div>
									<div class="">
										<label for="message-text" class="col-form-label">Description:</label>
										<textarea type="text" class="form-control" id="description" rows="8" name="description"></textarea>
									</div>
								</div>
								<div class="col-6">
									<div id="cat1" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="DI"><span style="font-size: 13px; margin-left: 5px;">Demande d'informations</span>
									</div>
									<!-- <span id="cat1"><input type="radio" name="categories" value="DI">Demande d'informations</span><br> -->
									<div id="cat2" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="CG"><span style="font-size: 13px; margin-left: 5px;">Consultation gynécologique</span>
									</div>
									<!-- <span id="cat2"><input type="radio" name="categories" value="CG">Consultation gynécologique</span><br> -->
									<div id="cat3" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="CB"><span style="font-size: 13px; margin-left: 5px;">Consultation biologique</span>
									</div>
									<!-- <span id="cat3"><input type="radio" name="categories" value="CB">Consultation biologique</span><br> -->
									<div id="cat4" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="CD"><span style="font-size: 13px; margin-left: 5px;">Constitution du dossier</span>
									</div>
									<!-- <span id="cat4"><input type="radio" name="categories" value="CD">Constitution du dossier</span><br> -->
									<div id="cat5" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="PS"><span style="font-size: 13px; margin-left: 5px;">Prélèvement sanguin</span>
									</div>
									<!-- <span id="cat5"><input type="radio" name="categories" value="PS">Prélèvement sanguin</span><br> -->
									<div id="cat6" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="RR"><span style="font-size: 13px; margin-left: 5px;">Retrait du résultat</span>
									</div>
									<!-- <span id="cat6"><input type="radio" name="categories" value="RR">Retrait du résultat</span><br> -->
									<div id="cat7" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="PF"><span style="font-size: 13px; margin-left: 5px;">Ponction folliculaire</span>
									</div>
									<!-- <span id="cat7"><input type="radio" name="categories" value="PF">Ponction folliculaire</span><br> -->
									<!-- ---------------------------- -->
									<div id="cat8" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="IAC"><span style="font-size: 13px; margin-left: 5px;">IAC</span>
									</div>
									<!-- <span id="cat8"><input type="radio" name="categories" value="IAC">IAC</span><br> -->
									<div id="cat9" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="Monitoring"><span style="font-size: 13px; margin-left: 5px;">Monitoring</span>
									</div>
									<!-- <span id="cat9"><input type="radio" name="categories" value="Monitoring">Monitoring</span><br> -->
									<div id="cat10" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="TEF"><span style="font-size: 13px; margin-left: 5px;">Transfert d'Embryon Frais</span>
									</div>
									<!-- <span id="cat10"><input type="radio" name="categories" value="TEF">Transfert d'Embryon Frais</span><br> -->
									<div id="cat11" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="TEC"><span style="font-size: 13px; margin-left: 5px;">Transfert d'Embryon Congelé</span>
									</div>
									<!-- <span id="cat11"><input type="radio" name="categories" value="TEC">Transfert d'Embryon Congelé</span><br> -->
									<div id="cat12" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="PRP"><span style="font-size: 13px; margin-left: 5px;">PRP</span>
									</div>
									<!-- <span id="cat12"><input type="radio" name="categories" value="PRP">PRP</span><br> -->
									<div id="cat13" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="BT"><span style="font-size: 13px; margin-left: 5px;">Biopsie testiculaire</span>
									</div>
									<!-- <span id="cat13"><input type="radio" name="categories" value="BT">Biopsie testiculaire</span><br> -->
									<div id="cat14" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="Spermogramme"><span style="font-size: 13px; margin-left: 5px;">Spermogramme</span>
									</div>
									<!-- <span id="cat14"><input type="radio" name="categories" value="Spermogramme">Spermogramme</span><br> -->
									<div id="cat15" class="mb-1 rounded">
										<input class="form-check-input" id="" type="radio" name="categories" value="CS"><span style="font-size: 13px; margin-left: 5px;">Congélation de sperme</span>
									</div>
									<!-- <span id="cat15"><input type="radio" name="categories" value="CS">Congélation de sperme</span><br> -->
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" name="btnDelete" id="btnDelete" class="btn btn-danger" >Supprimer</button>
							<input type="hidden" name="op" id="op" value="add"/>
							<input type="hidden" name="ID_Event" id="ID_Event"/>
							<button type="button" name="btnSave" id="btnSave" class="btn btn-dark">Enregistrer</button>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end modal -->

		<div id="calendar" ></div>
  	</div>
</div>
<!-- Content ends -->
<?php }else{
	header("Location: ../login/login-index.php");
} ?>

<?php
	include ('../includes/footer.html');
?>
