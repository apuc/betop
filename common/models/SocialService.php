<?php

namespace common\models;

use common\models\Social;
use phpDocumentor\Reflection\Types\Integer;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property int $id_soc
 * @property int $type_id
 * @property string $title
 * @property string $title_short
 * @property string $desc
 * @property int $price
 * @property boolean $status
 * @property string $inputs
 * @property \common\models\Social $social
 */
class SocialService extends \yii\db\ActiveRecord
{
    private $_social;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_soc', 'type_id', 'price'], 'integer'],
            [['title', 'title_short', 'desc', 'system_title'], 'safe'],
            [['title', 'title_short', 'desc', 'system_title'], 'string', 'max' => 50],
            [['status'], 'boolean']
        ];
    }

    public function getSocial()
    {
        if (isset($this->_social)) {
            return $this->_social;
        } else {
            $this->_social = Social::findOne(['id' => $this->id_soc]);
            return $this->_social;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'soc_code' => Yii::t('social', 'SOC'),
            'title' => Yii::t('social', 'Title'),
            'title_short' => Yii::t('social', 'Title Short'),
            'desc' => Yii::t('social', 'Description'),
            'price' => Yii::t('social', 'Price'),
            'system_title' => Yii::t('social', 'System_title'),
        ];
    }

    /**
     * @param int $typeId
     * @return string|null
     */
    public static function getPriceByType($typeId)
    {
        $service = self::findOne(['type_id' => (int)$typeId]);
        if ($service) {
            $coeff = Settings::findOne(['key' => 'add_coeff'])->value;
            $price = strval(round(($service->price * floatval($coeff)) / (1000000 * 1000), 4));

            return $price;
        }

        return null;
    }
}
