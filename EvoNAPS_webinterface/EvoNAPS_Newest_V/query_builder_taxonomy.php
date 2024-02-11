<?php
		
	//Include files and set memory limit
	
	ini_set('memory_limit','1000M');
	include('variables_alignment.php');
	include('DB_credentials.php');
		
	//initalize query parameters
	$f_d_conditions = [];
	$f_d_parameters = [];
	$f_d_parameters_source = [];
	$usedna = false;
		
		
		
			/////////////////////String Building Source ///////////////////////

$stringsource = "";
$stringall = "'PANDIT','OrthoMaM', 'Lanfear', 'TreeBASE'"; // 'OrthoMaM_v12a', 


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

			$Ali_ID = explode(", ", $Ali_ID_arr);
			$Ali_ID = array_diff($Ali_ID, ["-1"]);
			$Ali_ID = array_slice($Ali_ID, 0, 100); // limit for alignments 
			foreach ($Ali_ID as $id){
				echo $id;
				echo "<br>";}

			if (count($Ali_ID) == 1) {
				$select = "`SEQ_NAME`, `SEQ`";
				$f_d_query_1 = "SELECT ".$select . " FROM ";	
				$f_d_query = "SELECT count(*) FROM ";
			} else {
				/*$select = " DISTINCT `ALI_ID`";*/
				$select = "`ali`.`ALI_ID`, `ali`.`SEQUENCES`, `ali`.`COLUMNS`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`MODEL_RATE_HETEROGENEITY`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
				$f_d_query_1 = "SELECT ".$select . " FROM ";	
				$f_d_query = "SELECT count(`ALI_ID`) FROM ";
			}
			
			
			//$select = "`ALI_ID`";
			
			

					$Ali_ID_list = "('".implode("', '",$Ali_ID)."')";

			if (isset($Source_study) AND $Source_study == TRUE) {
				$select_study = "`a`.`ALI_ID`, `a`.`FROM_DATABASE`, `a`.`DATA_URL`, `a`.`STUDY_ID`, `b`.`STUDY_URL`, `b`.`CITATION` ";
				$f_d_query_study = "SELECT ".$select_study . " FROM ";	
				}
			
			try {
				
				if($DNA_Prot == "dna"){
					
					if (count($Ali_ID) == 1) {
					$f_d_query .= " `dna_sequences` ";
					$f_d_query_1 .= " `dna_sequences` ";
					} else {
					$f_d_query .= " `dna_alignments` as `ali` INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					$f_d_query_1 .= " `dna_alignments` as `ali` INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					}
					
					if (isset($Source_study) AND $Source_study == TRUE) {
					$f_d_query_study .= " `dna_alignments` as `a` INNER JOIN `studies` as `b` using (`STUDY_ID`) ";
					}

					//Proteins only do if dna is done and finished 
				} else {
					
					if (count($Ali_ID) == 1) {
						$f_d_query .= " `dna_sequences` ";
						$f_d_query_1 .= " `dna_sequences` ";
					} else {
						$f_d_query .= " `aa_alignments` as `ali` INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						$f_d_query_1 .= " `aa_alignments` as `ali` INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						if (isset($Source_study) AND $Source_study == TRUE) {
						$f_d_query_study .= " `aa_alignments` as `a` INNER JOIN `studies` as `b` using (`STUDY_ID`) ";
						}
					}
					
					//$Ali_ID_list = "(".implode(", ", $Ali_ID).")";

				}
		
			
			//Fuze conditions in 1 string
			if (count($Ali_ID) == 1) {
				$f_d_query .= " WHERE `ALI_ID` IN "."$Ali_ID_list";
				$f_d_query_1 .= " WHERE `ALI_ID` IN "."$Ali_ID_list";
			} else {
				$f_d_query .= " WHERE `ALI_ID` IN "."$Ali_ID_list"." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				$f_d_query_1 .= " WHERE `ALI_ID` IN "."$Ali_ID_list"." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
			}
				echo "<br>";

				if (isset($Source_study) AND $Source_study == TRUE) {
				$f_d_query_study .= "WHERE `a`.`ALI_ID` = ? ";
				$ID_source = $Ali_ID[0];
				echo $ID_source;
				$f_d_parameters_source[] = $ID_source;
				}
			
			$f_d_query .= " LIMIT {$Nr_hits}";
			$f_d_query_1 .= " LIMIT {$Nr_hits_preview}";
				
		
			//Echo string for the query
			echo $f_d_query."<br>\n";
			echo ($f_d_query_1)."<br>\n";
			
			if (isset($Source_study) AND $Source_study == TRUE) {
				echo $f_d_query_study;
			}
			
		} catch(PDOException $e) {
				
			echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
			}
		

















			

			//////// searching within ranks //////////

			
		} elseif (!empty($Rank_search) AND $Rank_search == TRUE) {
			$select = "`ali`.`ALI_ID`, `ali`.`SEQUENCES`, `ali`.`COLUMNS`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`MODEL_RATE_HETEROGENEITY`, ROUND(`tree`.`LOGL`,4) AS LOGL ";

			//$select = "`a`.`ALI_ID`";
						
			$f_d_query_1 = " SELECT ".$select . " FROM ";
							
			$f_d_query = " SELECT count(*) FROM ";
						

			try {
						
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= " INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					$f_d_query_1 .= " INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
												

				}else{
							
					$f_d_query .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					
					$f_d_query .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
					$f_d_query_1 .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						
				}


		
					
					// dynamic query


					if(!empty($Tax_resolv)){
						$f_d_conditions[] .=  '`a`.`TAX_RESOLVED` =? ';
						$f_d_parameters[] .=  $Tax_resolv;

					}

					if (!empty($Max_rank)){

						if(!empty($Min_rank)){
							$f_d_conditions[] .=  '`a`.`LCA_RANK_NR` >=? ';
							$f_d_parameters[] .=  $Min_rank;
	
						}
						$f_d_conditions[] .=  '`a`.`LCA_RANK_NR` <=? ';
						$f_d_parameters[] .=  $Max_rank;

					} else {

						if(!empty($Min_rank)){
							$f_d_conditions[] .=  '`a`.`LCA_RANK_NR` =? ';
							$f_d_parameters[] .=  $Min_rank;
						}

					}					
						

				
				if ($ALL == "checked"){
						
					$f_d_query .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
					$f_d_query_1 .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
	
					}elseif(!empty($Source)){
						
						$f_d_query .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						$f_d_query_1 .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
					
					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				}
					$f_d_query .= " LIMIT {$Nr_hits}";
					$f_d_query_1 .= " LIMIT {$Nr_hits_preview}";
					
				//Echo string for the query
				echo $f_d_query."<br>\n";
				echo ($f_d_query_1);
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}

















			

			//////// searching within   clade//////////
			} elseif (!empty($Clade_search) AND $Clade_search == TRUE) {


				$select = "`ali`.`ALI_ID`, `ali`.`SEQUENCES`, `ali`.`COLUMNS`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`MODEL_RATE_HETEROGENEITY`, ROUND(`tree`.`LOGL`,4) AS LOGL ";

				//$select = "`ALI_ID`";
						
				$f_d_query_1 = " SELECT ".$select . " FROM ";
								
				$f_d_query = " SELECT count(*) FROM ";
							
	
				try {
							
							
					if($DNA_Prot == "dna"){
								
								
						$f_d_query .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
						$f_d_query_1 .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
						$f_d_query .= " INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
						$f_d_query_1 .= " INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					
								

					}else{
								
						$f_d_query .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
						$f_d_query_1 .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
						$f_d_query .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						$f_d_query_1 .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
					
							
					}
	

						// dynamic query
	
	
						if(!empty($Tax_resolv)){
							$f_d_conditions[] .=  '`a`.`TAX_RESOLVED` =? ';
							$f_d_parameters[] .=  $Tax_resolv;
	
						}
						/*
						if(!empty($Clade) AND !empty($Clade_rank)){

							$f_d_conditions[] .=  "`a`.`{$Clade_rank}` =? ";
							$f_d_parameters[] .=  $Clade;
	
						}
						*/
						if(!empty($Clade)){
							if (!empty($Clade_rank)){
							$f_d_conditions[] .=  "`a`.`{$Clade_rank}` =? ";
							$f_d_parameters[] .=  $Clade;
							} else if (ctype_digit($Clade)){
								$f_d_conditions[] .=  '`a`.`LCA_TAX_ID` =? ';
								$f_d_parameters[] .=  $Clade;
							} else {
								$f_d_query .= " INNER JOIN `taxonomy` as `c` ON (`a`.`LCA_TAX_ID`=`c`.`TAX_ID`) ";
								$f_d_query_1 .= " INNER JOIN `taxonomy` as `c` ON (`a`.`LCA_TAX_ID`=`c`.`TAX_ID`) ";

								$f_d_conditions[] .=  '`c`.`TAX_NAME` =? ';
								$f_d_parameters[] .=  $Clade;
							}
	
						}
	

					if ($ALL == "checked"){
							
						$f_d_query .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
						$f_d_query_1 .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
		
						}elseif(!empty($Source)){
							
							$f_d_query .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
							$f_d_query_1 .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
							
						}
						
						//Fuze conditions in 1 string
					if($f_d_conditions){
						$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
						$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					}
					
						
					
						$f_d_query .= " LIMIT {$Nr_hits}";
						$f_d_query_1 .= " LIMIT {$Nr_hits_preview}";
						
					//Echo string for the query
					echo $f_d_query."<br>\n";
					echo ($f_d_query_1);
						
						
						
				}catch(PDOException $e) {				
					echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
					}
				

		
				
			














			

			//////// searching within   taxa//////////
		} elseif (!empty($Taxa_search) AND $Taxa_search == TRUE) {


			$select = "`ali`.`ALI_ID`, `ali`.`SEQUENCES`, `ali`.`COLUMNS`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`MODEL_RATE_HETEROGENEITY`, ROUND(`tree`.`LOGL`,4) AS LOGL ";

			//$select = "`a`.`ALI_ID`";
					
			$f_d_query_1 = " SELECT  ".$select . " FROM ";
							
			//$f_d_query = " SELECT count(*) FROM ";
			$f_d_query = " SELECT count( `a`.`ALI_ID`) FROM ";
						

			try {
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= "`dna_sequences` as `a` ";
					$f_d_query .= "INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `dna_alignments_taxonomy` as `c` using (`ALI_ID`) ";
					$f_d_query .= " INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					$f_d_query_1 .= "`dna_sequences` as `a` ";
					$f_d_query_1 .= "INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= "INNER JOIN `dna_alignments_taxonomy` as `c` using (`ALI_ID`) ";
					$f_d_query_1 .= " INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					

				}else{
					
					$f_d_query .= "`aa_sequences` as `a` ";
					$f_d_query .= "INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `aa_alignments_taxonomy` as `c` using (`ALI_ID`) ";
					$f_d_query .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
					$f_d_query_1 .= "`aa_sequences` as `a` ";
					$f_d_query_1 .= "INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= "INNER JOIN `aa_alignments_taxonomy` as `c` using (`ALI_ID`) ";					
					$f_d_query_1 .= " INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
						
				}


					// dynamic query


					if(!empty($Tax_resolv)){
						$f_d_conditions[] .=  '`c`.`TAX_RESOLVED` =? ';
						$f_d_parameters[] .=  $Tax_resolv;

					}

					if (!empty($Taxa_ID)){

						$f_d_conditions[] .=  '`a`.`TAX_ID` =? ';
						$f_d_parameters[] .=  $Taxa_ID;

					} 				
						

				
				if ($ALL == "checked"){
						
					$f_d_query .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
					$f_d_query_1 .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
	
					}elseif(!empty($Source)){
						
						$f_d_query .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						$f_d_query_1 .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
					
					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
					$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions)." AND `tree`.`TREE_TYPE` = 'ml' AND `tree`.`ORIGINAL_ALI`='1' ";
				}
					//$f_d_query .= " GROUP BY `a`.`ALI_ID`";
					//$f_d_query_1 .= " GROUP BY `a`.`ALI_ID`";
					$f_d_query .= " ORDER BY `a`.`ALI_ID`";
					$f_d_query_1 .= " ORDER BY `a`.`ALI_ID`";
					$f_d_query .= " LIMIT {$Nr_hits}";
					$f_d_query_1 .= " LIMIT {$Nr_hits_preview}";
					
				//Echo string for the query
				echo $f_d_query."<br>\n";
				echo ($f_d_query_1);
					
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}
			}	
				
				
		
		?>