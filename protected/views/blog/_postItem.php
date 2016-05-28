<div class="view">
	<h4><?php echo CHtml::link(CHtml::encode($data->title), array('read', 'id'=>$data->id)); if(Yii::app()->user->id === $data->authorID): ?> (<?php echo CHtml::link('edit', array('edit', 'id'=>$data->id)); ?> | <?php echo CHtml::link('delete', array('remove', 'id'=>$data->id)); ?>)<?php endif ?></h4>
	<i>Created <?php echo Yii::app()->format->formatDatetime($data->created); ?> by <?php echo CHtml::encode($data->author->username); ?></i>
	<?php if($data->edited): ?>
		<br><i>Edited <?php echo Yii::app()->format->formatDatetime($data->edited);?></i>
	<?php endif ?>
	<p>
	<?php
		if ($data->preview)
		{
			echo "<p id='post{$data->id}'>".Yii::app()->format->formatNText($data->preview);
			echo '<br>'.CHtml::ajaxLink(
				'Show full text...',
				array('blog/ajax', 'id' => $data->id),
				array('update' => "#post{$data->id}")
			).'</p>';
		}
		else
		{
			echo '<p>'.Yii::app()->format->formatNText($data->content).'</p>';
		}
	?>
	</p>
</div>