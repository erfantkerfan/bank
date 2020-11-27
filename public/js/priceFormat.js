function numberWithCommas() {
    var1 = parseInt(document.getElementById('payment').value.replace(/,/g, '')) || 0;
    if (document.getElementById("negative")) {
        if (document.getElementById('negative').checked) {
            var1 = -var1
        }
    }
    var2 = parseInt(document.getElementById('loan_payment').value.replace(/,/g, '')) || 0;
    var3 = parseInt(document.getElementById('loan_payment_force').value.replace(/,/g, '')) || 0;
    var4 = parseInt(document.getElementById('payment_cost').value.replace(/,/g, '')) || 0;
    x = var1 + var2 + var3 + var4
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}