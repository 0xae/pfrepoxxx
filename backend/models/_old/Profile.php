<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $public_email
 * @property string $sexo
 * @property string $telefone
 * @property string $location
 * @property string $website
 * @property string $bio
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['name', 'public_email', 'location', 'website'], 'string', 'max' => 255],
            [['sexo', 'telefone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'public_email' => 'Public Email',
            'sexo' => 'Sexo',
            'telefone' => 'Telefone',
            'location' => 'Location',
            'website' => 'Website',
            'bio' => 'Bio',
        ];
    }
}
