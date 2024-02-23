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
  
   
  
  <form action="results_mult_ali.php" method="post" class="was-validated" onsubmit="updateFormVal()">
	
    <div class = "data_type_mult_ali">
        <label for="data_type">  Data type:&nbsp; </label> 
        <select name="data_type" class="rank_form" id="datatype" required >
            <option value="" disabled selected hidden> choose type</option>
            <option value="dna" <?php if(!empty($_SESSION['data type']) AND $_SESSION['data type']=="dna"){ echo " selected";}?>> DNA </option>
				<option value="aa"<?php if(!empty($_SESSION['data type']) AND $_SESSION['data type']=="aa"){ echo " selected";}?>> Proteins </option>
        </select>
                    

        <br>
        <br>
    </div>
        
        
   
        <br>
        <fieldset  class="text_form formfield" id="id_search_field">
        <label for="Ali_ID" title="IDs should be separated by a and/or whitespace"> Alignment ID: </label> 
				<textarea type="text" name="Alignment_ID" id="Ali_ID" class="text_field_id" wrap="soft" placeholder="IDs should be separated by a comma and/or whitespace" ><?php if(!empty($_SESSION['Alignment ID'])){ echo $_SESSION['Alignment ID'];} ?> </textarea>
				
			<!-- class="text_form_pushed" -->
				<input type="checkbox" class="text_form_pushed" name="source_study"  id="source_study" value="TRUE" <?php if(!empty($_SESSION['source study'])){ echo "checked";} ?>>
				<label for = "source_study"> Provide study information </label> 
        </fieldset>
        

		  <br>
		  
		    <section class="filter_input">
		  <div class = "filter_input" id = "f1_input">
		  		
          <input class="search_btn" id= "submit" onclick= "loading()" type= "submit" value="Search database" >
		  </div>
		  
		  
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