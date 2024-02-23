<?php
		
	//Include files and set memory limit
	
	ini_set('memory_limit','1000M');
	include('variables_mult_ali.php');
	include('DB_credentials.php');
		
	//initalize query parameters
	$f_d_conditions = [];
	$f_d_parameters = [];
	$f_d_parameters_source = [];
	$usedna = false;
                
    
    
    // Dynamic Querys Parameters

    if (!empty($Ali_ID_arr)){
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
                    //Alignments Join 
					$f_d_query_count .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) ";
                    // Trees join
					$f_d_query_count.= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					//Preview
                    //Alignments Join 
					$f_d_query_prev .= " `dna_alignments_taxonomy` as `ali_tax` INNER JOIN `dna_alignments` as `ali` USING (`ALI_ID`) ";
                    // Trees join
					$f_d_query_prev .= " INNER JOIN `dna_trees` as `tree` USING (`ALI_ID`) ";
					}
					// Study information
					if (isset($Source_study) AND $Source_study == TRUE) {
					$f_d_query_study .= " `dna_alignments` as `ali` INNER JOIN `studies` as `study` using (`STUDY_ID`) ";
					}

					//Proteins only do if dna is done and finished 
				} else {
                    if (count($Ali_ID) == 1) {
					$f_d_query_count.= " `aa_sequences` ";
					//Preview
					$f_d_query_prev .= " `aa_sequences` ";
					} else {
                    //Alignments Join 
					$f_d_query_count .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) ";
                    // Trees join
					$f_d_query_count.= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
					//Preview
                    //Alignments Join 
					$f_d_query_prev .= " `aa_alignments_taxonomy` as `ali_tax` INNER JOIN `aa_alignments` as `ali` USING (`ALI_ID`) ";
                    // Trees join
					$f_d_query_prev .= " INNER JOIN `aa_trees` as `tree` USING (`ALI_ID`) ";
					}
					// Study information
					if (isset($Source_study) AND $Source_study == TRUE) {
					$f_d_query_study .= " `dna_alignments` as `ali` INNER JOIN `studies` as `study` using (`STUDY_ID`) ";
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
    }
?>