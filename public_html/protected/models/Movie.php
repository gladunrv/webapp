<?php

class Movie extends CActiveRecord
{

	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'movie';
    }

    public function rules()
    {
        return array(
            array('id, runtime', 'numerical', 'integerOnly'=>true),
            array('release_date', 'date', 'format'=>'yyyy-M-d'),
            array('title, original_title, overview, genres, poster_path', 'required'),
            array('id, title, original_title, release_date, runtime, overview, genres, poster_path', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'original_title' => 'Original title',
            'release_date' => 'Release date',
            'overview' => 'Overview',
            'runtime' => 'Runtime',
            'genres' => 'Genres',
            'poster_path' => 'Poster path'
        );
    }

    public function search()
    {

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('original_title',$this->original_title,true);
        $criteria->compare('release_date',$this->release_date,true);
        $criteria->compare('runtime',$this->runtime);
        $criteria->compare('overview',$this->overview,true);
        $criteria->compare('genres',$this->genres,true);
        $criteria->compare('poster_path',$this->poster_path,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}