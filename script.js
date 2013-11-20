document.getElementById('autreBac').style.display="none";
document.getElementById('afficherAutre').style.display="none";

function afficherBac(liste)
{
    var valeur = liste.options[liste.selectedIndex].value;
    if (valeur == 'Autre')
    {
        document.getElementById('autreBac').style.display="block";
        document.getElementById('autreBac').setAttribute("required","true");
    }
    else
    {
        document.getElementById('autreBac').style.display="none";
        document.getElementById('autreBac').removeAttribute("required","true");
    }
}

function afficher2()    
{
    var monForm= document.getElementById('monForm');
    var autre = monForm.SourceSIO[2].checked;

    if (autre)
    {
        document.getElementById('afficherAutre').style.display="block";
        document.getElementById('afficherAutre').setAttribute("required","true");
    }
    else 
    {
        document.getElementById('afficherAutre').style.display="none";
        document.getElementById('afficherAutre').removeAttribute("required","true");
    }
}
