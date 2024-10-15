$(document).ready(function () {
    $(".editadmin").on("click", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "/dashboard/users/" + id + "/edit",
            data: {
                id: id,
            },
            type: "get",
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#provinsi_id").val(data.provinsi_id);
                $("#username").val(data.username);
                $("#email").val(data.email);
                $("#password").val(data.password);
                $("#editformadmin").attr(
                    "action",
                    "/dashboard/users/" + data.id
                );
            },
        });
    });
});
