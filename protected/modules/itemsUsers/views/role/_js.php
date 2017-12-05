<script>
/* MANAGER Users */

function check_acton_controller() {
    var id = $("#group_id").val();
    jQuery.ajax({
        type: 'POST',
        url: "<?php echo CController::createUrl('Role/ViewActionContent');?>",
        data: {
            "id": id
        },
        success: function (data) {
            if (data == '0') {
                $("#view_content_actions").html('<p style="color:red;margin: 10px;">Administrator have full right!</p>');
            } else {
                jQuery("#view_content_actions").fadeOut(250, function () {
                    jQuery(this).html(data);
                }).fadeIn(250);
            }

        },
    });
}
</script>