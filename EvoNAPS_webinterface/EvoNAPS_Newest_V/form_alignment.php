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
  
  <div class ="center">
  
   
  
	<form action="results_alignment.php" method="post" class="was-validated" onsubmit="updateFormVal()">
	
		<div class = "data_type_taxonomy">
			<label for="data_type">  Data type:&nbsp; </label> 
			<select name="data_type" class="rank_form" id="datatype" required >
				<option value="" disabled selected hidden> choose type</option>
				<option value="dna"> DNA </option>
				<option value="aa"> Proteins </option>
			</select>
			<!--	
          	<input type="radio" name="datatype" onclick = "show(0)" id="DNA_Radio" value="dna" checked>
		    <label for = "DNA_Radio"><h4> DNA &emsp;</h4> </label>
       
	   
		  	<input type="radio" name="datatype" onclick = "show(1)" id="Prot_Radio" value="aa">
		    <label for = "Prot_Radio"><h4> Proteins</h4> </label>
			-->
			
		   	<label for = "resolved taxonomy"> &emsp; &emsp; &emsp;Fully resolved taxonomy </label> 
		    <input type="checkbox" name="resolved_taxonomy"  id="resolved_tax" value="TRUE">
			<br>
			<br>
		</div>
			
			
		<div>
			<input type="button" class= "search_option" value="Searching for specific alignment" name="id_search_btn" onclick="AliSearchOptions('id_search', 'id_search_radio')" id="specific_ali" value="A">
			 
		</div>

		<fieldset  class="text_form" id="id_search" style= "display:none;">
			<br>
			<input type="radio" name="id_search_radio"  id="id_search_radio" value="TRUE" style="display: none;">
			<input type="hidden" name="number_of_hits_id" id="Nr_hits_id" value='50' style="display: none;" checked>
		
			<label for="Ali_ID"> Alignment ID: </label> 
        	<input type="text" name="Alignment_ID" id="Ali_ID" class="text_field" >
			<!-- class="text_form_pushed" -->
			<input type="checkbox" class="text_form_pushed" name="source_study"  id="source_study" value="TRUE">
			<label for = "source_study"> Provide study information </label> 
		    
		</fieldset>


		<br>

		<div>
			<input type="button" class= "search_option" value="Searching for alignments within certain ranks" name="ranks_search_btn" onclick="AliSearchOptions('ranks_search', 'rank_search_radio')" id="specific_ali">
			
		</div> 

		<fieldset  class="text_form" id="ranks_search" style= "display:none;">
			<br>
			<input type="radio" name="rank_search_radio"  id="rank_search_radio" value="TRUE" style="display: none;">
			<label for="Rank_min"> Rank:</label> 
        	<!--<input type="text" name="min rank" id="Rank_min"  placeholder="species">-->
			<select name="min_rank" id="Rank_min" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
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
				<option value="14">14.superorder</option>
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
			
			<label for="Rank_max" class="text_form_pushed"> to: </label> 
        	<!-- <input type="text" name="max rank" id="Rank_max" placeholder="genus" > -->
			<select name="max_rank" id="Rank_max" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="1"> 1. superkingdom </option>
				<option value="2">2. kimgdom</option>
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
				<option value="14">14.superorder</option>
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
			
			<span> Alignments source: </span>
		    <br>
		   	<input class ="cb" type="checkbox" name="selectAll"  id="all_rank" onchange = "checkkallAli('rank')"  style='margin-left:-2px;'>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_rank"  value="PANDIT" onchange = "checkkallAli('rank')">
		   	<label for = "PANDIT"> PANDIT </label>
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_rank"  value="Lanfear" onchange = "checkkallAli('rank')">
			<label for = "Lanfear"> Lanfear </label> 
			<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_rank"  value="OrthoMaM" onchange = "checkkallAli('rank')">
			<label for = "OrthoMaM"> OrthoMaM </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_rank"  value="TreeBASE" onchange = "checkkallAli('rank')">
		  	<label for = "TreeBASE"> TreeBASE </label>
			<br>
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="rank_form" name="number_of_hits_rank" id="Nr_hits_rank" step="any" max="200">
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments within certain clade" name="clade_search_btn" onclick="AliSearchOptions('clade_search', 'clade_search_radio')" id="specific_ali">
			
		</div>

		<fieldset  class="text_form" id="clade_search" style= "display:none;">
			<br>
			<input type="radio" name="clade_search_radio"  id="clade_search_radio" value="TRUE" style="display: none;">
			<label for="Rank"> Clade:</label> 
        	<input type="text" name="Clade" id="Clade" class="text_field" >
			<label for="Rank" class="text_form_pushed2"> Rank: </label> 
        	<!-- <input type="text" name="rank" id="Rank" placeholder="class" > -->
			<select name="Clade_rank" id="clade_rank" class="rank_form">
				<option value="" disabled selected hidden> choose rank</option>
				<option value="none">  </option>
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
			
			<span> Alignments source: </span>
		   	<br>
		   	<input class ="cb" type="checkbox" name="selectAll"  id="all_clade" onchange = "checkkallAli('clade')" value="checked"  style='margin-left:-2px;'>
		   	<label for = "all"> all </label> 
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_clade"  value="PANDIT" onchange = "checkkallAli('clade')">
		   	<label for = "PANDIT"> PANDIT </label>
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_clade"  value="Lanfear" onchange = "checkkallAli('clade')">
		   	<label for = "Lanfear"> Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_clade"  value="OrthoMaM" onchange = "checkkallAli('clade')">
		   	<label for = "OrthoMaM"> OrthoMaM </label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_clade"  value="TreeBASE" onchange = "checkkallAli('clade')">
		  	<label for = "TreeBASE"> TreeBASE </label>
			
			<br>
			<br>
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="rank_form" name="number_of_hits_clade" id="Nr_hits_clade" step="any" max="200">
		
		</fieldset>

		<br>

		<div>
		<input type="button" class= "search_option" value="Searching for alignments containing specific taxa" name="sp_taxa_search_btn" onclick="AliSearchOptions('sp_taxa_search', 'taxa_search_radio')" id="specific_ali">
			
		</div>

		<fieldset  class="text_form" id="sp_taxa_search" style= "display:none;">
			<br>
			<input type="radio" name="taxa_search_radio"  id="taxa_search_radio" value="TRUE" style="display: none;">
			
			<label for="TaxaID">  Taxa ID: </label> 
        	<input type="text" name="Taxa_ID" id="TaxaID" class="text_field">
			<label class="suggestion" for="TaxaID">(recommended species level)</label>
			<br> 
			<label for="Rank"> Rank: &emsp;&emsp;</label> 
        	<!-- <input type="text" name="rank" id="Rank" placeholder="class" > -->
			<select name="Taxa_rank" id="taxa_rank" class="rank_form">
				<option value="none">  </option>
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
		
			<section class="source_field">
			<span > Allignments source: </span>
			<br>
		   	<input class ="cb" type="checkbox" name="selectAll"  id="all_taxa" onchange = "checkkallAli('taxa')" value="checked" style='margin-left:-1px;'>
		   	<label for = "all">all </label> 
		   	<input class ="cb" type="checkbox" name="PANDIT"  id="PANDIT_taxa"  value="PANDIT" onchange = "checkkallAli('taxa')">
		   	<label for = "PANDIT">PANDIT </label>
		   	<input class ="cb" type="checkbox" name="Lanfear"  id="Lanfear_taxa"  value="Lanfear" onchange = "checkkallAli('taxa')">
		   	<label for = "Lanfear">Lanfear </label> 
		   	<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_taxa"  value="OrthoMaM" onchange = "checkkallAli('taxa')">
		   	<label for = "OrthoMaM"> OrthoMaM V10c </label>
			<input class ="cb" type="checkbox" name="OrthoMaM"  id="OrthoMaM_taxa"  value="OrthoMaM" onchange = "checkkallAli('taxa')">
		   	<label for = "OrthoMaM"> OrthoMaM V12a</label>
			<input class ="cb" type="checkbox" name="TreeBASE"  id="TreeBASE_taxa"  value="TreeBASE" onchange = "checkkallAli('taxa')">
		  	<label for = "TreeBASE"> TreeBASE </label>
			</section>
			<br>
	
			<label for="max number of hits" class="ex1"> Max number of alignments:</label>
		 	<input type="number" class="rank_form" name="number_of_hits_taxa" id="Nr_hits_taxa" step="any" max="200">
		
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