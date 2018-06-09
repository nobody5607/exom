<?php
 
namespace common\modules\user\models;
use dektrium\user\models\UserSearch as BaseUserSearch;
use yii\data\ActiveDataProvider;
class UserSearch extends BaseUserSearch{
    public $q;
    public function rules()
    {
        parent::rules();
        return [            
            [['q'], 'safe'],
        ];
    }
    public function search($params)
    {
        $query = $this->finder->getUserQuery();
        $query->joinWith(['profile']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);

        $dataProvider->sort->attributes['firstname'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['profile.firstname' => SORT_ASC],
            'desc' => ['profile.firstname' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['lastname'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['profile.lastname' => SORT_ASC],
            'desc' => ['profile.lastname' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['sitecode'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['profile.sitecode' => SORT_ASC],
            'desc' => ['profile.sitecode' => SORT_DESC],
        ];
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $table_name = $query->modelClass::tableName();

        if ($this->created_at !== null) {
            $date = strtotime($this->created_at);
            $query->andFilterWhere(['between', $table_name . '.created_at', $date, $date + 3600 * 24]);
        }

        $query->orFilterWhere(['like', $table_name . '.username', $this->q])
              ->orFilterWhere(['like', $table_name . '.email', $this->q])
              ->orFilterWhere([$table_name . '.id' => $this->id])
              ->orFilterWhere(['like', 'profile.firstname', $this->q])
              ->orFilterWhere(['like', 'profile.lastname', $this->q])
              ->orFilterWhere(['like', 'profile.sitecode', $this->q])
              ->orFilterWhere([$table_name . 'registration_ip' => $this->registration_ip]);

        return $dataProvider;
    }
}
