============
Installation
============
1. Using Composer (recommended)
-------------------------------

To install GoogleTranslateBundle with Composer just add the following to your
`composer.json` file:

.. code-block :: js

    // composer.json
    {
        require: {
            "karser/google-translate-bundle": "dev-master"
        }
    }
    

Then, you can install the new dependencies by running Composer's ``update``
command from the directory where your ``composer.json`` file is located:

.. code-block :: bash

    $ php composer.phar update
    
Now, Composer will automatically download all required files, and install them
for you. All that is left to do is to update your ``AppKernel.php`` file, and
register the new bundle:

.. code-block :: php

    <?php

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new Karser\GoogleTranslateBundle\GoogleTranslateBundle(),
        // ...
    );


Configuration
-------------

.. code-block :: yml

    karser_google_translate:
        api_key: %google_translate_api_key%

The bundle caches translation to database, so you need to update your database:

.. code-block :: bash

    $ php app/console doctrine:schema:update --force

=====
Usage
=====

.. code-block :: php

    <?php

    $gm = $this->get('karser.google_translate.manager');
    $translated = $gm->translate($name, 'en', 'zh-CN');


