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
        // looks for \s+ - up to several whitespace characters, exchanges with "," in trimmed string
        $Ali_ID_arr = preg_replace('/\s+|;/',',',trim($_POST['Alignment_ID']));
        // turning multiple "," into one
        $Ali_ID_arr = preg_replace("/,+/", ",", $Ali_ID_arr);
        $_SESSION['Alignment ID']= $Ali_ID_arr;
        echo "array done";
        }
    if(isset($_POST['source_study'])){
        $Source_study = $_POST['source_study'];
        $_SESSION['source study']= $Source_study;
        }
    $Nr_hits_preview = 50;	
    // in case limit for numer of sequences will e needed
    //$Nr_hits = 3500;
    //$_SESSION['max number of datasets']= $Nr_hits;
?>