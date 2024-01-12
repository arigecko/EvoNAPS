<?php
		
	//Include files and set memory limit
	
	ini_set('memory_limit','1000M');
	include('variables_alignment.php');
	include('DB_credentials.php');
		
	//initalize query parameters
	$f_d_conditions = [];
	$f_d_parameters = [];
	$usedna = false;
		
		
		
			/////////////////////String Building Source ///////////////////////

$stringsource = "";
$stringall = "'PANDIT','OrthoMaM','Lanfear', 'TreeBASE'";


if(!empty($Ortho)){
			
			$Source[] = $Ortho;
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

			$select = "`SEQ_NAME`, `SEQ`";
			
			$f_d_query_1 = "SELECT ".$select . " FROM ";	
			$f_d_query = "SELECT count(*) FROM ";


			if (isset($Source_study) AND $Source_study == TRUE) {
				$select_study = "`a`.`ALI_ID`, `a`.`FROM_DATABASE`, `a`.`DATA_URL`, `a`.`STUDY_ID`, `b`.`STUDY_URL`, `b`.`CITATION` ";
				$f_d_query_study = "SELECT ".$select_study . " FROM ";	
				}
			
			try {
				
				if($DNA_Prot == "dna"){
					
					$f_d_query .= " `dna_sequences` ";
					$f_d_query_1 .= " `dna_sequences` ";
					if (isset($Source_study) AND $Source_study == TRUE) {
					$f_d_query_study .= " `dna_alignments` as `a` INNER JOIN `studies` as `b` using (`STUDY_ID`) ";
					}
					
					if(!empty($Ali_ID)){

						$f_d_conditions[] =  '`ALI_ID` =? ';
						$f_d_parameters[] =  $Ali_ID;
					}
	
					//Proteins only do if dna is done and finished 
				} else {
					
					
					$f_d_query .= " `aa_sequences` ";
					$f_d_query_1 .= " `aa_sequences` ";
					$f_d_query_study .= " `aa_alignments` as `a` INNER JOIN `studies` as `b` using (`STUDY_ID`) ";
					
					
					
					if(!empty($Ali_ID)){
						$f_d_conditions[] =  '`ALI_ID` =? ';
						$f_d_parameters[] =  $Ali_ID;
					
					}
				}
		
			
			//Fuze conditions in 1 string
			if($f_d_conditions){
				$f_d_query .= " WHERE ".implode(" AND ", $f_d_conditions);
				$f_d_query_1 .= " WHERE ".implode(" AND ", $f_d_conditions);

				if (isset($Source_study) AND $Source_study == TRUE) {
				$f_d_query_study .= "WHERE `a`.`ALI_ID` =?";
				}
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


			$select = "`a`.`ALI_ID`";
						
			$f_d_query_1 = " SELECT ".$select . " FROM ";
							
			$f_d_query = " SELECT count(*) FROM ";
						

			try {
						
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
							
							

				}else{
							
					$f_d_query .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
						
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
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
					$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions);
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



				$select = "`ALI_ID`";
						
				$f_d_query_1 = " SELECT ".$select . " FROM ";
								
				$f_d_query = " SELECT count(*) FROM ";
							
	
				try {
							
							
					if($DNA_Prot == "dna"){
								
								
						$f_d_query .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
						$f_d_query_1 .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
								

					}else{
								
						$f_d_query .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
						$f_d_query_1 .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
							
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
								$f_d_parameters[] .=  $Tax_resolv;
							} else {
								$f_d_query .= " INNER JOIN `taxonomy` as `c` ON (`a`.`LCA_TAX_ID`=`c`.`TAX_ID`) ";
								$f_d_query_1 .= " INNER JOIN `taxonomy` as `c` ON (`a`.`LCA_TAX_ID`=`c`.`TAX_ID`) ";

								$f_d_conditions[] .=  '`a`.`LCA_TAX_ID` =? ';
								$f_d_parameters[] .=  $Tax_resolv;
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
						$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
						$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions);
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



			$select = "`a`.`ALI_ID`";
					
			$f_d_query_1 = " SELECT ".$select . " FROM ";
							
			//$f_d_query = " SELECT count(*) FROM ";
			$f_d_query = " SELECT count(`a`.`ALI_ID`) FROM ";
						

			try {
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= "`dna_sequences` as `a` ";
					$f_d_query .= "INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `dna_alignments_taxonomy` as `c` using (`ALI_ID`) ";
					$f_d_query_1 .= "`dna_sequences` as `a` ";
					$f_d_query_1 .= "INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= "INNER JOIN `dna_alignments_taxonomy` as `c` using (`ALI_ID`) ";

				}else{
					
					$f_d_query .= "`aa_sequences` as `a` ";
					$f_d_query .= "INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `aa_alignments_taxonomy` as `c` using (`ALI_ID`) ";
					$f_d_query_1 .= "`aa_sequences` as `a` ";
					$f_d_query_1 .= "INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query_1 .= "INNER JOIN `aa_alignments_taxonomy` as `c` using (`ALI_ID`) ";
						
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
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
					$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions);
				}
					$f_d_query .= " GROUP BY `a`.`ALI_ID`";
					$f_d_query_1 .= " GROUP BY `a`.`ALI_ID`";
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