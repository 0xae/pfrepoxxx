<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
?>

<div class="row">
    <div class="col-md-6">
            <?php
                echo '<label class="control-label">Select the user </label>';
                echo Select2::widget([
                    'model' => $model,
                    'attribute' => 'responsable',
                    'data' => $_dataUsers,
                    'pluginOptions' => ['allowClear' => false],
                ]);
                echo '<br/>';
            ?>

            <?php
                echo '<label class="control-label">Permissions</label>';
                echo Select2::widget([
                    'name' => 'permissions',
                    'value' => $userPermissions,
                    'attribute' => 'permissions',
                    'data' => $_dataPermissions,
                    'options' => ['multiple' => false]
                ]);
            ?>
    </div>
</div>
