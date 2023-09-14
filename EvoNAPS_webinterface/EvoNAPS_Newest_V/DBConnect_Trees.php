<?php


		//Connect to DB
		
		ini_set('memory_limit','1000M');
		include('variables_trees.php');
		//Old
		
		
		//error_reporting(0);
		$hostname = 'localhost';
		$dbname= 'evonaps_try_2';
		$username='root';
		$password='';
		$dsn= "mysql:host=$hostname;dbname=$dbname";
		
		
		

		//Neqw
		/*
		$hostname = 'crick.cibiv.univie.ac.at';
		$dbname= 'fra_db';
		$username='evonapsweb';
		$password='SesamOeffneDich99';
		$dsn= "mysql:host=$hostname;dbname=$dbname";
		*/
		




		try {
			
		$connect = new PDO($dsn, $username, $password);
		 //Close Connection
		 //$connect = null;
		// set the PDO error mode to exception
		// $connect->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false); //Standard in PHP V.8 or higher unbuffered query setting
		
			//echo "Connected successfully";
					
			}catch(PDOException $e) {
				
			echo "Connection failed: " . $e->getMessage();
			}

		/*
		// Set Variables for the Filter 
		
		
		$DNA_Prot = $_POST['DNA_Prot'];
		
		
		$Nr_Seq = $_POST['Nr_Seq'];
		$Max_Nr_Seq = $_POST['Max_Nr_Seq'];
		
		$Nr_sites = $_POST['Nr_sites'];
		$Max_Nr_sites = $_POST['Max_Nr_sites'];
		
		
		
	
		$BL_mean_min = $_POST['BL_mean_min'];
		$BL_mean_max = $_POST['BL_mean_max'];
		$BL_min = $_POST['BL_min'];
		$BL_max = $_POST['BL_max'];
		
	
		$IBL_mean_min =  $_POST['IBL_mean_min'];
		$IBL_mean_max =  $_POST['IBL_mean_max'];
		$IBL_min  = $_POST['IBL_min'];
		$IBL_max =  $_POST['IBL_max'];
		
		
		$EBL_mean_min = $_POST['EBL_mean_min'];
		$EBL_mean_max = $_POST['EBL_mean_max'];
		$EBL_min = $_POST['EBL_min'];
		$EBL_max = $_POST['EBL_max'];
		
		$tree_len = $_POST['tree_len'];
		$Max_tree_len = $_POST['Max_tree_len'];
		$tree_dia = $_POST['tree_dia'];
		$Max_tree_dia = $_POST['Max_tree_dia'];
		
		
		$Branches_Check = $_POST['Branches_Check'];
		
		$Hits = $_POST['Hits_anzeigen'];
		
		*/
		
		
		// Dynamic Querys Parameters
		
		
		$f_d_conditions = [];
		$f_d_parameters = [];
		
		
		
		
		if($DNA_Prot == "dna" ){
			
			// DNA select
			$select = "`dna_alignments` .`ALI_ID`, `dna_trees`.`NEWICK_STRING`, `dna_trees`.`PROP_INVAR`,`dna_trees`.`ALPHA`,`dna_trees`.`STAT_FREQ_TYPE`, `dna_trees`.`STAT_FREQ_A`,`dna_trees`.`STAT_FREQ_C`, `dna_trees`.`STAT_FREQ_G`,`dna_trees`.`STAT_FREQ_T`,`dna_trees`.`RATE_AC`,`dna_trees`.`RATE_AG`,`dna_trees`.`RATE_AT`,`dna_trees`.`RATE_CA`,`dna_trees`.`RATE_CG`,`dna_trees`.`RATE_CT`,`dna_trees`.`RATE_GA`,`dna_trees`.`RATE_GC`,`dna_trees`.`RATE_GT`, `dna_trees`.`RATE_TA`";
			
			
			
		} else {
			
			//Aa select
		$select = "`aa_alignments` .`ALI_ID`, `aa_trees`.`NEWICK_STRING`, `aa_trees`.`PROP_INVAR`,`aa_trees`.`ALPHA`,`aa_trees`.`STAT_FREQ_TYPE`, `aa_trees`.`STAT_FREQ_A`,`aa_trees`.`STAT_FREQ_R`, `aa_trees`.`STAT_FREQ_N`,`aa_trees`.`STAT_FREQ_D`";
			$useprot = true;
		}
		
		
		
			
			
			$f_d_query_1 = " SELECT ".$select . " FROM ";
		
				
			$f_d_query = " SELECT count(*) FROM ";
			
		
		
		
		try {
			
		
			
			if($DNA_Prot == "dna"){
				

			//count
			$f_d_query .= " `dna_trees` INNER JOIN `dna_alignments` USING (`ALI_ID`) "; 
			$f_d_query .= " WHERE `dna_trees`.`TREE_TYPE` =  'ml' ";
			$f_d_query .= " AND `dna_trees`.`KEEP_IDENT` = 0 ";
			
			//preview
			$f_d_query_1 .= " `dna_trees` INNER JOIN `dna_alignments` USING (`ALI_ID`) "; 
			$f_d_query_1 .= " WHERE `dna_trees`.`TREE_TYPE` =  'ml' ";
			$f_d_query_1 .= " AND `dna_trees`.`KEEP_IDENT` = 0 ";
			
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
						
						//min
						if(!empty($tree_len)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $tree_len;
							
							}
						//min	
						if(!empty($tree_dia)){
							
							$f_d_conditions[] =  ' `dna_trees`.`TREE_DIAMETER` <= ? ';
							$f_d_parameters[] =  $tree_dia;
							
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
						
				
				
				//Proteins Trees
			}else{
				
				
				$f_d_query .= "`aa_trees` INNER JOIN `aa_alignments` USING (`ALI_ID`)"; 
				$f_d_query .= " WHERE `aa_trees`.`TREE_TYPE` =  'ml' ";
				$f_d_query .= " AND `aa_trees`.`KEEP_IDENT` = 0 ";
				
				$f_d_query_1 .= "`aa_trees` INNER JOIN `aa_alignments` USING (`ALI_ID`)"; 
				$f_d_query_1 .= " WHERE `aa_trees`.`TREE_TYPE` =  'ml' ";
				$f_d_query_1 .= " AND `aa_trees`.`KEEP_IDENT` = 0 ";
			
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
						
						//min
						if(!empty($tree_len)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $tree_len;
							
							}
						//min	
						if(!empty($tree_dia)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_DIAMETER` <= ? ';
							$f_d_parameters[] =  $tree_dia;
							
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
						if(!empty($BL_mean)){
							
							$f_d_conditions[] =  ' `aa_trees`.`TREE_LENGTH` >= ? ';
							$f_d_parameters[] =  $BL_mean;
							
							}
							
							//Internal Branch
							
							
							
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
						if(!empty($IBL_mean)){
							
							$f_d_conditions[] =  ' `aa_trees`.`IBL_MEAN` >= ? ';
							$f_d_parameters[] =  $IBL_mean;
							
							}
							
							
							
							
							
						//External Branch
						
						
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
						if(!empty($EBL_mean)){
							
							$f_d_conditions[] =  ' `aa_trees`.`EBL_MEAN` >= ? ';
							$f_d_parameters[] =  $EBL_mean;
							
							}
				
				
				
			}
			
			
		
			
			
			
			//Fuze conditions in 1 string
			if(empty($f_d_parameters)){
				
				$f_d_query_1 .= "LIMIT 20";
				
			}else {
				$f_d_query .= " AND ".implode(" AND ", $f_d_conditions);
				$f_d_query_1 .= " AND ".implode(" AND ", $f_d_conditions)." LIMIT 20";
				
			}
			 
			 
			
			
			
			
			//exception handling
		}catch(PDOException $e) {
				
			echo "Connection Stable Query wrong " . $e->getMessage();
			}
			
				
				
				
				
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		?>