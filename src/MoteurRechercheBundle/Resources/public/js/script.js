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
    "width=800,height=800,left=200,top=40")
 }

 function rechercheAjax()
 {
    var motcle = $("#zoneLibre").val();
    var DATA = 'zonelibre=' + motcle;
    $.ajax({
        type: "POST",
        url: "{{ path('recherche')}}",
        data: DATA,
        cache: false,
        success: function(data){
           $('#zoneResultat').html(data);
          // $(".loading").hide();
        }
    });    
    return false;
 }