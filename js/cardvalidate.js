function detectType(number){
    var reg = {
        amex: /^3[47][0-9]{13}$/,
        discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
        mastercard: /^5[1-5][0-9]{14}$/,
        visa: /^4[0-9]{12}(?:[0-9]{3})?$/
    }
    for(var key in reg) {
        if(reg[key].test(number)) {
            return key
        }
    }
}
function validate(form){
    var cardNumber= form.cardnumber.value;
    var n= detectType(cardNumber);
    var type= document.getElementById("cardtype");

    if(n == "amex"){
        type.innerHTML= "American Express";
    }
    if(n == "discover"){
        type.innerHTML= "Discover";
    }
    if(n == "mastercard"){
        type.innerHTML= "Mastercard";
    }
    if(n == "visa"){
        type.innerHTML= "Visa";
    }

    return false;
}