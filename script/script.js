alert ("blabla");
document.getElementById("champ_cache").style.display = "none";
 
function afficher()
{
    var coche = document.getElementsByName("connu")[0];
    console.log(coche);

    if(coche.checked)
    {
        document.getElementById("champ_cache").style.display = "block";
		console.log(coche);
    }
    else 
    {	
        document.getElementById("champ_cache").style.display = "none";
		
    }
}

