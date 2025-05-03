$(document).ready(function () {
    // Use event delegation for dynamically added elements if necessary
    $(document).on("click", ".edituser", function () {
        const id = $(this).data("id");
        const modal = $("#edituser"); // Target the specific modal

        $.ajax({
            url: "/dashboard/users/" + id + "/edit",
            type: "get",
            dataType: "json",
            success: function (data) {
                // Populate the modal with the fetched data
                modal.find("#id").val(data.id);
                modal.find("#name").val(data.name);
                modal.find("#nomor_induk").val(data.nomor_induk);
                modal.find("#email").val(data.email);
                modal.find("#role_id").val(data.role_id);

                // Update the form action dynamically
                modal.find("#editformuser").attr("action", "/dashboard/users/" + data.id);

                // Show the modal
                modal.modal("show");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                alert("Failed to fetch user data. Please try again.");
            },
        });
    });
});
