<?php

namespace VUEJS\Vuejs\Controller;


use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class VueBackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    protected ModuleTemplateFactory $moduleTemplateFactory;
    protected ModuleTemplate $moduleTemplate;

    public function __construct(ModuleTemplateFactory $moduleTemplateFactory, ModuleTemplate $moduleTemplate = null)
    {
        $this->moduleTemplateFactory = $moduleTemplateFactory;
        $this->moduleTemplate = $moduleTemplate ?? GeneralUtility::makeInstance(ModuleTemplate::class);
    }

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
