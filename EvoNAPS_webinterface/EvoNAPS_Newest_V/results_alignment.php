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
 	
	
	
	<script>
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
	})
	</script>
	
	

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
        <a class="nav-link active" href="#"><h2>results</h2></a>
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
<?php


	



Include 'query_builder_alignment.php';

echo '<div class ="center">';

		//Download Button 
		
		
		//Count 
		$filter_query = $connect->prepare($f_d_query);
		$filter_query->execute($f_d_parameters);

		//study if queried
		if(!empty($Source_study)){
		//if ($Source_study == TRUE) {
		$study_query = $connect->prepare($f_d_query_study);
		$study_query->execute($f_d_parameters);
		$study_query_result = $study_query->fetchAll(PDO::FETCH_ASSOC);
		}

		//Preview
		$filter_query_1 = $connect->prepare($f_d_query_1);
		$filter_query_1->execute($f_d_parameters);
		
		$filter_query_result = $filter_query_1->fetchAll(PDO::FETCH_ASSOC);
		$count = $filter_query -> fetchColumn();	
		
			echo "<br>";
			//echo "<hr>";
			
			echo "<h1> Number of hits in the database: ". " ". '<span class="badge bg-dark">'.$count.'</span>'.'</h1>';
			
			echo " <br>";
	
			echo " <h4> If you are satisfied with your search you can downlod your result set down below.  </h4>";
			
			echo "<br>";

	 echo "<hr>";

   echo "<h3>Used search parameters: </h3>";
  
   echo "<br>";
  foreach($_POST as $names => $values){
	  
	  if(!empty($values)){
	  echo "<h4>".$names.": "." ". " ".$values." "."</h4>";
	}  
  }
	echo "<br>";
	echo "<hr>";

	 
	
	echo '<h3> Download dataset:  <a href ="download_button.php" title = "Note!" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Here you can download your collected Data "> Download</a></h3> ';
	echo "<br>";
	echo '<h3>Refine your search: <a href ="form_alignment_refine.php" title = "Note!" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content=" Here you can go back to the orignal form with the search already filled in ">Refine </a> </h3> ';
	echo "<br>";
	echo '<h3><a href="alignment.php">Reset</a></h3>';

	echo '<hr>';
		echo "<br>" ;
		echo "<h3> Preview of selected dataset (max 20 results): </h3>";
		
		if (!empty($Source_study) AND $Source_study == TRUE) {
			foreach ($study_query_result as $list) {		
		
				echo "<br>";
				echo "<h5> alignment ID:&emsp;".$list["ALI_ID"]."</h5>";
				echo "<br>";
				echo "<h5>source database:&emsp;". $list["FROM_DATABASE"]."</h5>";	
				echo "<br>";
				echo "<h5>data URL:&emsp;". $list["DATA_URL"]."</h5>";	
				echo "<br>";
				echo "<h5>study ID:&emsp;". $list["STUDY_ID"]."</h5>";	
				echo "<br>";
				echo "<h5>study URL:&emsp;". $list["STUDY_URL"]."</h5>";	
				echo "<br>";
				echo "<h5>citation:&emsp;". $list["CITATION"]."</h5>";	
			}
		}
		foreach ($filter_query_result as $list) {		
		
		echo "<br>";
		echo implode("\n", $list);
		echo "<br>";	
		
		}

		
		echo " <br>";
			
		echo' </div>';	
		
		
		
		
		
		////////////////////////////////////////
		
			
			
		
		
		
		//fclose(output_file);
		
		
		$connect = null;
		
		



?>

<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>
		 <section class="damn">
  <!-- Footer -->
  <footer class="bg-secondary text-white text-center " >
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