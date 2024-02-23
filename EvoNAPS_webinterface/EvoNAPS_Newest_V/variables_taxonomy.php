<?php
	// start session
	session_start();
	// ckean old session
	$_SESSION = array();

		if(isset($_POST['data_type'])){
			$DNA_Prot = $_POST['data_type'];
			$_SESSION['data type']= $DNA_Prot; 
			}

		if(isset($_POST['resolved_taxonomy'])){
			$Tax_resolv = $_POST['resolved_taxonomy'];
			$_SESSION['resolved taxonomy']= $Tax_resolv;
			} 

		if(isset($_POST['Alignment_ID'])){
			/*$Ali_ID = explode(", ", $_POST['Alignment_ID']);
			$_SESSION['Alignment ID']= $Ali_ID;
			}
			foreach ($Ali_ID as $id){
				echo $id;
				echo "<br>";*/
			// looks for \s+ - up to several whitespace characters, exchanges with "," in trimmed string
			$Ali_ID_arr = preg_replace('/\s+|;/',',',trim($_POST['Alignment_ID']));
			// turning multiple "," into one
			$Ali_ID_arr = preg_replace("/,+/", ",", $Ali_ID_arr);
			$_SESSION['Alignment ID']= $Ali_ID_arr;
			//echo $Ali_ID_arr;
			//echo "<br>";
			//echo $_SESSION['Alignment ID'];
			//echo "<br>";
			}
			

		// set variables for search option based on alignment IDs
		if(isset($_POST['id_search'])){
			$ID_search = $_POST['id_search'];
			$_SESSION['id search']= $ID_search;
			if(isset($_POST['number_of_hits_id'])){
				if($_POST['number_of_hits_id'] > 0 && $_POST['number_of_hits_id'] <= 500){
					$Nr_hits = ($_POST['number_of_hits_id']);
					$_SESSION['max number of datasets']= $Nr_hits;
				}else{
					$Nr_hits = 500;
					$_SESSION['max number of datasets']= $Nr_hits;
				}
				if($_POST['number_of_hits_id'] >= 0 && $_POST['number_of_hits_id'] < 50){
					$Nr_hits_preview = ($_POST['number_of_hits_id']);
					//$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 50;
					//$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}
			
			if(isset($_POST['source_study'])){
				$Source_study = $_POST['source_study'];
				$_SESSION['source study']= $Source_study;
				}	

			}else{

				$ID_search="";
			}
// set variables for search option based on range of ranks
		if(isset($_POST['rank_search'])){
			$Rank_search = $_POST['rank_search'];
			$_SESSION['rank search']= $Rank_search; 
			
			if(isset($_POST['number_of_hits_rank'])){
				if($_POST['number_of_hits_rank'] > 0 && $_POST['number_of_hits_rank'] <= 500){
					$Nr_hits = ($_POST['number_of_hits_rank']);
					$_SESSION['max number of datasets']= $Nr_hits;
				}else{
					$Nr_hits = 500;
					$_SESSION['max number of datasets']= $Nr_hits;
				}
				if($_POST['number_of_hits_rank'] >= 0 && $_POST['number_of_hits_rank'] < 50){
					$Nr_hits_preview = ($_POST['number_of_hits_rank']);
					//$_SESSION['number of hits preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 50;
					//$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}

			if(isset($_POST['max_rank'])){
				if (isset($_POST['min_rank'])){
					if ($_POST['max_rank'] < $_POST['min_rank']){
						$Max_rank = $_POST['min_rank'];
						$_SESSION['max rank']= $Max_rank;
						$Min_rank = $_POST['max_rank'];
						$_SESSION['min rank']= $Min_rank;
					} else {
						$Max_rank = $_POST['max_rank'];
						$_SESSION['max rank']= $Max_rank;
						$Min_rank = $_POST['min_rank'];
						$_SESSION['min rank']= $Min_rank;
					}
				} else {
					$Max_rank = $_POST['max_rank'];
						$_SESSION['max rank']= $Max_rank;
				}
			}
			

			if(isset($_POST['min_number_of_sequences_rank'])){
				$Min_Nr_Seq = $_POST['min_number_of_sequences_rank'];
				$_SESSION['min number of sequences']= $Min_Nr_Seq;
				}	
			if(isset($_POST['max_number_of_sequences_rank'])){
				$Max_Nr_Seq = $_POST['max_number_of_sequences_rank'];
				$_SESSION['max number of sequences']= $Max_Nr_Seq;
				}	
			if(isset($_POST['min_number_of_sites_rank'])){
				$Min_Nr_sites = $_POST['min_number_of_sites_rank'];
				$_SESSION['min number of sites']= $Min_Nr_sites;
				}			
			if(isset($_POST['max_number_of_sites_rank'])){
				$Max_Nr_sites = $_POST['max_number_of_sites_rank'];
				$_SESSION['max number of sites']= $Max_Nr_sites;
				}			
			if(isset($_POST['wildcard_gaps_fraction_rank'])){
				$wildcard_gaps_fraction = $_POST['wildcard_gaps_fraction_rank'];
				$_SESSION['wildcard gaps fraction']= $wildcard_gaps_fraction;
				}	
			if(isset($_POST['distinct_patterns_fraction_rank'])){
				$distinct_patterns_fraction = $_POST['distinct_patterns_fraction_rank'];
				$_SESSION['distinct patterns fraction']= $distinct_patterns_fraction;
				}
			if(isset($_POST['parsimony_sites_fraction_rank'])){
				$parsimony_sites_fraction = $_POST['parsimony_sites_fraction_rank'];
				$_SESSION['parsimony sites fraction']= $parsimony_sites_fraction;
				}



				

/*
			if(isset($_POST['max_rank'])){
				$Max_rank = $_POST['max_rank'];
				$_SESSION['max rank']= $Max_rank;
				}
			if(isset($_POST['min_rank'])){
				$Min_rank = $_POST['min_rank'];
				$_SESSION['min rank']= $Min_rank;
				} */
			if(isset($_POST['all_sources'])){
				$ALL = $_POST['all_sources'];
				$_SESSION['all sources']= $ALL;
			}else{
				$ALL="";
				}
			}else{

				$Rank_search="";
			}


		if(isset($_POST['lca_search'])){
			$LCA_search = $_POST['lca_search'];
			$_SESSION['lca search']= $LCA_search; 
			if(isset($_POST['LCA'])){
				$LCA = trim($_POST['LCA']);
				$_SESSION['LCA']= $LCA;
				}
			if(isset($_POST['number_of_hits_lca'])){
				if($_POST['number_of_hits_lca'] > 0 && $_POST['number_of_hits_lca'] <= 500){
					$Nr_hits = ($_POST['number_of_hits_lca']);
					$_SESSION['max number of datasets']= $Nr_hits;
				}else{
					$Nr_hits = 500;
					$_SESSION['max number of datasets']= $Nr_hits;
				}
				if($_POST['number_of_hits_lca'] >= 0 && $_POST['number_of_hits_lca'] < 50){
					$Nr_hits_preview = ($_POST['number_of_hits_lca']);
					//$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 50;
					//$_SESSION['number of hits preview']= $Nr_hits_preview;
				}
			}	

			if(isset($_POST['all_sources'])){
				$ALL = $_POST['all_sources'];
				$_SESSION['all sources']= $ALL;
			}else{
				$ALL="";
		}
		

		if(isset($_POST['min_number_of_sequences_lca'])){
			$Min_Nr_Seq = $_POST['min_number_of_sequences_lca'];
			$_SESSION['min number of sequences']= $Min_Nr_Seq;
			}	
		if(isset($_POST['max_number_of_sequences_lca'])){
			$Max_Nr_Seq = $_POST['max_number_of_sequences_lca'];
			$_SESSION['max number of sequences']= $Max_Nr_Seq;
			}	
		if(isset($_POST['min_number_of_sites_lca'])){
			$Min_Nr_sites = $_POST['min_number_of_sites_lca'];
			$_SESSION['min number of sites']= $Min_Nr_sites;
			}			
		if(isset($_POST['max_number_of_sites_lca'])){
			$Max_Nr_sites = $_POST['max_number_of_sites_lca'];
			$_SESSION['max number of sites']= $Max_Nr_sites;
			}			
		if(isset($_POST['wildcard_gaps_fraction_lca'])){
			$wildcard_gaps_fraction = $_POST['wildcard_gaps_fraction_lca'];
			$_SESSION['wildcard gaps fraction']= $wildcard_gaps_fraction;
			}	
		if(isset($_POST['distinct_patterns_fraction_lca'])){
			$distinct_patterns_fraction = $_POST['distinct_patterns_fraction_lca'];
			$_SESSION['distinct patterns fraction']= $distinct_patterns_fraction;
			}
		if(isset($_POST['parsimony_sites_fraction_lca'])){
			$parsimony_sites_fraction = $_POST['parsimony_sites_fraction_lca'];
			$_SESSION['parsimony sites fraction']= $parsimony_sites_fraction;
			}


			}else{

				$LCA_search="";
			}


			if(isset($_POST['ancestor_search'])){
				$Ancestor_search = $_POST['ancestor_search'];
				$_SESSION['ancestor search']= $Ancestor_search; 
				if(isset($_POST['number_of_hits_ancestor'])){
					
					if($_POST['number_of_hits_ancestor'] > 0 && $_POST['number_of_hits_ancestor'] <= 500){
						$Nr_hits = ($_POST['number_of_hits_ancestor']);
						$_SESSION['max number of datasets']= $Nr_hits;
					}else{
						$Nr_hits = 500;
						$_SESSION['max number of datasets']= $Nr_hits;
					}
					if($_POST['number_of_hits_ancestor'] >= 0 && $_POST['number_of_hits_ancestor'] < 50){
						$Nr_hits_preview = ($_POST['number_of_hits_ancestor']);
						//$_SESSION['number_of_hits_preview']= $Nr_hits_preview;
					}else{
						$Nr_hits_preview = 50;
						//$_SESSION['number of hits preview']= $Nr_hits_preview;
					}
				}
				if(isset($_POST['Ancestor_rank'])){
					$Ancestor_rank = $_POST['Ancestor_rank'];
					$_SESSION['Ancestor rank']= $Ancestor_rank;
					}		
				if(isset($_POST['Ancestor'])){
					$Ancestor = trim($_POST['Ancestor']);
					$_SESSION['Ancestor']= $Ancestor;
					}
				if(isset($_POST['all_sources'])){
					$ALL = $_POST['all_sources'];
					$_SESSION['all sources']= $ALL;
				}else{
					$ALL="";
			}
			
	
			if(isset($_POST['min_number_of_sequences_ancestor'])){
				$Min_Nr_Seq = $_POST['min_number_of_sequences_ancestor'];
				$_SESSION['min number of sequences']= $Min_Nr_Seq;
				}	
			if(isset($_POST['max_number_of_sequences_ancestor'])){
				$Max_Nr_Seq = $_POST['max_number_of_sequences_ancestor'];
				$_SESSION['max number of sequences']= $Max_Nr_Seq;
				}	
			if(isset($_POST['min_number_of_sites_ancestor'])){
				$Min_Nr_sites = $_POST['min_number_of_sites_ancestor'];
				$_SESSION['min number of sites']= $Min_Nr_sites;
				}			
			if(isset($_POST['max_number_of_sites_ancestor'])){
				$Max_Nr_sites = $_POST['max_number_of_sites_ancestor'];
				$_SESSION['max number of sites']= $Max_Nr_sites;
				}			
			if(isset($_POST['wildcard_gaps_fraction_ancestor'])){
				$wildcard_gaps_fraction = $_POST['wildcard_gaps_fraction_ancestor'];
				$_SESSION['wildcard gaps fraction']= $wildcard_gaps_fraction;
				}	
			if(isset($_POST['distinct_patterns_fraction_ancestor'])){
				$distinct_patterns_fraction = $_POST['distinct_patterns_fraction_ancestor'];
				$_SESSION['distinct patterns fraction']= $distinct_patterns_fraction;
				}
			if(isset($_POST['parsimony_sites_fraction_ancestor'])){
				$parsimony_sites_fraction = $_POST['parsimony_sites_fraction_ancestor'];
				$_SESSION['parsimony sites fraction']= $parsimony_sites_fraction;
				}
	
	
	
				}else{
	
					$Ancestor_search="";
				}



// setting variables applicable to taxa search option

		if(isset($_POST['taxa_search'])){
			$Taxa_search = $_POST['taxa_search'];
			$_SESSION['taxa search']= $Taxa_search; 

			if(isset($_POST['Taxa_ID_1'])){
				$Taxa_ID_1 = trim($_POST['Taxa_ID_1']);
				$_SESSION['Taxa ID 1']= $Taxa_ID_1;
				}
            if(isset($_POST['Taxa_ID_2'])){
                $Taxa_ID_2 = trim($_POST['Taxa_ID_2']);
                $_SESSION['Taxa ID 2']= $Taxa_ID_2;
                }
            if(isset($_POST['Taxa_ID_3'])){
                $Taxa_ID_3 = trim($_POST['Taxa_ID_3']);
                $_SESSION['Taxa ID 3']= $Taxa_ID_3;
                }
            if(isset($_POST['Taxa_ID_4'])){
                $Taxa_ID_4 = trim($_POST['Taxa_ID_4']);
                $_SESSION['Taxa ID 4']= $Taxa_ID_4;
                }
            if(isset($_POST['Taxa_ID_5'])){
                $Taxa_ID_5 = trim($_POST['Taxa_ID_5']);
                $_SESSION['Taxa ID 5']= $Taxa_ID_5;
                }

			

				//additional parameters for taxa search

			if(isset($_POST['min_number_of_sequences_taxa'])){
				$Min_Nr_Seq = $_POST['min_number_of_sequences_taxa'];
				$_SESSION['min number of sequences']= $Min_Nr_Seq;
				}	
			if(isset($_POST['max_number_of_sequences_taxa'])){
				$Max_Nr_Seq = $_POST['max_number_of_sequences_taxa'];
				$_SESSION['max number of sequences']= $Max_Nr_Seq;
				}	
			if(isset($_POST['min_number_of_sites_taxa'])){
				$Min_Nr_sites = $_POST['min_number_of_sites_taxa'];
				$_SESSION['min number of sites']= $Min_Nr_sites;
				}			
			if(isset($_POST['max_number_of_sites_taxa'])){
				$Max_Nr_sites = $_POST['max_number_of_sites_taxa'];
				$_SESSION['max number of sites']= $Max_Nr_sites;
				}			
			if(isset($_POST['wildcard_gaps_fraction_taxa'])){
				$wildcard_gaps_fraction = $_POST['wildcard_gaps_fraction_taxa'];
				$_SESSION['wildcard gaps fraction']= $wildcard_gaps_fraction;
				}	
			if(isset($_POST['distinct_patterns_fraction_taxa'])){
				$distinct_patterns_fraction = $_POST['distinct_patterns_fraction_taxa'];
				$_SESSION['distinct patterns fraction']= $distinct_patterns_fraction;
				}
			if(isset($_POST['parsimony_sites_fraction_taxa'])){
				$parsimony_sites_fraction = $_POST['parsimony_sites_fraction_taxa'];
				$_SESSION['parsimony sites fraction']= $parsimony_sites_fraction;
				}     

				if(isset($_POST['Taxa_LCA']) && $_POST['Taxa_LCA'] != ""){
					$Taxa_LCA = $_POST['Taxa_LCA'];
					$_SESSION['Taxa_LCA']= $Taxa_LCA;
			} else if(isset($_POST['taxa_rank_max'])){
                if (isset($_POST['taxa_rank_min'])){
                        if ($_POST['taxa_rank_max'] < $_POST['taxa_rank_min']){
                            $Taxa_rank_max = $_POST['taxa_rank_min'];
                            $_SESSION['taxa rank max']= $Taxa_rank_max;
                            $Taxa_rank_min = $_POST['taxa_rank_max'];
                            $_SESSION['taxa rank min']= $Taxa_rank_min;
                        } else {
                            $Taxa_rank_max = $_POST['taxa_rank_max'];
                            $_SESSION['taxa rank max']= $Taxa_rank_max;
                            $Taxa_rank_min = $_POST['taxa_rank_min'];
                            $_SESSION['taxa rank min']= $Taxa_rank_min;
                        }
                    } else {
                        $Taxa_rank_max = $_POST['taxa_rank_max'];
                            $_SESSION['taxa rank max']= $Taxa_rank_max;
                    }
                    }
				
			if(isset($_POST['Taxa_LCA'])){
				$Taxa_LCA = $_POST['Taxa_LCA'];
				$_SESSION['Taxa_LCA']= $Taxa_LCA;
				}
			if(isset($_POST['all_sources'])){
				$ALL = $_POST['all_sources'];
				$_SESSION['all sources']= $ALL;
			}else{
				$ALL="";
				}
			if(isset($_POST['number_of_hits_taxa'])){
				if($_POST['number_of_hits_taxa'] > 0 && $_POST['number_of_hits_taxa'] <= 500){
					$Nr_hits = ($_POST['number_of_hits_taxa']);
					$_SESSION['max number of datasets']= $Nr_hits;
				}else{
					$Nr_hits = 500;
					$_SESSION['max number of datasets']= $Nr_hits;
				}
				if($_POST['number_of_hits_taxa'] >= 0 && $_POST['number_of_hits_taxa'] < 50){
					$Nr_hits_preview = ($_POST['number_of_hits_taxa']);
					//$_SESSION['number of hits preview']= $Nr_hits_preview;
				}else{
					$Nr_hits_preview = 50;
					//$_SESSION['number of hits preview']= $Nr_hits_preview;
					}
				}
			}else{

				$Taxa_search="";
			}

			
		
		/*
		//additional parameters

		if(isset($_POST['min_number_of_sequences'])){
			$Min_Nr_Seq = $_POST['min_number_of_sequences'];
			$_SESSION['min number of sequences']= $Min_Nr_Seq;
			}	
		if(isset($_POST['max_number_of_sequences'])){
			$Max_Nr_Seq = $_POST['max_number_of_sequences'];
			$_SESSION['max number of sequences']= $Max_Nr_Seq;
			}	
		if(isset($_POST['min_number_of_sites'])){
			$Min_Nr_sites = $_POST['min_number_of_sites'];
			$_SESSION['min number of sites']= $Min_Nr_sites;
			}			
		if(isset($_POST['max_number_of_sites'])){
			$Max_Nr_sites = $_POST['max_number_of_sites'];
			$_SESSION['max number of sites']= $Max_Nr_sites;
			}			
		if(isset($_POST['wildcard_gaps_fraction'])){
			$wildcard_gaps_fraction = $_POST['wildcard_gaps_fraction'];
			$_SESSION['wildcard gaps fraction']= $wildcard_gaps_fraction;
			}	
		if(isset($_POST['distinct_patterns_fraction'])){
			$distinct_patterns_fraction = $_POST['distinct_patterns_fraction'];
			$_SESSION['distinct patterns fraction']= $distinct_patterns_fraction;
			}
		if(isset($_POST['parsimony_sites_fraction'])){
			$parsimony_sites_fraction = $_POST['parsimony_sites_fraction'];
			$_SESSION['parsimony sites fraction']= $parsimony_sites_fraction;
			}
			*/

		//Source Variables
		$Source = [];
		
		if(isset($_POST['PANDIT'])){
			$Pan = $_POST['PANDIT'];
			$_SESSION['PANDIT']= $Pan;
			}
		
		if(isset($_POST['OrthoMaM_v10c'])){
			$Ortho_v1 =$_POST['OrthoMaM_v10c'];
			$_SESSION['OrthoMaM v10c']= $Ortho_v1;
			}
		if(isset($_POST['OrthoMaM_v12a'])){
			$Ortho_v2 =$_POST['OrthoMaM_v12a'];
			$_SESSION['OrthoMaM v12a']= $Ortho_v2;
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
		
?>