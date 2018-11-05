<?php
/**
 * Liquid Letters plugin for Craft CMS 3.x
 *
 * Liquid Letters counts words and gives reading times.
 *
 * @link      https://www.theindigoviking.com
 * @copyright Copyright (c) 2018 The Indigo Viking
 */

namespace indigoviking\liquidletters;

use indigoviking\liquidletters\twigextensions\LiquidLettersTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class LiquidLetters
 *
 * @author    The Indigo Viking
 * @package   LiquidLetters
 * @since     1.0.0
 *
 */
class LiquidLetters extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var LiquidLetters
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new LiquidLettersTwigExtension());

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'liquid-letters',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
