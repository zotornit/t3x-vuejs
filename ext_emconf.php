<?php

$EM_CONF['vuejs'] = array(
    'title' => 'Vue.js Framework for TYPO3 Backend Modules',
    'description' => 'Vue.js Framework for TYPO3 Backend Modules',
    'category' => 'be',
	'author' => 'Thomas Pronold',
    'author_email' => 'tp@zotorn.de',
	'author_company' => 'Zotorn IT | zotorn.de',
    'state' => 'stable',
    'uploadfolder' => false,
    'clearCacheOnLoad' => false,
    'version' => '1.0.9',
    'constraints' =>
        array(
            'depends' =>
                array(
                    'typo3' => '9.5.0-10.4.99',
                ),
            'conflicts' =>
                array(),
            'suggests' =>
                array(),
        ),

    'autoload' => [
        'psr-4' => [
            'VUEJS\\Vuejs\\' => 'Classes'
        ]
    ]
);

