<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_details".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $f_name
 * @property string $l_name
 * @property integer $p_phone
 * @property integer $s_phone
 * @property integer $t_phone
 * @property string $s_question
 * @property string $s_answer
 * @property string $p_email
 * @property string $s_email
 * @property integer $role
 * @property string $created
 * @property string $updated
 * @property string $deleted
 *
 * @property User $id0
 */
class UserDetails extends ActiveRecord
{
    const ROLE_USER  = 10;
    const ROLE_ADMIN = 20;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_details';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'f_name', 'p_phone', 's_question', 's_answer', 'p_email'], 'required'],
            [['p_phone', 's_phone', 't_phone', 'role'], 'integer'],
            [['created', 'updated', 'deleted'], 'safe'],
            [['f_name', 'l_name'], 'string', 'max' => 16],
            [['s_question', 's_answer'], 'string', 'max' => 128],
            [['p_email', 's_email'], 'string', 'max' => 64],
            ['role', 'default', 'value' => 10],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'created'    => 'Created',
            'deleted'    => 'Deleted',
            'f_name'     => 'First Name',
            'id'         => 'ID',
            'l_name'     => 'Last Name',
            'p_email'    => 'Primary Email',
            'p_phone'    => 'Primary Phone',
            'role'       => 'Role',
            's_answer'   => 'Security Answer',
            's_email'    => 'Secondary Email',
            's_phone'    => 'Secondary Phone',
            's_question' => 'Security Question',
            't_phone'    => 'Tertiary Phone',
            'updated'    => 'Updated',
            'user_id'    => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAccount()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

    /**
     * [isUserAdmin description]
     * @param  [type]  $username [description]
     * @return boolean           [description]
     */
    public static function isUserAdmin($username)
    {
        if (static::findOne(['role' => self::ROLE_ADMIN])){
     
            return true;
        }
     
        return false;
    }
}
