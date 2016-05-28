<?php

class BlogController extends Controller
{
	public function filters()
	{
		return array('accessControl');
	}

	public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('write', 'edit', 'remove'),
                'users'=>array('?'),
            ),
        );
    }

	public function actionIndex()
	{
		$provider = new CActiveDataProvider('Post', array(
			'criteria'=>array(
				'order'=>'created DESC',
				'with'=>array('author')
			),
			'pagination'=>array(
				'pageSize'=>5,
			),
		));
		$this->render('index', array(
			'provider'=>$provider,
		));
	}

	public function actionWrite()
	{
		$model=new Post('write');

		if(isset($_POST['ajax']) && $_POST['ajax']==='post-write-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->authorID = Yii::app()->user->id;
			$model->created = time();
			if($model->validate())
			{
				$model->save(false);
				$this->redirect('/');
				return;
			}
		}
		$this->render('write',array('model'=>$model));
	}

	public function actionEdit($id)
	{
		$model=$this->loadModel($id);
		$model->scenario='edit';
		$this->checkOwnership($model);
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-write-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->edited=time();
			if($model->validate())
			{
				$model->save(false);
				$this->redirect('/');
				return;
			}
		}
		$this->render('write',array('model'=>$model));
	}

	public function actionRead($id)
	{
		$model=$this->loadModel($id);
		$this->render('read',array('model'=>$model));
	}

	public function actionAjax($id)
	{
		$model=Post::model()->findByPk($id, array('select'=>'content'));
		if ($model!==null)
			echo Yii::app()->format->formatNText($model->content);
		else
			echo 'Post content not found';
		Yii::app()->end();
	}

	public function actionRemove($id)
	{
		$model = $this->loadModel($id);
		$this->checkOwnership($model);
		$model->delete();
		$this->redirect('/');
	}

	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function checkOwnership($model)
	{
		if (Yii::app()->user->id !== $model->authorID)
			throw new CHttpException(403,'This post doesn\'t belongs to you.');
	}
}