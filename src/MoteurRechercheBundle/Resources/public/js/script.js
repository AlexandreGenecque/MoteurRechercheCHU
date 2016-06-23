function RAZvalue()
{
	document.getElementById("zoneLibre").value = "";
	document.getElementById("zoneResultat").innerHTML = "";

	document.getElementById("selectLabo").value = "defaut";
	document.getElementById("selectMicroOrg").value = "defaut";
}

function ouvre(fichier) 
 {
    ff=window.open(fichier,"popup")
 }


 function rechercheLettre(event){

    var lettre = event.currentTarget.value;

    if (lettre != undefined && lettre != "")
    {
        var DATA = 'lettre=' + lettre;

        $.ajax({
            type: "POST",
            url: "/MoteurRechercheCHU/web/app_dev.php/rechercheIndex/rechercheLettre",
            data: DATA,
            cache: false,
            success: function(data){
               $('#zoneResultat').html(data);
            }
        });
    }
 }
function resize(){
    document.getElementById('cache').style.display="block";
    document.getElementById('bouton_d').style.display="none";
    document.getElementById('detailsmoins').style.display="block";
}
function moins(){
    document.getElementById('cache').style.display="none";
    document.getElementById('bouton_d').style.display="block";
    document.getElementById('detailsmoins').style.display="none";
}