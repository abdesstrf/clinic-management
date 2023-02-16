<?php
	$page_title = 'TFCI | Patient';
	$thisPage='patient';
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
<div class="mt-3">
	<div align="right">
		<button type="button" id="add_button" data-bs-toggle="modal" data-bs-target="#patientModal" class="btn btn-dark btn-sm">
		<img src="../includes/img/add_96.png" style="height: 24px; width: 24px;" alt="">	
		Ajouter</button>
	</div>
</div>
<!-- datatable  -->
<div class="box shadow">
    <div class="table-responsive">
        <table id="user_data" class="table table-striped table-bordered" >
            <thead class="fw-bold" style="font-size: medium;">
                <tr>
					<th width="1%">ID</th>
                    <th width="1%"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Nom</th>
                    <th width="6%"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Prénom</th>
                    <th width="7%"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Naissance</th>
                    <th width="1%"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Cin</th>
                    <th width="7%"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Téléphone</th>
                    <th width="1%"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Nom</th>
                    <th width="6%"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Prénom</th>
                    <th width="7%"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Naissance</th>
                    <th width="1%"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Cin</th>
                    <th width="7%"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Téléphone</th>
                    <th width="15%">Adresse</th>
                    <th width="1%">Couverture sanitaire</th>
                    <th width="1%">Tentative</th>
                    <th width="1%"></th>
                    <th width="1%"></th>
                    <th width="1%"></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- Modal Add/Edit Patient-->
<div class="modal fade" id="patientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		<form method="post" id="patient_form" enctype="multipart/form-data">
			<div class="modal-header bg-secondary text-light">
				<h1 class="modal-title fs-5"></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						<label class="label-sm" style="font-size: 13px;">N° Dossier</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="ID_Folder" id="ID_Folder" class="form-control" placeholder="exemple : 00/00">
							<input type="hidden" name="old_ID_Folder" id="old_ID_Folder"  >
						</div>
						<!-- <span class="text-danger" id="Input_ID_Error" style="display: none; margin-top: 0;">Erreur</span> -->
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<h4><img src="../includes/img/female_96.png" style="width: 24px; height: 24px;">Femme</h4>
						<label class="label-sm" style="font-size: 13px;">Nom</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="Fnom" id="Fnom" class="form-control">
						</div>
						<label class="label-sm" style="font-size: 13px;">Prénom</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="Fprenom" id="Fprenom" class="form-control">
						</div>
						<label class="label-sm" style="font-size: 13px;">Date de naissance</label>
						<div class="input-group input-group-sm mb-3">
							<input type="date" name="FdateNaissance" id="FdateNaissance" class="form-control">
						</div>
						<label class="label-sm" style="font-size: 13px;">CIN</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="Fcin" id="Fcin" class="form-control" placeholder="exemple : BJ11111">
						</div>
						<label class="label-sm" style="font-size: 13px;">Téléphone</label>
						<div class="input-group input-group-sm mb-3">
							<input type="tel" name="Ftel" id="Ftel" class="form-control" placeholder="exemple : 0661000000">
						</div>
					</div>
					<div class="col-6" style="border-left: 1px dotted grey;">
						<h4><img src="../includes/img/male_96.png" style="width: 24px; height: 24px;">Homme</h4>
						<label class="label-sm" style="font-size: 13px;">Nom</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="Hnom" id="Hnom" class="form-control">
						</div>
						<label class="label-sm" style="font-size: 13px;">Prénom</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text"  name="Hprenom" id="Hprenom" class="form-control">
						</div>
						<label class="label-sm" style="font-size: 13px;">Date de naissance</label>
						<div class="input-group input-group-sm mb-3">
							<input type="date" name="HdateNaissance" id="HdateNaissance" class="form-control">
						</div>
						<label class="label-sm" style="font-size: 13px;">CIN</label>
						<div class="input-group input-group-sm mb-3">
							<input type="text" name="Hcin" id="Hcin" class="form-control" placeholder="exemple : BJ11111">
						</div>
						<label class="label-sm" style="font-size: 13px;">Téléphone</label>
						<div class="input-group input-group-sm mb-3">
							<input type="tel" name="Htel" id="Htel" class="form-control" placeholder="exemple : 0661000000">
						</div>
					</div>
					<div class="col-12">
						<label class="label-sm" style="font-size: 13px;">Adresse</label>
						<textarea class="form-control mb-3" name="adresse" id="adresse"></textarea>
						
					</div>
					<div class="col-6">
					<label class="label-sm" style="font-size: 13px;">Couverture sanitaire</label>
						<select class="form-select form-select-sm" name="couv_sanitaire" id="couv_sanitaire" style="font-size: 13px;">
							<option value="">-- Couverture sanitaire --</option>
							<option value="CNSS">CNSS</option>
							<option value="CNOPS">CNOPS</option>
							<option value="Assurance privée">Assurance privée</option>
							<option value="Payant">Payant</option>
						</select>
					</div>
					<div class="col-6">
						<label class="label-sm" style="font-size: 13px;">Tentative</label>
						<!-- <div class="input-group input-group-sm">
							<input type="number" name="tentative" id="tentative" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
						</div> -->
						<select class="form-select form-select-sm" name="tentative" id="tentative" style="font-size: 13px;">
							<option value="">-- Tentative --</option>
							<option value="1ère">1ère</option>
							<option value="2ème">2ème</option>
							<option value="3ème">3ème</option>
							<option value="4ème">4ème</option>
							<option value="5ème">5ème</option>
							<option value="6ème">6ème</option>
							<option value="7ème">7ème</option>
							<option value="8ème">8ème</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer bg-light">
				<input type="hidden" name="patient_id" id="patient_id" />
				<input type="hidden" name="operacao" id="operacao" />
				
				<input type="submit" name="action" id="action" class="btn btn-dark" value="Add" />
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</form>
    </div>
  </div>
</div>

<!-- Modal Folder Patient-->
<div class="modal fade" id="folderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
		<form  id="folder_form" >
			<div class="modal-header bg-secondary text-light">
				<h1 class="modal-title fs-5"></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Content start modal folder -->
				<div class="container">
					<div class="row">

						<!------------------------ Form Female ------------------------>
						<div class="col-6 col-sm container shadow-sm border" style="border-radius: 10px; margin-right: 5px; background-color: #f5b8e55e;">
							<legend class="fw-bold" style="border-bottom: 1px solid #000; padding-bottom: 3px; ">
								<img src="../includes/img/female_96.png" style="width: 23px; height: 23px;"> Femme :
							</legend>
							<!-- ROW 1 POIDS/TAILLE/IMC/BAREME-->
							<div class="row">
								<!-- POIDS -->
								<div class="col-3" style="padding: 4px; padding-left: 12px;">
									<label class="label-sm" style="font-size: 13px;">Poids</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="fpoids" id="fpoids" class="form-control fimcCalc" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text">Kg</span>
									</div>
								</div>
								<!-- TAILLE -->
								<div class="col-3" style="padding: 4px;">
									<label class="label-sm" style="font-size: 13px;">Taille</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="ftaille" id="ftaille" class="form-control fimcCalc" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text">m</span>
									</div>
								</div>
								<!-- IMC -> POIDS/TAILLE -->
								<div class="col-3" style="padding: 4px;">
									<label class="label-sm" style="font-size: 13px;">IMC</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="fIMC" id="fIMC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
										<!-- <span class="input-group-text">=</span> -->
									</div>
								</div>
								<!-- BAREME -->
								<div class="col-3" style="padding: 4px; padding-right: 12px;">
									<label class="label-sm" style="font-size: 13px;">Baréme</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="fbareme" id="fbareme" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
									</div>
								</div>
							</div>

							<!-- GROUE SANGUINE -->
							<div class="row">
								<div class="col-3">
									<span style="font-size: 13px;">Groupe sanguine :</span>
								</div>
								<div class="col-4">
									<select class="form-select form-select-sm" name="fGrpSanguine" id="fGrpSanguine" style="font-size: 13px;">
										<option value="">--SELECTIONNER--</option>
										<option value="A+">A+</option>
										<option value="A-">A-</option>
										<option value="B+">B+</option>
										<option value="B-">B-</option>
										<option value="C+">C+</option>
										<option value="C-">C-</option>
										<option value="AB+">AB+</option>
										<option value="AB-">AB-</option>
									</select>
								</div>
							</div>

							<!-- SEROLOGIE -->
							<div class="row justify-content-around">
								<div class="col-2">
									<span class="mb-2" style="font-size: 13px;">Sérologie : </span>
								</div>
								<!-- HIV & HB & CT -->
								<div class="col-5">
									<div class="row d-flex">
										<!-- HIV -->
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">HIV</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="fHIV" id="fHIVp" value="fHIVp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="fHIV" id="fHIVm" value="fHIVm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">
										<!-- HB -->
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">HB</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="fHB" id="fHBp" value="fHBp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="fHB" id="fHBm" value="fHBm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">
										<!-- C.T -->
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">C.T</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="fCT" id="fCTp" value="fCTp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="fCT" id="fCTm" value="fCTm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
								</div>
								<!-- HC & TPHA & VDRL-->
								<div class="col-5">
									<div class="row d-flex">
										<!-- HC -->
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px;  padding-top: 2px;">HC</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="fHC" id="fHCp" value="fHCp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="fHC" id="fHCm" value="fHCm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">
										<!-- TPHA -->
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">TPHA</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="fTPHA" id="fTPHAp" value="fTPHAp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="fTPHA" id="fTPHAm" value="fTPHAm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<!-- VDRL -->
									<div class="row d-flex">
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">VDRL</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="fVDRL" id="fVDRLp" value="fVDRLp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="fVDRL" id="fVDRLm" value="fVDRLm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
								</div>
							</div>

							<!-- Tabagisme -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Tabagisme : </label>
								</div>
								<div class="col-3">
									<input class="form-check-input" type="radio" name="fTABAGISM" id="fTABAGISMoui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="fTABAGISM" id="fTABAGISMnon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
							</div>

							<!-- Alcoolisme -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Alcoolisme : </label>
								</div>
								<div class="col-3">
									<input class="form-check-input" type="radio" name="fALCOOLISME" id="fALCOOLISMEoui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="fALCOOLISME" id="fALCOOLISMEnon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
							</div>

							<!-- Mariage précédent -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Mariage précédent : </label>
								</div>
								<div class="col-4">
									<input class="form-check-input" type="radio" name="fMARIAGE" id="fMARIAGEoui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="fMARIAGE" id="fMARIAGEnon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
								<div class="col-4">
								<!-- <label class="label-sm" style="font-size: 13px;">Nombre d'enfants</label> -->
									<div class="input-group input-group-sm">
										<input type="number" name="fNbrEnfant" id="fNbrEnfant" placeholder="Nombre d'enfants" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<!-- Type d'infertilité & Durée d'infertilité -->
							<div class="row mt-1">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Type d'infertilité : </label>
								</div>
								<div class="col-5">
									<input class="form-check-input" type="radio" name="fTpInfer" id="fTpInfer" value="Primaire"><span style="font-size: 13px; margin-left: 5px;">Primaire</span>
									<input class="form-check-input" type="radio" name="fTpInfer" id="fTpInfer" value="Secondaire"><span style="font-size: 13px; margin-left: 5px;">Secondaire</span>
								</div>
								<div class="col-4">
								<!-- <label class="label-sm" style="font-size: 13px;">Durée d'infertilité</label> -->
									<div class="input-group input-group-sm">
										<input type="number" name="fDureeInfer" id="fDureeInfer" placeholder="Durée d'infertilité" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<!-- GESTITE & TAILLE & Naissance vivante & FC -->
							<div class="row mt-2">
								<div class="col-3" style="padding: 4px; padding-left: 12px;">
									<label class="label-sm" style="font-size: 13px;">Gestité</label>
									<div class="input-group input-group-sm">
										<input type="text" name="fGESTITE" id="fGESTITE" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-3" style="padding: 4px;">
									<label class="label-sm" style="font-size: 13px;">Parité</label>
									<div class="input-group input-group-sm">
										<input type="text" name="fPARITE" id="fPARITE" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-3" style="padding: 4px;">
									<label class="label-sm" style="font-size: 13px;">Naissance vivante</label>
									<div class="input-group input-group-sm">
										<input type="text" name="fNaissaceVivante" id="fNaissaceVivante" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-3" style="padding: 4px; padding-right: 12px;">
									<label class="label-sm" style="font-size: 13px;">FC</label>
									<div class="input-group input-group-sm">
										<input type="text" name="fFC" id="fFC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<!-- Antécédents PMA -->
							<div class="row mt-2">
								<div class="col">
									<label class="label-sm" style="font-size: 13px;">Antécédents PMA : </label>
									<input class="form-check-input" style="margin-left: 20px;" type="checkbox" name="fAntecedentPMA_IAC" id="fAntecedentPMA_IAC" ><span style="font-size: 13px; margin-left: 5px;">IAC</span>
									<input class="form-check-input" style="margin-left: 20px;" type="checkbox" name="fAntecedentPMA_FIV" id="fAntecedentPMA_FIV" ><span style="font-size: 13px; margin-left: 5px;">FIV/ICSI</span>
								</div>
							</div>

							<!-- Antécédents chirurgicaux & Traitement médicamenteux actuel -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<!-- <label class="label-sm" style="font-size: 13px;"></label> -->
									<textarea class="form-control" name="fAntChirurgie" id="fAntChirurgie" placeholder="Antécédents chirurgicaux"></textarea>
								</div>
								<div class="col-6" style="padding: 4px; padding-right: 12px;">
									<!-- <label class="label-sm" style="font-size: 13px;"></label> -->
									<textarea class="form-control" name="fTraitMedic" id="fTraitMedic" placeholder="Traitement médicamenteux actuel"></textarea>
								</div>
							</div>

							<br>
							<hr>
							<span class="fs-5">Hormonologie</span>
							<br>

							<!-- J & AMH -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px;">J</span>
										<input type="text" name="fJ" id="fJ" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-6" style="padding: 4px; padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">AMH</span>
										<input type="text" name="fAMH" id="fAMH" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">ng/mL</span>
									</div>
								</div>
							</div>

							<!-- TSH & FSH -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px;  padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">TSH</span>
										<input type="text" name="fTSH" id="fTSH" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">UI/mL</span>
									</div>
								</div>
								<div class="col-6" style="padding: 4px;  padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">FSH</span>
										<input type="text" name="fFSH" id="fFSH" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">mUI/mL</span>
									</div>
								</div>
							</div>

							<!-- OEstradiol & PRL -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px;">OEstradiol(F2)</span>
										<input type="text" name="fOEstradiol" id="fOEstradiol" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">pg/mL</span>
									</div>
								</div>
								<div class="col-6" style="padding: 4px;  padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">PRL</span>
										<input type="text" name="fPRL" id="fPRL" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">ng/mL</span>
									</div>
								</div>
							</div>

							<!-- LH & Progestérone -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px;  padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">LH</span>
										<input type="text" name="fLH" id="fLH" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">mUI/mL</span>
									</div>
								</div>
								<div class="col-6" style="padding: 4px;  padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">Progestérone</span>
										<input type="text" name="fProgesterone" id="fProgesterone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">ng/mL</span>
									</div>
								</div>
							</div>

							<br>
							<hr>
							<span class="fs-5">Examen gynécologique</span>
							<br>

							<!-- Endométriose & Polypes/Fibromes & SOPK -->
							<div class="row">
								<div class="col-4">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="fEndometriose" id="fEndometriose" ><span style="font-size: 13px; margin-left: 5px;">Endométriose</span>
								</div>
								<div class="col-4">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="fPolypesFibromes" id="fPolypesFibromes" ><span style="font-size: 13px; margin-left: 5px;">Polypes/Fibromes</span>
								</div>
								<div class="col-4">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="fSOPK" id="fSOPK" ><span style="font-size: 13px; margin-left: 5px;">SOPK</span>
								</div>
							</div>

							<!-- Hystérosalpingographie & IO & IOP -->
							<div class="row">
								<div class="col-5">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="fHysterosalpingographie" id="fHysterosalpingographie" value="false"><span style="font-size: 13px; margin-left: 5px;">Hystérosalpingographie</span>
								</div>
								<div class="col-3">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="fIO" id="fIO" ><span style="font-size: 13px; margin-left: 5px;">IO</span>
								</div>
								<div class="col-3">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="fIOP" id="fIOP" ><span style="font-size: 13px; margin-left: 5px;">IOP</span>
								</div>
							</div>

							<!-- CFA Droit & Gauche -->
							<div class="row mt-2">
								<div class="col mt-2">
									<div class="input-group input-group-sm" style="font-size: 13px; margin-top: auto; margin-bottom: auto;">
										<label class="label-sm" style="font-size: 13px; margin-top: auto; margin-bottom: auto;">CFA : </label>
										<span class="input-group-text fw-bold" style="font-size: 13px; margin-left: 5px;">Droit</span>
										<input type="text" name="fCFA_Droit" id="fCFA_Droit" style="margin-top: auto; margin-bottom: auto;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px; margin-left: 5px;">Gauche</span>
										<input type="text" name="fCFA_Gauche" id="fCFA_Gauche" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<!-- Commentaire -->
							<div class="row mt-3">
								<div class="col">
									<textarea class="form-control" name="fCommentaire" id="fCommentaire" placeholder="Commentaire" id="floatingTextarea2" ></textarea>
								</div>
							</div>
						</div>

						<!------------------------ Form Male ------------------------>

						<div class="col-6 col-sm container shadow-sm border" style="border-radius: 10px;margin-left: 5px; background-color: #b8ecf55e;">
							<legend class="fw-bold" style="border-bottom: 1px solid #000; padding-bottom: 3px; "><img src="../includes/img/male_96.png" style="width: 23px; height: 23px;"> Homme :</legend>
							<!-- ROW 1 -->
							<div class="row">
								<!-- POIDS -->
								<div class="col-3" style=" padding: 4px; padding-left: 12px;">
									<label class="label-sm" style="font-size: 13px;">Poids</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="hpoids" id="hpoids" class="form-control himcCalc" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text">Kg</span>
									</div>
								</div>
								<!-- TAILLE -->
								<div class="col-3" style="padding: 4px;">
									<label class="label-sm" style="font-size: 13px;">Taille</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="htaille" id="htaille" class="form-control himcCalc" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text">m</span>
									</div>
								</div>
								<!-- IMC -> POIDS/TAILLE -->
								<div class="col-3" style="padding: 4px;">
									<label class="label-sm" style="font-size: 13px;">IMC</label>
									<div class="input-group input-group-sm mb-3" >
										<input type="text" name="hIMC" id="hIMC" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
										<!-- <span class="input-group-text">=</span> -->
									</div>
								</div>
								<!-- BAREME -->
								<div class="col-3" style="padding: 4px; padding-right: 12px;">
									<label class="label-sm" style="font-size: 13px;">Baréme</label>
									<div class="input-group input-group-sm mb-3">
										<input type="text" name="hbareme" id="hbareme" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
									</div>
								</div>
							</div>

							<!-- ROW 2  SEROLOGIE-->
							<div class="row justify-content-around">
								<div class="col-2">
									<span style="font-size: 13px;">Sérologie : </span>
								</div>
								<div class="col-5">
									<div class="row d-flex">
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">HIV</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="hHIV" value="hHIVp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="hHIV" value="hHIVm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">HB</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="hHB" value="hHBp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="hHB" value="hHBm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">										
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">C.T</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="hCT" value="hCTp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="hCT" value="hCTm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
								</div>
								<div class="col-5">
									<div class="row d-flex">
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px;  padding-top: 2px;">HC</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="hHC" value="hHCp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="hHC" value="hHCm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">TPHA</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="hTPHA" value="hTPHAp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="hTPHA" value="hTPHAm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
									<div class="row d-flex">
										<div class="col-3">
											<label class="label-sm" style="font-size: 13px; padding-top: 2px;">VDRL</label>
										</div>
										<div class="col-6">
											<input class="form-check-input" type="radio" name="hVDRL" value="hVDRLp"><span style="font-size: 13px; margin-left: 5px;">+</span>
											<input class="form-check-input" type="radio" name="hVDRL" value="hVDRLm"><span style="font-size: 13px; margin-left: 5px;">-</span>
										</div>
									</div>
								</div>
							</div>
							
							<!-- ROW 3 Diabète type I  -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Diabète type I : </label>
								</div>
								<div class="col-3">
									<input class="form-check-input" type="radio" name="hDiabete" id="hDiabeteOui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="hDiabete" id="hDiabeteNon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
							</div>

							<!-- Tabagisme -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Tabagisme : </label>
								</div>
								<div class="col-3">
									<input class="form-check-input" type="radio" name="hTABAGISM" id="hTABAGISMoui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="hTABAGISM" id="hTABAGISMnon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
							</div>

							<!-- Alcoolisme -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Alcoolisme : </label>
								</div>
								<div class="col-3">
									<input class="form-check-input" type="radio" name="hALCOOLISME" id="hALCOOLISMEoui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="hALCOOLISME" id="hALCOOLISMEnon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
							</div>

							<!-- Mariage précédent & Nombre d'enfants -->
							<div class="row mt-2">
								<div class="col-4">
									<label class="label-sm" style="font-size: 13px;">Mariage précédent : </label>
								</div>
								<div class="col-4">
									<input class="form-check-input" type="radio" name="hMARIAGE" id="hMARIAGEoui" value="Oui"><span style="font-size: 13px; margin-left: 5px;">Oui</span>
									<input class="form-check-input" type="radio" name="hMARIAGE" id="hMARIAGEnon" value="Non"><span style="font-size: 13px; margin-left: 5px;">Non</span>
								</div>
								<div class="col-4">
								<!-- <label class="label-sm" style="font-size: 13px;">Nombre d'enfants</label> -->
									<div class="input-group input-group-sm">
										<input type="number" name="hNbrEnfant" id="hNbrEnfant" placeholder="Nombre d'enfants" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<!-- Type d'infertilité & Durée d'infertilité -->
							<div class="row mt-1">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Type d'infertilité : </label>
								</div>
								<div class="col-5">
									<input class="form-check-input" type="radio" name="hTpInfer" id="hTpInfer_Primaire" value="Primaire"><span style="font-size: 13px; margin-left: 5px;">Primaire</span>
									<input class="form-check-input" type="radio" name="hTpInfer" id="hTpInfer_Secondaire" value="Secondaire"><span style="font-size: 13px; margin-left: 5px;">Secondaire</span>
								</div>
								<div class="col-4">
								<!-- <label class="label-sm" style="font-size: 13px;">Durée d'infertilité</label> -->
									<div class="input-group input-group-sm">
										<input type="number" name="hDureeInfer" id="hDureeInfer" placeholder="Durée d'infertilité" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<!-- Antécédents chirurgicaux & Traitement médicamenteux actuel -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<!-- <label class="label-sm" style="font-size: 13px;"></label> -->
									<textarea class="form-control" name="hAntChirurgie" id="hAntChirurgie" placeholder="Antécédents chirurgicaux"></textarea>
								</div>
								<div class="col-6" style="padding: 4px; padding-right: 12px;">
									<!-- <label class="label-sm" style="font-size: 13px;"></label> -->
									<textarea class="form-control" name="hTraitMedic" id="hTraitMedic" placeholder="Traitement médicamenteux actuel"></textarea>
								</div>
							</div>

							<hr>
							<span class="fs-5">Hormonologie :</span>

							<!-- FSH & Téstostérone -->
							<div class="row">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px;">FSH</span>
										<input type="text" name="hFSH" id="hFSH" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">mUI/mL</span>
									</div>
								</div>
								<div class="col-6" style="padding: 4px; padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">Téstostérone</span>
										<input type="text" name="hTestosterone" id="hTestosterone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">ng/mL</span>
									</div>
								</div>
							</div>

							<!-- PRL -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px;  padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">PRL</span>
										<input type="text" name="hPRL" id="hPRL" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">NG/mL</span>
									</div>
								</div>
							</div>

							<hr>
							<span class="fs-5">Spermograme :</span>

							<!-- Date & Abstinence -->
							<div class="row">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px;">Date</span>
										<input type="date" name="hDate" id="hDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-6" style="padding: 4px;  padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">Abstinence</span>
										<input type="text" name="hAbstinence" id="hAbstinence" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">Jours</span>
									</div>
								</div>
							</div>
							
							<!-- Volume & Concentration -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px;">Volume</span>
										<input type="text" name="hVolume" id="hVolume" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">mL</span>
									</div>
								</div>
								<div class="col-6" style="padding: 4px; padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">Concentration</span>
										<input type="text" name="hConcentration" id="hConcentration" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">M/mL</span>
									</div>
								</div>
							</div>
							
							<!-- Forme typique -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">Forme typique</span>
										<input type="text" name="hFormeTypique" id="hFormeTypique" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">%</span>
									</div>
								</div>
							</div>

							<!-- Mobilité total & Mobilité -->
							<div class="row mt-2">
								<div class="col-6" style="padding: 4px; padding-left: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text fw-bold" style="font-size: 13px;">Mobilité total</span>
										<input type="text" name="hMobiliteTotal" id="hMobiliteTotal" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-6" style="padding: 4px;  padding-right: 12px;">
									<div class="input-group input-group-sm">
										<span class="input-group-text  fw-bold" style="font-size: 13px;">Mobilité</span>
										<input type="text" name="hMobilite" id="hMobilite" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
										<span class="input-group-text" style="font-size: 13px;">a + b</span>
									</div>
								</div>
							</div>
							
							<!-- Conclusion -->
							<div class="row mt-2">
								<div style="padding: 4px; padding-left: 12px; padding-right: 12px;">
									<textarea class="form-control" name="hConclusion" id="hConclusion" placeholder="Conclusion" id="floatingTextarea2" ></textarea>
								</div>
							</div>
							
							<hr>
							<span class="fs-5">Examen urologique :</span>

							<!-- Torison testiculaire & Ejaculation rétrograde -->
							<div class="row">
								<div class="col-5">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hTorisonTesticulaire" id="hTorisonTesticulaire"><span style="font-size: 13px; margin-left: 5px;">Torison testiculaire</span>
								</div>
								<div class="col-5">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hEjaculationRetrograde" id="hEjaculationRetrograde"><span style="font-size: 13px; margin-left: 5px;">Ejaculation rétrograde</span>
								</div>
							</div>
							
							<!-- Atrophie testiculaire & Dysfonction érectile -->
							<div class="row">
								<div class="col-5">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hAtrophieTesticulaire" id="hAtrophieTesticulaire"><span style="font-size: 13px; margin-left: 5px;">Atrophie testiculaire</span>
								</div>
								<div class="col-5">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hDysfonctionErectile" id="hDysfonctionErectile"><span style="font-size: 13px; margin-left: 5px;">Dysfonction érectile</span>
								</div>
							</div>

							<!-- Varicocèle & Cryptorchidie & Vasectomie -->
							<div class="row">
								<div class="col-3">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hVaricocele" id="hVaricocele"><span style="font-size: 13px; margin-left: 5px;">Varicocèle</span>
								</div>
								<div class="col-4">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hCryptorchidie" id="hCryptorchidie"><span style="font-size: 13px; margin-left: 5px;">Cryptorchidie</span>
								</div>
								<div class="col-3">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hVasectomie" id="hVasectomie"><span style="font-size: 13px; margin-left: 5px;">Vasectomie</span>
								</div>
							</div>

							<hr>
							<span class="fs-5">Examen génétique/immunologique :</span>

							<!-- Test de fragmentation d'ADN & Test de fragmentation d'ADN -->
							<div class="row">
								<div class="col-6">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hTestFragmentationADN" id="hTestFragmentationADN" ><span style="font-size: 13px; margin-left: 5px;">Test de fragmentation d'ADN</span>
								</div>
								<div class="col-6">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hMicrodeletionChromosomeY" id="hMicrodeletionChromosomeY"><span style="font-size: 13px; margin-left: 5px;">Microdélétion sur le chromosome Y</span>
								</div>
							</div>

							<!-- Syndrôme de Kinefelter & Caryotype & Caryotype -->
							<div class="row">
								<div class="col-5">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hSyndromeKinefelter" id="hSyndromeKinefelter"><span style="font-size: 13px; margin-left: 5px;">Syndrôme de Kinefelter</span>
								</div>
								<div class="col-3">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hCaryotype" id="hCaryotype"><span style="font-size: 13px; margin-left: 5px;">Caryotype</span>
								</div>
								<div class="col-3">
									<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="hMarTest" id="hMarTest"><span style="font-size: 13px;  margin-left: 5px;">MAR Test</span>
								</div>
							</div>

							<!-- Commentaire -->
							<div class="row mt-2">
								<div style="padding: 4px; padding-left: 12px; padding-right: 12px;">
									<textarea class="form-control" name="hCommentaire" id="hCommentaire" placeholder="Commentaire" id="floatingTextarea2" ></textarea>
								</div>
							</div>
						</div>

						<!------------------------ 3 Form  ------------------------>
						
						<div class="container shadow-lg bg-light mt-3 border" style="border-radius: 10px;">
							<h5 class="fw-bold">Compte-rendu FIV/ICSI :</h5>
							<h6 class="fw-bold">- Protocole de la Stimulation Ovarienne :</h6>
							<div class="row ">
								<div class="col-3">
									<!-- <select class="form-select form-select-sm" name="medecinTraitant" id="medecinTraitant">
										<option value="null">SELECTIONNER</option>
									</select> -->
									<label class="label-sm" style="font-size: 13px;">Médecin traitant :</label>
									<div class="input-group input-group-sm">
										<select class="form-select form-select-sm" name="medecinTraitant" id="medecinTraitant" style="font-size: 13px;">
											
										</select>
										<!-- <input type="text" name="medecinTraitant" id="medecinTraitant" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> -->
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Date du début :</label>
									<div class="input-group input-group-sm">
										<input type="date" name="dateDebut" id="dateDebut" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Durée de la stimulation ovarienne :</label>
									<div class="input-group input-group-sm">
										<input type="text" name="dureeStimuOvarienne" id="dureeStimuOvarienne" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Traitement utilisé et dose totale :</label>
									<div class="input-group input-group-sm">
										<input type="text" name="traitementDoseTotale" id="traitementDoseTotale" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
									</div>
								</div>
							</div>

							<hr>
							<h6 class="fw-bold">- Paramètres spermatiques du sperme du conjoint :</h6>
							<div class="row">
								<div class="col">
									<div class="input-group input-group-sm">
										<label class="label-sm" style="font-size: 13px; margin-top: auto; margin-bottom: auto;">Nature du prélèvement : </label>
										<div >
											<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="spermeFrais" id="spermeFrais">
											<span style="font-size: 13px;  margin-left: 5px;">Sperme frais</span>
										</div>
										<div>
											<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="spermeCongele" id="spermeCongele">
											<span style="font-size: 13px;  margin-left: 5px;">Sperme congelé</span>
										</div>
										<div>
											<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="biopsieTesticulaire" id="biopsieTesticulaire">
											<span style="font-size: 13px;  margin-left: 5px;">Biopsie testiculaire</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-2">
									<label class="label-sm" style="font-size: 13px;">Délai d'abstinence :</label>
									<div class="input-group input-group-sm">
										<input type="number" name="delaiDabstinence" id="delaiDabstinence" class="form-control">
										<span class="input-group-text">Jours</span>
									</div>
								</div>
								<div class="col-2">
									<label class="label-sm" style="font-size: 13px;">Mobilité Totale (a+b+c) :</label>
									<div class="input-group input-group-sm">
										<input type="number" name="mobiliteTotale" id="mobiliteTotale" class="form-control">
										<span class="input-group-text">%</span>
									</div>
								</div>
								<div class="col-2">
									<label class="label-sm" style="font-size: 13px;">Volume :</label>
									<div class="input-group input-group-sm">
										<input type="number" name="volume" id="volume" class="form-control">
										<span class="input-group-text">mL</span>
									</div>
								</div>
								<div class="col-2">
									<label class="label-sm" style="font-size: 13px;">Concentration :</label>
									<div class="input-group input-group-sm">
										<input type="number" name="concentration" id="concentration" class="form-control">
										<span class="input-group-text">M/mL</span>
									</div>
								</div>
								<div class="col-2">
									<label class="label-sm" style="font-size: 13px;">Mobilité Progressive(a+b) :</label>
									<div class="input-group input-group-sm">
										<input type="number" name="mobiliteProgressive" id="mobiliteProgressive" class="form-control">
										<span class="input-group-text">%</span>
									</div>
								</div>
								<div class="col-2">
									<label class="label-sm" style="font-size: 13px;">Formes typiques </label>
									<div class="input-group input-group-sm">
										<input type="number" name="formesTypiques" id="formesTypiques" class="form-control">
										<span class="input-group-text">%</span>
									</div>
								</div>
							</div>

							<hr>
							<h6 class="fw-bold">- Résultats de la ponction folliculaire :</h6>
							<div class="row justify-content-around">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Date de la ponction folliculaire</label>
									<div class="input-group input-group-sm">
										<input type="date" name="datePonstionFolliculaire" id="datePonstionFolliculaire" class="form-control">
									</div>
								</div>
								<div class="col-3"></div>
								<div class="col-3"></div>
							</div>
							<div class="row justify-content-around">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'ovocytes récupérés</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbOvocytesRecup" id="nbOvocytesRecup" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'ovocytes mâtures</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbOvocytesMatures" id="nbOvocytesMatures" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'ovocytes fécondés</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbOvocytesFecondes" id="nbOvocytesFecondes" class="form-control">
									</div>
								</div>
							</div>
							<div class="row justify-content-around">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'embryons obtenus</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbEmbryonsObtenus" id="nbEmbryonsObtenus" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'embryons en culture prolongée</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbEmbryonsCultureProlongee" id="nbEmbryonsCultureProlongee" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre de blastocystes obtenus</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbBlastocystesObtenus" id="nbBlastocystesObtenus" class="form-control">
									</div>
								</div>
							</div>
							<div class="row justify-content-around">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'embryons vitrifiés</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbEmbryonsVitrifies" id="nbEmbryonsVitrifies" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'embryons/blastocytes transférés</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbEmbryonsTransferes" id="nbEmbryonsTransferes" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre de blastocystes vitrifiés</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbBlastocystesVitrifies" id="nbBlastocystesVitrifies" class="form-control">
									</div>
								</div>
							</div>

							<hr>
							<h5 class="fw-bold">Compte-rendu Vitrification Embryons/Blastocystes :</h5>
							<div class="row mb-3">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre Total des paillettes</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbTotalPaillettes" id="nbTotalPaillettes" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Date de Vitrification</label>
									<div class="input-group input-group-sm">
										<input type="date" name="dateVitrification" id="dateVitrification" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'embryons/blastocytes vitrifiés</label>
									<div class="input-group input-group-sm">
										<select class="border" name="nbEmbryonsBlastocytesVitrifies" id="nbEmbryonsBlastocytesVitrifies" style="font-size: 13px;" onchange="Inputs_Generator(this.value)">
											<option value="">0</option>	
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
										</select>
										<input type="text" name="nbEmbryonsBlastocytesVitrifiesText" id="nbEmbryonsBlastocytesVitrifiesText" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Date du Renouvellement</label>
									<div class="input-group input-group-sm">
										<input type="date" name="dateRenouvellement" id="dateRenouvellement" class="form-control">
									</div>
								</div>
							</div>
							<div class="row" id="div-container" style="display: none;">
								<label class="label-sm" style="font-size: 13px; display: none;" id="label-container">Qualité embryonnaire</label>
								<div class="row container" id ="div-row">

								</div>
							</div>
							
							<hr>
							<h5 class="fw-bold">Compte-rendu Transfert d'Embryons Congelés (TEC) :</h5>
							<div class="row justify-content-around">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Date de dévitrification</label>
									<div class="input-group input-group-sm">
										<input type="date" name="dateDevitrificationTEC" id="dateDevitrificationTEC" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Date du Renouvellement</label>
									<div class="input-group input-group-sm">
										<input type="date" name="dateRenouvellementTEC" id="dateRenouvellementTEC" class="form-control">
									</div>
								</div>
							</div>
							<div class="row justify-content-around mb-3">
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre de paillette dévitrifiée</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbPailletteDevitrifieeTEC" id="nbPailletteDevitrifieeTEC" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Nombre d'embryons/blastocytes dévitrifiés</label>
									<div class="input-group input-group-sm">
										<input type="text" name="nbEmbryonsBlastocytesDevitrifiesTEC" id="nbEmbryonsBlastocytesDevitrifiesTEC" class="form-control">
									</div>
								</div>
								<div class="col-3">
									<label class="label-sm" style="font-size: 13px;">Reste</label>
									<div class="input-group input-group-sm">
										<input type="text" name="resteTEC" id="resteTEC" class="form-control">
									</div>
								</div>
							</div>

							<button type="button" class="btn btn-light border mb-2 text-dark" onclick="testprint()">
								<img src="../includes/img/download_pdf.png" style="height: 24px; width: 24px;" alt="">	
							Export as PDF</button>
							<!-- <input type="button" class="btn btn-primary mb-2" value="Export as PDF" onclick="testprint()"> -->
						</div>
					</div>
				</div>
				<!-- Content modal folder ends  -->
			</div>
			<div class="modal-footer bg-light">
				<input type="hidden" name="operacao2" id="operacao2" value="Add" />
				<input type="hidden" name="patient_idfk" id="patient_idfk"  />
				<!-- <input type="button" value="PDF" onclick="testprint()"> -->
				<input type="submit" name="action2" id="action2" class="btn btn-dark" />
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</form>
    </div>
  </div>
</div>

<div id="contentPDF" style="display: none; margin:0 auto;">
	<link type="text/css" href="../bootstrap.min.css" rel="stylesheet">
	<style>
		.size-a4
		{
			width: 210mm;
			height: 297mm;
			margin: 60px;
		}
	</style>
	
	<div class="size-a4">
		<!-- Le couple -->
		<table id="t" >
			<thead>
				<th class="bg-Secondary text-center" style="border-radius: 10px; font-size: 30px;" colspan="4">Compte-rendu FIV/ICSI</th>
			</thead>
			<tbody>
				<br>
				<br>
				<!-- date -->
				<tr>
					<td colspan="4" style="text-align: end;">Tanger, le <label name="DatePdf" class="DatePdf" style="margin-right: 10px;"></label></td>
				</tr>
				<tr>
					<td colspan="4">Le couple :</td>
				</tr>
				<tr>
					<td colspan="2" class="fw-bold"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Madame</td>
					<td colspan="2" class="fw-bold"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Monsieur</td>
				</tr>
				<!-- Nom  -->
				<tr>
					<td>
						<label>Nom:</label>
					</td>
					<td>
						<label name="FnomPDF" id="FnomPDF" class="fst-italic FnomPDF" >
					</td>

					<td>
						<label>Nom:</label>
					</td>
					<td>
						<label name="HnomPDF" id="HnomPDF" class="fst-italic HnomPDF" >
					</td>
				</tr>
				<!-- Prenom -->
				<tr>
					<td>
						<label>Prénom:</label>
					</td>
					<td>
						<label name="FprenomPDF" id="FprenomPDF" class="fst-italic FprenomPDF">
					</td>

					<td>
						<label>Prénom:</label>
					</td>
					<td>
						<label name="HprenomPDF" id="HprenomPDF" class="fst-italic HprenomPDF">
					</td>
				</tr>
				<!-- Date naissance -->
				<tr>
					<td>
						<label>Date de Naissance :</label>
					</td>
					<td>
						<label name="FdateNaissancePDF" id="FdateNaissancePDF" class="fst-italic FdateNaissancePDF">
					</td>

					<td>
						<label>Date de Naissance :</label>
					</td>
					<td>
						<label name="HdateNaissancePDF" id="HdateNaissancePDF" class="fst-italic HdateNaissancePDF">
					</td>
				</tr>
				<!-- CIN -->
				<tr>
					<td>
						<label>N° CIN :</label>
					</td>
					<td>
						<label name="FcinPDF" id="FcinPDF" class="fst-italic FcinPDF">
					</td>

					<td>
						<label>N° CIN :</label>
					</td>
					<td>
						<label name="HcinPDF" id="HcinPDF" class="fst-italic HcinPDF">
					</td>
				</tr>
				<!-- Adresse -->
				<tr>
					<td>
						<label>Adresse conjugale :</label>
					</td>
					<td colspan="3">
						<label name="adressePDF" id="adressePDF" class="fst-italic adressePDF">
					</td>
				</tr>
				<!-- Tentative -->
				<tr>
					<td colspan="4">
						<br>
						<span>A bénéficié de leur <span class="fw-bold"><label name="tentativePDF" id="tentativePDF" class="tentativePDF"></span> tentative au sein de notre centre de la Procréation Médicalement Assistée. <br> Ci-dessous, les détails de cette tentative :</span>
					</td>
				</tr>
			</tbody>
		</table>

		<br>

		<!-- Protocole de la Stimulation Ovarienne -->
		<table>
			<thead>
				<th colspan="4"><span class="fw-bold">Protocole de la Stimulation Ovarienne</span></th>
			</thead>
			<tbody>
				
				<!-- medecin traitant -->
				<tr>
					<td>
						<label>Médecin traitant :</label>
					</td>
					<td colspan="3">
						<label name="medecinTraitentPDF" id="medecinTraitentPDF">
					</td>
				</tr>
				<!-- Date du début  -->
				<tr>
					<td>
						<label>Date du début :</label>
					</td>
					<td colspan="3">
						<label name="dateDebutPDF" id="dateDebutPDF">
					</td>
				</tr>
				<!-- Durée de la stimulation ovarienne  -->
				<tr>
					<td>
						<label>Durée de la stimulation ovarienne :</label>
					</td>
					<td colspan="3">
						<label name="dureeStimuOvariennePDF" id="dureeStimuOvariennePDF"></label>
					</td>
				</tr>
				<!-- Traitement utilisé et dose totale  -->
				<tr>
					<td>
						<label>Traitement utilisé et dose totale :</label>
					</td>
					<td colspan="3">
						<label name="traitementDoseTotalePDF" id="traitementDoseTotalePDF"></label>
					</td>
				</tr>
			</tbody>
		</table>

		<br>

		<!-- Paramètres spermatiques du sperme du conjoint -->
		<table>
			<thead>
				<th colspan="4"><span class="fw-bold">Paramètres spermatiques du sperme du conjoint </span></th>
			</thead>
			<tbody>
				<!-- Nature du prélèvement -->
				<tr>
					<td>
						<label>Nature du prélèvement : </label>
					</td>
					<td colspan="3">
						<div class="input-group input-group-sm">
							<div >
								<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="spermeFraisPDF" id="spermeFraisPDF">
								<span style=" margin-left: 5px;">Sperme frais</span>
							</div>
							<div>
								<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="spermeCongelePDF" id="spermeCongelePDF">
								<span style=" margin-left: 5px;">Sperme congelé</span>
							</div>
							<div>
								<input class="form-check-input" style="margin-left: 10px;" type="checkbox" name="biopsieTesticulairePDF" id="biopsieTesticulairePDF">
								<span style=" margin-left: 5px;">Biopsie testiculaire</span>
							</div>
						</div>
					</td>
				</tr>
				<!-- Délai d'abstinence & Mobilité Totale -->
				<tr>
					<td colspan="4">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-8">
										<label>• Délai d'abstinence :</label>
									</div>
									<div class="col-4">
										<label name="delaiDabstinencePDF" id="delaiDabstinencePDF"></label>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-9">
										<label>• Mobilité Totale (a+b+c) :</label>
									</div>
									<div class="col-3">
										<label name="mobiliteTotalePDF" id="mobiliteTotalePDF"></label>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			
				<!-- Volume & Mobilité Progressive  -->
				<tr>
					<td colspan="4">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-8">
										<label>• Volume :</label>
									</div>
									<div class="col-4">
										<label name="volumePDF" id="volumePDF"></label>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-9">
										<label>• Mobilité Progressive (a+b) :</label>
									</div>
									<div class="col-3">
										<label name="mobiliteProgressivePDF" id="mobiliteProgressivePDF"></label>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>

				<!-- Concentration & Formes typiques   -->
				<tr>
					<td colspan="4">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-8">
										<label>• Concentration :</label>
									</div>
									<div class="col-4">
										<label name="concentrationPDF" id="concentrationPDF"></label>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-9">
										<label>• Formes typiques :</label>
									</div>
									<div class="col-3">
										<label name="formesTypiquesPDF" id="formesTypiquesPDF"></label>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<br>

		<!-- Résultats de la ponction folliculaire -->
		<span class="fw-bold">Résultats de la ponction folliculaire </span>

		<!-- Date de la ponction folliculaire -->
		<div class="row">
			<div class="col-6">
				<label>Date de la ponction folliculaire  :</label>
			</div>
			<div class="col-6">
				<label name="datePonstionFolliculairePDF" id="datePonstionFolliculairePDF"></label>
			</div>
		</div>

		<!-- Nombre d'ovocytes récupérés  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'ovocytes récupérés :</label>
			</div>
			<div class="col-6">
				<label name="nbOvocytesRecupPDF" id="nbOvocytesRecupPDF"></label>
			</div>
		</div>

		<!-- Nombre d'ovocytes mâtures  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'ovocytes mâtures :</label>
			</div>
			<div class="col-6">
				<label name="nbOvocytesMaturesPDF" id="nbOvocytesMaturesPDF"></label>
			</div>
		</div>

		<!-- Nombre d'ovocytes fécondés  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'ovocytes fécondés :</label>
			</div>
			<div class="col-6">
				<label name="nbOvocytesFecondesPDF" id="nbOvocytesFecondesPDF"></label>
			</div>
		</div>

		<!-- Nombre d'embryons obtenus   -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'embryons obtenus :</label>
			</div>
			<div class="col-6">
				<label name="nbEmbryonsObtenusPDF" id="nbEmbryonsObtenusPDF"></label>
			</div>
		</div>

		<!-- Nombre d'embryons obtenus   -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'embryons en culture prolongée :</label>
			</div>
			<div class="col-6">
				<label name="nbEmbryonsCultureProlongeePDF" id="nbEmbryonsCultureProlongeePDF"></label>
			</div>
		</div>

		<!-- Nombre de blastocystes obtenus  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre de blastocystes obtenus :</label>
			</div>
			<div class="col-6">
				<label name="nbBlastocystesObtenusPDF" id="nbBlastocystesObtenusPDF"></label>
			</div>
		</div>

		<!-- Nombre d’embryons/blastocytes transférés  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'embryons/blastocytes transférés :</label>
			</div>
			<div class="col-6">
				<label name="nbEmbryonsTransferesPDF" id="nbEmbryonsTransferesPDF"></label>
			</div>
		</div>

		<!-- Nombre d'embryons vitrifiés  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'embryons vitrifiés :</label>
			</div>
			<div class="col-6">
				<label name="nbEmbryonsVitrifiesPDF" id="nbEmbryonsVitrifiesPDF"></label>
			</div>
		</div>

		<!-- Nombre de blastocystes vitrifiés   -->
		<div class="row">
			<div class="col-6">
				<label>Nombre de blastocystes vitrifiés :</label>
			</div>
			<div class="col-6">
				<label name="nbBlastocystesVitrifiesPDF" id="nbBlastocystesVitrifiesPDF"></label>
			</div>
		</div>

		<div class="row">
			<span style="font-size: 12px;">*Voir Compte-rendu embryons / blastocystes vitrifiés*</span>
		</div>
	</div>

	<div class="size-a4 mt-5">
		<!-- Le couple -->
		<table id="t">
			<thead>
				<th class="bg-Secondary text-center" style="border-radius: 10px; font-size: 30px;" colspan="4">Compte-rendu FIV/ICSI</th>
			</thead>
			<tbody>
				<br>
				<br>
				<!-- date -->
				<tr>
					<td colspan="4" style="text-align: end;">Tanger, le <label name="DatePdf" class="DatePdf" style="margin-right: 10px;">10/10/2023</label></td>
				</tr>
				<tr>
					<td colspan="4">Le couple :</td>
				</tr>
				<tr>
					<td colspan="2" class="fw-bold"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Madame</td>
					<td colspan="2" class="fw-bold"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Monsieur</td>
				</tr>
				<!-- Nom  -->
				<tr>
					<td>
						<label>Nom:</label>
					</td>
					<td>
						<label name="FnomPDF" id="FnomPDF" class="fst-italic FnomPDF" >
					</td>

					<td>
						<label>Nom:</label>
					</td>
					<td>
						<label name="HnomPDF" id="HnomPDF" class="fst-italic HnomPDF" >
					</td>
				</tr>
				<!-- Prenom -->
				<tr>
					<td>
						<label>Prénom:</label>
					</td>
					<td>
						<label name="FprenomPDF" id="FprenomPDF" class="fst-italic FprenomPDF">
					</td>

					<td>
						<label>Prénom:</label>
					</td>
					<td>
						<label name="HprenomPDF" id="HprenomPDF" class="fst-italic HprenomPDF">
					</td>
				</tr>
				<!-- Date naissance -->
				<tr>
					<td>
						<label>Date de Naissance :</label>
					</td>
					<td>
						<label name="FdateNaissancePDF" id="FdateNaissancePDF" class="fst-italic FdateNaissancePDF">
					</td>

					<td>
						<label>Date de Naissance :</label>
					</td>
					<td>
						<label name="HdateNaissancePDF" id="HdateNaissancePDF" class="fst-italic HdateNaissancePDF">
					</td>
				</tr>
				<!-- CIN -->
				<tr>
					<td>
						<label>N° CIN :</label>
					</td>
					<td>
						<label name="FcinPDF" id="FcinPDF" class="fst-italic FcinPDF">
					</td>

					<td>
						<label>N° CIN :</label>
					</td>
					<td>
						<label name="HcinPDF" id="HcinPDF" class="fst-italic HcinPDF">
					</td>
				</tr>
				<!-- Adresse -->
				<tr>
					<td>
						<label>Adresse conjugale :</label>
					</td>
					<td colspan="3">
						<label name="adressePDF" id="adressePDF" class="fst-italic adressePDF">
					</td>
				</tr>
				<!-- Tentative -->
				<tr>
					<td colspan="4">
						<br><br>
						<span>A bénéficié de leur <span class="fw-bold"><label name="tentativePDF" id="tentativePDF" class="tentativePDF"></span> tentative au sein de notre centre de la Procréation Médicalement Assistée,<br>et a eu recours à la vitrification des embryons/blastocystes surnuméraires.</span>
						<br>
					</td>
				</tr>
			</tbody>
		</table>

		<br>

		<span class="fw-bold">VITRIFICATION</span>

		<!-- Date(s) de Vitrification  -->
		<div class="row">
			<div class="col-6">
				<label>Date(s) de Vitrification :</label>
			</div>
			<div class="col-6">
				<label name="dateVitrificationPDF" id="dateVitrificationPDF"></label>
			</div>
		</div>

		<!-- Nombre Total des paillettes  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre Total des paillettes :</label>
			</div>
			<div class="col-6">
				<label name="nbTotalPaillettesPDF" id="nbTotalPaillettesPDF"></label>
			</div>
		</div>

		<!-- Nombre d’embryons/blastocytes vitrifiés   -->
		<div class="row">
			<div class="col-6">
				<label>Nombre dembryons/blastocytes vitrifiés :</label>
			</div>
			<div class="col-6">
				<label name="nbEmbryonsBlastocytesVitrifiesPDF" id="nbEmbryonsBlastocytesVitrifiesPDF"></label>
			</div>
		</div>

		<!-- Qualité embryonnaire   -->
		<div class="row">
			<div class="col-6">
				<label>Qualité embryonnaire :</label>
			</div>
			<div class="col-6" id="div-label">
				
			</div>
		</div>

		<!-- Date du Renouvellement    -->
		<div class="row">
			<div class="col-6">
				<label>Date du Renouvellement :</label>
			</div>
			<div class="col-6">
				<label name="dateRenouvellementPDF" id="dateRenouvellementPDF"></label>
			</div>
		</div>
	</div>

	<div class="size-a4 mt-5">
		<!-- Le couple -->
		<table id="t">
			<thead>
				<th class="bg-Secondary text-center" style="border-radius: 10px; font-size: 30px;" colspan="4">Compte-rendu<br>Transfert d'Embryons Congelés (TEC)</th>
			</thead>
			<tbody>
				<br>
				<br>
				<!-- date -->
				<tr>
					<td colspan="4" style="text-align: end;">Tanger, le <label name="DatePdf" class="DatePdf" style="margin-right: 10px;">10/10/2023</label></td>
				</tr>
				<tr>
					<td colspan="4">Le couple :</td>
				</tr>
				<tr>
					<td colspan="2" class="fw-bold"><img src="../includes/img/female_96.png" style="width: 16px; height: 16px;">Madame</td>
					<td colspan="2" class="fw-bold"><img src="../includes/img/male_96.png" style="width: 16px; height: 16px;">Monsieur</td>
				</tr>
				<!-- Nom  -->
				<tr>
					<td>
						<label>Nom:</label>
					</td>
					<td>
						<label name="FnomPDF" id="FnomPDF" class="fst-italic FnomPDF" >
					</td>

					<td>
						<label>Nom:</label>
					</td>
					<td>
						<label name="HnomPDF" id="HnomPDF" class="fst-italic HnomPDF" >
					</td>
				</tr>
				<!-- Prenom -->
				<tr>
					<td>
						<label>Prénom:</label>
					</td>
					<td>
						<label name="FprenomPDF" id="FprenomPDF" class="fst-italic FprenomPDF">
					</td>

					<td>
						<label>Prénom:</label>
					</td>
					<td>
						<label name="HprenomPDF" id="HprenomPDF" class="fst-italic HprenomPDF">
					</td>
				</tr>
				<!-- Date naissance -->
				<tr>
					<td>
						<label>Date de Naissance :</label>
					</td>
					<td>
						<label name="FdateNaissancePDF" id="FdateNaissancePDF" class="fst-italic FdateNaissancePDF">
					</td>

					<td>
						<label>Date de Naissance :</label>
					</td>
					<td>
						<label name="HdateNaissancePDF" id="HdateNaissancePDF" class="fst-italic HdateNaissancePDF">
					</td>
				</tr>
				<!-- CIN -->
				<tr>
					<td>
						<label>N° CIN :</label>
					</td>
					<td>
						<label name="FcinPDF" id="FcinPDF" class="fst-italic FcinPDF">
					</td>

					<td>
						<label>N° CIN :</label>
					</td>
					<td>
						<label name="HcinPDF" id="HcinPDF" class="fst-italic HcinPDF">
					</td>
				</tr>
				<!-- Adresse -->
				<tr>
					<td>
						<label>Adresse conjugale :</label>
					</td>
					<td colspan="3">
						<label name="adressePDF" id="adressePDF" class="fst-italic adressePDF">
					</td>
				</tr>
				<!-- Tentative -->
				<tr>
					<td colspan="4">
						<br>
						<br>
						<span>A bénéficié de leur <span class="fw-bold"><label name="tentativePDF" id="tentativePDF" class="tentativePDF"></span> tentative au sein de notre centre de la Procréation Médicalement Assistée</span>
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<span>Un transfert des embryons/ blastocystes vitrifiés a été effectué, le : </span>
		<br>
		<!-- Date(s) de dévitrification    -->
		<div class="row">
			<div class="col-6">
				<label>Date(s) de dévitrification :</label>
			</div>
			<div class="col-6">
				<label name="dateDevitrificationTEC_PDF" id="dateDevitrificationTEC_PDF"></label>
			</div>
		</div>
		<!-- Nombre de paillette dévitrifiée  -->
		<div class="row">
			<div class="col-6">
				<label>Nombre de paillette dévitrifiée :</label>
			</div>
			<div class="col-6">
				<label name="nbPailletteDevitrifieeTEC_PDF" id="nbPailletteDevitrifieeTEC_PDF"></label>
			</div>
		</div>
		<!-- Nombre d’embryons/blastocytes dévitrifiés -->
		<div class="row">
			<div class="col-6">
				<label>Nombre d'embryons/blastocytes dévitrifiés :</label>
			</div>
			<div class="col-6">
				<label name="nbEmbryonsBlastocytesDevitrifiesTEC_PDF" id="nbEmbryonsBlastocytesDevitrifiesTEC_PDF"></label>
			</div>
		</div>
		<!-- Reste -->
		<div class="row">
			<div class="col-6">
				<label>Reste :</label>
			</div>
			<div class="col-6">
				<label name="resteTEC_PDF" id="resteTEC_PDF"></label>
			</div>
		</div>
		<!-- Date du Renouvellement -->
		<div class="row">
			<div class="col-6">
				<label>Date du Renouvellement :</label>
			</div>
			<div class="col-6">
				<label name="dateRenouvellementTEC_PDF" id="dateRenouvellementTEC_PDF"></label>
			</div>
		</div>
	</div>
</div>

<!-- LINKS -->
<link rel="stylesheet" href="../buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" >
$(document).ready(function(){

	myFunction();

	$('#add_button').click(function(){
		$('#patient_form')[0].reset();
		$('.modal-title').text("Ajouter patient");
		$('#action').val("Enregistrer");
		$('#operacao').val("Add");
		$("#patient_form").find('.is-valid').removeClass("is-valid");
	    $("#patient_form").find('.is-invalid').removeClass("is-invalid");

	});

	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"searchpatient.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
				"orderable":false,
			},
		],
		"oLanguage": {
                    "sProcessing":   "Traitement...",
                    "sLengthMenu":   "Afficher _MENU_",
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
		
		// dom: 'Bfrtip',
        // buttons: [ { extend: 'colvis', className: 'dropdwn' } ],

	});

	$(document).on('submit', '#patient_form', function(event){
		event.preventDefault();
		$.ajax({
			url:"insertpatient.php",
			method:'POST',
			data:new FormData(this),
			contentType:false,
			processData:false,
			success:function(data)
			{
				alert(data);
				$('#patient_form')[0].reset();
				$("#patient_form").find('.is-valid').removeClass("is-valid");
	        	$("#patient_form").find('.is-invalid').removeClass("is-invalid");
				$('#patientModal').modal('hide');
				dataTable.ajax.reload();
			}
		});
	});

	$(document).on('click', '.update', function(){
		var patient_id = $(this).attr("id");
		$.ajax({
			url:"selectonepatient.php",
			method:"POST",
			data:{patient_id:patient_id},
			dataType:"json",
			success:function(data)
			{
				
				$('#patientModal').modal('show');
				$('#ID_Folder').val(data.ID_Folder);
				$('#old_ID_Folder').val(data.ID_Folder);
				$('#Fnom').val(data.Fnom);
				$('#Fprenom').val(data.Fprenom);
				$('#Ftel').val(data.Ftel);
				$('#Fcin').val(data.Fcin);
				$('#FdateNaissance').val(data.FdateNaissance);
				$('#Hnom').val(data.Hnom);
				$('#Hprenom').val(data.Hprenom);
				$('#Htel').val(data.Htel);
				$('#Hcin').val(data.Hcin);
				$('#HdateNaissance').val(data.HdateNaissance);
				$('#adresse').val(data.adresse);
				$('#couv_sanitaire').val(data.couv_sanitaire);
				$('#tentative').val(data.tentative);
				$('.modal-title').text("Modifier patient");
				$('#patient_id').val(patient_id);
				$('#action').val("Enregistrer");
				$('#operacao').val("Edit");
				$("#patient_form").find('.is-valid').removeClass("is-valid");
	            $("#patient_form").find('.is-invalid').removeClass("is-invalid");
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var patient_id = $(this).attr("id");
		if(confirm("Voulez-vous vraiment supprimer ce patient ?"))
		{
			$.ajax({
				url:"deletepatient.php",
				method:"POST",
				data:{patient_id:patient_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
				});
				$.ajax({
					url:"deleteinfofolder.php",
					method:"POST",
					data:{patient_id:patient_id},
					success:function(data)
					{
						
					}
				});
		}
		else
		{
			return false;
		}
	});

	$(document).on('keyup', '#ID_Folder', function(event){
		var ID_Folder = $(this).val();
		
		validateRegex(this.value, '#ID_Folder', /^\d+\/\d{2}$/);

		if($(this).hasClass("is-valid")){
			$("#action").prop('disabled', false);
			$.ajax({
				url:"searchIDpatient.php",
				method:"POST",
				data:{ID_Folder:ID_Folder},
				dataType:"json",
				success:function(data)
				{
					if($('#operacao').val()=="Edit"){
						if(ID_Folder == data.ID_Folder && ID_Folder != $('#old_ID_Folder').val()){
							
							$("#action").prop('disabled', true);
							$('#ID_Folder').removeClass('is-valid');
							$('#ID_Folder').addClass('is-invalid');
						}
						else{
							$("#action").prop('disabled', false);
							$('#ID_Folder').removeClass('is-invalid');
							$('#ID_Folder').addClass('is-valid');
						}
					}else{
						if(ID_Folder == data.ID_Folder){
							$("#action").prop('disabled', true);
							$('#ID_Folder').removeClass('is-valid');
							$('#ID_Folder').addClass('is-invalid');
						
						}else{
							$("#action").prop('disabled', false);
							$('#ID_Folder').removeClass('is-invalid');
							$('#ID_Folder').addClass('is-valid');
						}

					}
				}
			});
		}
		else{
			$("#action").prop('disabled', true);
			$('#ID_Folder').addClass('is-invalid');
		}
	
	});

	// Start Docs
	// click show modal doc
	$(document).on('click', '.dossier', function(){
		var patient_idfk = $(this).attr("id");
		$.ajax({
			url:"selectoneInfoFolder.php",
			method:"POST",
			data:{patient_idfk:patient_idfk},
			dataType:"json",
			success:function(data)
			{
				$('#folder_form')[0].reset();
				$('#folderModal').modal('show');
				
				if (data.patient_idfk == patient_idfk) {
				$('#fpoids').val(data.fpoids);
				$('#ftaille').val(data.ftaille);
				$('#fIMC').val(data.fIMC);
				$('#fbareme').val(data.fbareme);
				$('input[name="fHIV"][value="'+data.fHIV+'"]').prop("checked",true);
				$('input[name="fHB"][value="'+data.fHB+'"]').prop("checked",true);
				$('input[name="fHC"][value="'+data.fHC+'"]').prop("checked",true);
				$('input[name="fCT"][value="'+data.fCT+'"]').prop("checked",true);
				$('input[name="fTPHA"][value="'+data.fTPHA+'"]').prop("checked",true);
				$('input[name="fVDRL"][value="'+data.fVDRL+'"]').prop("checked",true);
				$('#fGrpSanguine').val(data.fGrpSanguine);
				$('input[name="fTABAGISM"][value="'+data.fTABAGISM+'"]').prop("checked",true);
				$('input[name="fALCOOLISME"][value="'+data.fALCOOLISME+'"]').prop("checked",true);
				$('input[name="fMARIAGE"][value="'+data.fMARIAGE+'"]').prop("checked",true);
				$('#fNbrEnfant').val(data.fNbrEnfant);
				$('input[name="fTpInfer"][value="'+data.fTpInfer+'"]').prop("checked",true);
				$('#fDureeInfer').val(data.fDureeInfer);
				$('#fGESTITE').val(data.fGESTITE);
				$('#fPARITE').val(data.fPARITE);
				$('#fNaissaceVivante').val(data.fNaissaceVivante);
				$('#fFC').val(data.fFC);
				if(data.fAntecedentPMA_IAC=="true")
				$('input[name="fAntecedentPMA_IAC"]').prop("checked",true);
				else if(data.fAntecedentPMA_IAC=="flase") 
				$('input[name="fAntecedentPMA_IAC"]').prop("checked",false);
				if(data.fAntecedentPMA_FIV=="true")
				$('input[name="fAntecedentPMA_FIV"]').prop("checked",true);
				else $('input[name="fAntecedentPMA_FIV"]').prop("checked",false);
				$('#fAntChirurgie').val(data.fAntChirurgie);
				$('#fTraitMedic').val(data.fTraitMedic);
				$('#fJ').val(data.fJ);
				$('#fAMH').val(data.fAMH);
				$('#fTSH').val(data.fTSH);
				$('#fFSH').val(data.fFSH);
				$('#fOEstradiol').val(data.fOEstradiol);
				$('#fPRL').val(data.fPRL);
				$('#fLH').val(data.fLH);
				$('#fProgesterone').val(data.fProgesterone);
				if(data.fSOPK=="true")
				$('input[name="fSOPK"]').prop("checked",true);
				else $('input[name="fSOPK"]').prop("checked",false);
				if(data.fIO=="true")
				$('input[name="fIO"]').prop("checked",true);
				else $('input[name="fIO"]').prop("checked",false);
				if(data.fIOP=="true")
				$('input[name="fIOP"]').prop("checked",true);
				else $('input[name="fIOP"]').prop("checked",false);
				if(data.fEndometriose=="true")
				$('input[name="fEndometriose"]').prop("checked",true);
				else $('input[name="fEndometriose"]').prop("checked",false);
				if(data.fHysterosalpingographie=="true")
				$('input[name="fHysterosalpingographie"]').prop("checked",true);
				else $('input[name="fHysterosalpingographie"]').prop("checked",false);
				if(data.fPolypesFibromes=="true")
				$('input[name="fPolypesFibromes"]').prop("checked",true);
				else $('input[name="fPolypesFibromes"]').prop("checked",false);
				$('#fCFA_Droit').val(data.fCFA_Droit);
				$('#fCFA_Gauche').val(data.fCFA_Gauche);
				$('#fCommentaire').val(data.fCommentaire);
				$('#patient_idfk').val(data.patient_idfk);
				$('#hpoids').val(data.hpoids);
				$('#htaille').val(data.htaille);
				$('#hIMC').val(data.hIMC);
				$('#hbareme').val(data.hbareme);
				$('input[name="hHIV"][value="'+data.hHIV+'"]').prop("checked",true);
				$('input[name="hHB"][value="'+data.hHB+'"]').prop("checked",true);
				$('input[name="hHC"][value="'+data.hHC+'"]').prop("checked",true);
				$('input[name="hCT"][value="'+data.hCT+'"]').prop("checked",true);
				$('input[name="hTPHA"][value="'+data.hTPHA+'"]').prop("checked",true);
				$('input[name="hVDRL"][value="'+data.hVDRL+'"]').prop("checked",true);
				$('input[name="hDiabete"][value="'+data.hDiabete+'"]').prop("checked",true);
				$('input[name="hTABAGISM"][value="'+data.hTABAGISM+'"]').prop("checked",true);
				$('input[name="hALCOOLISME"][value="'+data.hALCOOLISME+'"]').prop("checked",true);
				$('input[name="hMARIAGE"][value="'+data.hMARIAGE+'"]').prop("checked",true);
				$('#hNbrEnfant').val(data.hNbrEnfant);
				$('input[name="hTpInfer"][value="'+data.hTpInfer+'"]').prop("checked",true);
				$('#hDureeInfer').val(data.hDureeInfer);
				$('#hAntChirurgie').val(data.hAntChirurgie);
				$('#hTraitMedic').val(data.hTraitMedic);
				$('#hFSH').val(data.hFSH);
				$('#hTestosterone').val(data.hTestosterone);
				$('#hPRL').val(data.hPRL);
				$('#hDate').val(data.hDate);
				$('#hAbstinence').val(data.hAbstinence);
				$('#hVolume').val(data.hVolume);
				$('#hConcentration').val(data.hConcentration);
				$('#hFormeTypique').val(data.hFormeTypique);
				$('#hMobiliteTotal').val(data.hMobiliteTotal);
				$('#hMobilite').val(data.hMobilite);
				$('#hConclusion').val(data.hConclusion);
				if(data.hVaricocele=="true")
				$('input[name="hVaricocele"]').prop("checked",true);
				else $('input[name="hVaricocele"]').prop("checked",false);
				if(data.hCryptorchidie=="true")
				$('input[name="hCryptorchidie"]').prop("checked",true);
				else $('input[name="hCryptorchidie"]').prop("checked",false);
				if(data.hVasectomie=="true")
				$('input[name="hVasectomie"]').prop("checked",true);
				else $('input[name="hVasectomie"]').prop("checked",false);
				if(data.hTorisonTesticulaire=="true")
				$('input[name="hTorisonTesticulaire"]').prop("checked",true);
				else $('input[name="hTorisonTesticulaire"]').prop("checked",false);
				if(data.hEjaculationRetrograde=="true")
				$('input[name="hEjaculationRetrograde"]').prop("checked",true);
				else $('input[name="hEjaculationRetrograde"]').prop("checked",false);
				if(data.hAtrophieTesticulaire=="true")
				$('input[name="hAtrophieTesticulaire"]').prop("checked",true);
				else $('input[name="hAtrophieTesticulaire"]').prop("checked",false);
				if(data.hDysfonctionErectile=="true")
				$('input[name="hDysfonctionErectile"]').prop("checked",true);
				else $('input[name="hDysfonctionErectile"]').prop("checked",false);
				if(data.hTestFragmentationADN=="true")
				$('input[name="hTestFragmentationADN"]').prop("checked",true);
				else $('input[name="hTestFragmentationADN"]').prop("checked",false);
				if(data.hMicrodeletionChromosomeY=="true")
				$('input[name="hMicrodeletionChromosomeY"]').prop("checked",true);
				else $('input[name="hMicrodeletionChromosomeY"]').prop("checked",false);
				if(data.hSyndromeKinefelter=="true")
				$('input[name="hSyndromeKinefelter"]').prop("checked",true);
				else $('input[name="hSyndromeKinefelter"]').prop("checked",false);
				if(data.hCaryotype=="true")
				$('input[name="hCaryotype"]').prop("checked",true);
				else $('input[name="hCaryotype"]').prop("checked",false);
				if(data.hMarTest=="true")
				$('input[name="hMarTest"]').prop("checked",true);
				else $('input[name="hMarTest"]').prop("checked",false);
				$('#hCommentaire').val(data.hCommentaire);
				// -----------------------------------------------------------------FORM 3-----------------------------------------------------------------
				console.log(data.medecinTraitant);
				$('#medecinTraitant').val(data.medecinTraitant);

				$('#dateDebut').val(data.dateDebut);
				$('#dureeStimuOvarienne').val(data.dureeStimuOvarienne);
				$('#traitementDoseTotale').val(data.traitementDoseTotale);
				if(data.spermeFrais=="true")
				$('input[name="spermeFrais"]').prop("checked",true);
				else $('input[name="spermeFrais"]').prop("checked",false);
				if(data.spermeCongele=="true")
				$('input[name="spermeCongele"]').prop("checked",true);
				else $('input[name="spermeCongele"]').prop("checked",false);
				if(data.biopsieTesticulaire=="true")
				$('input[name="biopsieTesticulaire"]').prop("checked",true);
				else $('input[name="biopsieTesticulaire"]').prop("checked",false);				
				$('#delaiDabstinence').val(data.delaiDabstinence);
				$('#mobiliteTotale').val(data.mobiliteTotale);
				$('#volume').val(data.volume);
				$('#concentration').val(data.concentration);
				$('#mobiliteProgressive').val(data.mobiliteProgressive);
				$('#formesTypiques').val(data.formesTypiques);
				$('#datePonstionFolliculaire').val(data.datePonstionFolliculaire);				
				$('#nbOvocytesRecup').val(data.nbOvocytesRecup);
				$('#nbOvocytesMatures').val(data.nbOvocytesMatures);
				$('#nbOvocytesFecondes').val(data.nbOvocytesFecondes);
				$('#nbEmbryonsObtenus').val(data.nbEmbryonsObtenus);
				$('#nbEmbryonsCultureProlongee').val(data.nbEmbryonsCultureProlongee);
				$('#nbBlastocystesObtenus').val(data.nbBlastocystesObtenus);
				$('#nbEmbryonsVitrifies').val(data.nbEmbryonsVitrifies);
				$('#nbEmbryonsTransferes').val(data.nbEmbryonsTransferes);
				$('#nbBlastocystesVitrifies').val(data.nbBlastocystesVitrifies);
				$('#nbTotalPaillettes').val(data.nbTotalPaillettes);
				$('#dateVitrification').val(data.dateVitrification);
				$('#nbEmbryonsBlastocytesVitrifies').val(data.nbEmbryonsBlastocytesVitrifies.split(',')[0]);
				$('#nbEmbryonsBlastocytesVitrifiesText').val(data.nbEmbryonsBlastocytesVitrifies.split(',')[1]);
				$('#dateRenouvellement').val(data.dateRenouvellement);
				Inputs_Generator(parseInt(data.nbEmbryonsBlastocytesVitrifies.split(',')[0]));
				$('#QualiteEmbryonnaire0').val(data.QualiteEmbryonnaire0);
				$('#QualiteEmbryonnaire1').val(data.QualiteEmbryonnaire1);
				$('#QualiteEmbryonnaire2').val(data.QualiteEmbryonnaire2);
				$('#QualiteEmbryonnaire3').val(data.QualiteEmbryonnaire3);
				$('#QualiteEmbryonnaire4').val(data.QualiteEmbryonnaire4);
				$('#QualiteEmbryonnaire5').val(data.QualiteEmbryonnaire5);
				$('#QualiteEmbryonnaire6').val(data.QualiteEmbryonnaire6);
				$('#QualiteEmbryonnaire7').val(data.QualiteEmbryonnaire7);
				$('#QualiteEmbryonnaire8').val(data.QualiteEmbryonnaire8);
				$('#QualiteEmbryonnaire9').val(data.QualiteEmbryonnaire9);

				$('#dateDevitrificationTEC').val(data.dateDevitrificationTEC);
				$('#nbPailletteDevitrifieeTEC').val(data.nbPailletteDevitrifieeTEC);
				$('#nbEmbryonsBlastocytesDevitrifiesTEC').val(data.nbEmbryonsBlastocytesDevitrifiesTEC);
				$('#resteTEC').val(data.resteTEC);
				$('#dateRenouvellementTEC').val(data.dateRenouvellementTEC);

				$('.modal-title').text("Modifier dossier");
				$('#action2').val("Modifier");
				$('#operacao2').val("Edit");
				$('#patient_idfk').val(parseInt(patient_idfk));
			}
			else{
				$('.modal-title').text("Ajouter dossier");
				$('#patient_idfk').val(patient_idfk);
				$('#action2').val("Ajouter");
				$('#operacao2').val("Add");
			}
		}
		});
	});
	
	$(".himcCalc").keyup(function(e) {
		var poids = $("#hpoids").val() || 0;
		var taille = $("#htaille").val() || 0;
		var imc = parseFloat(poids) / parseFloat(taille);

		if (!isNaN(imc) && imc !== Infinity) {

			if (imc < 18.5)
			{
				console.log(typeof(imc));
				$("#hbareme").val("Sous-poids");
			}
			else if (imc.toFixed(2) <= 24.9)
			{
				$("#hbareme").val("Normal");
			}
			else if (imc.toFixed(2) <= 29.9)
			{
				$("#hbareme").val("Surpoids");
			}
			else if (imc.toFixed(2) <= 34.9)
			{
				$("#hbareme").val("Obésité");
			}
			else if (imc.toFixed(2) >= 35.0)
			{
				$("#hbareme").val("Obésité Sévère");
			}

			$("#hIMC").val(imc.toFixed(2));
		}
	});

	$(".fimcCalc").keyup(function(e) {
		console.log("poids");
		var poids = $("#fpoids").val() || 0;
		var taille = $("#ftaille").val() || 0;

		var imc = poids / taille;

		if (!isNaN(imc) && imc !== Infinity) {
			$("#fIMC").val(imc.toFixed(2));

			if (imc < 18.5)
			{
				console.log(imc)
				$("#fbareme").val("Sous-poids");
			}
			else if (imc <= 24.9)
			{
				$("#fbareme").val("Normal");
			}
			else if (imc <= 29.9)
			{
				$("#fbareme").val("Surpoids");
			}
			else if (imc <= 34.9)
			{
				$("#fbareme").val("Obésité");
			}
			else if (imc >= 35.0)
			{
				$("#fbareme").val("Obésité Sévère");
			}
		}
	});

	// REGEX FEMALE INPUTS :
	$("#Fnom").keyup(function () { validateRegex(this.value, '#Fnom', /^[A-Za-z] [A-Za-z]|[A-Za-z]$/); });
	$("#Fprenom").keyup(function () { validateRegex(this.value, '#Fprenom', /^[A-Za-z] [A-Za-z]|[A-Za-z]$/); });
	$("#Fcin").keyup(function () { 
		$(this).val($(this).val().toUpperCase());
		validateRegex(this.value, '#Fcin', /^[A-Z]{1,2}[0-9]{1,7}$/); });
	$("#Ftel").keyup(function () { validateRegex(this.value, '#Ftel', /^0[0-9]{9}.*$/); });

	// REGEX MALE INPUTS :
	$("#Hnom").keyup(function () { validateRegex(this.value, '#Hnom', /^[A-Za-z] [A-Za-z]|[A-Za-z]$/); });
	$("#Hprenom").keyup(function () { validateRegex(this.value, '#Hprenom', /^[A-Za-z] [A-Za-z]|[A-Za-z]$/); });
	$("#Hcin").keyup(function () { 
		$(this).val($(this).val().toUpperCase());
		validateRegex(this.value, '#Hcin', /^[A-Z]{1,2}[0-9]{1,7}$/);
		});
	$("#Htel").keyup(function () { validateRegex(this.value, '#Htel', /^0[0-9]{9}.*$/); });

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
	
	$(document).on('submit', '#folder_form', function(event){
		event.preventDefault();
		var patient_idfk = $("#patient_idfk").val();
		//----------------------------------------------
		$('#fSOPK').val($('#fSOPK').is(':checked'));
		//-------------------------------------------
		$('#fIO').val($('#fIO').is(':checked'));
		//--------------------------------------------
		$('#fIOP').val($('#fIOP').is(':checked'));
		//--------------------------------------------
		$('#fEndometriose').val($('#fEndometriose').is(':checked'));
		//--------------------------------------------
		$('#fHysterosalpingographie').val($('#fHysterosalpingographie').is(':checked'));
		//--------------------------------------------
		$('#fPolypesFibromes').val($('#fPolypesFibromes').is(':checked'));
		//---------------------homme---------------------
		$('#hVaricocele').val($('#hVaricocele').is(':checked'));
		$('#hCryptorchidie').val($('#hCryptorchidie').is(':checked'));
		$('#hVasectomie').val($('#hVasectomie').is(':checked'));
		$('#hTorisonTesticulaire').val($('#hTorisonTesticulaire').is(':checked'));
		$('#hEjaculationRetrograde').val($('#hEjaculationRetrograde').is(':checked'));
		$('#hAtrophieTesticulaire').val($('#hAtrophieTesticulaire').is(':checked'));
		$('#hDysfonctionErectile').val($('#hDysfonctionErectile').is(':checked'));
		$('#hTestFragmentationADN').val($('#hTestFragmentationADN').is(':checked'));
		$('#hMicrodeletionChromosomeY').val($('#hMicrodeletionChromosomeY').is(':checked'));
		$('#hSyndromeKinefelter').val($('#hSyndromeKinefelter').is(':checked'));
		$('#hCaryotype').val($('#hCaryotype').is(':checked'));
		$('#hMarTest').val($('#hMarTest').is(':checked'));

		//---------------------FORM 3------------------------
		$('#spermeFrais').val($('#spermeFrais').is(':checked'));
		$('#spermeCongele').val($('#spermeCongele').is(':checked'));
		$('#biopsieTesticulaire').val($('#biopsieTesticulaire').is(':checked'));
		
		$('#nbEmbryonsBlastocytesVitrifiesText').val($('#nbEmbryonsBlastocytesVitrifies').val()+','+$('#nbEmbryonsBlastocytesVitrifiesText').val());
			$.ajax({
				url:"insertInfoFolder.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					//alert(data);
					$('#folder_form')[0].reset();
					$('#folderModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
	});
	// End Docs
});

function Inputs_Generator(value){
	var field = "";
	for( i = 0; i < value; i++){
		field += `<div class="col-2 mb-2"> <input type="text" id='QualiteEmbryonnaire${i}' name='QualiteEmbryonnaire${i}' class="form-control"/> </div>`;
	}
	if(value !== 0 && value <= 10){
		document.getElementById('div-container').style.display = 'block';
		document.getElementById('label-container').style.display = 'block';
		document.getElementById('div-row').innerHTML = field;
	}
	else{
		document.getElementById('div-container').style.display = 'none';
		document.getElementById('label-container').style.display = 'none';
	}
	// document.getElementById('div-container').style.display = 'block';
};

function labels_Generator(value){
	var field = "";
	for( i = 0; i < value; i++){
		field += `<label id='QualiteEmbryonnaire${i}PDF' name='QualiteEmbryonnaire${i}PDF'><span>|</span></label> `;
	}
	document.getElementById('div-label').innerHTML = field;
};

$('#dateVitrification').on('change', function(){
	var date = new Date(this.value);
	date.setFullYear(date.getFullYear() + 1);
	$('#dateRenouvellement').val(date.toISOString().substring(0, 10));
});

function testprint(){
	
	var patient_id = $('#patient_idfk').val();
	var patient_idfk =  $('#patient_idfk').val();
	$.ajax({
		url:"selectonepatient.php",
		method:"POST",
		data:{patient_id:patient_id},
		dataType:"json",
		success:function(data)
		{
			// Information Patient 
			$('.DatePdf').text(new Date().toLocaleDateString());
			$('.FnomPDF').text(data.Fnom);
			$('.FprenomPDF').text(data.Fprenom);
			$('.FdateNaissancePDF').text(data.FdateNaissance);
			$('.FcinPDF').text(data.Fcin);
			$('.HnomPDF').text(data.Hnom);
			$('.HprenomPDF').text(data.Hprenom);
			$('.HdateNaissancePDF').text(data.HdateNaissance);
			$('.HcinPDF').text(data.Hcin);
			$('.adressePDF').text(data.adresse);
			$('.tentativePDF').text(data.tentative);
			$.ajax({
				url:"selectoneInfoFolder.php",
				method:"POST",
				data:{patient_idfk:patient_idfk},
				dataType:"json",
				success:function(data)
				{
					$('#medecinTraitentPDF').text(data.medecinTraitant);
					$('#dateDebutPDF').text(data.dateDebut);
					$('#dureeStimuOvariennePDF').text(data.dureeStimuOvarienne);
					$('#traitementDoseTotalePDF').text(data.traitementDoseTotale);
					$('#delaiDabstinencePDF').text(data.delaiDabstinence);
					$('#mobiliteTotalePDF').text(data.mobiliteTotale);
					$('#volumePDF').text(data.volume);
					$('#concentrationPDF').text(data.concentration);
					$('#mobiliteProgressivePDF').text(data.mobiliteProgressive);
					$('#formesTypiquesPDF').text(data.formesTypiques);
					$('#datePonstionFolliculairePDF').text(data.datePonstionFolliculaire);
					$('#nbOvocytesRecupPDF').text(data.nbOvocytesRecup);
					$('#nbOvocytesMaturesPDF').text(data.nbOvocytesMatures);
					$('#nbOvocytesFecondesPDF').text(data.nbOvocytesFecondes);
					$('#nbEmbryonsObtenusPDF').text(data.nbEmbryonsObtenus);
					$('#nbEmbryonsCultureProlongeePDF').text(data.nbEmbryonsCultureProlongee);
					$('#nbBlastocystesObtenusPDF').text(data.nbBlastocystesObtenus);
					$('#nbEmbryonsVitrifiesPDF').text(data.nbEmbryonsVitrifies);
					$('#nbEmbryonsTransferesPDF').text(data.nbEmbryonsTransferes);
					$('#nbBlastocystesVitrifiesPDF').text(data.nbBlastocystesVitrifies);
					$('#nbTotalPaillettesPDF').text(data.nbTotalPaillettes);
					$('#dateVitrificationPDF').text(data.dateVitrification);
					$('#nbEmbryonsBlastocytesVitrifiesPDF').text(data.nbEmbryonsBlastocytesVitrifies.replace(',', ' '));
					$('#dateRenouvellementPDF').text(data.dateRenouvellement);
					labels_Generator(parseInt(data.nbEmbryonsBlastocytesVitrifies));
					$('#QualiteEmbryonnaire0PDF').text(data.QualiteEmbryonnaire0);
					$('#QualiteEmbryonnaire1PDF').text(data.QualiteEmbryonnaire1);
					$('#QualiteEmbryonnaire2PDF').text(data.QualiteEmbryonnaire2);
					$('#QualiteEmbryonnaire3PDF').text(data.QualiteEmbryonnaire3);
					$('#QualiteEmbryonnaire4PDF').text(data.QualiteEmbryonnaire4);
					$('#QualiteEmbryonnaire5PDF').text(data.QualiteEmbryonnaire5);
					$('#QualiteEmbryonnaire6PDF').text(data.QualiteEmbryonnaire6);
					$('#QualiteEmbryonnaire7PDF').text(data.QualiteEmbryonnaire7);
					$('#QualiteEmbryonnaire8PDF').text(data.QualiteEmbryonnaire8);
					$('#QualiteEmbryonnaire9PDF').text(data.QualiteEmbryonnaire9);
					$('#dateDevitrificationTEC_PDF').text(data.dateDevitrificationTEC);
					$('#nbPailletteDevitrifieeTEC_PDF').text(data.nbPailletteDevitrifieeTEC);
					$('#nbEmbryonsBlastocytesDevitrifiesTEC_PDF').text(data.nbEmbryonsBlastocytesDevitrifiesTEC);
					$('#resteTEC_PDF').text(data.resteTEC);
					$('#dateRenouvellementTEC_PDF').text(data.dateRenouvellementTEC);

					var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
					WinPrint.document.write(document.getElementById("contentPDF").innerHTML);
					if(data.spermeFrais=="true") {
						WinPrint.document.getElementById('spermeFraisPDF').checked = true;
					}else{
						WinPrint.document.getElementById('spermeFraisPDF').checked = false;
					}
					if(data.spermeCongele=="true") {
						WinPrint.document.getElementById('spermeCongelePDF').checked = true;
					}else{
						WinPrint.document.getElementById('spermeCongelePDF').checked = false;
					}
					if(data.biopsieTesticulaire=="true") {
						WinPrint.document.getElementById('biopsieTesticulairePDF').checked = true;
					}else{
						WinPrint.document.getElementById('biopsieTesticulairePDF').checked = false;
					}
					WinPrint.document.close();
					WinPrint.focus();
					WinPrint.print();
					WinPrint.close();
				}
			});
		}
	});

};

function myFunction(){
	$('#medecinTraitant').empty();
	$.ajax({
		type: "POST",
		url: "getalldoctorsNames.php",
		dataType:"json",
		success: function(data){
			$('#medecinTraitant').append('<option value="">-- SELECTIONNER --</option>');
			for (let index = 0; index < data.length; index++) {
				$('#medecinTraitant').append('<option value="' + data[index] + '">' +  data[index] + '</option>');
			}
		}
	});
}

</script>
<script src="../dataTables.buttons.min.js"></script>
<script src="../buttons.colVis.min.js"></script>

<!-- Content ends -->
<?php }else{
	header("Location: ../login/login-index.php");
} ?>
<?php
	include ('../includes/footer.html');
?>
