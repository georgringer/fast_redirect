<?php

namespace GeorgRinger\FastRedirect\Domain\Model\Dto;

class ExtensionConfiguration
{

    /** @var string */
    protected $fallbackHandling;

    public function __construct()
    {
        $settings = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['fast_redirect']);
        foreach ($settings as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getFallbackHandling()
    {
        return $this->fallbackHandling;
    }


}
