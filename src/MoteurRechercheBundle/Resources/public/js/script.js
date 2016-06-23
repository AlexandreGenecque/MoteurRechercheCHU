function RAZvalue()
{
	document.getElementById("zoneLibre").value = "";
	document.getElementById("zoneResultat").innerHTML = "";

	document.getElementById("selectLabo").value = "defaut";
	document.getElementById("selectMicroOrg").value = "defaut";

    document.getElementById("zoneResultat").innerHTML = "<div id=\"zonePresentation\"><h4>Comment rechercher une analyse ?</h4> <ul><li>Vous pouvez sélectionner une lettre et toutes les analyses commençant par cette lettre vous seront présentées. Sélectionnez la touche chiffres et toutes les analyses contenant des chiffre seront affichées (ex: 17 OH-progestérone)</li><li>Vous pouvez saisir un nom d'analyse, même partiel, ou un mot clé</li><li>Enfin vous pouvez rechercher par Laboratoire ou Micro-organisme pour affiner votre requête</li></ul><p>Cliquez sur le bouton \"Rechercher\" ou tapez sur la touche \"Entrée\" de votre clavier pour lancer votre recherche, les résultats s'afficheront ci-dessous. </p><p> Lorsque vous effectuez une recherche par mot clé, il est possible d'affiner les résultats en choisissant un Laboratoire et/ou un Micro-organisme.</p></div>";

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