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
        $table = 'tx_fast_redirect_entry';
        $url = ltrim($url, '/');
        $row = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            'url_to,status_code',
            $table,
            'url_from=' . $this->getDatabaseConnection()->fullQuoteStr($url, $table)
        );
        if (!empty($row)) {
            $statusCode = constant(HttpUtility::class . '::HTTP_STATUS_' . $row['status_code']);

            $redirectUrl = $this->generateValideUrl($row['url_to']);
            HttpUtility::redirect($redirectUrl, $statusCode);
        }
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