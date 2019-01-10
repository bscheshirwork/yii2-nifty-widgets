<?php

namespace bscheshirwork\nifty;

use yii\base\InvalidConfigException;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use Yii;
use yii\helpers\Json;

/**
 *  Flash messages with nifty style and support multiple flash
 *
 * @example
 * add
 *
 *   In layout
 *    <?=\bscheshirwork\nifty\FlashAlerts::widget(['clientOptions' => ['closeBtn' => false, 'timer' => 5000]]);?>
 *
 *   In controllers
 *    Yii::$app->session->setFlash('warning','Message1',true);
 *    Yii::$app->session->setFlash('warning-order','Message2');
 *    Yii::$app->session->setFlash('info1','Message3',true);
 *    Yii::$app->session->setFlash('info2','Message4',true);
 */
class FlashAlerts extends Widget
{
    /**
     * @var bool $delete whether to delete the flash messages right after this method is called.
     * If false, the flash messages will be automatically deleted in the next request.
     */
    public $delete = true;

    /**
     * @var array
     * Options of $.niftyNoty()
     * We must pass options as php array ['key' => 'value'] to convert it into js object "{key:value}"
     * note: some values (message, html) will be redefine on live
     * We can't pass string value with pure json "{key:value}" format for this reason.
     *
     * @see nifty-v2.9.1/documentation/js/docs.js:80
     * @see nifty-v2.9.1/documentation/index.html#docs-noty
     * Options
     * Name         Type    Default        Description
     * --------------------------------
     * type         string    primary     The type of notification. Example: primary info success warning danger mint purple pink dark
     * icon         string    null        Icon class names
     * title        string    null        The title of notification
     * message      string    null        The message of notification
     * closeBtn     boolean   true        Show or hide the close button.
     * container    string    page        This option is particularly useful in that it allows you to position the notification.
     *                                    Example : page floating "specified target name"
     * floating: {
     *   position
     * }            string    top-right   Floating position.
     *                                    top-right, top-center, top-left, center-right, center-center, center-left, bottom-right, bottom-center, bottom-left
     * floating: {
     *   animationIn
     * }            string    jellyIn     Apply a CSS animation to the notification
     * floating: {
     *   animationOut
     * }            string    fadeOut     Apply a CSS animation to the notification
     * html         string    null        Insert HTML into the notification. If false, jQuery's text method will be used to insert content into the DOM.
     * focus        boolean   true        Scroll to the notification.
     * timer        Number    0           To enable the "auto close" notofication, please specify the time to show the notification before it closed.
     *                                    Value is in milliseconds. (0 to disable the autoclose.)
     *
     * Also can accept a actions. Use JsExpression for pass callback function
     * @see nifty-v2.9.1/documentation/js/docs.js:135
     */
    public $clientOptions = [];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if (!is_array($this->clientOptions)) {
            throw new InvalidConfigException('clientOptions must be a php array!');
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        $allFlashes = Yii::$app->session->getAllFlashes($this->delete);
        foreach ($allFlashes as $category => $message) {
            $options = ArrayHelper::merge($this->clientOptions, [
                'type' => $category,
                'message' => $message,
            ]);
            $options = Json::htmlEncode($options);
            $view = $this->getView();
            $view->registerJs("$.niftyNoty($options);", $view::POS_READY);
        }

        return '';
    }

}
