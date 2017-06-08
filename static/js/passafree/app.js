$(document).ready(function () {
    var sessionBusiness = parseInt($("#session_business").val());
    $("#business-privacy-descr")
    .trumbowyg({
        btnsAdd: ['foreColor', 'backColor']
    }).on('tbwchange', function(e){
        $("#privacy_content_input").val(e.target.value);
    });

    $(".pf-text-editor").trumbowyg();

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

    $("#business-privacy").on("change", function (data) {
        // console.info(data);
        $("#privacy_input").val(data.target.value);
    });

    $("#business-privacy-descr").on("change", function (data) {
        // console.info(data);
        $("#privacy_content_input").val(data.target.value);
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

    if($('#blah').attr('src')=='#'){

        $('#trashd').hide();
        $('#papelFundo').hover($('#papelFundo').css('cursor','pointer'));
        $('#file').hide();
        $('#formFilro').hide();
        $('#papelFundo').css('opacity',1);
        $('#papelFundo').css('background','#f4f7fa');
    }
    else{
        $('#upload').hide();
        $('#papelFundo').show();
        $('#ecrevCriv').hide();
        $('#trashd').show();
        $('#trashd').hover($('#trashd').css('cursor','pointer'));
        $('#papelFundo').css('opacity',0.5);

    }

    $('#trashd').hide();
    $('#blah').hide();
    $('#papelFundo').hover($('#papelFundo').css('cursor','pointer'));
    $('#file').hide();
    $('#formFilro').hide();
    $('#papelFundo').css('opacity',1);
    $('#papelFundo').css('background','#f4f7fa');

    $('#papelFundo').click(function() {
        if( $('#blah').attr('src')=='#'){
            $('#file').click();
        }
    }
    );

    $('._filtroCr').hover(function() {
        if($('#blah').attr('src')!='#') {
            $('#papelFundo').css('background',$(this).attr('value'));
        }
        $('#formFilro').val($(this).attr('value'));
    });

    if($('#blah').attr('src')=='#'){
        $('#papelFundo').hover($('#papelFundo').css('cursor','pointer'));
    } else {
        $('#papelFundo').hover($('#papelFundo').css('cursor','crosshair'));
    }

    $('#trashd').click(function() {
        $('#file').val('');
        $('#upload').show();
        $('#ecrevCriv').show();
        $('#blah').attr('src','#');
        $('#file').val('');
        $('#trashd').hide();
        $('#papelFundo').css('opacity',1);
        $('#papelFundo').css('background','#f4f7fa');
        $('#formFilro').val('');
        $('#blah').hide();
    });

    var filtroConj=document.getElementsByClassName('filtro');
    var i=0;
    for(i=0;i<filtroConj.length;i++){

        filtroConj[i].style.background=filtroConj[i].getAttribute('value');

    }
});

function selectBiz(bizId) {
    return $.get("./index.php?r=site/set-biz&id="+bizId);
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
        'settingsModule',
        'BizModule',
        'userModule',
        'coreModule'
    ]);
})();

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#upload').hide();
            $('#papelFundo').show();
            $('#blah').show();
            $('#ecrevCriv').hide();
            $('#trashd').show();
            $('#trashd').hover($('#trashd').css('cursor','pointer'));
            $('#papelFundo').css('opacity',0);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

