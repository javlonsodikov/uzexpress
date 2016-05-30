<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RolesAccess */

$this->title = 'Update Roles Access: ' . $model->role_access_id;
$this->params['breadcrumbs'][] = ['label' => 'Roles Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_access_id, 'url' => ['view', 'id' => $model->role_access_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roles-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
