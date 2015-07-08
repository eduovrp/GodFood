function confirm(respXml) {
    if (JSON.parse(respXml).status == 2) {
        window.location = "confirmation.php?pagina=confirmacao&status=2";
    } else {
        window.location = "confirmation.php?pagina=confirmacao&status=1";
    }
}