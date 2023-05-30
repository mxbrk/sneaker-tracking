function calcProfit(){
    var buying_price = document.getElementById("buying_price").value;
    var payout = document.getElementById("payout").value;
    var profit =  payout - buying_price;
    document.getElementById("profit").value = profit.toFixed(2);
}