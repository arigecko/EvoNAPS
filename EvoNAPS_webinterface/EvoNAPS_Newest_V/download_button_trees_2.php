<?php

ini_set('memory_limit','1000M');
session_start();
include "DB_credentials.php";
			
			
		$DNA_Prot = $_SESSION['datatype'];
		
	
		
		$Nr_Seq = $_SESSION['number_of_sequences'];
		$Max_Nr_Seq = $_SESSION['max_number_of_sequences'];
		
		$Nr_sites = $_SESSION['number_of_sites'];
		$Max_Nr_sites = $_SESSION['max_number_of_sites'];
		
		$Alignment_Specs_Check = $_SESSION['alignment_features'];

		$Trees_Specs_Check = $_SESSION['tree_features'];
		
	
		$BL_mean_min = $_SESSION['min_mean_branch_length'];
		$BL_mean_max = $_SESSION['max_mean_branch_length'];
		$BL_min = $_SESSION['min_branch_length'];
		$BL_max = $_SESSION['max_branch_length'];
		
	
		$IBL_mean_min =  $_SESSION['min_mean_internal_branch_length'];
		$IBL_mean_max =  $_SESSION['max_mean_internal_branch_length'];
		$IBL_min  = $_SESSION['min_internal_branch_length'];
		$IBL_max =  $_SESSION['max_internal_branch_length'];
		
		
		$EBL_mean_min = $_SESSION['min_mean_external_branch_length'];
		$EBL_mean_max = $_SESSION['max_mean_external_branch_length'];
		$EBL_min = $_SESSION['min_external_branch_length'];
		$EBL_max = $_SESSION['max_external_branch_length'];
		
		$tree_len = $_SESSION['tree_length'];
		$Max_tree_len = $_SESSION['max_tree_length'];
		$tree_dia = $_SESSION['tree_diameter'];
		$Max_tree_dia = $_SESSION['max_tree_diameter'];
		

		
		//$Hits = $_SESSION['Hits_anzeigen'];

			//////////////////Setting Variables////////////777
	$Source = [];
	$Pan = $_SESSION['PANDIT'];
	$Ortho =$_SESSION['OrthoMaM'];
	$Lanf =$_SESSION['Lanfear'];
	$ALL = $_SESSION['selectAll'];



		$f_d_conditions = [];
		$f_d_parameters = [];




//////////////////////String Building Source ///////////////////////

$stringsource = "";
$stringall = "'PANDIT','OrthoMaM','Lanfear'";

if(!empty($Ortho)){
			
			$Source[] = $Ortho;
		}
		
		
if(!empty($Pan)){
			
			$Source[] = $Pan;
		}
		
if(!empty($Lanf)){
			
			$Source[] = $Lanf;
			
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
		$usedna = false;

		
		if($DNA_Prot == "dna"){
			
			// DNA select
			
			 $select = "`dna_alignments`.`ALI_KEY`,`dna_trees`.`TREE_KEY`, `dna_branches`.`BRANCH_KEY`, `dna_alignments`.`ALI_ID`,`dna_trees`.`TREE_TYPE`, `dna_branches`.`BRANCH_INDEX`, `dna_branches`.`BRANCH_TYPE`, `dna_sequences`.`SEQ_NAME`, `dna_branches`.`BL`,`dna_branches`.`SPLIT_SIZE` ";
			$usedna = true;
			
			
		} else {
			//Aa select
			 $select = "`aa_alignments`.`ALI_KEY`,`aa_trees`.`TREE_KEY`, `aa_branches`.`BRANCH_KEY`, `aa_alignments`.`ALI_ID`,`aa_trees`.`TREE_TYPE`, `aa_branches`.`BRANCH_INDEX`, `aa_branches`.`BRANCH_TYPE`, `aa_sequences`.`SEQ_NAME`, `aa_branches`.`BL`,`aa_branches`.`SPLIT_SIZE` ";
			
		}
		
		
		
			
			
			$f_d_query = " SELECT ".$select . " FROM ";
		
		
		
		try {
			
		
				
	
			
			if($usedna == true){
								
			$f_d_query .= "`dna_branches` INNER JOIN `dna_alignments` USING (`ALI_ID`)";
			$f_d_query .= " INNER JOIN `dna_trees` ON   (`dna_branches`.`ALI_ID` =`dna_trees`.`ALI_ID`) AND (`dna_branches`.`TREE_TYPE` =`dna_trees`.`TREE_TYPE`) AND (`dna_branches`.`TIME_STAMP` = `dna_trees`.`TIME_STAMP`) ";
			$f_d_query .= " LEFT JOIN `dna_sequences`  ON (`dna_branches`.`ALI_ID`=`dna_sequences`.`ALI_ID`) AND (`dna_branches`.`BRANCH_INDEX`=`dna_sequences`.`SEQ_INDEX`)";
			$f_d_query .= " WHERE `dna_branches`.`TREE_TYPE` =  'ml' ";
			

			if($ALL == "checked"){
							
				$f_d_query .= "AND  `dna_alignments`.`FROM_DATABASE` in " . "(" . $stringall. ")";

				}elseif(!empty($Source)){
					
					$f_d_query .= "AND `dna_alignments`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
					
				} 

				if($Alignment_Specs_Check == "TRUE"){		
					//Add SourceList
				
						
			
					//Min
						if(!empty($Nr_Seq)){
							
							$f_d_conditions[] =  ' `dna_alignments`.`SEQUENCES` >= ? ';
							$f_d_parameters[] =  $Nr_Seq;
						
						}
						
						//Max
						if(!empty($Max_Nr_Seq)){
							
							$f_d_conditions[] =  ' `dna_alignments`.`SEQUENCES` <= ? ';
							$f_d_parameters[] =  $Max_Nr_Seq;
							
						}
						
						
						//Min	
						if(!empty($Nr_sites)){
							
							$f_d_conditions[] =  ' `dna_alignments`.`COLUMNS` >= ? ';
							$f_d_parameters[] =  $Nr_sites;
							
						}
						//Max
						if(!empty($Max_Nr_sites)){
							
							$f_d_conditions[] =  ' `dna_alignments`.`COLUMNS` <= ? ';
							$f_d_parameters[] =  $Max_Nr_sites;
							
						}
					}
				if($Trees_Specs_Check== "TRUE"){

						//min
						if(!empty($tree_len)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $tree_len;
							
							}
							//max
						if(!empty($Max_tree_len)){
						
							$f_d_conditions[] =  ' `dna_trees`.`TREE_LENGTH` <= ? ';
							$f_d_parameters[] =  $Max_tree_len;
							
							}
						//min	
						if(!empty($tree_dia)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_DIAMETER` <= ? ';
							$f_d_parameters[] =  $tree_dia;
							
						}
						//max
						if(!empty($Max_tree_dia)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_DIAMETER` >= ? ';
							$f_d_parameters[] =  $Max_tree_dia;
							
						}
						//Branch length
						
						//min
						if(!empty($BL_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`BL_MIN` >= ? ';
							$f_d_parameters[] =  $BL_min;
							
							}
						//max	
						if(!empty($BL_max)){
							
							$f_d_conditions[] =  ' `dna_trees`.`BL_MAX` <= ? ';
							$f_d_parameters[] =  $BL_max;
							
						}
						//mean (min)
						if(!empty($BL_mean_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $BL_mean_min;
							
							}
							
							//mean (max)
						if(!empty($BL_mean_max)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_LENGTH` <= ? ';
							$f_d_parameters[] =  $BL_mean_max;
							
							}
							
							//Internal Branch
							
							
							//min
						if(!empty($IBL_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`IBL_MIN` >= ? ';
							$f_d_parameters[] =  $IBL_min;
							
							}
						//max	
						if(!empty($IBL_max)){
							
							$f_d_conditions[] =  ' `dna_trees`.`IBL_MAX` <= ? ';
							$f_d_parameters[] =  $IBL_max;
							
						}
						//mean (min)
						if(!empty($IBL_mean_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`IBL_MEAN` >= ? ';
							$f_d_parameters[] =  $IBL_mean_min;
							
							}
							
						//mean (max)
						if(!empty($IBL_mean_max)){
							
							$f_d_conditions[] =  ' `dna_trees`.`IBL_MEAN` <= ? ';
							$f_d_parameters[] =  $IBL_mean_max;
							
							}
							
							
							
							
							
						//External Branch
						
						//min
						if(!empty($EBL_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`EBL_MIN` >= ? ';
							$f_d_parameters[] =  $EBL_min;
							
							}
						//max	
						if(!empty($EBL_max)){
							
							$f_d_conditions[] =  ' `dna_trees`.`EBL_MAX` <= ? ';
							$f_d_parameters[] =  $EBL_max;
							
						}
						//mean (min)
						if(!empty($EBL_mean_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`EBL_MEAN` >= ? ';
							$f_d_parameters[] =  $EBL_mean_min;
							
							}
							
							//mean (max)
						if(!empty($EBL_mean_min)){
							
							$f_d_conditions[] =  ' `dna_trees`.`EBL_MEAN` <= ? ';
							$f_d_parameters[] =  $EBL_mean_min;
							
							}

						}


						
				
				
				//Proteins Trees
			}else {
				
				//To do
			$f_d_query .= "`aa_branches` INNER JOIN `aa_alignments` USING (`ALI_ID`)";
			$f_d_query .= " INNER JOIN `aa_trees` ON   (`aa_branches`.`ALI_ID` =`aa_trees`.`ALI_ID`) AND (`aa_branches`.`TREE_TYPE` =`aa_trees`.`TREE_TYPE`) AND (`aa_branches`.`TIME_STAMP` = `aa_trees`.`TIME_STAMP`) ";
			$f_d_query .= " LEFT JOIN `aa_sequences`  ON (`aa_branches`.`ALI_ID`=`aa_sequences`.`ALI_ID`) AND (`aa_branches`.`BRANCH_INDEX`=`aa_sequences`.`SEQ_INDEX`)";
			$f_d_query .= " WHERE `aa_branches`.`TREE_TYPE` =  'ml' ";
			
			if($ALL == "checked"){
						
				$f_d_query .= "AND  `aa_alignments`.`FROM_DATABASE` in " . "(" . $stringall. ")";

				}elseif(!empty($Source)){
					
					$f_d_query .= "AND `aa_alignments`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
					
				} 

			if($Alignment_Specs_Check == "TRUE"){		
				//Add SourceList
			
					
					//Min
						if(!empty($Nr_Seq)){
							
							$f_d_conditions[] =  ' `aa_alignments`.`SEQUENCES` >= ? ';
							$f_d_parameters[] =  $Nr_Seq;
						
						}
						
						//Max
						if(!empty($Max_Nr_Seq)){
							
							$f_d_conditions[] =  ' `aa_alignments`.`SEQUENCES` <= ? ';
							$f_d_parameters[] =  $Max_Nr_Seq;
							
						}
						
						
						//Min	
						if(!empty($Nr_sites)){
							
							$f_d_conditions[] =  ' `aa_alignments`.`COLUMNS` >= ? ';
							$f_d_parameters[] =  $Nr_sites;
							
						}
						//Max
						if(!empty($Max_Nr_sites)){
							
							$f_d_conditions[] =  ' `aa_alignments`.`COLUMNS` <= ? ';
							$f_d_parameters[] =  $Max_Nr_sites;
							
						}
					}
					if($Trees_Specs_Check== "TRUE"){
						
						//min
						if(!empty($tree_len)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $tree_len;
							
							}
							//max
						if(!empty($Max_tree_len)){
						
							$f_d_conditions[] =  ' `dna_trees`.`TREE_LENGTH` <= ? ';
							$f_d_parameters[] =  $Max_tree_len;
							
							}
						//min	
						if(!empty($tree_dia)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_DIAMETER` <= ? ';
							$f_d_parameters[] =  $tree_dia;
							
						}
						//max
						if(!empty($Max_tree_dia)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_DIAMETER` >= ? ';
							$f_d_parameters[] =  $Max_tree_dia;
							
						}
						//Branch length
						
						//min
						if(!empty($BL_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`BL_MIN` >= ? ';
							$f_d_parameters[] =  $BL_min;
							
							}
						//max	
						if(!empty($BL_max)){
							
							$f_d_conditions[] =  ' `aa_trees`.`BL_MAX` <= ? ';
							$f_d_parameters[] =  $BL_max;
							
						}
						//mean (min)
						if(!empty($BL_mean_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $BL_mean_min;
							
							}
							
							//mean (max)
						if(!empty($BL_mean_max)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_LENGTH` <= ? ';
							$f_d_parameters[] =  $BL_mean_max;
							
							}
							
							//Internal Branch
							
							
							//min
						if(!empty($IBL_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`IBL_MIN` >= ? ';
							$f_d_parameters[] =  $IBL_min;
							
							}
						//max	
						if(!empty($IBL_max)){
							
							$f_d_conditions[] =  ' `aa_trees`.`IBL_MAX` <= ? ';
							$f_d_parameters[] =  $IBL_max;
							
						}
						//mean (min)
						if(!empty($IBL_mean_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`IBL_MEAN` >= ? ';
							$f_d_parameters[] =  $IBL_mean_min;
							
							}
							
						//mean (max)
						if(!empty($IBL_mean_max)){
							
							$f_d_conditions[] =  ' `aa_trees`.`IBL_MEAN` <= ? ';
							$f_d_parameters[] =  $IBL_mean_max;
							
							}
							
							
							
							
							
						//External Branch
						
						//min
						if(!empty($EBL_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`EBL_MIN` >= ? ';
							$f_d_parameters[] =  $EBL_min;
							
							}
						//max	
						if(!empty($EBL_max)){
							
							$f_d_conditions[] =  ' `aa_trees`.`EBL_MAX` <= ? ';
							$f_d_parameters[] =  $EBL_max;
							
						}
						//mean (min)
						if(!empty($EBL_mean_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`EBL_MEAN` >= ? ';
							$f_d_parameters[] =  $EBL_mean_min;
							
							}
							
							//mean (max)
						if(!empty($EBL_mean_min)){
							
							$f_d_conditions[] =  ' `aa_trees`.`EBL_MEAN` <= ? ';
							$f_d_parameters[] =  $EBL_mean_min;
							
							}	
							
						}
			}
			
			//Fuze Conditions
			
			if($f_d_conditions)
				$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
			
			
			
						
			}catch(PDOException $e) {
				
			echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
			}
			
		$filter_query = $connect->prepare($f_d_query);
		$filter_query->execute($f_d_parameters);

			
		$filter_query_result = $filter_query->fetchAll(PDO::FETCH_ASSOC);
		
			
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=trees.txt');
		$output_file = fopen("php://output", "w"); 
		
		$headers_printed = false; 
		$output = " ";
		//$fasta = ">";
		
		foreach ($filter_query_result as $list) {
			 
			
			///download me 	
			if(!$headers_printed){
				
			echo $f_d_query;
			fwrite($output_file,"\n");
			fputcsv($output_file,array('Alignment Key ','Branch Key'));
			$headers_printed = true;
			
			
			
			
			
		}
		// Write Results in Document 
		//fwrite($output_file,"\n");
		fputcsv($output_file,$list,"\t");
		fpassthru($output_file);
			
			
			
			
		
		}
			
			
			
		
		
		
		
		$connect = null;
			



















?> 