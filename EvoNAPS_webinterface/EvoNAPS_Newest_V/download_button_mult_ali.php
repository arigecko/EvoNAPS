<?php

//include 'variables_alignment.php';
//include 'DBConnect_Alignment.php';
//include 'downloadme_alignment.php';

session_start();
ini_set('memory_limit','-1');
include "DB_credentials.php";


$DNA_Prot = isset($_SESSION['data type']) ? $_SESSION['data type'] : ""; 
 
// catching values applicable to id search option

$Ali_ID_arr =  isset($_SESSION['Alignment ID']) ? $_SESSION['Alignment ID'] : "";	
$Source_study = isset($_SESSION['source study']) ? $_SESSION['source study'] : "";


// Dynamic Querys Parameters
$f_d_conditions = [];
$f_d_parameters = [];
$f_d_parameters_source = [];
    
if (!empty($Ali_ID_arr)){

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
        $select = "`ali`.`ALI_ID`, `ali`.`TAXA`, `ali`.`SITES`, `ali`.`DISTINCT_PATTERNS`, `ali`.`PARSIMONY_INFORMATIVE_SITES`, `ali`.`FRAC_WILDCARDS_GAPS`, `tree`.`MODEL`, `tree`.`BASE_MODEL`, `tree`.`RHAS_MODEL`, ROUND(`tree`.`LOGL`,4) AS LOGL ";
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
}

			
			
			
			
		
			
			
			
		$filter_query = $connect->prepare($f_d_query);
		$filter_query->execute($f_d_parameters);

			
		$filter_query_result = $filter_query->fetchAll(PDO::FETCH_ASSOC);
		

	if(count($Ali_ID)  ==  1){ 
		echo $Ali_ID;
		echo "<br>";
		header('Content-Type: text/csv; charset=utf-8');
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