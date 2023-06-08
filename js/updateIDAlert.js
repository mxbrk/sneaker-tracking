function approveAlert(){
    var selectedOptionValue = document.getElementById("select");
    var value = selectedOptionValue.value;
    var sneakerID = document.getElementById("sneakerID").value;
  
      if (value === "delete_id"){
        if (confirm("Do you want to delete ID '" + sneakerID + "' ?")) {
          return true;
        } else {
          return false;
        }
      }
      if (value === "unsold"){
        if (confirm("Do you want to set ID '" + sneakerID + "' as unsold ?")) {
          return true;
        } else {
          return false;
        }
      }

  }  