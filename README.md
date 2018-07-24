# Widgets for nifty theme

 * Menu-widget
 * Flash-Alerts

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

add

```
"bscheshirwork/yii2-nifty-widgets": "@dev"
```

to the require section of your `composer.json` file.



## Usage
* Menu
```php
<?= \bscheshirwork\nifty\Menu::widget([
    'iconClassPrefix' => 'pli-',
    'collapseTemplate' => '<a href="{url}">{icon} <span class="menu-title">{label}</span> <i class="arrow"></i></a>',
    'defaultIconHtml' => '',
    'linkTemplate' => '<a href="{url}">{icon} <span class="menu-title">{label}</span></a>',
    'activateParents' => false,
    'activeCssClass' => 'active-link',
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
    'options' => [
        'id' => 'mainnav-menu',
        'class' => 'list-group',
    ]
]); ?>
```

* FlashAlert

Add in layout

```php
<?= \bscheshirwork\nifty\FlashAlerts::widget([
    'errorIcon' => '<i class="fa fa-warning"></i>',
    'successIcon' => '<i class="fa fa-check"></i>',
    'successTitle' => 'Done!',
    'closable' => true,
    'encode'=> false,
    'bold'=> false,
]); ?>
```

And set flash messages anywhere

```php
Yii::$app->session->setFlash('info1','Message1');
Yii::$app->session->setFlash('info2','Message2');
Yii::$app->session->setFlash('info3','Message3');
Yii::$app->session->setFlash('success-first','Message');
Yii::$app->session->setFlash('success-second','Message');
```
