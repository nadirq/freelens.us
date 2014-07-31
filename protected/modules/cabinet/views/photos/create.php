<?php
/**
 * Created by PhpStorm.
 * User: admin2
 * Date: 7/31/14
 * Time: 3:49 PM
 */

echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
    …
<?php echo CHtml::activeFileField($model,'photo'); ?>
    …
<br />
<?php echo CHtml::submitButton();?>
<?php echo CHtml::endForm(); ?>