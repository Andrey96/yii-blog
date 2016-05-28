<?php
/* @var $this BlogController */

$this->breadcrumbs=array(
	'Blog'=>array('/blog'),
	'Read',
);
?>
<h1><?php echo CHtml::encode($model->title); if(Yii::app()->user->id === $model->authorID): ?> (<?php echo CHtml::link('edit', array('edit', 'id'=>$model->id)); ?> | <?php echo CHtml::link('delete', array('remove', 'id'=>$model->id)); ?>)<?php endif ?></h1>
<i>Created <?php echo Yii::app()->format->formatDatetime($model->created); ?> by <?php echo CHtml::encode($model->author->username); ?></i>
<?php if($model->edited): ?>
	<br><i>Edited <?php echo Yii::app()->format->formatDatetime($model->edited);?></i>
<?php endif ?>
<p><?php echo '<p>'.Yii::app()->format->formatNText($model->content).'</p>'; ?></p>
