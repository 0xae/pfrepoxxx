<?php
namespace backend\models;
use Yii;


/**
 * This is the model class for table "faqs".
 *
 * @property integer $id
 * @property string $pergunta
 * @property string $resposta
 * @property integer $estado
 */
class Faq extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'faqs';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pergunta', 'resposta', 'estado'], 'required'],
            [['pergunta', 'resposta'], 'string'],
            [['estado'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'pergunta' => 'Pergunta',
            'resposta' => 'Resposta',
            'estado' => 'Estado',
        ];
    }
}
