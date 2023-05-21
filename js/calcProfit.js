function calcProfit(){
    var buying_price = document.getElementById("buying_price").value;
    var payout = document.getElementById("payout").value;
    document.getElementById("profit").value = payout - buying_price;
}