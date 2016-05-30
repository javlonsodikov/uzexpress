<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "roles_access".
 *
 * @property integer $role_access_id
 * @property integer $role_id
 * @property string $controller
 * @property integer $action
 * @property integer $allow
 *
 * @property Roles $role
 */
class RolesAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'controller', 'action', 'allow'], 'required'],
            [['role_id', 'allow'], 'integer'],
            [['controller'], 'string', 'max' => 64],
            [['action'], 'string', 'max' => 32],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_id' => 'role_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_access_id' => 'Role Access ID',
            'role_id'        => 'Role ID',
            'controller'     => 'Controller',
            'action'         => 'Action',
            'allow'          => 'Allow',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'role_id']);
    }
}
