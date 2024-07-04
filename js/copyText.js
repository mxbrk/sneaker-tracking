function copyMarkAsPayed() {
    var copyText = "Ist bezahlt, kannst du dann als verkauft markieren";
  
    navigator.clipboard.writeText(copyText);
  
    alert("Text kopiert: " + copyText);
  }

  function copyShippingAdress() {
    var copyText = "Versandadresse ist:";
  
    navigator.clipboard.writeText(copyText);
  
    alert("Lieferadresse kopiert: " + copyText);
  }

  function copyReview() {
    var copyText = "Hinterlass mir gerne noch eine Bewertung und folg mir für weitere ähnliche Angebote :)";
  
    navigator.clipboard.writeText(copyText);
  
    alert("Lieferadresse kopiert: " + copyText);
  }