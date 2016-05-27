<?php

/**
 * This is the model class for table "{{auth}}".
 *
 * The followings are the available columns in table '{{auth}}':
 * @property string $id
 * @property string $userID
 * @property string $lastTry
 * @property integer $fails
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Auth extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{auth}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'userID'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Auth the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
