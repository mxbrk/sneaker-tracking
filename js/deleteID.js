function approveDelete(){
    var selectedOptionValue = document.getElementById("select");
    var value = selectedOptionValue.value;
    var sneakerID = document.getElementById("sneakerID").value;
  debugger;
      if (value === "delete_id"){
        if (confirm("Do you want to delete " + sneakerID + " ?")) {
          return true;
        } else {
          return false;
        }
      }
  }
  //test
  