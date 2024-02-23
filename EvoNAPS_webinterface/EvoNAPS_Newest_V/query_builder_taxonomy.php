<?php
		
	//Include files and set memory limit
	
	ini_set('memory_limit','1000M');
	include('variables_taxonomy.php');
	include('DB_credentials.php');
		
	//initalize query parameters
	$f_d_conditions = [];
	$f_d_parameters = [];
	$f_d_parameters_source = [];
	$usedna = false;
		
		
		
			/////////////////////String Building Source ///////////////////////

$stringsource = "";
//$stringall = "'PANDIT','OrthoMaM', 'Lanfear', 'TreeBASE'"; // 'OrthoMaM_v12a', 
$stringall = "'PANDIT','Lanfear','TreeBASE', 'OrthoMaM_v10c', 'OrthoMaM_v12a'";

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
		
		
		if (!empty($ID_search) AND $ID_search == TRUE){

			$Ali_ID = explode(",", $Ali_ID_arr);
			$Ali_ID = array_diff($Ali_ID, ["-1"]);
			$Ali_ID = array_slice($Ali_ID, 0, 100); // limit for alignments 

			if (count($Ali_ID) == 1) {
				$select = "`SEQ_NAME`, `SEQ`";
				$f_d_query_prev = "SELECT ".$select . " FROM ";	
				$f_d_query_count= "SELECT count(*) FROM ";
				if (isset($Source_study) AND $Source_study == TRUE) {
					$select_study = "`ali`.`ALI_ID`, `ali`.`FROM_DATABASE`, `ali`.`DATA_URL`, `ali`.`STUDY_ID`, `study`.`STUDY_URL`, `study`.`CITATION` ";
					$f_d_query_study = "SELECT ".$select_study . " FROM ";	
					}
				
			} else {
				/*$select = " DISTINCT `ALI_ID`";*/
				$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
				$f_d_query_prev = "SELECT ".$select . " FROM ";	
				$f_d_query_count= "SELECT count(`ALI_ID`) FROM ";
			}

			

					$Ali_ID_list = "('".implode("', '",$Ali_ID)."')";
			
			
			try {
				
				if($DNA_Prot == "dna"){
					// check if one or multiple ali IDs were inputted
					if (count($Ali_ID) == 1) {
					$f_d_query_count.= " `dna_sequences` ";
					//Preview
					$f_d_query_prev .= " `dna_sequences` ";
					} else {
					$f_d_query_count.= " `dna_alignments` as `ali` INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					//Preview
					$f_d_query_prev .= " `dna_alignments` as `ali` INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					}
					// Study information
					if (isset($Source_study) AND $Source_study == TRUE) {
					$f_d_query_study .= " `dna_alignments` as `ali` INNER JOIN `studies` as `study` using (`STUDY_ID`) ";
					}

					//Proteins only do if dna is done and finished 
				} else {
					
					if (count($Ali_ID) == 1) {
						$f_d_query_count.= " `dna_sequences` ";
						$f_d_query_prev .= " `dna_sequences` ";
					} else {
						$f_d_query_count.= " `aa_alignments` as `ali` INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						$f_d_query_prev .= " `aa_alignments` as `ali` INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						if (isset($Source_study) AND $Source_study == TRUE) {
						$f_d_query_study .= " `aa_alignments` as `ali` INNER JOIN `studies` as `study` using (`STUDY_ID`) ";
						}
					}
					
					//$Ali_ID_list = "(".implode(", ", $Ali_ID).")";

				}
		
			
			//Fuze conditions in 1 string
			if (count($Ali_ID) == 1) {
				$f_d_query_count.= " WHERE `ALI_ID` IN "."$Ali_ID_list";
				$f_d_query_prev .= " WHERE `ALI_ID` IN "."$Ali_ID_list";
			} else {
				$f_d_query_count.= " WHERE `ALI_ID` IN "."$Ali_ID_list"." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				$f_d_query_prev .= " WHERE `ALI_ID` IN "."$Ali_ID_list"." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
			}
				

				if (isset($Source_study) AND $Source_study == TRUE) {
				$f_d_query_study .= "WHERE `ali`.`ALI_ID` = ? ";
				$ID_source = $Ali_ID[0];
				$f_d_parameters_source[] = $ID_source;
				}
			
			$f_d_query_prev .= " LIMIT {$Nr_hits_preview} ";
				
		
			//Echo string for the query
			echo $f_d_query_count."<br>\n";
			echo $f_d_query_prev."<br>\n";
			
			if (isset($Source_study) AND $Source_study == TRUE) {
				echo $f_d_query_study;
			}
			
		} catch(PDOException $e) {
				
			echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
			}
		

















			

			//////// searching within ranks //////////

			
		} elseif (!empty($Rank_search) AND $Rank_search == TRUE) {
			$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";

						
			$f_d_query_prev = " SELECT ".$select . " FROM ";
							
			$f_d_query_count= " SELECT count(*) FROM ";
						

			try {
						
				//decide to search in DNA or Proteins 
				if($DNA_Prot == "dna"){
					//Alignments Join 
					$f_d_query_count.= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) ";
					//Trees Join 
					$f_d_query_count.= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

					//Preview
					//Alignments Join 
					$f_d_query_prev .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) ";
					//Trees Join 
					$f_d_query_prev .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";						

				}else{
					//Alignments Join 
					$f_d_query_count.= " `aa_alignments_taxonomy` as `ali_tax` ";
					//Trees Join 
					$f_d_query_count.= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
					
					//Preview
					//Alignments Join 
					$f_d_query_prev .= " `aa_alignments_taxonomy` as `ali_tax` ";
					//Trees Join 
					$f_d_query_prev .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						
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
						
					$f_d_query_count.= " WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
					$f_d_query_prev .= " WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
	
					}elseif(!empty($Source)){
						
						$f_d_query_count.= " WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						$f_d_query_prev .= " WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
					
					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query_count.= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					$f_d_query_prev .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				}
					$f_d_query_prev .= "LIMIT {$Nr_hits_preview} ";
					
				//Echo string for the query
				echo $f_d_query_count."<br>\n";
				echo ($f_d_query_prev);
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}








			//////// searching with specified LCA//////////

			} elseif (!empty($LCA_search) AND $LCA_search == TRUE) {

				$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
						
				$f_d_query_prev = " SELECT ".$select . " FROM ";
								
				$f_d_query_count= " SELECT count(*) FROM ";
							
	
				try {
							
					//decide to search in DNA or Proteins 
					if($DNA_Prot == "dna"){

						//Alignment join
						$f_d_query_count.= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
						//Tree Join 
						$f_d_query_count.= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

						//Preview
						//Alignment join
						$f_d_query_prev .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
						//Tree Join 
						$f_d_query_prev .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

					}else if ($DNA_Prot == "aa"){
								
						$f_d_query_count.= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
						//Trees Join 
						$f_d_query_count.= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";

						//Preview
						//Alignment join
						$f_d_query_prev .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
						//Trees Join 
						$f_d_query_prev .= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";	
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
								$f_d_query_count.= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
								$f_d_query_prev .= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";

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
							
						$f_d_query_count.= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
						$f_d_query_prev .= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
		
						}elseif(!empty($Source)){
							
							$f_d_query_count.= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
							$f_d_query_prev .= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";		
						}
						
					//Fuze conditions in 1 string
					if($f_d_conditions){
						$f_d_query_count.= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
						$f_d_query_prev .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					}
					
					//Limit number of hits
					$f_d_query_prev .= " LIMIT {$Nr_hits_preview} ";
						
					//Echo string for the query
					echo $f_d_query_count."<br>\n";
					echo $f_d_query_prev;

						
				}catch(PDOException $e) {				
					echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
					}
				

		
				//////// searching below specified Ancestor//////////
			
				} elseif (!empty($Ancestor_search) AND $Ancestor_search == TRUE) {

					$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
							
					$f_d_query_prev = " SELECT ".$select . " FROM ";
									
					$f_d_query_count= " SELECT count(*) FROM ";
								
		
					try {
						//decide to search in DNA or Proteins
						if($DNA_Prot == "dna"){
									
							//Alignment join		
							$f_d_query_count.= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
							//Tree join
							$f_d_query_count.= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
							
							//Preview
							$f_d_query_prev .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
							//Tree join
							$f_d_query_prev .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

						}else if ($DNA_Prot == "aa"){
							//Alignment join		
							$f_d_query_count.= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
							//Tree join
							$f_d_query_count.= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";

							//Preview
							$f_d_query_prev .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
							//Tree join
							$f_d_query_prev .= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
								
						}

							// dynamic query
		
							//resolved taxonomy
							if(!empty($Tax_resolv)){
								$f_d_conditions[] .=  '`ali_tax`.`TAX_RESOLVED` =? ';
								$f_d_parameters[] .=  $Tax_resolv;
							}

							if(!empty($Ancestor) && !empty($Ancestor_rank)){
								
								if (ctype_digit($Ancestor)){
									$f_d_conditions[] .=  "`ali_tax`.`{$Ancestor_rank}` =? ";
									$f_d_parameters[] .=  $Ancestor;
									echo $Ancestor;
								} else {
									$f_d_query_count.= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`{$Ancestor_rank}`=`tax`.`TAX_ID`) ";
									$f_d_query_prev .= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`{$Ancestor_rank}`=`tax`.`TAX_ID`) ";
									//$f_d_query_count.= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
									//$f_d_query_prev .= " INNER JOIN `taxonomy` as `tax` ON (`ali_tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
	
									$f_d_conditions[] .=  '`tax`.`TAX_NAME` =? ';
									$f_d_parameters[] .=  $Ancestor;
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
								
							$f_d_query_count.= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
							$f_d_query_prev .= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
			
							}elseif(!empty($Source)){
								
								$f_d_query_count.= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
								$f_d_query_prev .= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
								
							}
							
							//Fuze conditions in 1 string
						if($f_d_conditions){
							$f_d_query_count.= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
							$f_d_query_prev .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
						}
						
						//Limit number of hits
						$f_d_query_prev .= " LIMIT {$Nr_hits_preview} ";
							
						//Echo string for the query
						echo $f_d_query_count."<br>\n";
						echo $f_d_query_prev;
							
							
							
					}catch(PDOException $e) {				
						echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
						}













			

			//////// searching for specified taxa//////////
		} elseif (!empty($Taxa_search) AND $Taxa_search == TRUE) {


			$select = "`ali`.`ALI_ID`, `ali_tax`.`LCA_RANK_NAME`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
					
			//$f_d_query_prev = " SELECT DISTINCT ".$select . " FROM ";
							
			$f_d_query_count= " SELECT count(*) FROM ";
			//$f_d_query_count= " SELECT count( DISTINCT `ali`.`ALI_ID`) FROM ";
			

			$f_d_query_prev = " SELECT ".$select . " FROM ";
			//$f_d_query_count= " SELECT count( `ali`.`ALI_ID`) FROM ";


			/////////////////////String Building Taxa List///////////////////////

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
					$f_d_query_count.= "`dna_alignments_taxonomy` as `ali_tax` ";
					if($stringtaxa != ""){
					$f_d_query_count.= "INNER JOIN `dna_sequences` as `seq` using (`ALI_ID`) ";
					}
					//$f_d_query_count.= "`dna_sequences` as `seq` ";
					//$f_d_query_count.= "INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
					$f_d_query_count.= "INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
					//$f_d_query_count.= "INNER JOIN `dna_alignments_taxonomy` as `ali_tax` using (`ALI_ID`) ";
					$f_d_query_count.= "INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";

					//Preview
					$f_d_query_prev.= "`dna_alignments_taxonomy` as `ali_tax` ";
					if($stringtaxa != ""){
					$f_d_query_prev.= "INNER JOIN `dna_sequences` as `seq` using (`ALI_ID`) ";
					}
					//$f_d_query_prev .= "`dna_sequences` as `seq` ";
					//$f_d_query_prev .= "INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
					$f_d_query_prev.= "INNER JOIN `dna_alignments` as `ali` using (`ALI_ID`) ";
					//$f_d_query_count.= "INNER JOIN `dna_alignments_taxonomy` as `ali_tax` using (`ALI_ID`) ";
					$f_d_query_prev .= "INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					

				}else{
					$f_d_query_count.= "`aa_alignments` as `ali` ";
					$f_d_query_count.= "INNER JOIN `aa_sequences` as `seq` using (`ALI_ID`) ";
					//$f_d_query_count.= "`aa_sequences` as `seq` ";
					//$f_d_query_count.= "INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
					$f_d_query_count.= "INNER JOIN `aa_alignments_taxonomy` as `ali_tax` using (`ALI_ID`) ";
					$f_d_query_count.= "INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";

					//Preview
					$f_d_query_count.= "`aa_alignments` as `ali` ";
					$f_d_query_count.= "INNER JOIN `aa_sequences` as `seq` using (`ALI_ID`) ";
					//$f_d_query_prev .= "`aa_sequences` as `seq` ";
					//$f_d_query_prev .= "INNER JOIN `aa_alignments` as `ali` using (`ALI_ID`) ";
					$f_d_query_prev .= "INNER JOIN `aa_alignments_taxonomy` as `ali_tax` using (`ALI_ID`) ";					
					$f_d_query_prev .= "INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
				}
					
				if ($Taxa_type == "STR"){
					$f_d_query_count.= "INNER JOIN `taxonomy` as `tax` ON (`TAX_ID`) ";
					$f_d_query_prev .= "INNER JOIN `taxonomy` as `tax` ON (`TAX_ID`) ";
				} /*
				if ($Taxa_type == "STR"){
					$f_d_query_count.= "INNER JOIN `taxonomy` as `tax` ON (`tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
					$f_d_query_prev .= "INNER JOIN `taxonomy` as `tax` ON (`tax`.`LCA_TAX_ID`=`tax`.`TAX_ID`) ";
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
                        $f_d_parameters[] .=  $Taxa_rank_max;					

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
						
					$f_d_query_count.= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
					$f_d_query_prev .= "WHERE  `ali`.`FROM_DATABASE` in " . "(" . $stringall. ")";
	
					}elseif(!empty($Source)){
						
						$f_d_query_count.= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						$f_d_query_prev .= "WHERE `ali`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
				if (!empty($Taxa_list)){
					if ($Taxa_type == "NUM"){

					$f_d_query_count.=  " AND `seq`.`TAX_ID` in " . "(" . $stringtaxa. ")";
					$f_d_query_prev .=  " AND `seq`.`TAX_ID` in " . "(" . $stringtaxa. ")";
					} else if ($Taxa_type == "STR") {
					$f_d_query_count.=  " AND `tax`.`TAX_NAME` in " . "(" . $stringtaxa. ")";
					$f_d_query_prev .=  " AND `tax`.`TAX_NAME` in " . "(" . $stringtaxa. ")";
					}
				}



					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query_count.= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					$f_d_query_prev .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				}
				if($stringtaxa != ""){
					$f_d_query_count.= " GROUP BY `seq`.`ALI_ID`";
					$f_d_query_prev .= " GROUP BY `seq`.`ALI_ID`";
				}
					//$f_d_query_count.= " ORDER BY `seq`.`ALI_ID`";
					//$f_d_query_prev .= " ORDER BY `seq`.`ALI_ID`";


					

					$f_d_query_prev .= " LIMIT {$Nr_hits_preview} ";
					$count_query = " SELECT count(*) FROM (".$f_d_query_prev.") ";
					
				//Echo string for the query
				echo $f_d_query_count."<br>\n";
				//echo $count_query."<br>\n";
				echo $f_d_query_prev;
					
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}
			}	
		
				
		
		?>