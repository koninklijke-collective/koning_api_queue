<?php
namespace Keizer\KoningApiQueue\Utility;

/**
 * Utility: Configuration
 *
 * @package Keizer\KoningApiQueue\Utility
 */
class ConfigurationUtility
{
    /**
     * @return boolean
     */
    public static function isValid()
    {
        $settings = static::getConfiguration();
        return (is_array($settings) && !empty($settings['process.']) && !empty($settings['retention.']));
    }

    /**
     * @return array
     */
    public static function getConfiguration()
    {
        static $configuration;
        if ($configuration === null) {
            $data = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['koning_api_queue'];
            if (!is_array($data)) {
                $configuration = (array) unserialize($data);
            } else {
                $configuration = $data;
            }
        }
        return $configuration;
    }
}