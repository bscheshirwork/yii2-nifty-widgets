<?php

namespace bscheshirwork\nifty\generators\crud;

use ReflectionClass;

class Generator extends \yii\gii\generators\crud\Generator
{
    /**
     * {@inheritdoc}
     * @return string
     * @throws \ReflectionException
     */
    public function formView()
    {
        $class = new ReflectionClass(parent::class);

        return dirname($class->getFileName()) . '/form.php';
    }

}