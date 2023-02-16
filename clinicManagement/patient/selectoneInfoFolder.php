<?php
include('../db_conn.php');
include('getallInfoFolder.php');
if(isset($_POST["patient_idfk"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM info_folder 
		WHERE ID_Patientfk = '".$_POST["patient_idfk"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $linha)
	{
		// FEMME
		$saida["fpoids"]	=	$linha["F_Poids"];
		$saida["ftaille"]	=	$linha["F_Taille"];
		$saida["fIMC"]	=	$linha["F_IMC"];
		$saida["fbareme"]	=	$linha["F_Bareme"];
		$saida["fHIV"]	=	$linha["F_Serol_HIV"];
		$saida["fHB"]	=	$linha["F_Serol_HB"];
		$saida["fHC"]	=	$linha["F_Serol_HC"];
		$saida["fCT"]	=	$linha["F_Serol_CT"];
		$saida["fTPHA"]	=	$linha["F_Serol_TPHA"];
		$saida["fVDRL"]	=	$linha["F_Serol_VDRL"];
		$saida["fGrpSanguine"]	=	$linha["F_GrpSang"];
		$saida["fTABAGISM"]	=	$linha["F_Tabagisme"];
		$saida["fALCOOLISME"]	=	$linha["F_Alcoolisme"];
		$saida["fMARIAGE"]	=	$linha["F_Mariage_precedent"];
		$saida["fNbrEnfant"]	=	$linha["F_Nbr_enfant"];
		$saida["fTpInfer"]	=	$linha["F_Type_infertilite"];
		$saida["fDureeInfer"]	=	$linha["F_Duree_infertilite"];
		$saida["fGESTITE"]	=	$linha["F_Gestite"];
		$saida["fPARITE"]	=	$linha["F_Parite"];
		$saida["fNaissaceVivante"]	=	$linha["F_Naissance_vivante"];
		$saida["fFC"]	=	$linha["F_FC"];
		$saida["fAntecedentPMA_IAC"]	=	$linha["F_AntePMA_IAC"];
		$saida["fAntecedentPMA_FIV"]	=	$linha["F_AntePMA_FIV"];
		$saida["fAntChirurgie"]	=	$linha["F_AntChirurgie"];
		$saida["fTraitMedic"]	=	$linha["F_TraitMedic"];
		$saida["fJ"]	=	$linha["F_J"];
		$saida["fAMH"]	=	$linha["F_AMH"];
		$saida["fTSH"]	=	$linha["F_TSH"];
		$saida["fFSH"]	=	$linha["F_FSH"];
		$saida["fOEstradiol"]	=	$linha["F_Oestradiol"];
		$saida["fPRL"]	=	$linha["F_PRL"];
		$saida["fLH"]	=	$linha["F_LH"];
		$saida["fProgesterone"]	=	$linha["F_Progesterome"];
		$saida["fSOPK"]	=	$linha["F_SOPK"];
		$saida["fIO"]	=	$linha["F_IO_"];
		$saida["fIOP"]	=	$linha["F_IOP"];
		$saida["fEndometriose"]	=	$linha["F_Endometriose"];
		$saida["fHysterosalpingographie"]	=	$linha["F_Hysterosalpingographie"];
		$saida["fPolypesFibromes"]	=	$linha["F_Polypes_fibromes"];
		$saida["fCFA_Droit"]	=	$linha["F_CFA_Droit"];
		$saida["fCFA_Gauche"]	=	$linha["F_CFA_Gauche"];
		$saida["fCommentaire"]	=	$linha["F_Commentaire"];
		$saida["patient_idfk"]	=	$linha["ID_Patientfk"];

		// HOMME
		$saida["hpoids"]	=	$linha["H_poids"];
		$saida["htaille"]	=	$linha["H_taille"];
		$saida["hIMC"]	=	$linha["H_IMC"];
		$saida["hbareme"]	=	$linha["H_bareme"];
		$saida["hHIV"]	=	$linha["H_HIV"];
		$saida["hHB"]	=	$linha["H_HB"];
		$saida["hHC"]	=	$linha["H_HC"];
		$saida["hCT"]	=	$linha["H_CT"];
		$saida["hTPHA"]	=	$linha["H_TPHA"];
		$saida["hVDRL"]	=	$linha["H_VDRL"];
		$saida["hDiabete"]	=	$linha["H_Diabete"];
		$saida["hTABAGISM"]	=	$linha["H_TABAGISM"];
		$saida["hALCOOLISME"]	=	$linha["H_ALCOOLISME"];
		$saida["hMARIAGE"]	=	$linha["H_MARIAGE"];
		$saida["hNbrEnfant"]	=	$linha["H_NbrEnfant"];
		$saida["hTpInfer"]	=	$linha["H_TpInfer"];
		$saida["hDureeInfer"]	=	$linha["H_DureeInfer"];
		$saida["hAntChirurgie"]	=	$linha["H_AntChirurgie"];
		$saida["hTraitMedic"]	=	$linha["H_TraitMedic"];
		$saida["hFSH"]	=	$linha["H_FSH"];
		$saida["hTestosterone"]	=	$linha["H_Testosterone"];
		$saida["hPRL"]	=	$linha["H_PRL"];
		$saida["hDate"]	=	$linha["H_Date"];
		$saida["hAbstinence"]	=	$linha["H_Abstinence"];
		$saida["hVolume"]	=	$linha["H_Volume"];
		$saida["hConcentration"]	=	$linha["H_Concentration"];
		$saida["hFormeTypique"]	=	$linha["H_FormeTypique"];
		$saida["hMobiliteTotal"]	=	$linha["H_MobiliteTotal"];
		$saida["hMobilite"]	=	$linha["H_Mobilite"];
		$saida["hConclusion"]	=	$linha["H_Conclusion"];
		$saida["hVaricocele"]	=	$linha["H_Varicocele"];
		$saida["hCryptorchidie"]	=	$linha["H_Cryptorchidie"];
		$saida["hVasectomie"]	=	$linha["H_asectomie"];
		$saida["hTorisonTesticulaire"]	=	$linha["H_TorisonTesticulaire"];
		$saida["hEjaculationRetrograde"]	=	$linha["H_EjaculationRetrograde"];
		$saida["hAtrophieTesticulaire"]	=	$linha["H_AtrophieTesticulaire"];
		$saida["hDysfonctionErectile"]	=	$linha["H_DysfonctionErectile"];
		$saida["hTestFragmentationADN"]	=	$linha["H_TestFragmentationADN"];
		$saida["hMicrodeletionChromosomeY"]	=	$linha["H_MicrodeletionChromosomeY"];
		$saida["hSyndromeKinefelter"]	=	$linha["H_SyndromeKinefelter"];
		$saida["hCaryotype"]	=	$linha["H_Caryotype"];
		$saida["hMarTest"]	=	$linha["H_MarTest"];
		$saida["hCommentaire"]	=	$linha["H_Commentaire"];

		//3 FORM
		$saida["medecinTraitant"]	=	$linha["medecinTraitant"];
		$saida["dateDebut"]	=	$linha["dateDebut"];
		$saida["dureeStimuOvarienne"]	=	$linha["dureeStimuOvarienne"];
		$saida["traitementDoseTotale"]	=	$linha["traitementDoseTotale"];
		$saida["spermeFrais"]	=	$linha["spermeFrais"];
		$saida["spermeCongele"]	=	$linha["spermeCongele"];
		$saida["biopsieTesticulaire"]	=	$linha["biopsieTesticulaire"];
		$saida["delaiDabstinence"]	=	$linha["delaiDabstinence"];
		$saida["mobiliteTotale"]	=	$linha["mobiliteTotale"];
		$saida["volume"]	=	$linha["volume"];
		$saida["concentration"]	=	$linha["concentration"];
		$saida["mobiliteProgressive"]	=	$linha["mobiliteProgressive"];
		$saida["formesTypiques"]	=	$linha["formesTypiques"];
		$saida["datePonstionFolliculaire"]	=	$linha["datePonstionFolliculaire"];
		$saida["nbOvocytesRecup"]	=	$linha["nbOvocytesRecup"];
		$saida["nbOvocytesMatures"]	=	$linha["nbOvocytesMatures"];
		$saida["nbOvocytesFecondes"]	=	$linha["nbOvocytesFecondes"];
		$saida["nbEmbryonsObtenus"]	=	$linha["nbEmbryonsObtenus"];
		$saida["nbEmbryonsCultureProlongee"]	=	$linha["nbEmbryonsCultureProlongee"];
		$saida["nbBlastocystesObtenus"]	=	$linha["nbBlastocystesObtenus"];
		$saida["nbEmbryonsVitrifies"]	=	$linha["nbEmbryonsVitrifies"];
		$saida["nbEmbryonsTransferes"]	=	$linha["nbEmbryonsTransferes"];
		$saida["nbBlastocystesVitrifies"]	=	$linha["nbBlastocystesVitrifies"];
		$saida["nbTotalPaillettes"]	=	$linha["nbTotalPaillettes"];
		$saida["dateVitrification"]	=	$linha["dateVitrification"];
		$saida["nbEmbryonsBlastocytesVitrifies"]	=	$linha["nbEmbryonsBlastocytesVitrifies"];
		$saida["dateRenouvellement"]	=	$linha["dateRenouvellement"];		
		$saida["QualiteEmbryonnaire0"]	=	$linha["QualiteEmbryonnaire0"];
		$saida["QualiteEmbryonnaire1"]	=	$linha["QualiteEmbryonnaire1"];
		$saida["QualiteEmbryonnaire2"]	=	$linha["QualiteEmbryonnaire2"];
		$saida["QualiteEmbryonnaire3"]	=	$linha["QualiteEmbryonnaire3"];
		$saida["QualiteEmbryonnaire4"]	=	$linha["QualiteEmbryonnaire4"];
		$saida["QualiteEmbryonnaire5"]	=	$linha["QualiteEmbryonnaire5"];
		$saida["QualiteEmbryonnaire6"]	=	$linha["QualiteEmbryonnaire6"];
		$saida["QualiteEmbryonnaire7"]	=	$linha["QualiteEmbryonnaire7"];
		$saida["QualiteEmbryonnaire8"]	=	$linha["QualiteEmbryonnaire8"];
		$saida["QualiteEmbryonnaire9"]	=	$linha["QualiteEmbryonnaire9"];

		$saida["dateDevitrificationTEC"]	=	$linha["dateDevitrificationTEC"];
		$saida["nbPailletteDevitrifieeTEC"]	=	$linha["nbPailletteDevitrifieeTEC"];
		$saida["nbEmbryonsBlastocytesDevitrifiesTEC"]	=	$linha["nbEmbryonsBlastocytesDevitrifiesTEC"];
		$saida["resteTEC"]	=	$linha["resteTEC"];
		$saida["dateRenouvellementTEC"]	=	$linha["dateRenouvellementTEC"];

	}
	echo json_encode($saida);
}
?>