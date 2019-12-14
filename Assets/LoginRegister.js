$(document).ready(function () {
    $('#ustore').hide();
    $('#uloc').hide();
    $('.msg').hide();
    $('.rmsg').hide();
    $('.loginLink').hide();
    
    $('.msg').text("");
    $("#loginbtn").click(function () {
        var mobile = $("#umobile").val();
        var password = $("#upass").val();
        if (mobile == "" || password == "") {

            $('.msg').show();
            $('.msg').text("Please enter all values!");
        }

        else {
            $.ajax({
                type: "POST",
                url: "LoginServer.php",
                data:
                {
                    "umobile": mobile,
                    "upass": password
                },
                success: function (data) {
                    if (data == "Admin")
                        window.location.href = "Admin.php";
                    if (data == "Customer")
                        window.location.href = "CustomerShopping.php";
                    if (data == "Seller")
                        window.location.href = "Seller.php";
                    if (data == "NewUser") {
                        $('.msg').show();
                        $('.msg').text("Mobile number doesnt exist ,Please Register !");
                    }
                    if (data == "Incorrect") {
                        $('.msg').show();
                        $('.msg').text("Mobile number and Password do not match,Please Enter Correct Password !");
                    }

                }

            });
        }
    });
    $("#regbtn").click(function () {
        var name = $("#uname").val();
        var mobile = $("#umobile").val();
        var password = $("#upass").val();
        var role = $("#urole").val();
        var store = $("#ustore").val();
        var loc = $("#uloc").val();
        var email = $("#uemail").val();
        $.ajax({
            type: "POST",
            url: "RegisterServer.php",
            data:
            {
                "uname": name,
                "umobile": mobile,
                "upass": password,
                "urole": role,
                "ustore": store,
                "uloc":loc,
                "uemail": email
            },
            success: function (data) {
                if (data == "Success") {
                    $('.rmsg').show();
                    $(".rmsg").text("Successfully Registered");
                    document.getElementById("regForm").reset();
                    $('.loginLink').show();
                }
                if (data == "MobileExist") {
                    $('.rmsg').show();
                    $('.rmsg').text("Mobile number already registered.Please Login !");
                    $('.loginLink').show();
                }
                if (data == "EmailExist") {
                    $('.rmsg').show();
                    $('.rmsg').text("Email already exist !");
                    $('.loginLink').hide();

                }

            }

        });
    });
});

function displayStore() {
    var role = $("#urole").val();
    if (role == "Seller") {
        $('#ustore').show();
        $('#uloc').show();
    }
}

