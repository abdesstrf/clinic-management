<?php
	$page_title = 'TFCI | Utilisateur';
	$thisPage='utilisateur';
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
		margin:0;
		padding:0;
		background-color:#f1f1f1;
	}
	.box
	{
		width:100%;
		padding:20px;
		background-color:#fff;
		border:1px solid #ccc;
		border-radius:5px;
		margin-top:10px;
	}
</style>
<div class="container mt-3">
	<div align="right">
		<button type="button" id="add_button" data-bs-toggle="modal" data-bs-target="#userModal" class="btn btn-dark btn-sm">
		<img src="../includes/img/add_96.png" style="height: 24px; width: 24px;" alt="">	
		Ajouter</button>
	</div>
</div>
<div class="container box shadow">
    <div class="table-responsive">
        <table id="user_data" class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Nom complet</th>
                    <th width="30%">Email</th>
                    <th width="20%">Mot de passe</th>
                    <th width="1%"></th>
                    <th width="1%"></th>
                </tr>
            </thead>
        </table>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-header bg-secondary text-light">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<label class="label-sm" style="font-size: 13px;">Nom complet</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="nomcomplet" id="nomcomplet" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
						</div>
						<label class="label-sm" style="font-size: 13px;">Email</label>
						<div class="input-group input-group-sm mb-3">
							<input type="email" name="email" id="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
						</div>
						<label class="label-sm" style="font-size: 13px;">Mot de passe</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="mdp" id="mdp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="utilisateur_id" id="utilisateur_id" />
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
		$('#user_form')[0].reset();
		$('.modal-title').text("Ajouter utilisateur");
		$('#action').val("Enregistrer");
		$('#operacao').val("Add");
	});

	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"searchuser.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 2, 3, 4, 5],
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

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var nomcomplet = $('#nomcomplet').val();
		var email = $('#email').val();
		var mdp = $('#mdp').val();
		if(nomcomplet != '' && email != '' && mdp != '')
		{
			$.ajax({
				url:"insertuser.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
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
		var utilisateur_id = $(this).attr("id");
		$.ajax({
			url:"selectoneuser.php",
			method:"POST",
			data:{utilisateur_id:utilisateur_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#nomcomplet').val(data.nomcomplet);
				$('#email').val(data.email);
				$('#mdp').val(data.mdp);
				$('.modal-title').text("Modifier utilisateur");
				$('#utilisateur_id').val(utilisateur_id);
				$('#action').val("Enregistrer");
				$('#operacao').val("Edit");
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var utilisateur_id = $(this).attr("id");
		if(confirm("Voulez-vous vraiment supprimer cette utilisateur ?"))
		{
			$.ajax({
				url:"deleteuser.php",
				method:"POST",
				data:{utilisateur_id:utilisateur_id},
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
});

</script>

<!-- Content ends -->
<?php }else{
	header("Location: ../login/login-index.php");
} ?>
<?php
	include ('../includes/footer.html');
?>
