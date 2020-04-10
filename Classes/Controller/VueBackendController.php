<?php

namespace VUEJS\Vuejs\Controller;


use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class VueBackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
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
        if (!($this->view instanceof BackendTemplateView)) {
            return;
        }

        /** @var BackendTemplateView $view */
        parent::initializeView($view);

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

        if (isset($GLOBALS['TYPO3_CONF_VARS']['BE']['debug']) && $GLOBALS['TYPO3_CONF_VARS']['BE']['debug']) {
            $pageRenderer->addJsFile('EXT:vuejs/Resources/Public/JavaScript/Contrib/Vue/vue.js'); // development version with hints
        } else {
            $pageRenderer->addJsFile('EXT:vuejs/Resources/Public/JavaScript/Contrib/Vue/vue.min.js'); // silent production version
        }
    }
}
