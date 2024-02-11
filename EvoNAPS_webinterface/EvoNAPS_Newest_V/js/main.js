document.getElementById('Ali_Specs').style.display = "none";


function show(x) {
	
	
	if(x==0)
	{
		
		/* 
		const Matrices_D  = document.getElementById('Matrices_DNA');
		Matrices_D.style.display = 'block';
		const Matrices_P  = document.getElementById('Matrices_Prot');
		Matrices_P.style.display = 'none';
		
		*/ 
		
		//works////////////
		
		
		document.getElementById('Matrices_DNA').style.visibility='visible';
		document.getElementById('Matrices_Prot').style.visibility='hidden';
		document.getElementById('Matrices_+F').style.visibility='hidden';
		
		
		return;
	}else{
		
		/*
		Same
		
		const Matrices_D  = document.getElementById('Matrices_DNA');
		Matrices_D.style.display = 'none';
		const Matrices_P  = document.getElementById('Matrices_Prot');
		Matrices_P.style.display = 'block';
		
		
		*/
		///////////////////////////Works///
		document.getElementById('Matrices_Prot').style.visibility='visible';
		document.getElementById('Matrices_DNA').style.visibility='hidden';
		document.getElementById('Matrices_+F').style.visibility='visible';
		
		
		
		
		
		return;
	}
}




function show2(x) {
	var Restrict = document.getElementById('Restrict');
	if(x==0)
		
		{
			Restrict.style.display=  "none";
			
			
			
			
		} else {
			
			Restrict.style.display= "block";
			
		}
	
}


	

function show3() {


	var Ali_Specs = document.getElementById('Ali_Specs');
	 checkb1 = document.getElementById('Alignment_Specs_Check');
	 
	 if(checkb1.checked == true){
		 
		 Ali_Specs.style.display = "block";
	 } else {
		 
		 Ali_Specs.style.display = "none";
	 }
	
	
}

function show4() {


	var Tree_Specs = document.getElementById('Tree_Specs');
	 checkb2 = document.getElementById('Trees_Specs_Check');
	 
	 if(checkb2.checked == true){
		 
		 Tree_Specs.style.display = "block";
	 } else {
		 
		 Tree_Specs.style.display = "none";
	 }
}
	
function checkkall(){
	
	cb1= document.getElementById('PANDIT');
	cb2= document.getElementById('Lanfear');
	cb3= document.getElementById('OrthoMaM');
	 // TreeBASE added
   
	cb4= document.getElementById('TreeBASE');
	cb5= document.getElementById('all');
   
   
   if(cb5.checked == true){
	   document.getElementById('PANDIT').checked = false;
	   document.getElementById('Lanfear').checked = false;
	   document.getElementById('OrthoMaM').checked = false;
	   document.getElementById('TreeBASE').checked = false;
	   
   }
   if(cb1.checked == true){
	   cb5.checked = false;
   
   }
   if(cb2.checked == true){
	   cb5.checked = false;
   
   }
   if(cb3.checked == true){
	   cb5.checked = false;
   
   }
   if(cb4.checked == true){
	   cb5.checked = false;
   
   }
   
}
// added for alignment form
function checkkallAli(obj){
	rank = ['PANDIT_rank', 'Lanfear_rank', 'OrthoMaM_v10c_rank', 'OrthoMaM_v12a_rank', 'TreeBASE_rank', 'all_rank']
	clade = ['PANDIT_clade', 'Lanfear_clade', 'OrthoMaM_v10c_clade', 'OrthoMaM_v12a_clade', 'TreeBASE_clade', 'all_clade']
	taxa = ['PANDIT_taxa', 'Lanfear_taxa', 'OrthoMaM_v10c_taxa', 'OrthoMaM_v12a_taxa','TreeBASE', 'all_taxa']
	idList = []
	if (obj == "rank"){
		idList = rank
	} else if (obj == "clade"){
		idList = clade
	} else if (obj == "taxa"){
		idList = taxa
	}

	cb1= document.getElementById(idList[0]);
	cb2= document.getElementById(idList[1]);
	cb3= document.getElementById(idList[2]);
   
	cb4= document.getElementById(idList[3]);
	cb5= document.getElementById(idList[4]);
	cb6= document.getElementById(idList[5]);
   
   
   if(cb6.checked == true){
	   document.getElementById(idList[0]).checked = false;
	   document.getElementById(idList[1]).checked = false;
	   document.getElementById(idList[2]).checked = false;
	   document.getElementById(idList[3]).checked = false;
	   
	   document.getElementById(idList[4]).checked = false;
	   
   }
   if(cb1.checked == true){
	   cb6.checked = false;
   
   }
   if(cb2.checked == true){
	   cb6.checked = false;
   
   }
   if(cb3.checked == true){
	   cb6.checked = false;
   
   }
   if(cb4.checked == true){
	   cb6.checked = false;
   
   }
   if(cb5.checked == true){
		cb6.checked = false;

}
   
}


function cbChange(obj) {
    var cbs = document.getElementsByClassName("cb");
    for (var i = 0; i < cbs.length; i++) {
        cbs[i].checked = false;
    }
    obj.checked = true;
}


function loading() {
  $(".btn .fa-spinner").show();
  $(".btn .btn-text").html("Loading");
  
}



function AliSearchOptions(id, radio_id) {
    const field = ["id_search_field", "ranks_search_field", "clade_search_field", "sp_taxa_search_field"];
	const fieldRadio = ["id_search", "rank_search", "clade_search", "taxa_search"];
    clickedField = document.getElementById(id);
	clicked_radio = document.getElementById(radio_id);
    displayValue = "";
	displayRest = "none";
	clicked_radio.checked = true;
    if (clickedField.style.display == ""){
        displayValue = "none";
		clicked_radio.checked = false;
    }
    clickedField.style.display = displayValue;
	
	for (let i = 0; i < field.length; i++){
		if (field[i] != id){
			fieldID = field[i];
			radio_btn = fieldRadio[i];
			document.getElementById(fieldID).style.display = displayRest;
			document.getElementById(radio_btn).checked = false;
		}
	}
}

function updateFormVal(){
	
	const fieldRadio = ["id_search", "rank_search", "clade_search", "taxa_search"];
	const sourceAll = ["all_rank", "all_clade", "all_taxa"];
	idSearch = document.getElementById("id_search"); 
	if (idSearch.checked == true){
		for (let i = 0; i < sourceAll.length; i++){
			document.getElementById(sourceAll[n]).checked = "";
		}
	} else {
		for (let i = 1; i < fieldRadio.length; i++){
			if  (document.getElementById(fieldRadio[i]).checked == true){
				for (let n = 0; n < sourceAll.length; n++){
					if (n != (i - 1)){
					document.getElementById(sourceAll[n]).checked = false;
					} /*else {
						document.getElementById(sourceAll[n]).value = "";
					}*/
				}
			}
		} 
	}
	idHits = document.getElementById("Nr_hits_id");
	if (idSearch.checked == true) {
		idHits.checked = true;
		idHits.value = "100";
	} else {
		idHits.checked = false;
		}
	
	/*
	const idSearchField = document.getElementById("id_search_field").children;
    const rankSearchField = document.getElementById("ranks_search_field").children;
    const cladeSearchField = document.getElementById("clade_search_field").children;
    const taxaSearchField = document.getElementById("sp_taxa_search_field").children;
    const allFields = [idSearchField, rankSearchField, cladeSearchField, taxaSearchField];
    for (let i = 0; i < fieldRadio.length; i++){
        if (document.getElementById(fieldRadio[i]).checked = true) {
            for (let fieldN = 0; fieldN < allFields.length; fieldN++){
                if (fieldN != i){
                    field = allFields[fieldN];
                    for (let n = 0; n < field.length; n++){
                        field[n].value = false;
                    }
                }
            }
        }
    }*/

}
	



