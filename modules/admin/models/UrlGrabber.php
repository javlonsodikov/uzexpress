<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for url.
 *
 * @property string $url
 * @property integer $category_id
 */
class UrlGrabber extends Model
{
    public $url;
    public $category_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'string', 'max' => 1254],
            ['category_id', 'integer'],
        ];
    }


}
