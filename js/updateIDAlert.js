function approveAlert() {
  var selectedOptionValue = document.getElementById("select").value;
  var checkboxes = document.querySelectorAll(".sneakerCheckbox:checked");

  if (checkboxes.length === 0) {
      alert("Please select at least one Sneaker ID.");
      return false;
  }

  var sneakerID = checkboxes[0].value; // Erstes ausgewähltes ID

  if (selectedOptionValue === "delete_id") {
      return confirm("Do you want to delete ID '" + sneakerID + "' ?");
  }
  if (selectedOptionValue === "unsold") {
      return confirm("Do you want to set ID '" + sneakerID + "' as unsold ?");
  }

  return true; // Standardmäßig erlauben
}
