<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $started_at
 * @property string|null $finished_at
 *
 * @property Task $task
 * @property User $user
 */
class Session extends \yii\db\ActiveRecord
{
    const SCENARIO_START_SESSION = 'start';
    const SCENARIO_STOP_SESSION = 'stop';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        return [
            self::SCENARIO_START_SESSION => ['task_id', 'user_id', 'started_at',],
            self::SCENARIO_STOP_SESSION => ['id', 'finished_at',],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'started_at'], 'required', 'on' => self::SCENARIO_START_SESSION],
            [['id', 'finished_at', 'required', 'on' => self::SCENARIO_STOP_SESSION]],
            [['task_id', 'user_id'], 'integer'],
            [['started_at', 'finished_at'], 'datetime'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
