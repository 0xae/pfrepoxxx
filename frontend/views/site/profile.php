<?php
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



$this->title = 'Atualizar Conta Produtor';
?>
<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

<div id="formulario" style="margin-top: 5.8%; margin-left: 25%; width: 500px; height: 500px; left:50%;">
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'country')  ?>
    


<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('Editar', ['class' => 'glyphicon glyphicon-pencil btn btn-block btn-success ']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
</div>

<?php
$scrip= <<< JS
        $(function () {

$('.Editar').click(function() {
        
        
              alert('sucess');
            
           
        
        
    
       
    });
    
JS;


$this->registerJs($scrip);



?>
