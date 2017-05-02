<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use dosamigos\datepicker\DatePicker;

use kartik\time\TimePicker;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $modelEvento backend\modelEventos\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

$_dataIlhas=$modelEvento->getIlhas();
$_dataFiltros=$modelEvento->getFiltros();


?>
<div class="evento-form" >



    <!--?= ?-->
    <div class="row">

        <div class="col-md-3">

        </div>
        <div class="col-md-3">
<!--            --><?php //echo $form->field($modelEvento, 'filtro')->widget(Select2::className(), [
//                'data' => $data = $_dataFiltros,
//                'options' => ['placeholder' => 'Escolha o filtro...', 'multiple' => false],
//            ]);?>
        </div>






    <div class="col-md-3" >
     <?php
//     echo $form->field($modelEvento, 'file')->widget(FileInput::classname(), [
//        'options' => ['accept' => 'image/*'],
//         'pluginOptions' => [
//             'showPreview' => true,
//             'showCaption' => false,
//             'showRemove' => true,
//             'showUpload' => false,
//             'browseLabel' => 'Imagem',
//             'removeLabel' => 'Eliminar',
//         ]
//        ]); /**/ ?>

    </div>

      </div> <!-- fim de row -->

        <?php
//        $form->field($modelEvento, 'descricao')->textarea(['rows' => 6]) ?>
        <?php // $form->field($modelEvento, 'estado')->textInput() ?>

        <div class="form-group">

        </div>



</div>
<div>
<h4 style="color: #009447; font-weight: 700; font-stretch: normal; font-style: normal; text-transform: uppercase;">
    <i class="fa fa-minus" style="transform: rotate(-90deg);"></i>filtros</h4>



<!--inicio filtros-->
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div id="carousel-id" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-id" data-slide-to="0" class=""></li>
        <li data-target="#carousel-id" data-slide-to="1" class="active"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">7</div>
                    <div class="col-md-2">8</div>
                    <div class="col-md-2">9</div>
                    <div class="col-md-2">10</div>
                    <div class="col-md-2">11</div>
                    <div class="col-md-2">12</div>
                </div>
            </div>
        </div>
        <div class="item active">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">1</div>
                    <div class="col-md-2">2</div>
                    <div class="col-md-2">3</div>
                    <div class="col-md-2">4</div>
                    <div class="col-md-2">5</div>
                    <div class="col-md-2">6</div>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!--fim de filtros-->
<br>
<h4 style="color: #009447; font-weight: 700; font-stretch: normal; font-style: normal; text-transform: uppercase;">
    <i class="fa fa-minus" style="transform: rotate(-90deg);"></i> informações</h4>
<div class="row">
    <div class="col-md-6 infoput">
        <?php
            echo $form->field($modelEvento, 'nome')->textInput(['maxlength' => true,'class'=>'form-control'])
        ?>
        <input type="email" class="form-control" value="" placeholder="Local">
        <?php
        echo $form->field($modelEvento, 'hora')->widget(
                TimePicker::className(), [
                'name' => 'start_time',
                'pluginOptions' => [
                    'showSeconds' => false,
                    'autoclose'=>true,
                    'format' => 'hh:ii',
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                ],
            'options'=>['class'=>'form-control']
                ]);?>
        <?php
            echo $form->field($modelEvento, 'data')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Data','class'=>'form-control',
                        'value'  => empty(($modelEvento->data))?'':date("d-m-Y",$modelEvento->data),
                        ],

                    'value'  => "12-12-2016",
                    'pluginOptions' => [
                        'format' => 'dd-m-yyyy',
                        'todayHighlight' => true,


//
                    ]
                ]);?>
        <?php echo $form->field($modelEvento, 'ilha')->widget(Select2::className(), [
            'data' => $data = $_dataIlhas,
            'options' => ['placeholder' => 'Escolha a ilha...', 'multiple' => false,'class'=>'form-control'],
        ]);?>
        <input type="email" class="form-control" value="" placeholder="Tipo evento">
    </div>

    <div class="col-md-6">
        <textarea name="" id="input" class="form-control" rows="10" required="required" style="background: #ecf0f1; border:solid 1px rgba(189, 195, 199, 0.3); border-radius: 2px;">
        </textarea>
    </div>
    <?php
    Html::submitButton($modelEvento->isNewRecord ? 'Create' : 'Update', ['class' => $modelEvento->isNewRecord ? 'btn btn-primary criar' : 'btn btn-primary criar'])
    ?>

</div>
<div class="modal-footer rodape">

</div>
    <?php ActiveForm::end(); ?>
</div>
