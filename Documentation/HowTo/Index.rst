.. include:: ../Includes.txt


.. _how-to:

===========
How To
===========

.. tip::

   View the `source code <https://github.com/zotornit/t3x-webfonts>`__ of `webfonts <https://extensions.typo3.org/extension/webfonts>`__ extension which makes use of Vue.js


.. tip::

    When backend debugging :php:`$GLOBALS['TYPO3_CONF_VARS']['BE']['debug']` is enabled Vue.js will log debug information to JavaScript console.




Controller
--------------

Your controller must extend :file:`\\VUEJS\\Vuejs\\Controller\\VueBackendController`

.. code-block:: php

   class YourController extends \VUEJS\Vuejs\Controller\VueBackendController
   {

   }


Use Vue.js as RequireJS module
-----------------------

.. important::
   Learn how to use `RequireJS <https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/JavaScript/RequireJS/Index.html>`__ modules in TYPO3 backend first.

Setup a HTML element where the Vue app should get attached to within your Templates.

.. code-block:: php

    <f:be.pageRenderer
        includeRequireJsModules="{
            1000: 'TYPO3/CMS/Yourext/MyAppComponent'
        }"
    />

    <div id="my-vue-app">
        ...
    </div

Create a RequireJS module :file:`/yourext/Resources/Public/JavaScript/MyApp.js`

.. code-block:: javascript

    define([
        'vue',
    ], function () {
        'use strict';

        var app = new Vue({
            el: '#my-vue-app',
            data: {
                ...
            },
            computed: {
                ...
            },
            methods: {
                ...
            },
        });
        return app;
    });


================
Components
================

Extend your Template file like this


.. code-block:: php

   <f:be.pageRenderer
        includeRequireJsModules="{
            10: 'TYPO3/CMS/Yourext/MyComponent',
            1000: 'TYPO3/CMS/Yourext/MyApp'
        }"
    />

   <script type="text/x-template" id="my-vue-component">
      <div>
         ...
      </div>
   </script>

   <div id="my-vue-app">
        ...
   </div


Create a requireJS module for each component :file:`/yourext/Resources/Public/JavaScript/MyComponent.js`


.. code-block:: javascript

   define([
       'TYPO3/CMS/Yourext/MyApp'
       'vue',
   ], function (myApp) {
       'use strict';

       return Vue.component('my-vue-component',
           {
               template: '#my-vue-component',
               data: function () {
                   return {}
               },
               props: [],
               methods: {
                   doSomething: function() {
                       console.log(myApp); // use myApp reference in component
                   }
               },
           }
       );
   });


