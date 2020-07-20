<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * To Do List
 *
 * @property int $id
 * @property string $caption
 * @property string $description
 * @property datetime $complete_date
 * @property string $priority
 * @property boolean $is_complete
 */

class ToDo extends ActiveRecord
{
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';

    public static $priorityValues = [
        self::PRIORITY_LOW => 'Низкий',
        self::PRIORITY_MEDIUM => 'Средний',
        self::PRIORITY_HIGH => 'Высокий',
    ];

    public static function tableName()
    {
        return 'to_do_list';
    }

    public function rules()
    {
        return [
            [['caption', 'priority'], 'required'],
            [['description', 'complete_date'], 'safe'],
            ['priority', 'in', 'range' => [self::PRIORITY_LOW, self::PRIORITY_MEDIUM, self::PRIORITY_HIGH]],
            ['is_complete', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caption' => 'Заголовок',
            'description' => 'Описание',
            'complete_date' => 'Дата выполнения',
            'priority' => 'Приоритет',
            'is_complete' => 'Задача выполнена',
        ];
    }

    public function search()
    {
        $query = ToDo::find();

        if ($this->caption)
        {
            $query->andWhere(['LIKE', 'caption', '%'.$this->caption.'%']);
        }
        if ($this->description)
        {
            $query->andWhere(['LIKE', 'caption', '%'.$this->description.'%']);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 25
            ]
        ]);
    }
}