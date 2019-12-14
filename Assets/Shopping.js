$(document).ready(function () {
    $.ajax({
        url: "CartServer.php",
        method: "POST",
        data: {
            "action": "fetch"
        },
        success: function (data) {
            if (data.trim() == "showItems") {
                $(".noPrdDiv").css("display", "none");
                $(".cartDiv").css("display", "block");
            }
            else if (data.trim() == "noItems") {
                $(".cartDiv").css("display", "none");
                $(".noPrdDiv").css("display", "block");
            }

        }
    });

})

function incQty(prodId, stock) {
    var qty = parseInt($("#qtyBox_" + prodId).val()) + 1;
    if (qty <= stock) {
        $("#qtyBox_" + prodId).val(qty);
    }
    else
        alert("Only " + stock + " items available in stock");
}
function decQty(prodId) {
    var qty = parseInt($("#qtyBox_" + prodId).val()) - 1;
    if (qty > 0) {
        $("#qtyBox_" + prodId).val(qty);
    }
    else
        alert("Minimum quantity should be 1");
}

function qtyChange(newVal, stock, prodId) {
    if (newVal > stock) {
        alert("Only " + stock + " items available in stock");
        $("#qtyBox_" + prodId).val(stock);
    }
    if (newVal <= 0) {
        alert("Minimum quantity should be 1");
        $("#qtyBox_" + prodId).val(1);
    }
}

function addtoCart(prodId, prodIdDB, userId) {
    var selectedQty = $("#qtyBox_" + prodId).val();

    $.ajax({
        url: "CartServer.php",
        method: "POST",
        data: {
            "userId": userId,
            "prodId": prodIdDB,
            "qty": selectedQty,
            "action": "add"
        },
        success: function (data) {
            if (data.trim() == "Success") {
                alert("Successfully added  product to cart");
                window.location.href = "CustomerShopping.php";
            }

        }
    });
}
function deleteProduct(prodId, userId) {

    $.ajax({
        url: "CartServer.php",
        method: "POST",
        data: {
            "userId": userId,
            "prodId": prodId,
            "action": "delete"
        },
        success: function (data) {
            if (data.trim() == "Success") {
                alert("Successfully deleted product from cart");
                window.location.href = "CustomerShopping.php";
            }

        }
    });

}
function makePurchase(customerUserId) {
    var orderTotal=0;
    var balance=0;
    orderTotal=$("#totalOrder").val();
    balance=$("#balance").val();
    if(orderTotal>balance){
        alert("Please Recharge .Balance less than Order amount");
    }
    else{
    $.ajax({
        url: "CartServer.php",
        method: "POST",
        data: {
            "userId": customerUserId,
            "action": "order"
        },
        success: function (data) {
            if (data.trim() == "Success") {
                alert("Successfully ordered products .Please wait for the sellers approval for confirmation of your order");
                window.location.href = "CustomerShopping.php";
            }
        }
    });
}
}
function checkBalance() {
    document.getElementById("balanceSheet").style.display = "block";
}
function closeFun(){
    document.getElementById("balanceSheet").style.display = "none";
    document.getElementById("orderSheet").style.display = "none";
}
function checkOrderHst(){
    document.getElementById("orderSheet").style.display = "block";
}
function recharge(){
    if($("#amtBox").val() != "")
    var amtBox=parseInt($("#amtBox").val());
    if(amtBox >0 ){
        
    $.ajax({
        url: "CartServer.php",
        method: "POST",
        data: {
            "amt": amtBox,
            "action": "recharge"
        },
        success: function (data) {
            if (data.trim() == "Success") {
                alert("Recharge Successfull");
                window.location.href = "CustomerShopping.php";
                document.getElementById("balanceSheet").style.display = "block";
            }

        }
    });

    }
    else{
        alert("Please enter amount to be recharged");
    }
}