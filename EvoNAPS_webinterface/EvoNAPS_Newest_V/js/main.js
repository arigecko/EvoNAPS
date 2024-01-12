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
	//cb4= document.getElementById('all');
	//if(cb4.checked == true){
   
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
rank = ['PANDIT_rank', 'Lanfear_rank', 'OrthoMaM_rank', 'TreeBASE_rank', 'all_rank']
clade = ['PANDIT_clade', 'Lanfear_clade', 'OrthoMaM_clade', 'TreeBASE_clade', 'all_clade']
taxa = ['PANDIT_taxa', 'Lanfear_taxa', 'OrthoMaM_taxa', 'TreeBASE', 'all_taxa']
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
   
   
   if(cb5.checked == true){
	   document.getElementById(idList[0]).checked = false;
	   document.getElementById(idList[1]).checked = false;
	   document.getElementById(idList[2]).checked = false;
	   document.getElementById(idList[3]).checked = false;
	   
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

 


/*function updateFormVal(){
	max = 200;
	if (document.getElementById('id_search_btn').clicked){
		document.getElementById('Nr_hits_id').value = 15
	}
	if(document.getElementById('Nr_hits_rank').value) {
		maxValue = document.getElementById('Nr_hits_rank').value
		if (maxValue.value > max){
			maxValue.value = max
		}
	} else if (document.getElementById('Nr_hits_clade').value) {
		value = document.getElementById('Nr_hits_clade').value
		if (maxValue.value > max){
			maxValue.value = max
		}
	} else if (document.getElementById('Nr_hits_taxa').value) {
		value = document.getElementById('Nr_hits_taxa').value
		if (maxValue.value > max){
			maxValue.value = max
		}
	} 
	
	return
} */

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
    const field = ["id_search", "ranks_search", "clade_search", "sp_taxa_search"]
	const fieldRadio = ["id_search_radio", "rank_search_radio", "clade_search_radio", "taxa_search_radio"]
    clickedField = document.getElementById(id)
	clicked_radio = document.getElementById(radio_id)
    displayValue = "";
	displayRest = "none";
	clicked_radio.checked = true
    if (clickedField.style.display == ""){
        displayValue = "none";
		clicked_radio.checked = false
    }
    clickedField.style.display = displayValue;
	
	for (let i = 0; i < field.length; i++){
		if (field[i] != id){
			fieldID = field[i]
			radio_btn = fieldRadio[i]
			document.getElementById(fieldID).style.display = displayRest;
			document.getElementById(radio_btn).checked = false;
		}
	}
}


	


/*
function show3() {
	
	
	 var Ali_Specs = document.getElementById('Ali_Specs');
	 var checkb1 = document.getElementById('Alignment_Specs_Check');
	 
	 if(checkb1.checked){
		 
		 
		 Ali_Specs = 'block';
		 
	 } else {
		 
		Ali_Specs = 'none';
	 }
}

	var Ali_Specs = document.getElementById('Ali_Specs');
	var cb1 = document.getElementById('Alignment_Specs_Check')
	cb1.checked = false;
	cb1.onchange = function show3() {
		
	Ali_Specs.style.display = this.checked ? 'block' : 'none';}
	};
	cb1.onchange();
		
		
	}
	
*/ 
/*
	 checkb1.checked = false;
	 
	 checkb1.onchange = function 
		
		{
			
			return document.getElementById('Ali_Specs').style.display='none'; 
			
			
			
		} else {
			
			document.getElementById('Restrict').style.visibility='block';
			
		}
	
}

*/

	