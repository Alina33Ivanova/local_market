<?php

namespace app\modules\seller;

/**
 * seller module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\seller\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->shop_image->saveAs('uploads/' . $this->shop_image->baseName . '.' . $this->shop_image->extension);
            return true;
        } else {
            return false;
        }
    }
}
