<?php

//include 'variables_alignment.php';
//include 'DBConnect_Alignment.php';
//include 'downloadme_alignment.php';

session_start();
include "DB_credentials.php";


$DNA_Prot = $_SESSION['data_type'];
if(isset($_SESSION['resolved_taxonomy'])){
$Tax_resolv = $_SESSION['resolved_taxonomy'];
}

if(isset($_SESSION['id_search'])){
$Ali_ID = $_SESSION['Alignment_ID'];
$ID_search = $_SESSION['id_search'];
if(isset($_SESSION['source_study'])){
$Source_study = $_SESSION['source_study'];
}
}else{
$ID_search="";
}


if(isset($_SESSION['rank_search'])){
$Rank_search = $_SESSION['rank_search'];
$Max_rank = $_SESSION['max_rank'];
if(isset($_SESSION['min_rank'])){
$Min_rank = $_SESSION['min_rank'];
}
}else{
$Rank_search="";
}


if(isset($_SESSION['clade_search'])){
$Clade_search = $_SESSION['clade_search'];
$Clade_rank = $_SESSION['Clade_rank'];
$Clade = $_SESSION['Clade'];
}else{
$Clade_search="";
}


if(isset($_SESSION['taxa_search'])){
$Taxa_search = $_SESSION['taxa_search'];
$Taxa_ID = $_SESSION['Taxa_ID'];
if(isset($_SESSION['taxa_rank'])){
$Taxa_rank = $_SESSION['taxa_rank'];
}
}else{
$Taxa_search="";
}

$Nr_hits = $_SESSION['number_of_hits'];

//Source Variables
$Source = [];

if(isset($_SESSION['PANDIT'])){
$Pan = $_SESSION['PANDIT'];
}
if(isset($_SESSION['OrthoMaM_v10c'])){
$Ortho_v1 = $_SESSION['OrthoMaM_v10c'];
}
if(isset($_SESSION['OrthoMaM_v12a'])){
$Ortho_v2 =$_SESSION['OrthoMaM_v12a'];
}
if(isset($_SESSION['Lanfear'])){
$Lanf =$_SESSION['Lanfear'];
}
if(isset($_SESSION['TreeBASE'])){
$TreeB =$_SESSION['TreeBASE'];
}
if(isset($_SESSION['all_sources'])){
$ALL = $_SESSION['all_sources'];
}else { 
	$ALL="";
}

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
		
		
		if (!empty($ID_search) AND $ID_search == TRUE){

			$select = "`SEQ_NAME`, `SEQ`";
			
			$f_d_query = "SELECT ".$select . " FROM ";	


			if (isset($Source_study) AND $Source_study == TRUE) {
				$select_study = "`a`.`ALI_ID`, `a`.`FROM_DATABASE`, `a`.`DATA_URL`, `a`.`STUDY_ID`, `b`.`STUDY_URL`, `b`.`CITATION` ";
				$f_d_query_study = "SELECT ".$select_study . " FROM ";	
				}
			
			try {
				
				if($DNA_Prot == "dna"){
					
					$f_d_query .= " `dna_sequences` ";
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
					$f_d_query_study .= " `aa_alignments` as `a` INNER JOIN `studies` as `b` using (`STUDY_ID`) ";
					
					
					
					if(!empty($Ali_ID)){
						$f_d_conditions[] =  '`ALI_ID` =? ';
						$f_d_parameters[] =  $Ali_ID;
					
					}
				}
		
			
			//Fuze conditions in 1 string
			if($f_d_conditions){
				$f_d_query .= " WHERE ".implode(" AND ", $f_d_conditions);

				if (isset($Source_study) AND $Source_study == TRUE) {
				$f_d_query_study .= "WHERE `a`.`ALI_ID` =?";
				}
			}
			$f_d_query .= " LIMIT {$Nr_hits}";
		
			//Echo string for the query
			//echo $f_d_query."<br>\n";
			
			if (isset($Source_study) AND $Source_study == TRUE) {
				echo $f_d_query_study;
			}
			
		} catch(PDOException $e) {
				
			echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
			}
		

















			

			//////// searching within ranks //////////

			
		} elseif (!empty($Rank_search) AND $Rank_search == TRUE) {


			$select = "`a`.`ALI_ID`";
						
							
			$f_d_query = " SELECT ".$select . " FROM ";
						

			try {
						
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
							
							

				}else{
							
					$f_d_query .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
						
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
	
					}elseif(!empty($Source)){
						
						$f_d_query .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
					
					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
				}
					$f_d_query .= " LIMIT {$Nr_hits}";
					
				//Echo string for the query
				//echo $f_d_query."<br>\n";
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}

















			

			//////// searching within   clade//////////
			} elseif (!empty($Clade_search) AND $Clade_search == TRUE) {



				$select = "`ALI_ID`";
						
								
				$f_d_query = " SELECT ".$select . " FROM ";
							
	
				try {
							
							
					if($DNA_Prot == "dna"){
								
								
						$f_d_query .= " `dna_alignments_taxonomy` as `a` INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
								

					}else{
								
						$f_d_query .= " `aa_alignments_taxonomy` as `a` INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
							
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

								$f_d_conditions[] .=  '`a`.`LCA_TAX_ID` =? ';
								$f_d_parameters[] .=  $Tax_resolv;
							}
	
						}
	

					if ($ALL == "checked"){
							
						$f_d_query .= "WHERE  `b`.`FROM_DATABASE` in " . "(" . $stringall. ")";
		
						}elseif(!empty($Source)){
							
							$f_d_query .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
							
						}
						
						//Fuze conditions in 1 string
					if($f_d_conditions){
						$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
					}
					
						
					
						$f_d_query .= " LIMIT {$Nr_hits}";
						
					//Echo string for the query
					//echo $f_d_query."<br>\n";
						
						
						
				}catch(PDOException $e) {				
					echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
					}
				

		
				
			














			

			//////// searching within   taxa//////////
		} elseif (!empty($Taxa_search) AND $Taxa_search == TRUE) {



			$select = "`a`.`ALI_ID`";
							
			$f_d_query = " SELECT ".$select . " FROM ";
						

			try {
						
				if($DNA_Prot == "dna"){
							
					$f_d_query .= "`dna_sequences` as `a` ";
					$f_d_query .= "INNER JOIN `dna_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `dna_alignments_taxonomy` as `c` using (`ALI_ID`) ";

				}else{
					
					$f_d_query .= "`aa_sequences` as `a` ";
					$f_d_query .= "INNER JOIN `aa_alignments` as `b` using (`ALI_ID`) ";
					$f_d_query .= "INNER JOIN `aa_alignments_taxonomy` as `c` using (`ALI_ID`) ";
						
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
	
					}elseif(!empty($Source)){
						
						$f_d_query .= "WHERE `b`.`FROM_DATABASE` in " . "(" . $stringsource. ")";
						
					}
					
					//Fuze conditions in 1 string
				if($f_d_conditions){
					$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
				}
					$f_d_query .= " ORDER BY `a`.`ALI_ID`";
					$f_d_query .= " LIMIT {$Nr_hits}";
					
				//Echo string for the query
				//echo $f_d_query."<br>\n";
					
					
					
			}catch(PDOException $e) {				
				echo "Connection Stable Query wrong " . $e->getMessage(). $f_d_query;
				}
			}	
			
			
			
			
			
			
		
			
			
			
		$filter_query = $connect->prepare($f_d_query);
		$filter_query->execute($f_d_parameters);

			
		$filter_query_result = $filter_query->fetchAll(PDO::FETCH_ASSOC);
		
			
		
		if(!empty($ID_search) AND count($Ali_ID) == 1){ 

			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=alignment.fasta');
	
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
	}

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

	if(isset($_SESSION['id_search'])){ 
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=alignment.csv');
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
			
			fwrite($output_file,"\n");
			//fwrite($output_file,">");
			
			
			// Write Results in Document 
			fputcsv($output_file,$list,"\n");
			//fwrite($output_file,"\n");
			fpassthru($output_file);

		}
	}
		
		
		$connect = null;


?>