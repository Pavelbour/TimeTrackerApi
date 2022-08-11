<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $project_id
 * @property string $task_name
 * @property string|null $description
 * @property int $created_by
 * @property int|null $charged_to
 * @property string|null $started_at
 * @property string|null $finished_at
 * @property string|null $estimated_finished_at
 *
 * @property User $chargedTo
 * @property User $createdBy
 * @property Project $project
 * @property Session[] $sessions
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'task_name', 'created_by'], 'required'],
            [['project_id', 'created_by', 'charged_to'], 'integer'],
            [['description'], 'string'],
            [['started_at', 'finished_at', 'estimated_finished_at'], 'datetime'],
            [['task_name'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['charged_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['charged_to' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'task_name' => 'Task Name',
            'description' => 'Description',
            'created_by' => 'Created By',
            'charged_to' => 'Charged To',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'estimated_finished_at' => 'Estimated Finished At',
        ];
    }

    /**
     * Gets query for [[ChargedTo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChargedTo()
    {
        return $this->hasOne(User::class, ['id' => 'charged_to']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::class, ['task_id' => 'id']);
    }
}
