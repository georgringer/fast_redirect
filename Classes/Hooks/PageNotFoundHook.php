<?php

namespace GeorgRinger\FastRedirect\Hooks;

use GeorgRinger\FastRedirect\Domain\Model\Dto\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class PageNotFoundHook
{

    /** @var ExtensionConfiguration */
    protected $extensionConfiguration;

    public function __construct()
    {
        $this->extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
    }

    public function pageNotFound(array $params)
    {
        $this->handleRedirect($params['currentUrl']);
        $fallbackHandling = $this->extensionConfiguration->getFallbackHandling();
        $this->getTsfe()->pageErrorHandler($fallbackHandling);
    }

    /**
     * @param string $url
     */
    protected function handleRedirect($url)
    {

        $url = ltrim($url, '/');
        $result = $this->matchUrl($url);

        if (!empty($result)) {
            HttpUtility::redirect($result['redirectUrl'], $result['statusCode']);
        }
    }

    /**
     * @param $url
     * @return array - redirectUrl, statusCode
     */
    protected function matchUrl($url) {

        $table = 'tx_fast_redirect_entry';
        $retarr = array();
        $row = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
          'url_to,status_code',
          $table,
          'url_from=' . $this->getDatabaseConnection()->fullQuoteStr($url, $table) . ' OR url_from= ' .$this->getDatabaseConnection()->fullQuoteStr(rtrim($url, '/'), $table)
        );

      echo $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery;
        if (!empty($row)) {
            $retarr['statusCode'] = constant(HttpUtility::class . '::HTTP_STATUS_' . $row['status_code']);
            $retarr['redirectUrl'] = $this->generateValideUrl($row['url_to']);
        }
        return $retarr;
    }
 
    /**
     * If domain is not included, prepend current one
     *
     * @param string $url
     * @return string
     */
    protected function generateValideUrl($url)
    {
        if (StringUtility::beginsWith($url, 'http://') || StringUtility::beginsWith($url, 'https://')) {
            return $url;
        } else {
            return GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . ltrim($url, '/');
        }
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTsfe()
    {
        return $GLOBALS['TSFE'];
    }


    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}