<?php

//include 'variables_alignment.php';
//include 'DBConnect_Alignment.php';
//include 'downloadme_alignment.php';

session_start();
ini_set('memory_limit','-1');
include "DB_credentials.php";


$DNA_Prot = isset($_SESSION['data type']) ? $_SESSION['data type'] : ""; 
$Tax_resolv = isset($_SESSION['resolved taxonomy']) ? $_SESSION['resolved taxonomy'] : "";
 
// catching values applicable to id search option

$Ali_ID_arr =  isset($_SESSION['Alignment ID']) ? $_SESSION['Alignment ID'] : "";			
$ID_search = isset($_SESSION['id search']) ? $_SESSION['id search'] : "";
$Source_study = isset($_SESSION['source study']) ? $_SESSION['source study'] : "";

// catching values applicable to rank search option

$Rank_search = isset($_SESSION['rank search']) ? $_SESSION['rank search'] : ""; 		
$Min_rank = isset($_SESSION['min rank']) ? $_SESSION['min rank'] : "";
$Max_rank = isset($_SESSION['max rank']) ? $_SESSION['max rank'] : "";


// catching values applicable to LCA search option

$LCA_search = isset($_SESSION['lca search']) ? $_SESSION['lca search'] : ""; 
$LCA = isset($_SESSION['LCA']) ? $_SESSION['LCA'] : "";

// catching values applicable to ancestor search option

$Ancestor_search = isset($_SESSION['ancestor search']) ? $_SESSION['ancestor search'] : ""; 
$Ancestor_rank = isset($_SESSION['Ancestor rank']) ? $_SESSION['Ancestor rank'] : "";
$Ancestor = isset($_SESSION['Ancestor']) ? $_SESSION['Ancestor'] : "";

// catching values applicable to taxa search option

$Taxa_search = isset($_SESSION['taxa search']) ? $_SESSION['taxa search'] : ""; 
$Taxa_ID_1 = isset($_SESSION['Taxa ID 1']) ? $_SESSION['Taxa ID 1'] : "";
$Taxa_ID_2 = isset($_SESSION['Taxa ID 2']) ? $_SESSION['Taxa ID 2'] : "";
$Taxa_ID_3 = isset($_SESSION['Taxa ID 3']) ? $_SESSION['Taxa ID 3'] : "";
$Taxa_ID_4 = isset($_SESSION['Taxa ID 4']) ? $_SESSION['Taxa ID 4'] : "";
$Taxa_ID_5 = isset($_SESSION['Taxa ID 5']) ? $_SESSION['Taxa ID 5'] : "";
$Taxa_rank_max = isset($_SESSION['taxa rank max']) ? $_SESSION['taxa rank max'] : "";
$Taxa_rank_min = isset($_SESSION['taxa rank min']) ? $_SESSION['taxa rank min'] : "";
$Taxa_LCA = isset($_SESSION['Taxa_LCA']) ? $_SESSION['Taxa_LCA'] : "";			


//additional parameters 

$Min_Nr_Seq = isset($_SESSION['min number of sequences']) ? $_SESSION['min number of sequences'] : "";
$Max_Nr_Seq = isset($_SESSION['max number of sequences']) ? $_SESSION['max number of sequences'] : "";
$Min_Nr_sites = isset($_SESSION['min number of sites']) ? $_SESSION['min number of sites'] : "";
$Max_Nr_sites = isset($_SESSION['max number of sites']) ? $_SESSION['max number of sites'] : "";		
$wildcard_gaps_fraction = isset($_SESSION['wildcard gaps fraction']) ? $_SESSION['wildcard gaps fraction'] : "";
$distinct_patterns_fraction = isset($_SESSION['distinct patterns fraction']) ? $_SESSION['distinct patterns fraction'] : "";
$parsimony_sites_fraction = isset($_SESSION['parsimony sites fraction']) ? $_SESSION['parsimony sites fraction'] : "";
$Nr_hits = $_SESSION['max number of datasets'];	

//Source Variables

$Source = [];
$Pan = isset($_SESSION['PANDIT']) ? $_SESSION['PANDIT'] : "";
$Ortho_v1 = isset($_SESSION['OrthoMaM v10c']) ? $_SESSION['OrthoMaM v10c'] : "";
$Ortho_v2 = isset($_SESSION['OrthoMaM v12a']) ? $_SESSION['OrthoMaM v12a'] : "";
$Lanf = isset($_SESSION['Lanfear']) ? $_SESSION['Lanfear'] : "";
$TreeB = isset($_POST['TreeBASE']) ? $_SESSION['TreeBASE'] : "";
$ALL = isset($_SESSION['all sources']) ? $_SESSION['all sources'] : "";
		


//////////////////////String Building Source ///////////////////////

$stringsource = "";
$stringall = "'PANDIT','OrthoMaM',  'Lanfear', 'TreeBASE'"; //'OrthoMaM_v12a',


if(!empty($Ortho_v1)){
			
			$Source[] = $Ortho_v1;
		}
if(!empty($Ortho_v2)){
			
	$Source[] = $Ortho_v2;
}
		
if(!empty($Pan)){
			
			$Source[] = $Pan;
		}
		
if(!empty($Lanf)){
			
			$Source[] = $Lanf;
		}

if(!empty($TreeB)){
			
			$Source[] = $TreeB;
		}

//////////////Loop for String Source Building////////////////////////


$first = false;
		
		
		if(!empty($Source)){
			
		foreach($Source as $list){
			
			
			if($first == false){
				
				$stringsource .= "'".$list."'";
				
				$first = true; 
				
			}else {
				$stringsource .= ","."'".$list."'";
				
			}
		}
	}
		
		// Dynamic Querys Parameters
		$f_d_conditions = [];
		$f_d_parameters = [];
		$f_d_parameters_source = [];
			
		if (!empty($ID_search) AND $ID_search == TRUE){

			$Ali_ID = explode(",", $Ali_ID_arr);
			$Ali_ID = array_diff($Ali_ID, ["-1"]);
			$Ali_ID = array_slice($Ali_ID, 0, 100); // limit for alignments 
			

			if (count($Ali_ID) == 1) {
				$select = "`SEQ_NAME`, `SEQ`";
				$f_d_query = "SELECT ".$select . " FROM ";	
				if (isset($Source_study) AND $Source_study == TRUE) {
					$select_study = "`ali`.`ALI_ID`, `ali`.`FROM_DATABASE`, `ali`.`DATA_URL`, `ali`.`STUDY_ID`, `study`.`STUDY_URL`, `study`.`CITATION` ";
					$f_d_query_study = "SELECT ".$select_study . " FROM ";	
					}
				
			} else {
				/*$select = " DISTINCT `ALI_ID`";*/
				$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`RHAS_MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
				$f_d_query = "SELECT ".$select . " FROM ";	
			}

			

					$Ali_ID_list = "('".implode("', '",$Ali_ID)."')";

			
			
			try {
				
				if($DNA_Prot == "dna"){
					// check if one or multiple ali IDs were inputted
					if (count($Ali_ID) == 1) {
					$f_d_query .= " `dna_sequences` ";
					} else {
					$f_d_query .= " `dna_alignments` as `ali` INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					}
					// Study information
					if (isset($Source_study) AND $Source_study == TRUE) {
					$f_d_query_study .= " `dna_alignments` as `ali` INNER JOIN `studies` as `study` using (`STUDY_ID`) ";
					}

					//Proteins only do if dna is done and finished 
				} else {
					
					if (count($Ali_ID) == 1) {
						$f_d_query .= " `dna_sequences` ";
					} else {
						$f_d_query .= " `aa_alignments` as `ali` INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						if (isset($Source_study) AND $Source_study == TRUE) {
						$f_d_query_study .= " `aa_alignments` as `ali` INNER JOIN `studies` as `study` using (`STUDY_ID`) ";
						}
					}
					
					//$Ali_ID_list = "(".implode(", ", $Ali_ID).")";

				}
		
			
			//Fuze conditions in 1 string
			if (count($Ali_ID) == 1) {
				$f_d_query .= " WHERE `ALI_ID` IN "."$Ali_ID_list";
			} else {
				$f_d_query .= " WHERE `ALI_ID` IN "."$Ali_ID_list"." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
			}
				

				if (isset($Source_study) AND $Source_study == TRUE) {
				$f_d_query_study .= "WHERE `ali`.`ALI_ID` = ? ";
				$ID_source = $Ali_ID[0];
				$f_d_parameters_source[] = $ID_source;
				}
			
			$f_d_query .= " LIMIT {$Nr_hits} ";
				
				
		} catch(PDOException $e) {
				
			echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
			}
		















			

			//////// searching within ranks //////////

			
		} elseif (!empty($Rank_search) AND $Rank_search == TRUE) {
			$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`RHAS_MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";

						
			$f_d_query = " SELECT ".$select . " FROM ";
						

			try {
						
				//decide to search in DNA or Proteins 
				if($DNA_Prot == "dna"){
					//Alignments Join 
					$f_d_query .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) ";
					//Trees Join 
					$f_d_query .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";						

				}else{
					//Alignments Join 
					$f_d_query .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) ";
					//Trees Join 
					$f_d_query .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						
				}

					
					// dynamic query

					// resolved taxonomy
					if(!empty($Tax_resolv)){
						$f_d_conditions[] .=  '`ali_tax`.`TAX_RESOLVED` =? ';
						$f_d_parameters[] .=  $Tax_resolv;
					}

					if (!empty($Max_rank)){

						if(!empty($Min_rank)){
							$f_d_conditions[] .=  '`ali_tax`.`LCA_RANK_NR` >=? ';
							$f_d_parameters[] .=  $Min_rank;
                            $f_d_conditions[] .=  '`ali_tax`.`LCA_RANK_NR` <=? ';
                            $f_d_parameters[] .=  $Max_rank;					

					    } else {
                            $f_d_conditions[] .=  '`ali_tax`.`LCA_RANK_NR` =? ';
                            $f_d_parameters[] .=  $Min_rank;
                        }
					}


					//Min number of sequences
					if(!empty($Min_Nr_Seq)){
							
						$f_d_conditions[] =  '`ali`.`TAXA` >= ? ';
						$f_d_parameters[] =  $Min_Nr_Seq;
					}
					
					//Max number of sequences
					if(!empty($Max_Nr_Seq)){	

						$f_d_conditions[] =  '`ali`.`TAXA` <= ? ';
						$f_d_parameters[] =  $Max_Nr_Seq;
					}
					
					//Min number of sites
					if(!empty($Min_Nr_sites)){
						
						$f_d_conditions[] =  '`ali`.`SITES` >= ? ';
						$f_d_parameters[] =  $Min_Nr_sites;	
					}

					//Max number of sites
					if(!empty($Max_Nr_sites)){
						
						$f_d_conditions[] =  '`ali`.`SITES` <= ? ';
						$f_d_parameters[] =  $Max_Nr_sites;
					}
					
					// fraction parsimony sies
					if(!empty($parsimony_sites_fraction)){
						
						$f_d_conditions[] =  '`ali`.`PARSIMONY_INFORMATIVE_SITES` / `ali`.`SITES` >= ? ';
						$f_d_parameters[] =  $parsimony_sites_fraction;
					}
					//fraction of patterns
					if(!empty($distinct_patterns_fraction)){
						
						$f_d_conditions[] =  '`ali`.`DISTINCT_PATTERNS` / `ali`.`SITES` >= ? ';
						$f_d_parameters[] =  $distinct_patterns_fraction;
					}
					
					//wildcard gaps
					if(!empty($wildcard_gaps_fraction)){
						
						$f_d_conditions[] =  '`ali`.`FRAC_WILDCARDS_GAPS` <= ? ';
						$f_d_parameters[] =  $wildcard_gaps_fraction;
					}						

				// source database
				if ($ALL == "checked"){
						
					$f_d_query .= " WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
	
					}elseif(!empty($Source)){
						
						$f_d_query .= " WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
					
					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				}
					$f_d_query .= "LIMIT {$Nr_hits} ";
					
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}








			//////// searching with specified LCA//////////

			} elseif (!empty($LCA_search) AND $LCA_search == TRUE) {

				$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`RHAS_MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
						
				$f_d_query = " SELECT ".$select . " FROM ";
							
	
				try {
							
					//decide to search in DNA or Proteins 
					if($DNA_Prot == "dna"){
						//Alignment join
						$f_d_query .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
						//Tree Join 
						$f_d_query .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

					}else if ($DNA_Prot == "aa"){
						//Alignment join
						$f_d_query .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
						//Trees Join 
						$f_d_query .= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";	
					}
	
					// dynamic query
	
						// resolved taxonomy
						if(!empty($Tax_resolv)){
							$f_d_conditions[] .=  '`ali_tax`.`TAX_RESOLVED` =? ';
							$f_d_parameters[] .=  $Tax_resolv;
						}

						// LCA and check if it's Name or ID
						if(!empty($LCA)){
							if (ctype_digit($LCA)){
								$f_d_conditions[] .=  '`ali_tax`.`LCA_TAX_ID` =? ';
								$f_d_parameters[] .=  $LCA;
							} else {
								$f_d_query .= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";

								$f_d_conditions[] .=  '`tax`.`TAX_NAME` =? ';
								$f_d_parameters[] .=  $LCA;
							}
						}

					//Min number of sequences
					if(!empty($Min_Nr_Seq)){
							
						$f_d_conditions[] =  ' `ali`.`TAXA` >= ? ';
						$f_d_parameters[] =  $Min_Nr_Seq;
					}
					
					//Max number of sequences
					if(!empty($Max_Nr_Seq)){	

						$f_d_conditions[] =  ' `ali`.`TAXA` <= ? ';
						$f_d_parameters[] =  $Max_Nr_Seq;
					}
					
					//Min number of sites
					if(!empty($Min_Nr_sites)){
						
						$f_d_conditions[] =  ' `ali`.`SITES` >= ? ';
						$f_d_parameters[] =  $Min_Nr_sites;	
					}

					//Max number of sites
					if(!empty($Max_Nr_sites)){
						
						$f_d_conditions[] =  ' `ali`.`SITES` <= ? ';
						$f_d_parameters[] =  $Max_Nr_sites;
					}
					
					// fraction parsimony sies
					if(!empty($parsimony_sites_fraction)){
						
						$f_d_conditions[] =  ' `ali`.`PARSIMONY_INFORMATIVE_SITES` / `ali`.`SITES` >= ? ';
						$f_d_parameters[] =  $parsimony_sites_fraction;
					}
					//fraction of patterns
					if(!empty($distinct_patterns_fraction)){
						
						$f_d_conditions[] =  ' `ali`.`DISTINCT_PATTERNS` / `ali`.`SITES` >= ? ';
						$f_d_parameters[] =  $distinct_patterns_fraction;
					}
					
					//wildcard gaps
					if(!empty($wildcard_gaps_fraction)){
						
						$f_d_conditions[] =  ' `ali`.`FRAC_WILDCARDS_GAPS` <= ? ';
						$f_d_parameters[] =  $wildcard_gaps_fraction;
					}	
	
					// source database
					if ($ALL == "checked"){
							
						$f_d_query .= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
		
						}elseif(!empty($Source)){
							
							$f_d_query .= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";		
						}
						
					//Fuze conditions in 1 string
					if($f_d_conditions){
						$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					}
					
					//Limit number of hits
					$f_d_query .= " LIMIT {$Nr_hits} ";
						
						
				}catch(PDOException $e) {				
					echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
					}
				

		
				//////// searching below specified Ancestor//////////
			
				} elseif (!empty($Ancestor_search) AND $Ancestor_search == TRUE) {

					$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`RHAS_MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
							
					$f_d_query = " SELECT ".$select . " FROM ";
		
					try {
						//decide to search in DNA or Proteins
						if($DNA_Prot == "dna"){
							//Alignment join
							$f_d_query .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
							//Tree join
							$f_d_query .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

						}else if ($DNA_Prot == "aa"){
							//Alignment join		
							$f_d_query .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
							//Tree join
							$f_d_query .= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
								
						}

							// dynamic query
		
							//resolved taxonomy
							if(!empty($Tax_resolv)){
								$f_d_conditions[] .=  '`ali_tax`.`TAX_RESOLVED` =? ';
								$f_d_parameters[] .=  $Tax_resolv;
							}

							if(!empty($Clade) && !empty($Clade_rank)){
								/*
								if (ctype_digit($Ancestor)){
									$f_d_conditions[] .=  '`ali_tax`.`LCA_TAX_ID` =? ';
									$f_d_parameters[] .=  $Ancestor;
								} else {
									$f_d_query_count.= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
									$f_d_query .= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
	
									$f_d_conditions[] .=  '`tax`.`TAX_NAME` =? ';
									$f_d_parameters[] .=  $Ancestor;
								}*/
							}
	
						//Min number of sequences
						if(!empty($Min_Nr_Seq)){
								
							$f_d_conditions[] =  ' `ali`.`TAXA` >= ? ';
							$f_d_parameters[] =  $Min_Nr_Seq;
						}
						
						//Max number of sequences
						if(!empty($Max_Nr_Seq)){	

							$f_d_conditions[] =  ' `ali`.`TAXA` <= ? ';
							$f_d_parameters[] =  $Max_Nr_Seq;
						}
						
						//Min number of sites
						if(!empty($Min_Nr_sites)){
							
							$f_d_conditions[] =  ' `ali`.`SITES` >= ? ';
							$f_d_parameters[] =  $Min_Nr_sites;	
						}

						//Max number of sites
						if(!empty($Max_Nr_sites)){
							
							$f_d_conditions[] =  ' `ali`.`SITES` <= ? ';
							$f_d_parameters[] =  $Max_Nr_sites;
						}
						
						// fraction parsimony sies
						if(!empty($parsimony_sites_fraction)){
							
							$f_d_conditions[] =  ' `ali`.`PARSIMONY_INFORMATIVE_SITES` / `ali`.`SITES` >= ? ';
							$f_d_parameters[] =  $parsimony_sites_fraction;
						}
						//fraction of patterns
						if(!empty($distinct_patterns_fraction)){
							
							$f_d_conditions[] =  ' `ali`.`DISTINCT_PATTERNS` / `ali`.`SITES` >= ? ';
							$f_d_parameters[] =  $distinct_patterns_fraction;
						}
						
						//wildcard gaps
						if(!empty($wildcard_gaps_fraction)){
							
							$f_d_conditions[] =  ' `ali`.`FRAC_WILDCARDS_GAPS` <= ? ';
							$f_d_parameters[] =  $wildcard_gaps_fraction;
						}	
		
						// source database
						if ($ALL == "checked"){
								
							$f_d_query .= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
			
							}elseif(!empty($Source)){
								
								$f_d_query .= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
								
							}
							
							//Fuze conditions in 1 string
						if($f_d_conditions){
							$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
						}
						
						//Limit number of hits
						$f_d_query .= " LIMIT {$Nr_hits} ";
							
							
					}catch(PDOException $e) {				
						echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
						}

	

			//////// searching for specified taxa//////////
		} elseif (!empty($Taxa_search) AND $Taxa_search == TRUE) {


			$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`RHAS_MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
					
			//$f_d_query = " SELECT DISTINCT ".$select . " FROM ";
			
			$f_d_query = " SELECT ".$select . " FROM ";


			/////////////////////String Building Taxa ///////////////////////

			$stringtaxa = "";

			if(!empty($Taxa_ID_1)){
						
						$Taxa_list[] = $Taxa_ID_1;
					}
			if(!empty($Taxa_ID_2)){
						
						$Taxa_list[] = $Taxa_ID_2;
					}
					
			if(!empty($Taxa_ID_3)){
						
						$Taxa_list[] = $Taxa_ID_3;
					}
					
			if(!empty($Taxa_ID_4)){
						
						$Taxa_list[] = $Taxa_ID_4;
					}

			if(!empty($Taxa_ID_5)){

						$Taxa_list[] = $Taxa_ID_5;
					}

			//////////////Loop for Taxa String Building////////////////////////

			$first = false;		
					
				if(!empty($Taxa_list)){
						
					foreach($Taxa_list as $list){
						
						if($first == false){
							
							$stringtaxa .= "'".$list."'";
							
							$first = true; 
							if (ctype_digit($list)){
								$Taxa_type = "NUM";
							} else {
								$Taxa_type = "STR";
							}
							
						}else {
							$stringtaxa .= ", "."'".$list."'";
						}
					}
				}


					



			try {
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= "`dna_sequences` as `seq` ";
					$f_d_query .= "INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `dna_alignments_taxonomy` as `ali_tax` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					

				}else{

					$f_d_query .= "`aa_sequences` as `seq` ";
					$f_d_query .= "INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `aa_alignments_taxonomy` as `ali_tax` using (`ALI_ID`) ";					
					$f_d_query .= "INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
				}
					
				if ($Taxa_type == "STR"){
					$f_d_query .= "INNER JOIN `taxonomy` as `tax` ON (`TAX_ID`) ";
				} /*
				if ($Taxa_type == "STR"){
					$f_d_query_count.= "INNER JOIN `taxonomy` as `tax` ON (`tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
					$f_d_query .= "INNER JOIN `taxonomy` as `tax` ON (`tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
				} */

					// dynamic query


				if(!empty($Tax_resolv)){
					$f_d_conditions[] .=  '`ali_tax`.`TAX_RESOLVED` =? ';
					$f_d_parameters[] .=  $Tax_resolv;
					}
				if(!empty($Taxa_LCA)){
					$f_d_conditions[] .=  '`ali_tax`.`LCA_TAX_ID` =? ';
					$f_d_parameters[] .=  $Taxa_LCA;

				}
					
                if (!empty($Taxa_rank_max)){

					if(!empty($Taxa_rank_min)){
						$f_d_conditions[] .=  '`ali_tax`.`LCA_RANK_NR` >=? ';
						$f_d_parameters[] .=  $Taxa_rank_min;
                        $f_d_conditions[] .=  '`ali_tax`.`LCA_RANK_NR` <=? ';
                        $f_d_parameters[] .=  $Taxa_rank_min;					

				    } else {
                        $f_d_conditions[] .=  '`ali_tax`.`LCA_RANK_NR` =? ';
                        $f_d_parameters[] .=  $Taxa_rank_max;
                       }
				}	
					
				//Min
				if(!empty($Min_Nr_Seq)){
							
					$f_d_conditions[] =  ' `ali`.`TAXA` >= ? ';
					$f_d_parameters[] =  $Min_Nr_Seq;
				}
					
				//Max
				if(!empty($Max_Nr_Seq)){	

					$f_d_conditions[] =  ' `ali`.`TAXA` <= ? ';
					$f_d_parameters[] =  $Max_Nr_Seq;
				}
					
				//Min	
				if(!empty($Min_Nr_sites)){
					
					$f_d_conditions[] =  ' `ali`.`SITES` >= ? ';
					$f_d_parameters[] =  $Min_Nr_sites;	
				}

				//Max
				if(!empty($Max_Nr_sites)){
					
					$f_d_conditions[] =  ' `ali`.`SITES` <= ? ';
					$f_d_parameters[] =  $Max_Nr_sites;
				}
					
				// fraction parsimony sies
				if(!empty($parsimony_sites_fraction)){
					
					$f_d_conditions[] =  ' `ali`.`PARSIMONY_INFORMATIVE_SITES` / `ali`.`SITES` >= ? ';
					$f_d_parameters[] =  $parsimony_sites_fraction;
				}
				//fraction of patterns
				if(!empty($distinct_patterns_fraction)){
			
					$f_d_conditions[] =  ' `ali`.`DISTINCT_PATTERNS` / `ali`.`SITES` >= ? ';
					$f_d_parameters[] =  $distinct_patterns_fraction;
				}
				
				//wildcard gaps
				if(!empty($wildcard_gaps_fraction)){
					
					$f_d_conditions[] =  ' `ali`.`FRAC_WILDCARDS_GAPS` <= ? ';
					$f_d_parameters[] =  $wildcard_gaps_fraction;
				}	
	
		
						
				// source database	
				if ($ALL == "checked"){
						
					$f_d_query .= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
	
					}elseif(!empty($Source)){
						
						$f_d_query .= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
				if (!empty($Taxa_list)){
					if ($Taxa_type == "NUM"){

					$f_d_query .=  " AND `seq`.`TAX_ID` in " . "(" . $stringtaxa. ")";
					} else if ($Taxa_type == "STR") {
					$f_d_query .=  " AND `tax`.`TAX_NAME` in " . "(" . $stringtaxa. ")";
					}
				}



					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				}
					$f_d_query .= " GROUP BY `seq`.`ALI_ID`";

					$f_d_query .= " LIMIT {$Nr_hits} ";
					$count_query = " SELECT count(*) FROM (".$f_d_query.") ";
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}
			}	
			
			
			
			
		
			
			
			
		$filter_query = $connect->prepare($f_d_query);
		$filter_query->execute($f_d_parameters);

			
		$filter_query_result = $filter_query->fetchAll(PDO::FETCH_ASSOC);
		
			
	//if(!empty($ID_search) && count($Ali_ID)  ==  1)
	if(!empty($ID_search) && count($Ali_ID)  ==  1){ 
		echo $Ali_ID;
		echo "<br>";
		header('Content-Type: text/csv; charset=utf-8');
		//header('Content-Disposition: attachment; filename=alignment.fasta');
		// file name contains the Ali ID
		header('Content-Disposition: attachment; filename="'.implode($Ali_ID).'.fasta"');
		//created file
		$output_file = fopen("php://output", "w"); 
			
		$headers_printed = true; 
		$output = " ";
		
		// loop through the fetched data
		foreach ($filter_query_result as $list) {
				 
				
			//check for headders 	
			if(!$headers_printed){
				
			//Fill in Headers here 
			fputcsv($output_file,array(''));
			$headers_printed = true;
			}
				
		// Write Results in Document 
		fwrite($output_file,">");
		fputcsv($output_file,$list,"\n");
		
		fpassthru($output_file);
		}
	} else {

/*

			header('Content-Type: text/c; charset=utf-8');
		header('Content-Disposition: attachment; filename=alignment.fasta');
		$output_file = fopen("php://output", "w"); 
		
		$headers_printed = true; 
		$output = " ";
		//$fasta = ">";
		
		foreach ($filter_query_result as $list) {
			 
			
			///download me 	
			if(!$headers_printed){
			
			//Fill in Headers here 
			fputcsv($output_file,array(''));
			$headers_printed = true;
			}
			
			//fwrite($output_file,"\n");
			fwrite($output_file,">");
		
		
			// Write Results in Document 
			fputcsv($output_file,$list,"\n");
			//fwrite($output_file,"\n");
			fpassthru($output_file);
		*/

	//if(!empty($ID_search) AND $ID_search == TRUE){ 
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=alignment.csv');
		$output_file = fopen("php://output", "w"); 
		
		$headers_printed = false; 
		$output = " ";
		//$fasta = ">";
		
		foreach ($filter_query_result as $list) {


			
			///download me 	
			if(!$headers_printed){
			
			//Fill in Headers here 
			fputcsv($output_file,array("Alignment_ID", "LCA_NAME", "LCA_RANK", "TAXA", "SITES", "DISTINCT_PATTERNS", "PARSIMONY_INFORMATIVE_SITES", "FRAC_WILDCARDS_GAPS", "MODEL", "BASE_MODEL", "RHAS", "LogL"),"\t");
			$headers_printed = true;
			}


			
			// Write Results in Document 
			fputcsv($output_file,$list,"\t");
			fpassthru($output_file);

		}
	}

		
		$connect = null;


?>