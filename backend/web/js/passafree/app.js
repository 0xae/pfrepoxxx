$(document).ready(function () {
    var sessionBusiness = parseInt($("#session_business").val()) ||  getStoredBiz();

    $(".biz-choice").on("click", function () {
        var bizId = $(this).attr('data-id');
        selectBiz(bizId)
        .then(function () {
            localStorage.setItem('defaultBiz', bizId);
            location.reload();
        });
    });

    if (isNaN(sessionBusiness)) {
        $("#choose_biz").modal();
    } 
});

function selectBiz(bizId) {
    return $.get("./index.php?r=business/select&id="+bizId);
}

function getStoredBiz() {
    var it = localStorage.getItem('defaultBiz');
    return parseInt(it);
}

