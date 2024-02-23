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
        <a class="nav-link active" href="#"><h2>taxonomy</h2></a>
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
  
  <div class ="center">
  
   
  
	<form action="results_taxonomy.php" method="post" class="was-validated" onsubmit="updateFormVal()">
	
		<div class = "data_type_taxonomy">
			<label for="data_type">  Data type:&nbsp; </label> 
			<select name="data_type" class="rank_form" id="datatype" required >
				<option value="" disabled selected hidden> choose type</option>
				<option value="dna"> DNA </option>
				<option value="aa"> Proteins </option>
			</select>
						
		   	<label for = "resolved taxonomy"> &emsp; &emsp; &emsp;Fully resolved taxonomy </label> 
		    <input type="checkbox" name="resolved_taxonomy"  id="resolved_tax" value="TRUE">
			<br>
			<br>
		</div>
			
			
		<div>
			<input type="button" class= "search_option" value="Searching for specific alignments" name="id_search_btn" onclick="AliSearchOptions('id_search_field', 'id_search')" id="specific_ali" value="A">
			 
		</div>

		<fieldset  class="text_form" id="id_search_field" style= "display:none;">
			<br>
			<input type="radio" name="id_search"  id="id_search" value="TRUE" style="display: none;">
			<input type="hidden" name="number_of_hits_id" id="Nr_hits_id" style="display: none;" >
			<div class="formfield">
				<label for="Ali_ID" title="IDs should be separated by a comma and/or whitespace"> Alignment ID: </label> 
				<textarea type="text" name="Alignment_ID" id="Ali_ID" class="text_field_id" wrap="soft" placeholder="IDs should be separated by a comma and/or whitespace"></textarea>
				<!-- class="text_form_pushed" -->
				<input type="checkbox" class="text_form_pushed" name="source_study"  id="source_study" value="TRUE">
				<label for = "source_study"> Provide study information </label> 
			</div>
		    
		</fieldset>


		<br>

		<div>
			<input type="button" class= "search_option" value="Searching for alignments with LCA within certain ranks" name="ranks_search_btn" onclick="AliSearchOptions('ranks_search_field', 'rank_search')" id="specific_ali">
			
		</div> 

		<fieldset  class="text_form" id="ranks_search_field" style= "display:none;">
			<br>
			<input type="radio" name="rank_search"  id="rank_search" value="TRUE" style="display: none;">
			<label for="Rank_min"> LCA rank: from</label> 
        	<!--<input type="text" name="min rank" id="Rank_min"  placeholder="species">-->
			<select name="min_rank" id="Rank_min" class="rank_form" > <!--onchange="selectGray('Rank_min')"> -->
				<option value="" selected > choose rank</option>
				<!--<option value="none">  </option> -->
				<option value="1"> 1. superkingdom </option>
				<option value="2">2. kingdom</option>
				<option value="3">3. subkingdom</option>
				<option value="4">4. superphylum</option>
				<option value="5">5. phylum</option>
				<option value="6">6. subphylum</option>
				<option value="7">7. infraphylum</option>
				<option value="8">8. superclass</option>
				<option value="9">9. class</option>
				<option value="10">10. subclass</option>
				<option value="11">11. infraclass</option>
				<option value="12">12. cohort</option>
				<option value="13">13. subcohort</option>
				<option value="14">14. superorder</option>
				<option value="15">15. order</option>
				<option value="16">16. suborder</option>
				<option value="17">17. infraorder</option>
				<option value="18">18. parvorder</option>
				<option value="19">19. superfamily</option>
				<option value="20">20. family</option>
				<option value="21">21. subfamily</option>
				<option value="22">22. tribe</option>
				<option value="23">23. subtribe</option>
				<option value="24">24. genus</option>
				<option value="25">25. subgenus</option>
				<option value="26">26. section</option>
				<option value="27">27. subsection</option>
				<option value="28">28. series</option>
				<option value="29">29. subseries</option>
				<option value="30">30. species group</option>
				<option value="31">31. species subgroup</option>
				<option value="32">32. species</option>
				<option value="33">33. forma specialis</option>
				<option value="34">34. subspecies</option>
				<option value="35">35. varietas</option>
				<option value="36">36. subvariety</option>
				<option value="37">37. forma</option>
				<option value="38">38. serogroup</option>
				<option value="39">39. serotype</option>
				<option value="40">40. strain</option>
				<option value="41">41. isolate</option>
			</select>
			
			<label for="Rank_max" class="text_form_pushed"> to </label> 
        	<!-- <input type="text" name="max rank" id="Rank_max" placeholder="genus" > -->
			<select name="max_rank" id="Rank_max" class="rank_form" onchange="changeMe(this)">
				<option value="" selected > choose rank</option>
				<!--<option value="none">  </option> -->v
				<option value="1"> 1. superkingdom </option>
				<option value="2">2. kingdom</option>
				<option value="3">3. subkingdom</option>
				<option value="4">4. superphylum</option>
				<option value="5">5. phylum</option>
				<option value="6">6. subphylum</option>
				<option value="7">7. infraphylum</option>
				<option value="8">8. superclass</option>
				<option value="9">9. class</option>
				<option value="10">10. subclass</option>
				<option value="11">11. infraclass</option>
				<option value="12">12. cohort</option>
				<option value="13">13. subcohort</option>
				<option value="14">14. superorder</option>
				<option value="15">15. order</option>
				<option value="16">16. suborder</option>
				<option value="17">17. infraorder</option>
				<option value="18">18. parvorder</option>
				<option value="19">19. superfamily</option>
				<option value="20">20. family</option>
				<option value="21">21. subfamily</option>
				<option value="22">22. tribe</option>
				<option value="23">23. subtribe</option>
				<option value="24">24. genus</option>
				<option value="25">25. subgenus</option>
				<option value="26">26. section</option>
				<option value="27">27. subsection</option>
				<option value="28">28. series</option>
				<option value="29">29. subseries</option>
				<option value="30">30. species group</option>
				<option value="31">31. species subgroup</option>
				<option value="32">32. species</option>
				<option value="33">33. forma specialis</option>
				<option value="34">34. subspecies</option>
				<option value="35">35. varietas</option>
				<option value="36">36. subvariety</option>
				<option value="37">37. forma</option>
				<option value="38">38. serogroup</option>
				<option value="39">39. serotype</option>
				<option value="40">40. strain</option>
				<option value="41">41. isolate</option>
			</select>
			<label for="Rank_max" class="suggestion"> (optional)</label> 




			<br>
			<br>
			
			<span > <b> <u>  Alignments source: </u></b> </span>
		    <br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_rank" onchange = "checkkallAli('rank')" value="checked" checked style='margin-left:-2px;'>
		   	<label for = "all">all</label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_rank"  value="Lanfear" onchange = "checkkallAli('rank')">
			<label for = "Lanfear">Lanfear</label> 
			<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_v10c_rank"  value="OrthoMaM_v10c" onchange = "checkkallAli('rank')">
			<label for = "OrthoMaM"> OrthoMaM v10c</label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_v12a_rank"  value="OrthoMaM_v12a" onchange = "checkkallAli('rank')">
			<label for = "OrthoMaM"> OrthoMaM v12a</label>			
			<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_rank"  value="PANDIT" onchange = "checkkallAli('rank')">
		   	<label for = "PANDIT"> PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_rank"  value="TreeBASE" onchange = "checkkallAli('rank')">
		  	<label for = "TreeBASE">&nbsp;TreeBASE </label>
			
			<br>
			<br>




			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_rank" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_rank" id="Min_Nr_Seq_rank" step="any" min="0" max="500" onchange="addParameters('min_seq', 'Min_Nr_Seq_rank', 'Min_Nr_Seq_clade', 'Min_Nr_Seq_taxa')"> 
			
			<label for="Max_Nr_Seq_rank" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_rank" id="Max_Nr_Seq_rank" step="any" min="0" max="500"> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_rank" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_rank" id="Min_Nr_sites_rank" step="any" min="0" max="500"> 


			<label for="Max_Nr_sites_rank" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_rank" id="Max_Nr_sites_rank" step="any" min="0" max="500"> <br>
			 <br>

			<label for="Fr_WL_Gaps_rank" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard " name="wildcard_gaps_fraction_rank" id="Fr_WL_Gaps_rank" step="0.1" min="0" max="1"> <br>
			
			<label for="Fr_Dis_Pat_rank" class="ex1"> Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_rank" id="Fr_Dis_Pat_rank" step="0.1" min="0" max="1"> <br>

			<label for="Fr_Pars_rank" class="ex1"> Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction" id="Fr_Pars_rank" step="0.1" min="0" max="1"> <br>
			
		  
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_rank" id="Nr_hits_rank" step="any" min="0" max="500">
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments with a specific LCA" name="lca_search_btn" onclick="AliSearchOptions('lca_search_field', 'lca_search')" id="specific_ali">
			
		</div>

		<fieldset  class="text_form" id="lca_search_field" style= "display:none;">
			<br>
			<input type="radio" name="lca_search"  id="lca_search" value="TRUE" style="display: none;">
			<label for="LCA"> LCA taxon name/ID:</label> 
        	<input type="text" name="LCA" id="LCA" class="text_field" >
			
			<br>
			<br>
			
			<span > <b> <u>  Alignments source: </u></b> </span>
		   	<br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_lca" onchange = "checkkallAli('lca')" value="checked" checked style='margin-left:-2px;'>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_lca"  value="Lanfear" onchange = "checkkallAli('lca')">
		   	<label for = "Lanfear"> Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_v10c_lca"  value="OrthoMaM_v10c" onchange = "checkkallAli('lca')">
		   	<label for = "OrthoMaM"> OrthoMaM v10c</label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_v12a_lca"  value="OrthoMaM_v12a" onchange = "checkkallAli('lca')">
			<label for = "OrthoMaM"> OrthoMaM v12a</label>
			<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_lca"  value="PANDIT" onchange = "checkkallAli('lca')">
		   	<label for = "PANDIT"> PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_lca"  value="TreeBASE" onchange = "checkkallAli('lca')">
		  	<label for = "TreeBASE"> TreeBASE </label>
			
			<br>
			<br>

			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_lca" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_lca" id="Min_Nr_Seq_lca" step="any" min="0" max="500" onchange="addParameters('min_seq', 'Min_Nr_Seq_lca', 'Min_Nr_Seq_rank', 'Min_Nr_Seq_taxa')"> 
			
			<label for="Max_Nr_Seq_lca" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_lca" id="Max_Nr_Seq_lca" step="any" min="0" max="500"> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_lca" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_lca" id="Min_Nr_sites_lca" step="any" min="0" max="500"> 


			<label for="Max_Nr_sites_lca" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_lca" id="Max_Nr_sites_lca" step="any" min="0" max="500"> <br>
			 <br>

			<label for="Fr_WL_Gaps_lca" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard" name="wildcard_gaps_fraction_lca" id="Fr_WL_Gaps_lca" step="0.1" min="0" max="1"> <br>
			
			<label for="Fr_Dis_Pat_lca" class="ex1"> Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_lca" id="Fr_Dis_Pat_lca" step="0.1" min="0" max="1"> <br>

			<label for="Fr_Pars_lca" class="ex1"> Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction" id="Fr_Pars_lca" step="0.1" min="0" max="1"> <br>


			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_lca" id="Nr_hits_lca" step="any" min="0" max="500">
		
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments with an LCA below specific ancestor" name="ancestor_search_btn" onclick="AliSearchOptions('ancestor_search_field', 'ancestor_search')" id="specific_ali">
			
		</div>

		<fieldset  class="text_form" id="ancestor_search_field" style= "display:none;">
			<br>
			<input type="radio" name="ancestor_search"  id="ancestor_search" value="TRUE" style="display: none;">
			<label for="Ancestor"> Ancestor taxon ID/name:</label> 
        	<input type="text" name="Ancestor" id="Ancestor" class="text_field" >
			<label for="ancestor_rank" class="text_form_ancestor_rank"> Rank: </label> 
			<select name="Ancestor_rank" id="ancestor_rank" class="rank_form" onchange="changeMe(this)">
				<option value="" selected > choose rank</option>
				<!--<option value="none">  </option> -->
				<option value="1_superkingdom"> 1. superkingdom </option>
				<option value="2_kingdom">2. kingdom</option>
				<option value="3_subkingdom">3. subkingdom</option>
				<option value="4_superphylum">4. superphylum</option>
				<option value="5_phylum">5. phylum</option>
				<option value="6_subphylum">6. subphylum</option>
				<option value="7_infraphylum">7. infraphylum</option>
				<option value="8_superclass">8. superclass</option>
				<option value="9_class">9. class</option>
				<option value="10_subclass">10. subclass</option>
				<option value="11_infraclass">11. infraclass</option>
				<option value="12_cohort">12. cohort</option>
				<option value="13_subcohort">13. subcohort</option>
				<option value="14_superorder">14. superorder</option>
				<option value="15_order">15. order</option>
				<option value="16_suborder">16. suborder</option>
				<option value="17_infraorder">17. infraorder</option>
				<option value="18_parvorder">18. parvorder</option>
				<option value="19_superfamily">19. superfamily</option>
				<option value="20_family">20. family</option>
				<option value="21_subfamily">21. subfamily</option>
				<option value="22_tribe">22. tribe</option>
				<option value="23_subtribe">23. subtribe</option>
				<option value="24_genus">24. genus</option>
				<option value="25_subgenus">25. subgenus</option>
				<option value="26_section">26. section</option>
				<option value="27_subsection">27. subsection</option>
				<option value="28_series">28. series</option>
				<option value="29_subseries">29. subseries</option>
				<option value="30_species_group">30. species group</option>
				<option value="31_species_subgroup">31. species subgroup</option>
				<option value="32_species">32. species</option>
				<option value="33_forma_specialis">33. forma specialis</option>
				<option value="34_subspecies">34. subspecies</option>
				<option value="35_varietas">35. varietas</option>
				<option value="36_subvariety">36. subvariety</option>
				<option value="37_forma">37. forma</option>
				<option value="38_serogroup">38. serogroup</option>
				<option value="39_serotype">39. serotype</option>
				<option value="40_strain">40. strain</option>
				<option value="41_isolate">41. isolate</option>
				
			</select>

			<br>
			<br>
			
			<span > <b> <u>  Alignments source: </u></b> </span>
		   	<br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_ancestor" onchange = "checkkallAli('ancestor')" value="checked" checked style='margin-left:-2px;'>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_ancestor"  value="Lanfear" onchange = "checkkallAli('ancestor')">
		   	<label for = "Lanfear"> Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_v10c_ancestor"  value="OrthoMaM_v10c" onchange = "checkkallAli('ancestor')">
		   	<label for = "OrthoMaM"> OrthoMaM v10c</label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_v12a_ancestor"  value="OrthoMaM_v12a" onchange = "checkkallAli('ancestor')">
			<label for = "OrthoMaM"> OrthoMaM v12a</label>
			<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_ancestor"  value="PANDIT" onchange = "checkkallAli('ancestor')">
		   	<label for = "PANDIT"> PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_ancestor"  value="TreeBASE" onchange = "checkkallAli('ancestor')">
		  	<label for = "TreeBASE"> TreeBASE </label>
			
			<br>

			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_ancestor" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_ancestor" id="Min_Nr_Seq_ancestor" step="any" min="0" max="500" onchange="addParameters('min_seq', 'Min_Nr_Seq_ancestor', 'Min_Nr_Seq_rank', 'Min_Nr_Seq_taxa')"> 
			
			<label for="Max_Nr_Seq_ancestor" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_ancestor" id="Max_Nr_Seq_ancestor" step="any" min="0" max="500"> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_ancestor" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_ancestor" id="Min_Nr_sites_ancestor" step="any" min="0" max="500"> 


			<label for="Max_Nr_sites_ancestor" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_ancestor" id="Max_Nr_sites_ancestor" step="any" min="0" max="500"> <br>
			 <br>

			<label for="Fr_WL_Gaps_ancestor" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard" name="wildcard_gaps_fraction_ancestor" id="Fr_WL_Gaps_ancestor" step="0.1" min="0" max="1" max="1"> <br>
			
			<label for="Fr_Dis_Pat_ancestor" class="ex1"> Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_ancestor" id="Fr_Dis_Pat_ancestor" step="0.1" min="0" max="1"> <br>

			<label for="Fr_Pars_ancestor" class="ex1"> Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction" id="Fr_Pars_ancestor" step="0.1" min="0" max="1"> <br>


			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_ancestor" id="Nr_hits_ancestor" step="any" min="0" max="500">
		
		</fieldset>







		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments containing specific taxa" name="sp_taxa_search_btn" onclick="AliSearchOptions('sp_taxa_search_field', 'taxa_search')" id="specific_ali">
			
		</div>

		<fieldset  class="text_form" id="sp_taxa_search_field" style= "display:none;">
			<br>
			<input type="radio" name="taxa_search"  id="taxa_search" value="TRUE" style="display: none;">
			
			<label for="TaxaID_1">  Taxon ID 1: </label> 
        	<input type="text" name="Taxa_ID_1" id="TaxaID_1" class="text_field">
			<label class="suggestion" for="TaxaID">(recommended species level)</label>
			<br> 
			<label for="TaxaID_2">  Taxon ID 2: </label> 
        	<input type="text" name="Taxa_ID_2" id="TaxaID_2" class="text_field">
			<br> 
			<label for="TaxaID_3">  Taxon ID 3: </label> 
        	<input type="text" name="Taxa_ID_3" id="TaxaID_3" class="text_field">
			<br> 
			<label for="TaxaID_4">  Taxon ID 4: </label> 
        	<input type="text" name="Taxa_ID_4" id="TaxaID_4" class="text_field">
			<br> 
			<label for="TaxaID_5">  Taxon ID 5: </label> 
        	<input type="text" name="Taxa_ID_5" id="TaxaID_5" class="text_field">
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
			<select name="taxa_rank_min" id="taxa_rank_min" class="rank_form">
				<option value="" selected > choose rank</option>
				<!--<option value="none">  </option> -->
				<option value="1"> 1. superkingdom </option>
				<option value="2">2. kingdom</option>
				<option value="3">3. subkingdom</option>
				<option value="4">4. superphylum</option>
				<option value="5">5. phylum</option>
				<option value="6">6. subphylum</option>
				<option value="7">7. infraphylum</option>
				<option value="8">8. superclass</option>
				<option value="9">9. class</option>
				<option value="10">10. subclass</option>
				<option value="11">11. infraclass</option>
				<option value="12">12. cohort</option>
				<option value="13">13. subcohort</option>
				<option value="14">14. superorder</option>
				<option value="15">15. order</option>
				<option value="16">16. suborder</option>
				<option value="17">17. infraorder</option>
				<option value="18">18. parvorder</option>
				<option value="19">19. superfamily</option>
				<option value="20">20. family</option>
				<option value="21">21. subfamily</option>
				<option value="22">22. tribe</option>
				<option value="23">23. subtribe</option>
				<option value="24">24. genus</option>
				<option value="25">25. subgenus</option>
				<option value="26">26. section</option>
				<option value="27">27. subsection</option>
				<option value="28">28. series</option>
				<option value="29">29. subseries</option>
				<option value="30">30. species group</option>
				<option value="31">31. species subgroup</option>
				<option value="32">32. species</option>
				<option value="33">33. forma specialis</option>
				<option value="34">34. subspecies</option>
				<option value="35">35. varietas</option>
				<option value="36">36. subvariety</option>
				<option value="37">37. forma</option>
				<option value="38">38. serogroup</option>
				<option value="39">39. serotype</option>
				<option value="40">40. strain</option>
				<option value="41">41. isolate</option>
			</select>


            <label for="Taxa_rank_max" class="text_form_pushed"> to </label> 
			<select name="taxa_rank_max" id="Taxa_rank_max" class="rank_form" onchange="changeMe(this)">
				<option value="" selected > choose rank</option>
				<!--<option value="none">  </option> -->
				<option value="1"> 1. superkingdom </option>
				<option value="2">2. kingdom</option>
				<option value="3">3. subkingdom</option>
				<option value="4">4. superphylum</option>
				<option value="5">5. phylum</option>
				<option value="6">6. subphylum</option>
				<option value="7">7. infraphylum</option>
				<option value="8">8. superclass</option>
				<option value="9">9. class</option>
				<option value="10">10. subclass</option>
				<option value="11">11. infraclass</option>
				<option value="12">12. cohort</option>
				<option value="13">13. subcohort</option>
				<option value="14">14. superorder</option>
				<option value="15">15. order</option>
				<option value="16">16. suborder</option>
				<option value="17">17. infraorder</option>
				<option value="18">18. parvorder</option>
				<option value="19">19. superfamily</option>
				<option value="20">20. family</option>
				<option value="21">21. subfamily</option>
				<option value="22">22. tribe</option>
				<option value="23">23. subtribe</option>
				<option value="24">24. genus</option>
				<option value="25">25. subgenus</option>
				<option value="26">26. section</option>
				<option value="27">27. subsection</option>
				<option value="28">28. series</option>
				<option value="29">29. subseries</option>
				<option value="30">30. species group</option>
				<option value="31">31. species subgroup</option>
				<option value="32">32. species</option>
				<option value="33">33. forma specialis</option>
				<option value="34">34. subspecies</option>
				<option value="35">35. varietas</option>
				<option value="36">36. subvariety</option>
				<option value="37">37. forma</option>
				<option value="38">38. serogroup</option>
				<option value="39">39. serotype</option>
				<option value="40">40. strain</option>
				<option value="41">41. isolate</option>
			</select>
			<br>
			<br>
		
			<section class="source_field">
			<span > <b> <u>  Alignments source: </u></b> </span>
			<br>
		   	<input class ="cb" type="checkbox" name="all_sources"  id="all_taxa" onchange = "checkkallAli('taxa')" value="checked" checked style='margin-left:-1px;'>
		   	<label for = "all">all </label> 
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_taxa"  value="Lanfear" onchange = "checkkallAli('taxa')">
		   	<label for = "Lanfear">Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM_v10c"  id="OrthoMaM_v10c_taxa"  value="OrthoMaM_v10c" onchange = "checkkallAli('taxa')">
		   	<label for = "OrthoMaM"> OrthoMaM V10c </label>
			<input class ="cb" type="checkbox" name="OrthoMaM_v12a"  id="OrthoMaM_v12a_taxa"  value="OrthoMaM_v12a" onchange = "checkkallAli('taxa')">
		   	<label for = "OrthoMaM"> OrthoMaM V12a</label>
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_taxa"  value="PANDIT" onchange = "checkkallAli('taxa')">
		   	<label for = "PANDIT">PANDIT </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_taxa"  value="TreeBASE" onchange = "checkkallAli('taxa')">
		  	<label for = "TreeBASE"> TreeBASE </label>
			</section>

			<br>
			<span> <b><u>Alignment features</u></b> </span>
			<br>
			<span> Number of sequences: </span>
			<label for="Min_Nr_Seq_taxa" class="ex1"> &emsp;minimum </label>
		 	<input type="number" class="num_form min_seq" name="min_number_of_sequences_taxa" id="Min_Nr_Seq_taxa" step="any" min="0" max="500" onchange="addParameters('min_seq', 'Min_Nr_Seq_taxa', 'Min_Nr_Seq_clade', 'Min_Nr_Seq_rank')"> 
			
			<label for="Max_Nr_Seq_taxa" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_seq" name="max_number_of_sequences_taxa" id="Max_Nr_Seq_taxa" step="any" min="0" max="500"> <br>


			<span> Number of sites:&ensp;</span>
			<label for="Min_Nr_sites_taxa" class="ex1">&emsp; &emsp; minimum </label>
		 	<input type="number" class="num_form min_sites" name="min_number_of_sites_taxa" id="Min_Nr_sites_taxa" step="any" min="0" max="500"> 


			<label for="Max_Nr_sites_taxa" class="ex1">&emsp; &emsp; maximum </label>
		 	<input type="number" class="num_form max_sites" name="max_number_of_sites_taxa" id="Max_Nr_sites_taxa" step="any" min="0" max="500"> <br>
			 <br>

			<label for="Fr_WL_Gaps_taxa" class="ex1">Max fraction of wildcard gaps: &emsp; &emsp;&emsp;&ensp;</label>
		 	<input type="number" class="num_form wildcard" name="wildcard_gaps_fraction_taxa" id="Fr_WL_Gaps_taxa" step="0.1" min="0" max="1"> <br>
			
			<label for="Fr_Dis_Pat_taxa" class="ex1">Min fraction of distinct patterns: &emsp; </label>
		 	<input type="number" class="num_form dist_patterns" name="distinct_patterns_fraction_taxa" id="Fr_Dis_Pat_taxa" step="0.1" min="0" max="1"> <br>

			<label for="Fr_Pars_taxa" class="ex1">Min fraction of parsimony sites: &emsp; &emsp;</label>
		 	<input type="number" class="num_form pars_sites" name="parsimony_sites_fraction_taxa" id="Fr_Pars_taxa" step="0.1" min="0" max="1"> <br>
			<br>
	
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="num_form" name="number_of_hits_taxa" id="Nr_hits_taxa" step="any" min="0" max="500">
		
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