<?php
session_start();
		if(isset($_POST['data type'])){
			$DNA_Prot = $_POST['data type'];
			$_SESSION['data type']= $DNA_Prot; 
			}
		if(isset($_POST['resolved taxonomy'])){
			$Tax_resolv = $_POST['resolved taxonomy'];
			$_SESSION['resolved taxonomy']= $Tax_resolv;
			} 
	
		// Alignment ID searh variables
		if(isset($_POST['Alignment_ID'])){
			$Ali_ID = $_POST['Alignment_ID'];
			$_SESSION['Alignment_ID']= $Ali_ID;
			}
		
	
		//
		if(isset($_POST['id_search_btn'])){
			$ID_search = $_POST['id_search_btn'];
			$_SESSION['id_search_btn']= $ID_search; 
			}else{

				$ID_search="";
			}
		if(isset($_POST['ranks_search_btn'])){
			$Rank_search = $_POST['ranks_search_btn'];
			$_SESSION['ranks_search_btn']= $Rank_search; 
			}else{

				$Rank_search="";
			}
		if(isset($_POST['clade_search_btn'])){
			$Clade_search = $_POST['clade_search_btn'];
			$_SESSION['clade_search_btn']= $Clade_search; 
			}else{

				$Clade_search="";
			}
		if(isset($_POST['sp_taxa_search_btn'])){
			$Taxa_search = $_POST['sp_taxa_search_btn'];
			$_SESSION['sp_taxa_search_btn']= $Taxa_search; 
			}else{

				$Taxa_search="";
			}

		
		if(isset($_POST['max rank'])){
			$Max_rank = $_POST['max rank'];
			$_SESSION['max rank']= $Max_rank;
			}
		if(isset($_POST['min rank'])){
			$Min_rank = $_POST['min rank'];
			$_SESSION['min rank']= $Min_rank;
			}
		if(isset($_POST['Clade rank'])){
			$Clade_rank = $_POST['Clade rank'];
			$_SESSION['Clade rank']= $Clade_rank;
			}
		if(isset($_POST['taxa rank'])){
			$Taxa_rank = $_POST['taxa rank'];
			$_SESSION['taxa rank']= $Taxa_rank;
			}
		if(isset($_POST['Taxa ID'])){
			$Taxa_ID = $_POST['Taxa ID'];
			$_SESSION['Taxa ID']= $Taxa_ID;
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
		if(isset($_POST['number_of_hits'])){
			$Nr_hits = ($_POST['number_of_hits']);
			$_SESSION['number_of_hits']= $Nr_hits;
			if($_POST['number_of_hits'] >= 0 && $_POST['number_of_hits'] < 20){
				$Nr_hits_preview = ($_POST['number_of_hits']);
				$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
			}else{
				$Nr_hits_preview = 20;
				$_SESSION['number of hits preview']= $Nr_hits_preview;
			}
		}
		/*if(isset($_POST['number_of_hits'])){
			if($_POST['number_of_hits'] >= 0 && $_POST['number_of_hits'] < 200){
				$Nr_hits = ($_POST['number_of_hits']);
				$_SESSION['number_of_hits']= $Nr_hits;
				//$lim_val = "value is set";
				//$_SESSION['value_set']= $lim_val;
			}else{
				$Nr_hits = 200;
				$_SESSION['number_of_hits']= $Nr_hits;
				//$lim_val = "value is not set";
				//$_SESSION['value_set']= $lim_val;
			}
			if($_POST['number_of_hits'] >= 0 && $_POST['number_of_hits'] < 20){
				$Nr_hits_preview = ($_POST['number_of_hits']);
				$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
			}else{
				$Nr_hits_preview = 20;
				$_SESSION['number of hits preview']= $Nr_hits_preview;
			}
		} */

	
		






?>