<?php
session_start();
$_SESSION = array();
//error_reporting(0);

// Set Variables for the Filter 
	if(isset($_POST['alignment_features'])){
		$Alignment_Specs_Check = $_POST['alignment_features'];
		$_SESSION['alignment_features']= $Alignment_Specs_Check; 
	}else{
		$Alignment_Specs_Check = "";

	}
	if(isset($_POST['tree_features'])){
		$Trees_Specs_Check = $_POST['tree_features'];
		$_SESSION['tree_features']= $Trees_Specs_Check; 
	}else{
		$Trees_Specs_Check = "";

	}
		if(isset($_POST['datatype'])){
		$DNA_Prot = $_POST['datatype'];
		$_SESSION['datatype']= $DNA_Prot; 
		}
		if(isset($_POST['number_of_sequences'])){
		$Nr_Seq = $_POST['number_of_sequences'];
		$_SESSION['number_of_sequences']= $Nr_Seq; 
		}
		if(isset($_POST['max_number_of_sequences'])){
		$Max_Nr_Seq = $_POST['max_number_of_sequences'];
		$_SESSION['max_number_of_sequences']= $Max_Nr_Seq; 
		}
		if(isset($_POST['number_of_sites'])){
		$Nr_sites = $_POST['number_of_sites'];
		$_SESSION['number_of_sites']= $Nr_sites; 
		}
		if(isset($_POST['max_number_of_sites'])){
		$Max_Nr_sites = $_POST['max_number_of_sites'];
		$_SESSION['max_number_of_sites']= $Max_Nr_sites; 
		}
		
		
		if(isset($_POST['min_mean_branch_length'])){
		$BL_mean_min = $_POST['min_mean_branch_length'];
		$_SESSION['min_mean_branch_length']= $BL_mean_min;
		}
		if(isset($_POST['max_mean_branch_length'])){
		$BL_mean_max = $_POST['max_mean_branch_length'];
		$_SESSION['max_mean_branch_length']= $BL_mean_max;
		}
		if(isset($_POST['min_branch_length'])){
		$BL_min = $_POST['min_branch_length'];
		$_SESSION['min_branch_length']= $BL_min;
		}
		if(isset($_POST['max_branch_length'])){
		$BL_max = $_POST['max_branch_length'];
		$_SESSION['max_branch_length']= $BL_max;
		}
		if(isset($_POST['min_mean_internal_branch_length'])){
		$IBL_mean_min = $_POST['min_mean_internal_branch_length'];
		$_SESSION['min_mean_internal_branch_length']= $IBL_mean_min;
		}
		if(isset($_POST['max_mean_internal_branch_length'])){
		$IBL_mean_max = $_POST['max_mean_internal_branch_length'];
		$_SESSION['max_mean_internal_branch_length']= $IBL_mean_max;
		}
		if(isset($_POST['min_internal_branch_length'])){
		$IBL_min  = $_POST['min_internal_branch_length'];
		$_SESSION['min_internal_branch_length']= $IBL_min;
		}
		if(isset($_POST['max_internal_branch_length'])){
		$IBL_max =  $_POST['max_internal_branch_length'];
		$_SESSION['max_internal_branch_length']= $IBL_max;
		}
		
		if(isset($_POST['min_mean_external_branch_length'])){
		$EBL_mean_min = $_POST['min_mean_external_branch_length'];
		$_SESSION['min_mean_external_branch_length']= $EBL_mean_min;
		}
		if(isset($_POST['max_mean_external_branch_length'])){
		$EBL_mean_max = $_POST['max_mean_external_branch_length'];
		$_SESSION['max_mean_external_branch_length']= $EBL_mean_max;
		}
		if(isset($_POST['min_external_branch_length'])){
		$EBL_min = $_POST['min_external_branch_length'];
		$_SESSION['min_external_branch_length']= $EBL_min;
		}
		if(isset($_POST['max_external_branch_length'])){
		$EBL_max = $_POST['max_external_branch_length'];
		$_SESSION['max_external_branch_length']= $EBL_max;
		}
		if(isset($_POST['tree_length'])){
		$tree_len = $_POST['tree_length'];
		$_SESSION['tree_length']= $tree_len;
		}
		if(isset($_POST['max_tree_length'])){
		$Max_tree_len = $_POST['max_tree_length'];
		$_SESSION['max_tree_length']= $Max_tree_len;
		}
		if(isset($_POST['tree_diameter'])){
		$tree_dia = $_POST['tree_diameter'];
		$_SESSION['tree_diameter']= $tree_dia;
		}
		if(isset($_POST['max_tree_diameter'])){
		$Max_tree_dia = $_POST['max_tree_diameter'];
		$_SESSION['max_tree_diameter']= $Max_tree_dia;

		// <!-- new number of hits -->
		
		if(isset($_POST['number_of_hits'])){
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
		}
		
		
		



?>