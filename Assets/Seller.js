$(document).ready(function () {
    //fetch_data();
    $('#image_form').submit(function (event) {
        event.preventDefault();
        var image_name = $('#file').val();
        if (image_name == '') {
            alert("Please Select Image");
            return false;
        }
        else {
            var extension = $('#file').val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#file').val('');
                return false;

            }
            else {
                $.ajax({
                    url: "SellerServer.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.trim() == "Success"){
                            alert("Successfully added product");
                            window.location.href = "Seller.php";
                        }
                           
                    }
                });

            }
        }
    });
    $(".delete").click(function () {
        var delId = $(this).attr("id");
        var action = "delete";
        if (confirm("Are you sure you want to remove this from database?")) {
            $.ajax({
                url: "SellerServer.php",
                method: "POST",
                data: { delId: delId, action: action },
                success: function (data) {
                    alert("Successfully deleted the product");
                    if (data.trim() == "Success")
                    window.location.href = "Seller.php";
                        //fetch_data();
                }
            })
        }
        else {
            return false;
        }
    });
});

function fetch_data() {

    $.ajax({
        url: "SellerServer.php",
        method: "POST",
        data: {
            action: "fetch"
        },
        success: function (data) {
            $('#image_data').html(data);
        }
    })
}
