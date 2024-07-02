function copyShippingAdress() {
    var copyText = "Versandadresse ist:\nMaximilian Bronkhorst\nAfrikanische Straße 23\n13351 Berlin";
  
    navigator.clipboard.writeText(copyText);
  
    alert("Lieferadresse kopiert: " + copyText);
  }