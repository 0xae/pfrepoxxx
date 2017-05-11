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
});

function selectBiz(bizId) {
    return $.get("./index.php?r=business/select&id="+bizId);
}

(function () {
    angular.module('passafree', [
        'eventModule',
        'analyticsModule'
    ]);
    console.info('== angular inited ==');
})();

