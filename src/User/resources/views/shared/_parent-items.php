<?php
/**
 * @var \yii\rbac\Item[] $parentItems
 */

use yii\helpers\Html;
use yii\rbac\Role;

if (!empty($parentItems)):
?>
    <h4><?php echo Yii::t('usuario', 'Parent items') ?></h4>
<?php
foreach ($parentItems as $parentItem) {
    echo Html::a($parentItem->name, [($parentItem instanceof Role ? 'role' : 'permission') . '/update', 'name' => $parentItem->name], ['class' => 'badge']);
}
endif;
