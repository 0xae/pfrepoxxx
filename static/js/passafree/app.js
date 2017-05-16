$(document).ready(function () {
    var sessionBusiness = parseInt($("#session_business").val());

    $(".biz-choice").on("click", function () {
        var bizId = $(this).attr('data-id');
        selectBiz(bizId)
        .then(function () {
            location.reload();
        });
    });

    if (isNaN(sessionBusiness)) {
        $("#choose_biz").modal();
    } 

    $(".money").each(function () {
        var item = $(this).text();
        var num = Number(item).toLocaleString('en');
        $(this).text(num);
    });

    $(".pf-next-step").on("click", function (e) {
        var thisStep = $(this).attr("data-step");
        var target =$(this).attr("data-target");
        if (!thisStep) { return; }

        e.stopPropagation();
        validateForm("#w0");

        setTimeout(function () {
            if ($("div#"+thisStep).find('.has-error').length) {
                return false;
            } else if (target) {
                $('a[href="'+target+'"]').tab('show');
            }
        }, 200);
    });
});

function selectBiz(bizId) {
    return $.get("./index.php?r=business/select&id="+bizId);
}

function validateForm(m) {
    var $form = $(m);
    var data = $form.data("yiiActiveForm");
    $.each(data.attributes, function() {
        this.status = 3; 
    });
    $form.yiiActiveForm("validate");
}

(function () {
    angular.module('passafree', [
        'eventModule',
        'analyticsModule',
        'userModule'
    ]);
})();

