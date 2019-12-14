$(document).ready(function () {
    var selectedList = [];
    $("#rejectActiveBtn").click(function () {
        selectedList = [];
        $.each($("input[name='active']:checked"), function () {
            selectedList.push($(this).val());
        });
        if (selectedList.length > 0)
            ajaxCall(selectedList, "reject");
        else
            alert("Please select atleast one record in Active Sellers to perform the action");

    });
    $("#approvePendingBtn").click(function () {
        selectedList = [];
        $.each($("input[name='pending']:checked"), function () {
            selectedList.push($(this).val());
        });
        if (selectedList.length > 0)

            ajaxCall(selectedList, "approve");
        else
            alert("Please select atleast one record in Pending Sellers to perform the action");

    });
    $("#rejectPendingBtn").click(function () {
        selectedList = [];
        $.each($("input[name='pending']:checked"), function () {
            selectedList.push($(this).val());
        });
        if (selectedList.length > 0)

            ajaxCall(selectedList, "reject");
        else
            alert("Please select atleast one record in Pending Sellers to perform the action");


    });
    $("#approveRejectBtn").click(function () {
        selectedList = [];
        $.each($("input[name='rejected']:checked"), function () {
            selectedList.push($(this).val());
        });
        if (selectedList.length > 0)

            ajaxCall(selectedList, "approve");
        else
            alert("Please select atleast one record in Rejected Sellers to perform the action");


    });






});

function ajaxCall(selectedList, action) {
    $.ajax({
        type: "POST",
        url: "AdminActionServer.php",
        data:
        {
            "selectedList": selectedList,
            "action": action
        },
        success: function (data) {
            if (data == "Success")
                window.location.href = "AdminViewSeller.php";

        }

    });
}