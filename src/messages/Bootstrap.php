<?php

namespace bscheshirwork\nifty\messages;

use yii\base\BootstrapInterface;
use yii\base\Application;
use yii\i18n\PhpMessageSource;
use yii\base\InvalidConfigException;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->initTranslations($app);
    }

    /**
     * Registers translation messages.
     *
     * @param Application $app
     *
     * @throws InvalidConfigException
     */
    protected function initTranslations(Application $app)
    {
        if (!isset($app->get('i18n')->translations['nifty*'])) {
            $app->get('i18n')->translations['nifty*'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__,
                'sourceLanguage' => 'en-US',
            ];
        }
    }

}