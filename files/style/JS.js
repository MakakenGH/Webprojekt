
//Beschreibung Store einklappen/ausklappen
$(document).ready(function(){
    $("#beschreibung_button_store").click(function(){
        $("#beschreibung_store").toggle();
    });

    function popupCenter('/functions/users/login-form.php', title, w, h) {
        var left = (screen.width / 2)  - (w / 2);
        var top  = (screen.height / 2) - (h / 2);
        var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }

});
