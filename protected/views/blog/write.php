<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
	'Blog'=>array('/blog'),
	$model->scenario=='write'?'Write':'Edit',
);
?>
<h1><?php echo $model->scenario=='write'?'Writing post':'Editing post'; ?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-write-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('value'=>$model->title));//При выполнении сценария edit поля будут заполнены из модели ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preview'); ?>
		<?php echo $form->textArea($model,'preview',array('value'=>$model->preview)); ?>
		<?php echo $form->error($model,'preview'); ?>
		<p class="hint">
			If preview is not empty, it will be shown in post list instead of full content.<br>
			Also there will be 'Show full text...' link.
		</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('value'=>$model->content)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->