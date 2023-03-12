function calcFees() {
    // get user input
    var netPrice = parseInt(document.getElementById("calcFeesInput").value);
  
    // calculate price to pay
    var result = (netPrice + 0.35) /(1-0.0249);
    result = result.toFixed(2);
    // display result in the input field
    document.getElementById("calcFeesInput").value = result;  
  }