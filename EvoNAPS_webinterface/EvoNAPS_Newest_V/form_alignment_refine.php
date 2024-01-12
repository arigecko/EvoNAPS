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
 	
	
	
	
	 <script src="js/main.js"></script> 
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	 <link href="StyleSheet.css"type="text/css" rel="stylesheet"/>
	

	

	
	
	
	 
  </head>
  
  <div class = "fix">
  <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
   
   <a class="navbar-brand" href="index.php">
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
	 <a class="nav-link active" href="index.php"><h4>Home</h4></a>
	 </li>
	 <li class="nav-item">
	 <a class="nav-link active" href="index.php"><h4>Documentation</h4></a>
	 </li>
	 <li class="nav-item">
	 <a class="nav-link active" href="index.php"><h4>FAQ</h4></a>
	 </li>
	
	</ul>
	</div>

	 
	
      
</nav>
  <body>
  <?php  session_start(); //echo "pls show the number:".$_SESSION['ALID']; ?>
  <div class ="center">
  
   
  
	<form action="results_alignment.php" method="post" class="was-validated" onsubmit="updateFormVal()">
	
		<div class = "data_type_taxonomy">
			<label for="data_type">  Data type:&nbsp; </label> 
			<select name="data_type" class="rank_form" id="datatype" required >
				<option value="" disabled selected hidden> choose type</option>
				<option value="dna" <?php if(!empty($_SESSION['data_type']) AND $_SESSION['data_type']=="dna"){ echo " selected";}?>> DNA </option>
				<option value="aa"<?php if(!empty($_SESSION['data_type']) AND $_SESSION['data_type']=="aa"){ echo " selected";}?>> Proteins </option>
			</select>
						
		   	<label for = "resolved taxonomy"> &emsp; &emsp; &emsp;Fully resolved taxonomy </label> 
		    <input type="checkbox" name="resolved_taxonomy"  id="resolved_tax" value="TRUE" <?php if(!empty($_SESSION['resolved_taxonomy'])){ echo "checked";} ?>>
			<br>
			<br>
		</div>
			
			
		<div>
			<input type="button" class= "search_option" value="Searching for specific alignment" name="id_search_btn" onclick="AliSearchOptions('id_search', 'id_search_radio')" id="specific_ali" value="A">
			 
		</div>

		<fieldset  class="text_form" id="id_search" <?php echo (!empty($_SESSION['id_search_radio'])) ? "style = display : block" : "style = display : none";?>>
			<br>
			<input type="radio" name="id_search_radio"  id="id_search_radio" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['id_search_radio'])){ echo "checked"; } ?>>
			<input type="hidden" name="number_of_hits_id" id="Nr_hits_id" value='50' style="display: none;" checked>
		
			<label for="Ali_ID"> Alignment ID: </label> 
        	<input type="text" name="Alignment_ID" id="Ali_ID" class="text_field" <?php if(!empty($_SESSION['Alignment_ID'])){ echo "value =".$_SESSION['Alignment_ID'];} ?>>
			<!-- class="text_form_pushed" -->
			<input type="checkbox" class="text_form_pushed" name="source_study"  id="source_study" value="TRUE" <?php if(!empty($_SESSION['source_study'])){ echo "checked";} ?>>
			<label for = "source_study"> Provide study information </label> 
		    
		</fieldset>


		<br>

		<div>
			<input type="button" class= "search_option" value="Searching for alignments within certain ranks" name="ranks_search_btn" onclick="AliSearchOptions('ranks_search', 'rank_search_radio')" id="specific_ali">
			
		</div>
		<fieldset  class="text_form" id="ranks_search" <?php if (!isset($Rank_search)){echo "style=display : none;";}?>> 
		<!--<fieldset  class="text_form" id="ranks_search" <?php /*echo (!empty($_SESSION['rank_search_radio'])) ? "style = display : block" : "style = display : none"; */?>> -->
			<br>
			<input type="radio" name="rank_search_radio"  id="rank_search_radio" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['rank_search_radio'])){ echo "checked"; } ?>>
			<label for="Rank_min"> Rank:</label> 
        	<!--<input type="text" name="min rank" id="Rank_min"  placeholder="species">-->
			<select name="min_rank" id="Rank_min" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="1" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="1"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="2"){ echo " selected";}?>>2. kingdom</option>
				<option value="3" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="3"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="4"){ echo " selected";}?>>4. superphylum</option>
				<option value="5" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="5"){ echo " selected";}?>>5. phylum</option>
				<option value="6" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="6"){ echo " selected";}?>>6. subphylum</option>
				<option value="7" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="7"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="8"){ echo " selected";}?>>8. superclass</option>
				<option value="9" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="9"){ echo " selected";}?>>9. class</option>
				<option value="10" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="10"){ echo " selected";}?>>10. subclass</option>
				<option value="11" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="11"){ echo " selected";}?>>11. infraclass</option>
				<option value="12" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="12"){ echo " selected";}?>>12. cohort</option>
				<option value="13" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="13"){ echo " selected";}?>>13. subcohort</option>
				<option value="14" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="14"){ echo " selected";}?>>14.superorder</option>
				<option value="15" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="15"){ echo " selected";}?>>15. order</option>
				<option value="16" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="16"){ echo " selected";}?>>16. suborder</option>
				<option value="17" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="17"){ echo " selected";}?>>17. infraorder</option>
				<option value="18" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="18"){ echo " selected";}?>>18. parvorder</option>
				<option value="19" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="19"){ echo " selected";}?>>19. superfamily</option>
				<option value="20" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="20"){ echo " selected";}?>>20. family</option>
				<option value="21" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="21"){ echo " selected";}?>>21. subfamily</option>
				<option value="22" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="22"){ echo " selected";}?>>22. tribe</option>
				<option value="23" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="23"){ echo " selected";}?>>23. subtribe</option>
				<option value="24" <?php if(!empty($_SESSION['min_rank']) AND $_SESSION['min_rank']=="24"){ echo " selected";}?>>24. genus</option>
				<option value="25" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="25"){ echo " selected";}?>>25. subgenus</option>
				<option value="26" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="26"){ echo " selected";}?>>26. section</option>
				<option value="27" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="27"){ echo " selected";}?>>27. subsection</option>
				<option value="28" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="28"){ echo " selected";}?>>28. series</option>
				<option value="29" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="29"){ echo " selected";}?>>29. subseries</option>
				<option value="30" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="30"){ echo " selected";}?>>30. species group</option>
				<option value="31" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="31"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32" <?php if(!empty($_SESSION['min_rank']) AND $_SESSION['min_rank']=="32"){ echo " selected";}?>>32. species</option>
				<option value="33" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="33"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="34"){ echo " selected";}?>>34. subspecies</option>
				<option value="35" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="35"){ echo " selected";}?>>35. varietas</option>
				<option value="36" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="36"){ echo " selected";}?>>36. subvariety</option>
				<option value="37" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="37"){ echo " selected";}?>>37. forma</option>
				<option value="38" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="38"){ echo " selected";}?>>38. serogroup</option>
				<option value="39" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="39"){ echo " selected";}?>>39. serotype</option>
				<option value="40" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="40"){ echo " selected";}?>>40. strain</option>
				<option value="41" <?php if(!empty($_SESSION['Rank_min']) AND $_SESSION['Rank_min']=="41"){ echo " selected";}?>>41. isolate</option>
			</select>
			
			<label for="Rank_max" class="text_form_pushed"> to: </label> 
        	<!-- <input type="text" name="max rank" id="Rank_max" placeholder="genus" > -->
			<select name="max_rank" id="Rank_max" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="1" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="1"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="2"){ echo " selected";}?>>2. kingdom</option>
				<option value="3" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="3"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="4"){ echo " selected";}?>>4. superphylum</option>
				<option value="5" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="5"){ echo " selected";}?>>5. phylum</option>
				<option value="6" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="6"){ echo " selected";}?>>6. subphylum</option>
				<option value="7" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="7"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="8"){ echo " selected";}?>>8. superclass</option>
				<option value="9" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="9"){ echo " selected";}?>>9. class</option>
				<option value="10" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="10"){ echo " selected";}?>>10. subclass</option>
				<option value="11" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="11"){ echo " selected";}?>>11. infraclass</option>
				<option value="12" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="12"){ echo " selected";}?>>12. cohort</option>
				<option value="13" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="13"){ echo " selected";}?>>13. subcohort</option>
				<option value="14" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="14"){ echo " selected";}?>>14.superorder</option>
				<option value="15" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="15"){ echo " selected";}?>>15. order</option>
				<option value="16" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="16"){ echo " selected";}?>>16. suborder</option>
				<option value="17" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="17"){ echo " selected";}?>>17. infraorder</option>
				<option value="18" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="18"){ echo " selected";}?>>18. parvorder</option>
				<option value="19" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="19"){ echo " selected";}?>>19. superfamily</option>
				<option value="20" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="20"){ echo " selected";}?>>20. family</option>
				<option value="21" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="21"){ echo " selected";}?>>21. subfamily</option>
				<option value="22" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="22"){ echo " selected";}?>>22. tribe</option>
				<option value="23" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="23"){ echo " selected";}?>>23. subtribe</option>
				<option value="24" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="24"){ echo " selected";}?>>24. genus</option>
				<option value="25" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="25"){ echo " selected";}?>>25. subgenus</option>
				<option value="26" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="26"){ echo " selected";}?>>26. section</option>
				<option value="27" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="27"){ echo " selected";}?>>27. subsection</option>
				<option value="28" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="28"){ echo " selected";}?>>28. series</option>
				<option value="29" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="29"){ echo " selected";}?>>29. subseries</option>
				<option value="30" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="30"){ echo " selected";}?>>30. species group</option>
				<option value="31" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="31"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="32"){ echo " selected";}?>>32. species</option>
				<option value="33" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="33"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="34"){ echo " selected";}?>>34. subspecies</option>
				<option value="35" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="35"){ echo " selected";}?>>35. varietas</option>
				<option value="36" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="36"){ echo " selected";}?>>36. subvariety</option>
				<option value="37" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="37"){ echo " selected";}?>>37. forma</option>
				<option value="38" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="38"){ echo " selected";}?>>38. serogroup</option>
				<option value="39" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="39"){ echo " selected";}?>>39. serotype</option>
				<option value="40" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="40"){ echo " selected";}?>>40. strain</option>
				<option value="41" <?php if(!empty($_SESSION['max_rank']) AND $_SESSION['max_rank']=="41"){ echo " selected";}?>>41. isolate</option>
			</select>
			<label for="Rank_max" class="suggestion"> (optional)</label> 




			<br>
			<br>
			
			<span> Alignments source: </span>
		    <br>
		   	<input class ="cb" type="checkbox" name="selectAll"  id="all_rank" onchange = "checkkallAli('rank')"  style='margin-left:-2px;' <?php if(isset($_SESSION['selectAll'])){ echo "checked"; }?>>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_rank"  value="PANDIT" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT"> PANDIT </label>
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_rank"  value="Lanfear" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
			<label for = "Lanfear"> Lanfear </label> 
			<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_rank"  value="OrthoMaM" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['OrthoMaM'])){ echo "checked"; }?>>
			<label for = "OrthoMaM"> OrthoMaM </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_rank"  value="TreeBASE" onchange = "checkkallAli('rank')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			<br>
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="rank_form" name="number_of_hits_rank" id="Nr_hits_rank" step="any" max="200" <?php if(!empty($_SESSION['Nr_hits_rank'])){ echo "value =".$_SESSION['Nr_hits_rank'];} ?>>
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments within certain clade" name="clade_search_btn" onclick="AliSearchOptions('clade_search', 'clade_search_radio')" id="specific_ali">
			
		</div>

		<fieldset  class="text_form" id="clade_search" <?php echo isset($Clade_search) AND !empty($_SESSION['clade_search_radio']) ? "style = display : block" :  "style = display : none";;?>>
			<br>
			<input type="radio" name="clade_search_radio"  id="clade_search_radio" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['clade_search_radio'])){ echo "checked"; } ?>>
			<label for="Rank"> Clade:</label> 
        	<input type="text" name="Clade" id="Clade" class="text_field" <?php if(!empty($_SESSION['Clade'])){ echo "value =".$_SESSION['Clade'];} ?>>
			<label for="Rank" class="text_form_pushed2"> Rank: </label> 
        	<!-- <input type="text" name="rank" id="Rank" placeholder="class" > -->
			<select name="Clade_rank" id="clade_rank" class="rank_form">
				<option value="none">  </option>
				<option value="1_superkingdom" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="1_superkingdom"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2_kingdom" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="2_kingdom"){ echo " selected";}?>>2. kingdom</option>
				<option value="3_subkingdom" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="3_subkingdom"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4_superphylum" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="4_superphylum"){ echo " selected";}?>>4. superphylum</option>
				<option value="5_phylum" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="5_phylum"){ echo " selected";}?>>5. phylum</option>
				<option value="6_subphylum" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="6_subphylum"){ echo " selected";}?>>6. subphylum</option>
				<option value="7_infraphylum" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="7_infraphylum"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8_superclass" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="8_superclass"){ echo " selected";}?>>8. superclass</option>
				<option value="9_class" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="9_class"){ echo " selected";}?>>9. class</option>
				<option value="10_subclass" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="10_subclass"){ echo " selected";}?>>10. subclass</option>
				<option value="11_infraclass" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="11_infraclass"){ echo " selected";}?>>11. infraclass</option>
				<option value="12_cohort" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="12_cohort"){ echo " selected";}?>>12. cohort</option>
				<option value="13_subcohort" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="13_subcohort"){ echo " selected";}?>>13. subcohort</option>
				<option value="14_superorder" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="14_superorder"){ echo " selected";}?>>14.superorder</option>
				<option value="15_order" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="15_order"){ echo " selected";}?>>15. order</option>
				<option value="16_suborder" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="16_suborder"){ echo " selected";}?>>16. suborder</option>
				<option value="17_infraorder" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="17_infraorder"){ echo " selected";}?>>17. infraorder</option>
				<option value="18_parvorder" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="18_parvorder"){ echo " selected";}?>>18. parvorder</option>
				<option value="19_superfamily" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="19_superfamily"){ echo " selected";}?>>19. superfamily</option>
				<option value="20_family" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="20_family"){ echo " selected";}?>>20. family</option>
				<option value="21_subfamily" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="21_subfamily"){ echo " selected";}?>>21. subfamily</option>
				<option value="22_tribe" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="22_tribe"){ echo " selected";}?>>22. tribe</option>
				<option value="23_subtribe" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="23_subtribe"){ echo " selected";}?>>23. subtribe</option>
				<option value="24_genus" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="24_genus"){ echo " selected";}?>>24. genus</option>
				<option value="25_subgenus" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="25_subgenus"){ echo " selected";}?>>25. subgenus</option>
				<option value="26_section" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="26_section"){ echo " selected";}?>>26. section</option>
				<option value="27_subsection" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="27_subsection"){ echo " selected";}?>>27. subsection</option>
				<option value="28_series" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="28_series"){ echo " selected";}?>>28. series</option>
				<option value="29_subseries" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="29_subseries"){ echo " selected";}?>>29. subseries</option>
				<option value="30_species_group" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="30_species_group"){ echo " selected";}?>>30. species group</option>
				<option value="31_species_subgroup" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="31_species_subgroup"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32_species" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="32_species"){ echo " selected";}?>>32. species</option>
				<option value="33_forma_specialis" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="33_forma_specialis"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34_subspecies" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="34_subspecies"){ echo " selected";}?>>34. subspecies</option>
				<option value="35_varietas" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="35_varietas"){ echo " selected";}?>>35. varietas</option>
				<option value="36_subvariety" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="36_subvariety"){ echo " selected";}?>>36. subvariety</option>
				<option value="37_forma" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="37_forma"){ echo " selected";}?>>37. forma</option>
				<option value="38_serogroup" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="38_serogroup"){ echo " selected";}?>>38. serogroup</option>
				<option value="39_serotype" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="39_serotype"){ echo " selected";}?>>39. serotype</option>
				<option value="40_strain" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="40_strain"){ echo " selected";}?>>40. strain</option>
				<option value="41_isolate" <?php if(!empty($_SESSION['Clade_rank']) AND $_SESSION['Clade_rank']=="41_isolate"){ echo " selected";}?>>41. isolate</option>
			</select>

			<br>
			<br>
			
			<span> Alignments source: </span>
		   	<br>
		   	<input class ="cb" type="checkbox" name="selectAll"  id="all_clade" onchange = "checkkallAli('clade')" value="checked"  style='margin-left:-2px;' <?php if(isset($_SESSION['selectAll'])){ echo "checked"; }?>>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_clade"  value="PANDIT" onchange = "checkkallAli('clade')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT"> PANDIT </label>
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_clade"  value="Lanfear" onchange = "checkkallAli('clade')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
		   	<label for = "Lanfear"> Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_clade"  value="OrthoMaM" onchange = "checkkallAli('clade')" <?php if(isset($_SESSION['OrthoMaM'])){ echo "checked"; }?>>
		   	<label for = "OrthoMaM"> OrthoMaM </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_clade"  value="TreeBASE" onchange = "checkkallAli('clade')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			
			<br>
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="rank_form" name="number_of_hits_clade" id="Nr_hits_clade" step="any" max="200" <?php if(!empty($_SESSION['Nr_hits_clade'])){ echo "value =".$_SESSION['Nr_hits_clade'];} ?>>
		
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments containing specific taxa" name="sp_taxa_search_btn" onclick="AliSearchOptions('sp_taxa_search', 'taxa_search_radio')" id="specific_ali">
			
		</div>
		<fieldset  class="text_form" id="sp_taxa_search" <?php echo (!empty($_SESSION['taxa_search_radio'])) ? "style = display : block" : "style = display : none"; ?>>
			<br>
			<input type="radio" name="taxa_search_radio"  id="taxa_search_radio" value="TRUE" style="display: none;" <?php if(!empty($_SESSION['taxa_search_radio'])){ echo "checked"; } ?>>
			
			<label for="TaxaID">  Taxa ID: </label> 
        	<input type="text" name="Taxa_ID" id="TaxaID" class="text_field" <?php if(!empty($_SESSION['Taxa_ID'])){ echo "value =".$_SESSION['Taxa_ID'];} ?>>
			<label class="suggestion" for="TaxaID">(recommended species level)</label>
			<br> 
			<label for="Rank"> Rank: &emsp;&emsp;</label> 
        	<!-- <input type="text" name="rank" id="Rank" placeholder="class" > -->
			<select name="Taxa_rank" id="taxa_rank" class="rank_form">
			<option value="none">  </option>
				<option value="1_superkingdom" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="1_superkingdom"){ echo " selected";}?>> 1. superkingdom </option>
				<option value="2_kingdom" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="2_kingdom"){ echo " selected";}?>>2. kingdom</option>
				<option value="3_subkingdom" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="3_subkingdom"){ echo " selected";}?>>3. subkingdom</option>
				<option value="4_superphylum" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="4_superphylum"){ echo " selected";}?>>4. superphylum</option>
				<option value="5_phylum" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="5_phylum"){ echo " selected";}?>>5. phylum</option>
				<option value="6_subphylum" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="6_subphylum"){ echo " selected";}?>>6. subphylum</option>
				<option value="7_infraphylum" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="7_infraphylum"){ echo " selected";}?>>7. infraphylum</option>
				<option value="8_superclass" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="8_superclass"){ echo " selected";}?>>8. superclass</option>
				<option value="9_class" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="9_class"){ echo " selected";}?>>9. class</option>
				<option value="10_subclass" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="10_subclass"){ echo " selected";}?>>10. subclass</option>
				<option value="11_infraclass" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="11_infraclass"){ echo " selected";}?>>11. infraclass</option>
				<option value="12_cohort" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="12_cohort"){ echo " selected";}?>>12. cohort</option>
				<option value="13_subcohort" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="13_subcohort"){ echo " selected";}?>>13. subcohort</option>
				<option value="14_superorder" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="14_superorder"){ echo " selected";}?>>14.superorder</option>
				<option value="15_order" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="15_order"){ echo " selected";}?>>15. order</option>
				<option value="16_suborder" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="16_suborder"){ echo " selected";}?>>16. suborder</option>
				<option value="17_infraorder" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="17_infraorder"){ echo " selected";}?>>17. infraorder</option>
				<option value="18_parvorder" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="18_parvorder"){ echo " selected";}?>>18. parvorder</option>
				<option value="19_superfamily" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="19_superfamily"){ echo " selected";}?>>19. superfamily</option>
				<option value="20_family" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="20_family"){ echo " selected";}?>>20. family</option>
				<option value="21_subfamily" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="21_subfamily"){ echo " selected";}?>>21. subfamily</option>
				<option value="22_tribe" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="22_tribe"){ echo " selected";}?>>22. tribe</option>
				<option value="23_subtribe" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="23_subtribe"){ echo " selected";}?>>23. subtribe</option>
				<option value="24_genus" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="24_genus"){ echo " selected";}?>>24. genus</option>
				<option value="25_subgenus" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="25_subgenus"){ echo " selected";}?>>25. subgenus</option>
				<option value="26_section" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="26_section"){ echo " selected";}?>>26. section</option>
				<option value="27_subsection" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="27_subsection"){ echo " selected";}?>>27. subsection</option>
				<option value="28_series" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="28_series"){ echo " selected";}?>>28. series</option>
				<option value="29_subseries" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="29_subseries"){ echo " selected";}?>>29. subseries</option>
				<option value="30_species_group" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="30_species_group"){ echo " selected";}?>>30. species group</option>
				<option value="31_species_subgroup" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="31_species_subgroup"){ echo " selected";}?>>31. species subgroup</option>
				<option value="32_species" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="32_species"){ echo " selected";}?>>32. species</option>
				<option value="33_forma_specialis" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="33_forma_specialis"){ echo " selected";}?>>33. forma specialis</option>
				<option value="34_subspecies" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="34_subspecies"){ echo " selected";}?>>34. subspecies</option>
				<option value="35_varietas" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="35_varietas"){ echo " selected";}?>>35. varietas</option>
				<option value="36_subvariety" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="36_subvariety"){ echo " selected";}?>>36. subvariety</option>
				<option value="37_forma" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="37_forma"){ echo " selected";}?>>37. forma</option>
				<option value="38_serogroup" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="38_serogroup"){ echo " selected";}?>>38. serogroup</option>
				<option value="39_serotype" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="39_serotype"){ echo " selected";}?>>39. serotype</option>
				<option value="40_strain" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="40_strain"){ echo " selected";}?>>40. strain</option>
				<option value="41_isolate" <?php if(!empty($_SESSION['Taxa_rank']) AND $_SESSION['Taxa_rank']=="41_isolate"){ echo " selected";}?>>41. isolate</option>
			</select>
		
			<br>
			<br>
		
			<section class="source_field">
			<span > Allignments source: </span>
			<br>
		   	<input class ="cb" type="checkbox" name="selectAll"  id="all_taxa" onchange = "checkkallAli('taxa')" value="checked" style='margin-left:-1px;' <?php if(isset($_SESSION['selectAll'])){ echo "checked"; }?>>
		   	<label for = "all">all </label> 
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_taxa"  value="PANDIT" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['PANDIT'])){ echo "checked"; }?>>
		   	<label for = "PANDIT">PANDIT </label>
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_taxa"  value="Lanfear" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['Lanfear'])){ echo "checked"; }?>>
		   	<label for = "Lanfear">Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_taxa"  value="OrthoMaM" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['OrthoMaM'])){ echo "checked"; }?>>
		   	<label for = "OrthoMaM"> OrthoMaM V10c </label>
			<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_taxa"  value="OrthoMaM" onchange = "checkkallAli('taxa')">
		   	<label for = "OrthoMaM"> OrthoMaM V12a</label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_taxa"  value="TreeBASE" onchange = "checkkallAli('taxa')" <?php if(isset($_SESSION['TreeBASE'])){ echo "checked"; }?>>
		  	<label for = "TreeBASE"> TreeBASE </label>
			</section>
			<br>
	
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="rank_form" name="number_of_hits_taxa" id="Nr_hits_taxa" step="any" max="200" <?php if(!empty($_SESSION['Nr_hits_taxa'])){ echo "value =".$_SESSION['Nr_hits_taxa'];} ?>>
		
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