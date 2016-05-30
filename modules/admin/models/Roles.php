<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $role_id
 * @property string $name
 *
 * @property RolesAccess[] $rolesAccesses
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesAccesses()
    {
        return $this->hasMany(RolesAccess::className(), ['role_id' => 'role_id']);
    }
}
