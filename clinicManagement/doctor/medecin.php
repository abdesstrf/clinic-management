<?php
	$page_title = 'TFCI | Médecin';
	$thisPage='medecin';
	include ('../includes/header.html');
?>
<?php 
   session_start();
   include "../db_conn.php";
   if (isset($_SESSION['ID_Utilisateur']) && isset($_SESSION['Email'])) {   ?>

<!-- Content starts -->

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
		background-color: #fff;
		border: 1px solid #ccc;
		border-radius: 5px;
		margin-top: 10px;
	}
</style>
<div class="container mt-3">
	<div align="right">
		<button type="button" id="add_button" data-bs-toggle="modal" data-bs-target="#doctorModal" class="btn btn-dark btn-sm">
		<img src="../includes/img/add_96.png" style="height: 24px; width: 24px;">	
		Ajouter</button>
	</div>
</div>
<div class="container box shadow">
    <div class="table-responsive">
        <table id="user_data" class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="10%">Nom complet</th>
                    <th width="10%">Specialite</th>
                    <th width="20%">Adresse</th>
                    <th width="10%">Téléphone fixe</th>
                    <th width="10%">Téléphone Portable</th>
                    <th width="11%">Téléphone Personnel</th>
                    <th width="1%"></th>
                    <th width="1%"></th>
                </tr>
            </thead>
        </table>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		<form method="post" id="doctor_form" enctype="multipart/form-data">
			<div class="modal-header bg-secondary text-light">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body row">
				<div class="col-6">
					<label class="label-sm" style="font-size: 13px;">Nom complet</label>
					<div class="input-group input-group-sm mb-3">
						<input type="text" name="nomcomplet" id="nomcomplet" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
					</div>
					<label class="label-sm" style="font-size: 13px;">Spécialite</label>
					<select class="form-select form-select-sm" name="specialite" id="specialite" style="font-size: 13px;" aria-label=".form-select-sm example">
						<option value="">-- SELECTIONNER --</option>
						<option value="Gynécologue">Gynécologue</option>
						<option value="Urologue">Urologue</option>
						<option value="Biologiste">Biologiste</option>
						<option value="Oncologue">Oncologue</option>
					</select>
					<div class="mt-3 mb-3">
						<label class="label-sm" style="font-size: 13px;">Adresse</label>
						<textarea class="form-control" name="adresse" id="adresse" placeholder="" id="floatingTextarea2" ></textarea>
					</div>
				</div>
				<div class="col-6" style="border-left: 1px dotted grey;">
					<label class="label-sm" style="font-size: 13px;">Téléphone fixe</label>
					<div class="input-group input-group-sm mb-3">
						<input type="tel" name="tel_fix" id="tel_fix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
					</div>
					<label class="label-sm" style="font-size: 13px;">Téléphone portable</label>
					<div class="input-group input-group-sm mb-3">
						<input type="tel" name="tel_potable" id="tel_potable" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
					</div>
					<label class="label-sm" style="font-size: 13px;">Téléphone personnel</label>
					<div class="input-group input-group-sm mb-3">
						<input type="tel" name="tel_perso" id="tel_perso" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="medecin_id" id="medecin_id" />
				<input type="hidden" name="operacao" id="operacao" />
				<input type="submit" name="action" id="action" class="btn btn-dark" value="Add" />
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</form>
    </div>
  </div>
</div>

<!-- script -->

<script type="text/javascript" language="javascript" >

$(document).ready(function(){

	$('#add_button').click(function(){
		$('#doctor_form')[0].reset();
		$('.modal-title').text("Ajouter médecin");
		$('#action').val("Enregistrer");
		$('#operacao').val("Add");
	});

	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"searchdoctor.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4, 5, 6, 7, 8],
				"orderable":false,
			},
		],
		"oLanguage": {
                    "sProcessing":   "Traitement...",
                    "sLengthMenu":   "Afficher _MENU_ enregistrements",
                    "sZeroRecords":  "Aucun resultat n'a été trouvé",
                    "sInfo":         "Affichage de _START_ à _END_ de _TOTAL_ enregistrements",
                    "sInfoEmpty":    "Affichage de 0 à 0 sur 0 enregistrements",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Rechercher : ",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Premier",
                        "sPrevious": "Précédent",
                        "sNext":     "Suivant",
                        "sLast":     "Dernier"
                    }
                },

	});

	$(document).on('submit', '#doctor_form', function(event){
		event.preventDefault();
		var nomcomplet = $('#nomcomplet').val();
		var specialite = $('#specialite').val();
		var adresse = $('#adresse').val();
		var tel_fix = $('#tel_fix').val();
		var tel_potable = $('#tel_potable').val();
		var tel_perso = $('#tel_perso').val();
		if(nomcomplet != '')
		{
			$.ajax({
				url:"insertdoctor.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#doctor_form')[0].reset();
					$('#doctorModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("l'un des champs oublier est obligatoire !");
		}
	});

	$(document).on('click', '.update', function(){
		var medecin_id = $(this).attr("id");
		$.ajax({
			url:"selectonedoctor.php",
			method:"POST",
			data:{medecin_id:medecin_id},
			dataType:"json",
			success:function(data)
			{
				$('#doctorModal').modal('show');
				$('#nomcomplet').val(data.nomcomplet);
				$('#specialite').val(data.specialite);
				$('#adresse').val(data.adresse);
				$('#tel_fix').val(data.tel_fix);
				$('#tel_potable').val(data.tel_potable);
				$('#tel_perso').val(data.tel_perso);
				$('.modal-title').text("Modifier médecin");
				$('#medecin_id').val(medecin_id);
				$('#action').val("Enregistrer");
				$('#operacao').val("Edit");
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var medecin_id = $(this).attr("id");
		if(confirm("Voulez-vous vraiment supprimer ce médecin ?"))
		{
			$.ajax({
				url:"deletedoctor.php",
				method:"POST",
				data:{medecin_id:medecin_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;
		}
	});

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

	$("#tel_fix").keyup(function () { validateRegex(this.value, '#tel_fix', /^0[0-9]{9}.*$/); });
	$("#tel_potable").keyup(function () { validateRegex(this.value, '#tel_potable', /^0[0-9]{9}.*$/); });
	$("#tel_perso").keyup(function () { validateRegex(this.value, '#tel_perso', /^0[0-9]{9}.*$/); });
});

</script>

<!-- Content ends -->
<?php }else{
	header("Location: ../login/login-index.php");
} ?>
<?php
	include ('../includes/footer.html');
?>
