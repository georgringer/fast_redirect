<?php

namespace GeorgRinger\FastRedirect\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dbal\Database\DatabaseConnection;

class PreProcessRequestHook
{

    public function run()
    {
        // @todo would be called every time
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}