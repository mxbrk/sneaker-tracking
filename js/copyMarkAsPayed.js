function copyMarkAsPayed() {
    var copyText = "Ist bezahlt, kannst du dann als verkauft markieren";
  
    navigator.clipboard.writeText(copyText);
  
    alert("Text kopiert: " + copyText);
  }