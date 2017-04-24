<?php

namespace yuncms\wallet\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yuncms\wallet\models\Withdrawals;

/**
 * WithdrawalsSearch represents the model behind the search form about `yuncms\wallet\models\Withdrawals`.
 */
class WithdrawalsSearch extends Withdrawals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bankcard_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['currency'], 'safe'],
            [['money'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Withdrawals::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->orderBy(['status' => SORT_ASC, 'id' => SORT_DESC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'bankcard_id' => $this->bankcard_id,
            'money' => $this->money,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }

    /**
     * 下拉筛选
     * @param string $column
     * @param null|string $value
     * @return bool|mixed
     */
    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            "status" => [
                Withdrawals::STATUS_PENDING => Yii::t('wallet', 'Pending'),
                Withdrawals::STATUS_REJECTED => Yii::t('wallet', 'Rejected'),
                Withdrawals::STATUS_DONE => Yii::t('wallet', 'Done'),
            ],
        ];
        //根据具体值显示对应的值
        if ($value !== null) {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        } else {//返回关联数组，用户下拉的filter实现
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }
}
