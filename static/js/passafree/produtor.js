$(document).ready(function () {
    var _sch = {};
    $(".pf-next-step").on("click", function (e) {
        var thisStep = $(this).attr("data-step");
        var target =$(this).attr("data-target");
        if (!thisStep) { 
            return;
        }

        e.stopPropagation();
        validateForm(false);

        setTimeout(function () {
            if ($("div#"+thisStep).find('.has-error').length) {
                return false;
            } else if (target) {
                $('a[href="'+target+'"]').tab('show');
            }
        }, 200);
    });
});

function validateForm(m) {
    var $form = $("#w0");
    var data = $form.data("yiiActiveForm");
    $.each(data.attributes, function() {
        this.status = 3; 
    });
    $form.yiiActiveForm("validate");
}

