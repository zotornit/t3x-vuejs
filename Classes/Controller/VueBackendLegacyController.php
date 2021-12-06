<?php

namespace VUEJS\Vuejs\Controller;


use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;


// only to support typo3 10 for a while

class VueBackendLegacyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Backend Template Container
     *
     * @var string
     */
    protected $defaultViewObjectName = \TYPO3\CMS\Backend\View\BackendTemplateView::class;

    /**
     * Load Vue.js
     *
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view)
    {
        if (TYPO3_MODE != 'BE') {
            return;
        }

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

        if (isset($GLOBALS['TYPO3_CONF_VARS']['BE']['debug']) && $GLOBALS['TYPO3_CONF_VARS']['BE']['debug']) {
            $pageRenderer->addJsFile('EXT:vuejs/Resources/Public/JavaScript/Contrib/Vue/vue.js'); // development version with hints
        } else {
            $pageRenderer->addJsFile('EXT:vuejs/Resources/Public/JavaScript/Contrib/Vue/vue.min.js'); // silent production version
        }
    }
}
