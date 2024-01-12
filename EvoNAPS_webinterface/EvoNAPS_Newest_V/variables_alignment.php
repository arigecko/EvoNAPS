<?php
session_start();
$_SESSION = array();

		if(isset($_POST['data_type'])){
			$DNA_Prot = $_POST['data_type'];
			$_SESSION['data_type']= $DNA_Prot; 
			}

		if(isset($_POST['resolved_taxonomy'])){
			$Tax_resolv = $_POST['resolved_taxonomy'];
			$_SESSION['resolved_taxonomy']= $Tax_resolv;
			} 
		// Alignment ID searh variables
		
		if(isset($_POST['Alignment_ID'])){
			$Ali_ID = $_POST['Alignment_ID'];
			$_SESSION['Alignment_ID']= $Ali_ID;
			}
	
		//
		if(isset($_POST['id_search_radio'])){
			$ID_search = $_POST['id_search_radio'];
			$_SESSION['id_search_radio']= $ID_search;
			if(isset($_POST['number_of_hits_id'])){
				if($_POST['number_of_hits_id'] > 0 && $_POST['number_of_hits_id'] <= 200){
					$Nr_hits = ($_POST['number_of_hits_id']);
					$_SESSION['number_of_hits_id']= $Nr_hits;
				}else{
					$Nr_hits = 200;
					$_SESSION['number_of_hits_id']= $Nr_hits;
				}
				if($_POST['number_of_hits_id'] >= 0 && $_POST['number_of_hits_id'] < 20){
					$Nr_hits_preview = ($_POST['number_of_hits_id']);
					$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 20;
					$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}
			




			}

		if(isset($_POST['rank_search_radio'])){
			$Rank_search = $_POST['rank_search_radio'];
			$_SESSION['rank_search_radio']= $Rank_search; 
			
			if(isset($_POST['number_of_hits_rank'])){
				if($_POST['number_of_hits_rank'] > 0 && $_POST['number_of_hits_rank'] <= 200){
					$Nr_hits = ($_POST['number_of_hits_rank']);
					$_SESSION['number_of_hits_rank']= $Nr_hits;
				}else{
					$Nr_hits = 200;
					$_SESSION['number_of_hits_rank']= $Nr_hits;
				}
				if($_POST['number_of_hits_rank'] >= 0 && $_POST['number_of_hits_rank'] < 20){
					$Nr_hits_preview = ($_POST['number_of_hits_rank']);
					$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 20;
					$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}
			}else{

				$Rank_search="";
			}
		if(isset($_POST['clade_search_radio'])){
			$Clade_search = $_POST['clade_search_radio'];
			$_SESSION['clade_search_radio']= $Clade_search; 
			if(isset($_POST['number_of_hits_clade'])){
				if($_POST['number_of_hits_clade'] > 0 && $_POST['number_of_hits_clade'] <= 200){
					$Nr_hits = ($_POST['number_of_hits_clade']);
					$_SESSION['number_of_hits_clade']= $Nr_hits;
				}else{
					$Nr_hits = 200;
					$_SESSION['number_of_hits_clade']= $Nr_hits;
				}
				if($_POST['number_of_hits_clade'] >= 0 && $_POST['number_of_hits_clade'] < 20){
					$Nr_hits_preview = ($_POST['number_of_hits_clade']);
					$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 20;
					$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}
			}else{

				$Clade_search="";
			}
		if(isset($_POST['taxa_search_radio'])){
			$Taxa_search = $_POST['taxa_search_radio'];
			$_SESSION['taxa_search_radio']= $Taxa_search; 
			if(isset($_POST['number_of_hits_taxa'])){
				if($_POST['number_of_hits_taxa'] > 0 && $_POST['number_of_hits_taxa'] <= 200){
					$Nr_hits = ($_POST['number_of_hits_taxa']);
					$_SESSION['number_of_hits_taxa']= $Nr_hits;
				}else{
					$Nr_hits = 200;
					$_SESSION['number_of_hits_taxa']= $Nr_hits;
				}
				if($_POST['number_of_hits_taxa'] >= 0 && $_POST['number_of_hits_taxa'] < 20){
					$Nr_hits_preview = ($_POST['number_of_hits_taxa']);
					$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 200;
					$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}
			}else{

				$Taxa_search="";
			}

			
		if(isset($_POST['source_study'])){
			$Source_study = $_POST['source_study'];
			$_SESSION['source_study']= $Source_study;
			}	
		if(isset($_POST['max_rank'])){
			$Max_rank = $_POST['max_rank'];
			$_SESSION['max_rank']= $Max_rank;
			}
		if(isset($_POST['min_rank'])){
			$Min_rank = $_POST['min_rank'];
			$_SESSION['min_rank']= $Min_rank;
			}
		if(isset($_POST['Clade_rank'])){
			$Clade_rank = $_POST['Clade_rank'];
			$_SESSION['Clade_rank']= $Clade_rank;
			}
		if(isset($_POST['taxa_rank'])){
			$Taxa_rank = $_POST['taxa_rank'];
			$_SESSION['taxa_rank']= $Taxa_rank;
			}
		if(isset($_POST['Taxa_ID'])){
			$Taxa_ID = $_POST['Taxa_ID'];
			$_SESSION['Taxa_ID']= $Taxa_ID;
			}
		if(isset($_POST['Clade'])){
			$Clade = $_POST['Clade'];
			$_SESSION['Clade']= $Clade;
			}


		//Source Variables
		$Source = [];
		
		if(isset($_POST['PANDIT'])){
			$Pan = $_POST['PANDIT'];
			$_SESSION['PANDIT']= $Pan;
			}
		
		if(isset($_POST['OrthoMaM'])){
			$Ortho =$_POST['OrthoMaM'];
			$_SESSION['OrthoMaM']= $Ortho;
			}
		if(isset($_POST['Lanfear'])){
			$Lanf =$_POST['Lanfear'];
			$_SESSION['Lanfear']= $Lanf;
			}
		// new TreeBASE
		if(isset($_POST['TreeBASE'])){
			$TreeB =$_POST['TreeBASE'];
			$_SESSION['TreeBASE']= $TreeB;
			}
		//
		if(isset($_POST['selectAll'])){
			$ALL = $_POST['selectAll'];
			$_SESSION['selectAll']= $ALL;
		}else{

			$ALL="";
		}
		

?>