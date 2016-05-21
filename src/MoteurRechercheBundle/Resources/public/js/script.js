function RAZvalue()
{
	document.getElementById("zoneLibre").value = " ";
	document.getElementById("zoneResultat").innerHTML = " ";

	document.getElementById("selectLabo").value = "defaut";
	document.getElementById("selectMicroOrg").value = "defaut";
}

function ouvre(fichier) 
 {
    ff=window.open(fichier,"popup",
    "width=900,height=600,left=200,top=40") 
 }
