<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<div class = "title id" = "title" />
    <title>EvoNAPS</title>
 	
	
	
	
	 <script src="js/main_taxonomy.js"></script> 
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	 <link href="StyleSheet.css"type="text/css" rel="stylesheet"/>
	

	

	
	
	
	 
  </head>
  
  <div class = "fix">
  <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
   
   <a class="navbar-brand" href="index_taxonomy.php">
	<img src="Logo_EvoNAPS_04.png" alt="Avatar Logo" style="width:350px;"> 
	</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="#"><h2>alignments</h2></a>
		 <li class="nav-item">
		 </li>
		
    </ul>
	
	<ul class ="navbar-nav ms-auto">
	
	 <li class="nav-item">
	 <a class="nav-link active" href="index_taxonomy.php"><h4>Home</h4></a>
	 </li>
	 <li class="nav-item">
	 <a class="nav-link active" href="index_taxonomy.php"><h4>Documentation</h4></a>
	 </li>
	 <li class="nav-item">
	 <a class="nav-link active" href="index_taxonomy.php"><h4>FAQ</h4></a>
	 </li>
	
	</ul>
	</div>

	 
	
      
</nav>
  <body>
  <?php  session_start(); //echo "pls show the number:".$_SESSION['ALID']; ?>
  <div class ="center">
  
   
  
	<form action="results_taxonomy.php" method="post" class="was-validated" onsubmit="updateFormVal()">
	
		<div class = "data_type_taxonomy">
			<label for="data_type">  Data type:&nbsp; </label> 
			<select name="data_type" class="rank_form" id="datatype" required >
				<option value="" disabled selected hidden> choose type</option>
				<option value="dna" <?php if(!empty($_SESSION['data type']) AND $_SESSION['data type']=="dna"){ echo " selected";}?>> DNA </option>
				<option value="aa"<?php if(!empty($_SESSION['data type']) AND $_SESSION['data type']=="aa"){ echo " selected";}?>> Proteins </option>
			</select>
						
		   	<label for = "resolved taxonomy"> &emsp; &emsp; &emsp;Fully resolved taxonomy </label> 
		    <input type="checkbox" name="resolved_taxonomy"  id="resolved_tax" value="TRUE" <?php if(!empty($_SESSION['resolved taxonomy'])){ echo "checked";} ?>>
			<br>
			<br>
		</div>
			
			
		<div>
			<input type="button" class= "search_option" value="Searching for specific alignment" name="id_search_btn" onclick="AliSearchOptions('id_search_field', 'id_search')" id="specific_ali" value="A">
			 
		</div>

		<fieldset  class="text_form" id="id_search_field" <?php echo (!empty($_SESSION['id search'])) ? "style='display : block;'" : "style='display : none;'";?>>
			<br>
			<input type="radio" name="id_search"  id="id_search" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['id search'])){ echo "checked"; } ?>>
			<input type="hidden" name="number_of_hits_id" id="Nr_hits_id" style="display: none;" >
			<div class="formfield">
				<label for="Ali_ID" title="IDs should be separated by a and/or wwhitespace"> Alignment ID: </label> 
				<textarea type="text" name="Alignment_ID" id="Ali_ID" class="text_field_id" wrap="soft" placeholder="IDs should be separated by a comma and/or whitespace" ><?php if(!empty($_SESSION['Alignment ID'])){ echo $_SESSION['Alignment ID'];} ?> </textarea>
				
			<!-- class="text_form_pushed" -->
				<input type="checkbox" class="text_form_pushed" name="source_study"  id="source_study" value="TRUE" <?php if(!empty($_SESSION['source study'])){ echo "checked";} ?>>
				<label for = "source_study"> Provide study information </label> 
		    </div>
		</fieldset>


		<br>

		<div>
			<input type="button" class= "search_option" value="Searching for alignments with LCA within certain ranks" name="ranks_search_btn" onclick="AliSearchOptions('ranks_search_field', 'rank_search')" id="specific_ali">
			
		</div>
		<fieldset  class="text_form" id="ranks_search_field" <?php echo (!empty($_SESSION['rank search'])) ? "style = 'display : block;'" : "style = 'display : none;'";?>> 
			<br>
			<input type="radio" name="rank_search"  id="rank_search" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['rank search'])){ echo "checked"; } ?>>
			<label for="Rank_min"> LCA rank: from </label> 
        	<!--<input type="text" name="min rank" id="Rank_min"  placeholder="species">-->
			<select name="min_rank" id="Rank_min" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="1" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="1"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="2"){ echo " selected";}?>>2. kingdom</option>
				<option value="3" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="3"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="4"){ echo " selected";}?>>4. superphylum</option>
				<option value="5" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="5"){ echo " selected";}?>>5. phylum</option>
				<option value="6" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="6"){ echo " selected";}?>>6. subphylum</option>
				<option value="7" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="7"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="8"){ echo " selected";}?>>8. superclass</option>
				<option value="9" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="9"){ echo " selected";}?>>9. class</option>
				<option value="10" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="10"){ echo " selected";}?>>10. subclass</option>
				<option value="11" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="11"){ echo " selected";}?>>11. infraclass</option>
				<option value="12" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="12"){ echo " selected";}?>>12. cohort</option>
				<option value="13" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="13"){ echo " selected";}?>>13. subcohort</option>
				<option value="14" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="14"){ echo " selected";}?>>14.superorder</option>
				<option value="15" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="15"){ echo " selected";}?>>15. order</option>
				<option value="16" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="16"){ echo " selected";}?>>16. suborder</option>
				<option value="17" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="17"){ echo " selected";}?>>17. infraorder</option>
				<option value="18" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="18"){ echo " selected";}?>>18. parvorder</option>
				<option value="19" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="19"){ echo " selected";}?>>19. superfamily</option>
				<option value="20" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="20"){ echo " selected";}?>>20. family</option>
				<option value="21" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="21"){ echo " selected";}?>>21. subfamily</option>
				<option value="22" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="22"){ echo " selected";}?>>22. tribe</option>
				<option value="23" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="23"){ echo " selected";}?>>23. subtribe</option>
				<option value="24" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="24"){ echo " selected";}?>>24. genus</option>
				<option value="25" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="25"){ echo " selected";}?>>25. subgenus</option>
				<option value="26" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="26"){ echo " selected";}?>>26. section</option>
				<option value="27" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="27"){ echo " selected";}?>>27. subsection</option>
				<option value="28" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="28"){ echo " selected";}?>>28. series</option>
				<option value="29" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="29"){ echo " selected";}?>>29. subseries</option>
				<option value="30" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="30"){ echo " selected";}?>>30. species group</option>
				<option value="31" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="31"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="32"){ echo " selected";}?>>32. species</option>
				<option value="33" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="33"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="34"){ echo " selected";}?>>34. subspecies</option>
				<option value="35" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="35"){ echo " selected";}?>>35. varietas</option>
				<option value="36" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="36"){ echo " selected";}?>>36. subvariety</option>
				<option value="37" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="37"){ echo " selected";}?>>37. forma</option>
				<option value="38" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="38"){ echo " selected";}?>>38. serogroup</option>
				<option value="39" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="39"){ echo " selected";}?>>39. serotype</option>
				<option value="40" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['min rank']=="40"){ echo " selected";}?>>40. strain</option>
				<option value="41" <?php if(!empty($_SESSION['min rank']) AND $_SESSION['Rank_min']=="41"){ echo " selected";}?>>41. isolate</option>
			</select>
			
			<label for="Rank_max" class="text_form_pushed"> to </label> 
        	<!-- <input type="text" name="max rank" id="Rank_max" placeholder="genus" > -->
			<select name="max_rank" id="Rank_max" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="1" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="1"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="2"){ echo " selected";}?>>2. kingdom</option>
				<option value="3" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="3"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="4"){ echo " selected";}?>>4. superphylum</option>
				<option value="5" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="5"){ echo " selected";}?>>5. phylum</option>
				<option value="6" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="6"){ echo " selected";}?>>6. subphylum</option>
				<option value="7" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="7"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="8"){ echo " selected";}?>>8. superclass</option>
				<option value="9" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="9"){ echo " selected";}?>>9. class</option>
				<option value="10" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="10"){ echo " selected";}?>>10. subclass</option>
				<option value="11" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="11"){ echo " selected";}?>>11. infraclass</option>
				<option value="12" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="12"){ echo " selected";}?>>12. cohort</option>
				<option value="13" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="13"){ echo " selected";}?>>13. subcohort</option>
				<option value="14" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="14"){ echo " selected";}?>>14.superorder</option>
				<option value="15" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="15"){ echo " selected";}?>>15. order</option>
				<option value="16" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="16"){ echo " selected";}?>>16. suborder</option>
				<option value="17" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="17"){ echo " selected";}?>>17. infraorder</option>
				<option value="18" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="18"){ echo " selected";}?>>18. parvorder</option>
				<option value="19" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="19"){ echo " selected";}?>>19. superfamily</option>
				<option value="20" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="20"){ echo " selected";}?>>20. family</option>
				<option value="21" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="21"){ echo " selected";}?>>21. subfamily</option>
				<option value="22" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="22"){ echo " selected";}?>>22. tribe</option>
				<option value="23" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="23"){ echo " selected";}?>>23. subtribe</option>
				<option value="24" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="24"){ echo " selected";}?>>24. genus</option>
				<option value="25" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="25"){ echo " selected";}?>>25. subgenus</option>
				<option value="26" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="26"){ echo " selected";}?>>26. section</option>
				<option value="27" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="27"){ echo " selected";}?>>27. subsection</option>
				<option value="28" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="28"){ echo " selected";}?>>28. series</option>
				<option value="29" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="29"){ echo " selected";}?>>29. subseries</option>
				<option value="30" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="30"){ echo " selected";}?>>30. species group</option>
				<option value="31" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="31"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="32"){ echo " selected";}?>>32. species</option>
				<option value="33" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="33"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="34"){ echo " selected";}?>>34. subspecies</option>
				<option value="35" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="35"){ echo " selected";}?>>35. varietas</option>
				<option value="36" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="36"){ echo " selected";}?>>36. subvariety</option>
				<option value="37" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="37"){ echo " selected";}?>>37. forma</option>
				<option value="38" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="38"){ echo " selected";}?>>38. serogroup</option>
				<option value="39" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="39"){ echo " selected";}?>>39. serotype</option>
				<option value="40" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="40"){ echo " selected";}?>>40. strain</option>
				<option value="41" <?php if(!empty($_SESSION['max rank']) AND $_SESSION['max rank']=="41"){ echo " selected";}?>>41. isolate</option>
			</select>
			<label for="Rank_max" class="suggestion"> (optional)</label> 




			<br>
			<br>
			
			<span > <b> <u>  Alignments source: </u></b> </span>
		    <br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_rank" onchange = "checkkallAli('rank')"  value="checked" style='margin-left:-2px;' <?php if(isset($_SESSION['all sources']) && !empty($_SESSION['rank search'])){ echo "checked"; }?>>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_rank"  value="Lanfear" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
			<label for = "Lanfear"> Lanfear </label> 
			<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_v10c_rank"  value="OrthoMaM_v10c" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['OrthoMaM v10c'])){ echo "checked"; }?>>
			<label for = "OrthoMaM"> OrthoMaM v10c</label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_v12a_rank"  value="OrthoMaM_v12a" onchange = "checkkallAli('rank')">  <?php // if(isset($_SESSION['OrthoMaM v12a'])){ echo "checked"; }?>>
			<label for = "OrthoMaM"> OrthoMaM v12a</label>
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_rank"  value="PANDIT" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT"> PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_rank"  value="TreeBASE" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			<br>
			<br>
			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_rank" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_rank" id="Min_Nr_Seq_rank" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sequences']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['min number of sequences'];} ?>> 
			
			<label for="Max_Nr_Seq_rank" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_rank" id="Max_Nr_Seq_rank" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sequences']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['max number of sequences'];} ?>> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_rank" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_rank" id="Min_Nr_sites_rank" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sites']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['min number of sites'];} ?>> 


			<label for="Max_Nr_sites_rank" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_rank" id="Max_Nr_sites_rank" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sites']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['max number of sites'];} ?>> <br>
			 <br>

			<label for="Fr_WL_Gaps_rank" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard " name="wildcard_gaps_fraction_rank" id="Fr_WL_Gaps_rank" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['wildcard gaps fraction']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['wildcard gaps fraction'];} ?>> <br>
			
			<label for="Fr_Dis_Pat_rank" class="ex1"> Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_rank" id="Fr_Dis_Pat_rank" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['distinct patterns fraction']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['distinct patterns fraction'];} ?>> <br>

			<label for="Fr_Pars_rank" class="ex1"> Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction" id="Fr_Pars_rank" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['parsimony sites fraction']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['parsimony sites fraction'];} ?>> <br>
			
		  
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_rank" id="Nr_hits_rank" step="any" max="500" <?php if(!empty($_SESSION['max number of datasets']) && !empty($_SESSION['rank search'])){ echo "value =".$_SESSION['max number of datasets'];} ?>>
		</fieldset>
		<br>



		
		<div>
		<input type="button" class= "search_option" value="Searching for alignments with a specific LCA" name="lca_search_btn" onclick="AliSearchOptions('lca_search_field', 'lca_search')" id="specific_ali">
			
		</div>
		<fieldset  class="text_form" id="lca_search_field" <?php echo (!empty($_SESSION['lca search'])) ? "style = 'display : block';" :  "style = 'display : none;'";?>>
			<br>
			<input type="radio" name="lca_search"  id="lca_search" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['lca search'])){ echo "checked"; } ?>>
			<label for="LCA"> LCA taxon name/ID:</label> 
        	<input type="text" name="LCA" id="LCA" class="text_field" <?php if(!empty($_SESSION['LCA'])){ echo "value =".$_SESSION['LCA'];} ?>>
			<br>
			<br>
			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_lca" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_lca" id="Min_Nr_Seq_lca" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sequences']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['min number of sequences'];} ?>> 
			
			<label for="Max_Nr_Seq_lca" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_lca" id="Max_Nr_Seq_lca" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sequences']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['max number of sequences'];} ?>> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_lca" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_lca" id="Min_Nr_sites_lca" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sites']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['min number of sites'];} ?>> 


			<label for="Max_Nr_sites_lca" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_lca" id="Max_Nr_sites_lca" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sites']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['max number of sites'];} ?>> <br>
			 <br>

			<label for="Fr_WL_Gaps_lca" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard" name="wildcard_gaps_fraction_lca" id="Fr_WL_Gaps_lca" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['wildcard gaps fraction']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['wildcard gaps fraction'];} ?>> <br>
			
			<label for="Fr_Dis_Pat_lca" class="ex1"> Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_lca" id="Fr_Dis_Pat_lca" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['distinct patterns fraction']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['distinct patterns fraction'];} ?>> <br>

			<label for="Fr_Pars_lca" class="ex1"> Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction" id="Fr_Pars_lca" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['parsimony sites fraction']) && !empty($_SESSION['lca search'])){ echo "value =".$_SESSION['parsimony sites fraction'];} ?>> <br>


			<br>
			
			<span > <b> <u>  Alignments source: </u></b> </span>
		   	<br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_lca" onchange = "checkkallAli('lca')" value="checked"  style='margin-left:-2px;' <?php if(isset($_SESSION['all sources']) && !empty($_SESSION['lca search'])){ echo "checked"; }?>>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_lca"  value="Lanfear" onchange = "checkkallAli('lca')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
		   	<label for = "Lanfear"> Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_v10c_lca"  value="OrthoMaM_v10c" onchange = "checkkallAli('lca')" <?php if(isset($_SESSION['OrthoMaM v10c'])){ echo "checked"; }?>>
		   	<label for = "OrthoMaM"> OrthoMaM v10c </label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_v12a_lca"  value="OrthoMaM_v12a" onchange = "checkkallAli('lca')"<?php //if(isset($_SESSION['OrthoMaM v12a'])){ echo "checked"; }?>>
			<label for = "OrthoMaM"> OrthoMaM v12a</label>
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_lca"  value="PANDIT" onchange = "checkkallAli('lca')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT"> PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_lca"  value="TreeBASE" onchange = "checkkallAli('lca')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			
			<br>
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_lca" id="Nr_hits_lca" step="any" max="500" <?php if(!empty($_SESSION['max number of datasets'])){ echo "value =".$_SESSION['max number of datasets'];} ?>>
		
		</fieldset>
		<br>


		<div>
		<input type="button" class= "search_option" value="Searching for alignments with an LCA below specific ancestor" name="ancestor_search_btn" onclick="AliSearchOptions('ancestor_search_field', 'ancestor_search')" id="specific_ali">
			
		</div>
		<fieldset  class="text_form" id="ancestor_search_field" <?php echo (!empty($_SESSION['ancestor search'])) ? "style = 'display : block';" :  "style = 'display : none;'";?>>
			<br>
			<input type="radio" name="ancestor_search"  id="ancestor_search" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['ancestor search'])){ echo "checked"; } ?>>
			<label for="Ancestor"> Ancestor taxon ID/name:</label> 
        	<input type="text" name="Ancestor" id="Ancestor" class="text_field" <?php if(!empty($_SESSION['Ancestor'])){ echo "value =".$_SESSION['Ancestor'];} ?>>
			<label for="ancestor_rank" class="text_form_pushed2"> Rank: </label> 
        	<!-- <input type="text" name="rank" id="Rank" placeholder="class" > -->
			<select name="Ancestor_rank" id="ancestor_rank" class="rank_form">
				<option value="none">  </option>
				<option value="1_superkingdom" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="1_superkingdom"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2_kingdom" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="2_kingdom"){ echo " selected";}?>>2. kingdom</option>
				<option value="3_subkingdom" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="3_subkingdom"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4_superphylum" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="4_superphylum"){ echo " selected";}?>>4. superphylum</option>
				<option value="5_phylum" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="5_phylum"){ echo " selected";}?>>5. phylum</option>
				<option value="6_subphylum" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="6_subphylum"){ echo " selected";}?>>6. subphylum</option>
				<option value="7_infraphylum" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="7_infraphylum"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8_superclass" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="8_superclass"){ echo " selected";}?>>8. superclass</option>
				<option value="9_class" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="9_class"){ echo " selected";}?>>9. class</option>
				<option value="10_subclass" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="10_subclass"){ echo " selected";}?>>10. subclass</option>
				<option value="11_infraclass" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="11_infraclass"){ echo " selected";}?>>11. infraclass</option>
				<option value="12_cohort" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="12_cohort"){ echo " selected";}?>>12. cohort</option>
				<option value="13_subcohort" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="13_subcohort"){ echo " selected";}?>>13. subcohort</option>
				<option value="14_superorder" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="14_superorder"){ echo " selected";}?>>14.superorder</option>
				<option value="15_order" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="15_order"){ echo " selected";}?>>15. order</option>
				<option value="16_suborder" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="16_suborder"){ echo " selected";}?>>16. suborder</option>
				<option value="17_infraorder" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="17_infraorder"){ echo " selected";}?>>17. infraorder</option>
				<option value="18_parvorder" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="18_parvorder"){ echo " selected";}?>>18. parvorder</option>
				<option value="19_superfamily" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="19_superfamily"){ echo " selected";}?>>19. superfamily</option>
				<option value="20_family" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="20_family"){ echo " selected";}?>>20. family</option>
				<option value="21_subfamily" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="21_subfamily"){ echo " selected";}?>>21. subfamily</option>
				<option value="22_tribe" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="22_tribe"){ echo " selected";}?>>22. tribe</option>
				<option value="23_subtribe" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="23_subtribe"){ echo " selected";}?>>23. subtribe</option>
				<option value="24_genus" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="24_genus"){ echo " selected";}?>>24. genus</option>
				<option value="25_subgenus" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="25_subgenus"){ echo " selected";}?>>25. subgenus</option>
				<option value="26_section" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="26_section"){ echo " selected";}?>>26. section</option>
				<option value="27_subsection" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="27_subsection"){ echo " selected";}?>>27. subsection</option>
				<option value="28_series" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="28_series"){ echo " selected";}?>>28. series</option>
				<option value="29_subseries" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="29_subseries"){ echo " selected";}?>>29. subseries</option>
				<option value="30_species_group" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="30_species_group"){ echo " selected";}?>>30. species group</option>
				<option value="31_species_subgroup" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="31_species_subgroup"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32_species" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="32_species"){ echo " selected";}?>>32. species</option>
				<option value="33_forma_specialis" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="33_forma_specialis"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34_subspecies" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="34_subspecies"){ echo " selected";}?>>34. subspecies</option>
				<option value="35_varietas" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="35_varietas"){ echo " selected";}?>>35. varietas</option>
				<option value="36_subvariety" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="36_subvariety"){ echo " selected";}?>>36. subvariety</option>
				<option value="37_forma" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="37_forma"){ echo " selected";}?>>37. forma</option>
				<option value="38_serogroup" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="38_serogroup"){ echo " selected";}?>>38. serogroup</option>
				<option value="39_serotype" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="39_serotype"){ echo " selected";}?>>39. serotype</option>
				<option value="40_strain" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="40_strain"){ echo " selected";}?>>40. strain</option>
				<option value="41_isolate" <?php if(!empty($_SESSION['Ancestor rank']) AND $_SESSION['Ancestor rank']=="41_isolate"){ echo " selected";}?>>41. isolate</option>
			</select>

			<br>
			<br>
			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_ancestor" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_ancestor" id="Min_Nr_Seq_ancestor" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sequences']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['min number of sequences'];} ?>> 
			
			<label for="Max_Nr_Seq_ancestor" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_ancestor" id="Max_Nr_Seq_ancestor" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sequences']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['max number of sequences'];} ?>> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_ancestor" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_ancestor" id="Min_Nr_sites_ancestor" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sites']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['min number of sites'];} ?>> 


			<label for="Max_Nr_sites_ancestor" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_ancestor" id="Max_Nr_sites_ancestor" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sites']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['max number of sites'];} ?>> <br>
			 <br>

			<label for="Fr_WL_Gaps_ancestor" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard" name="wildcard_gaps_fraction_ancestor" id="Fr_WL_Gaps_ancestor" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['wildcard gaps fraction']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['wildcard gaps fraction'];} ?>> <br>
			
			<label for="Fr_Dis_Pat_ancestor" class="ex1"> Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_ancestor" id="Fr_Dis_Pat_ancestor" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['distinct patterns fraction']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['distinct patterns fraction'];} ?>> <br>

			<label for="Fr_Pars_ancestor" class="ex1"> Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction" id="Fr_Pars_ancestor" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['parsimony sites fraction']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['parsimony sites fraction'];} ?>> <br>


			<br>
			
			<span > <b> <u>  Alignments source: </u></b> </span>
		   	<br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_ancestor" onchange = "checkkallAli('ancestor')" value="checked"  style='margin-left:-2px;' <?php if(isset($_SESSION['all sources']) && !empty($_SESSION['ancestor search'])){ echo "checked"; }?>>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_ancestor"  value="Lanfear" onchange = "checkkallAli('ancestor')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
		   	<label for = "Lanfear"> Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_ancestor_v10c"  value="OrthoMaM_v10c" onchange = "checkkallAli('ancestor')" <?php if(isset($_SESSION['OrthoMaM v10c'])){ echo "checked"; }?>>
		   	<label for = "OrthoMaM"> OrthoMaM v10c </label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_ancestor_v12a"  value="OrthoMaM_v12a" onchange = "checkkallAli('ancestor')"<?php //if(isset($_SESSION['OrthoMaM v12a'])){ echo "checked"; }?>>
			<label for = "OrthoMaM"> OrthoMaM v12a</label>
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_ancestor"  value="PANDIT" onchange = "checkkallAli('ancestor')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT"> PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_ancestor"  value="TreeBASE" onchange = "checkkallAli('ancestor')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			
			<br>
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_ancestor" id="Nr_hits_ancestor" step="any" max="500" <?php if(!empty($_SESSION['max number of datasets']) && !empty($_SESSION['ancestor search'])){ echo "value =".$_SESSION['max number of datasets'];} ?>>
		
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments containing specific taxa" name="sp_taxa_search_btn" onclick="AliSearchOptions('sp_taxa_search_field', 'taxa_search')" id="specific_ali">
			
		</div>
		<fieldset  class="text_form" id="sp_taxa_search_field" <?php echo (!empty($_SESSION['taxa search'])) ? "style = 'display : block';" : "style = 'display : none';"; ?>>
			<br>
			<input type="radio" name="taxa_search"  id="taxa_search" value="TRUE" style="display: none;">
			
			<label for="TaxaID_1">  Taxon ID 1: </label> 
        	<input type="text" name="Taxa_ID_1" id="TaxaID_1" class="text_field" <?php if(!empty($_SESSION['Taxa ID 1'])){ echo "value =".$_SESSION['Taxa ID 1'];} ?>>
			<label class="suggestion" for="TaxaID">(recommended species level)</label>
			<br> 
			<label for="TaxaID_2">  Taxon ID 2: </label> 
        	<input type="text" name="Taxa_ID_2" id="TaxaID_2" class="text_field" <?php if(!empty($_SESSION['Taxa ID 2'])){ echo "value =".$_SESSION['Taxa ID 2'];} ?>>
			<br> 
			<label for="TaxaID_3">  Taxon ID 3: </label> 
        	<input type="text" name="Taxa_ID_3" id="TaxaID_3" class="text_field" <?php if(!empty($_SESSION['Taxa ID 3'])){ echo "value =".$_SESSION['Taxa ID 3'];} ?>>
			<br> 
			<label for="TaxaID_4">  Taxon ID 4: </label> 
        	<input type="text" name="Taxa_ID_4" id="TaxaID_4" class="text_field" <?php if(!empty($_SESSION['Taxa ID 4'])){ echo "value =".$_SESSION['Taxa ID 4'];} ?>>
			<br> 
			<label for="TaxaID_5">  Taxon ID 5: </label> 
        	<input type="text" name="Taxa_ID_5" id="TaxaID_5" class="text_field" <?php if(!empty($_SESSION['Taxa ID 5'])){ echo "value =".$_SESSION['Taxa ID 5'];} ?>>
			<br> 
            <br>
			<span > <b> <u> LCA information </u></b> </span>
			<br>
            <span > Taxon name or ID of LCA: </span>
			<br>
            <label for="Taxa_LCA">  LCA Taxon: </label> 
        	<input type="text" name="Taxa_LCA" id="Taxa_LCA" class="text_field">
            <br>
			<span > <b> OR </b> </span>
            <br>
            <span > Range of ranks of LCA: </span>
			<br>
			<label for="Taxa_rank_min"> Rank of LCA: from </label> 
        	<!-- <input type="text" name="rank" id="Rank" placeholder="class" > -->
			<select name="taxa_rank_min" id="taxa_rank_min" class="rank_form">
            	<option value="" disabled selected hidden> choose rank</option>
				<option value="1" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="1"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="2"){ echo " selected";}?>>2. kingdom</option>
				<option value="3" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="3"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="4"){ echo " selected";}?>>4. superphylum</option>
				<option value="5" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="5"){ echo " selected";}?>>5. phylum</option>
				<option value="6" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="6"){ echo " selected";}?>>6. subphylum</option>
				<option value="7" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="7"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="8"){ echo " selected";}?>>8. superclass</option>
				<option value="9" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="9"){ echo " selected";}?>>9. class</option>
				<option value="10" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="10"){ echo " selected";}?>>10. subclass</option>
				<option value="11" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="11"){ echo " selected";}?>>11. infraclass</option>
				<option value="12" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="12"){ echo " selected";}?>>12. cohort</option>
				<option value="13" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="13"){ echo " selected";}?>>13. subcohort</option>
				<option value="14" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="14"){ echo " selected";}?>>14.superorder</option>
				<option value="15" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="15"){ echo " selected";}?>>15. order</option>
				<option value="16" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="16"){ echo " selected";}?>>16. suborder</option>
				<option value="17" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="17"){ echo " selected";}?>>17. infraorder</option>
				<option value="18" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="18"){ echo " selected";}?>>18. parvorder</option>
				<option value="19" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="19"){ echo " selected";}?>>19. superfamily</option>
				<option value="20" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="20"){ echo " selected";}?>>20. family</option>
				<option value="21" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="21"){ echo " selected";}?>>21. subfamily</option>
				<option value="22" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="22"){ echo " selected";}?>>22. tribe</option>
				<option value="23" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="23"){ echo " selected";}?>>23. subtribe</option>
				<option value="24" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="24"){ echo " selected";}?>>24. genus</option>
				<option value="25" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="25"){ echo " selected";}?>>25. subgenus</option>
				<option value="26" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="26"){ echo " selected";}?>>26. section</option>
				<option value="27" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="27"){ echo " selected";}?>>27. subsection</option>
				<option value="28" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="28"){ echo " selected";}?>>28. series</option>
				<option value="29" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="29"){ echo " selected";}?>>29. subseries</option>
				<option value="30" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="30"){ echo " selected";}?>>30. species group</option>
				<option value="31" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="31"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="32"){ echo " selected";}?>>32. species</option>
				<option value="33" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="33"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="34"){ echo " selected";}?>>34. subspecies</option>
				<option value="35" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="35"){ echo " selected";}?>>35. varietas</option>
				<option value="36" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="36"){ echo " selected";}?>>36. subvariety</option>
				<option value="37" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="37"){ echo " selected";}?>>37. forma</option>
				<option value="38" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="38"){ echo " selected";}?>>38. serogroup</option>
				<option value="39" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="39"){ echo " selected";}?>>39. serotype</option>
				<option value="40" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="40"){ echo " selected";}?>>40. strain</option>
				<option value="41" <?php if(!empty($_SESSION['taxa rank min']) AND $_SESSION['taxa rank min']=="41"){ echo " selected";}?>>41. isolate</option>
			</select>


            <label for="Taxa_rank_max" class="text_form_pushed"> to </label> 
        	<!-- <input type="text" name="max rank" id="Rank_max" placeholder="genus" > -->
			<select name="taxa_rank_max" id="Taxa_rank_max" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="1" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="1"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="2"){ echo " selected";}?>>2. kingdom</option>
				<option value="3" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="3"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="4"){ echo " selected";}?>>4. superphylum</option>
				<option value="5" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="5"){ echo " selected";}?>>5. phylum</option>
				<option value="6" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="6"){ echo " selected";}?>>6. subphylum</option>
				<option value="7" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="7"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="8"){ echo " selected";}?>>8. superclass</option>
				<option value="9" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="9"){ echo " selected";}?>>9. class</option>
				<option value="10" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="10"){ echo " selected";}?>>10. subclass</option>
				<option value="11" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="11"){ echo " selected";}?>>11. infraclass</option>
				<option value="12" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="12"){ echo " selected";}?>>12. cohort</option>
				<option value="13" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="13"){ echo " selected";}?>>13. subcohort</option>
				<option value="14" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="14"){ echo " selected";}?>>14.superorder</option>
				<option value="15" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="15"){ echo " selected";}?>>15. order</option>
				<option value="16" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="16"){ echo " selected";}?>>16. suborder</option>
				<option value="17" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="17"){ echo " selected";}?>>17. infraorder</option>
				<option value="18" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="18"){ echo " selected";}?>>18. parvorder</option>
				<option value="19" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="19"){ echo " selected";}?>>19. superfamily</option>
				<option value="20" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="20"){ echo " selected";}?>>20. family</option>
				<option value="21" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="21"){ echo " selected";}?>>21. subfamily</option>
				<option value="22" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="22"){ echo " selected";}?>>22. tribe</option>
				<option value="23" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="23"){ echo " selected";}?>>23. subtribe</option>
				<option value="24" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="24"){ echo " selected";}?>>24. genus</option>
				<option value="25" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="25"){ echo " selected";}?>>25. subgenus</option>
				<option value="26" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="26"){ echo " selected";}?>>26. section</option>
				<option value="27" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="27"){ echo " selected";}?>>27. subsection</option>
				<option value="28" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="28"){ echo " selected";}?>>28. series</option>
				<option value="29" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="29"){ echo " selected";}?>>29. subseries</option>
				<option value="30" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="30"){ echo " selected";}?>>30. species group</option>
				<option value="31" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="31"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="32"){ echo " selected";}?>>32. species</option>
				<option value="33" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="33"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="34"){ echo " selected";}?>>34. subspecies</option>
				<option value="35" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="35"){ echo " selected";}?>>35. varietas</option>
				<option value="36" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="36"){ echo " selected";}?>>36. subvariety</option>
				<option value="37" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="37"){ echo " selected";}?>>37. forma</option>
				<option value="38" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="38"){ echo " selected";}?>>38. serogroup</option>
				<option value="39" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="39"){ echo " selected";}?>>39. serotype</option>
				<option value="40" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="40"){ echo " selected";}?>>40. strain</option>
				<option value="41" <?php if(!empty($_SESSION['taxa rank max']) AND $_SESSION['taxa rank max']=="41"){ echo " selected";}?>>41. isolate</option>
			</select>
			<br>
			<br>
		
			<section class="source_field">
			<span > <b> <u>  Alignments source: </u></b> </span>
			<br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_taxa" onchange = "checkkallAli('taxa')" value="checked" style='margin-left:-1px;' <?php if(isset($_SESSION['all sources']) && !empty($_SESSION['taxa search'])){ echo "checked"; }?>>
		   	<label for = "all">all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_taxa"  value="Lanfear" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
		   	<label for = "Lanfear">Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_taxa_v10c"  value="OrthoMaM_v10c" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['OrthoMaM v10c'])){ echo "checked"; }?>>
		   	<label for = "OrthoMaM"> OrthoMaM V10c </label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_taxa_v12a"  value="OrthoMaM_v12a" onchange = "checkkallAli('taxa')"<?php //if(isset($_SESSION['OrthoMaM v12a'])){ echo "checked"; }?>>
		   	<label for = "OrthoMaM"> OrthoMaM V12a</label>
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_taxa"  value="PANDIT" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT">PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_taxa"  value="TreeBASE" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			</section>
			<br>
			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_taxa" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_taxa" id="Min_Nr_Seq_taxa" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sequences']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['min number of sequences'];} ?>> 
			
			<label for="Max_Nr_Seq_taxa" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_taxa" id="Max_Nr_Seq_taxa" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sequences']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['max number of sequences'];} ?>> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_taxa" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_taxa" id="Min_Nr_sites_taxa" step="any" min="0" max="500" <?php if(!empty($_SESSION['min number of sites']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['min number of sites'];} ?>> 


			<label for="Max_Nr_sites_taxa" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_taxa" id="Max_Nr_sites_taxa" step="any" min="0" max="500" <?php if(!empty($_SESSION['max number of sites']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['max number of sites'];} ?>> <br>
			 <br>

			<label for="Fr_WL_Gaps_taxa" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard" name="wildcard_gaps_fraction_taxa" id="Fr_WL_Gaps_taxa" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['wildcard gaps fraction']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['wildcard gaps fraction'];} ?>> <br>
			
			<label for="Fr_Dis_Pat_taxa" class="ex1">Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_taxa" id="Fr_Dis_Pat_taxa" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['distinct patterns fraction']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['distinct patterns fraction'];} ?>> <br>

			<label for="Fr_Pars_taxa" class="ex1">Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction_taxa" id="Fr_Pars_taxa" step="0.1" min="0" max="1" <?php if(!empty($_SESSION['parsimony sites fraction']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['parsimony sites fraction'];} ?>> <br>
			<br>
	
	
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_taxa" id="Nr_hits_taxa" step="any" max="500" <?php if(!empty($_SESSION['max number of datasets']) && !empty($_SESSION['taxa search'])){ echo "value =".$_SESSION['max number of datasets'];} ?>>
		
		</fieldset>
		  <br>
		  
		   <section class="filter_input">
		  <div class = "filter_input" id = "f1_input">
		  		
          <input class="search_btn" id= "submit" onclick= "loading()" type= "submit" value="Search database" >
		  </div>
		  
		  <br>
		 <section class="damn">
  <!-- Footer -->
  <footer class="bg-secondary text-white text-center fixed-bottom" >
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
		
        


          
        </div>
        <!--Grid column-->
		 <h6 class="text-lowercase">impressum </h6>

        
      
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
   
  </footer>
  <!-- Footer -->
</section>	
		  
		  
		  </div>
		 </form>
        </section>