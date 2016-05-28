<?php
/* @var $this BlogController */

$this->breadcrumbs=array(
	'Blog',
);

?>
<h1>Recent posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$provider,
	'itemView'=>'_postItem'
)); ?>