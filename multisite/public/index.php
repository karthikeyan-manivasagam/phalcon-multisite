<?php

use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Collection as collection;
use Phalcon\Mvc\Collection\Manager as CollectionManager;
use Extended\ExtendedVolt;
use Extended\ExtendedView;
use Extended\ExtendedBootstrap;
use Phalcon\Config;



define('APP_PATH', realpath('..') . '/');

try {

    $loader = new Loader();

    $loader->registerNamespaces(array(
        'Common\Controller' => '../app/common/controllers',
        'Common\Model' => '../app/common/models',
        'Common\Helper' => '../app/common/helpers',
        'Extended' => '../extended/',
    ))->register();

    $extended = new ExtendedBootstrap();

    define('SITENAME', $extended->sitename);

    $loader->registerDirs(array(
        '../app/'.SITENAME.'/controllers/',

        '../app/'.SITENAME.'/models/'
    ))->register();


    $di = new FactoryDefault();   

    $di->set(
        'voltService',
        function ($view, $di) {
            $volt = new ExtendedVolt($view, $di);
            $volt->setOptions(
                array(
                    "compiledPath"      => "../cache/volt/".SITENAME."/",
                    "compiledExtension" => ".compiled",
                    'compileAlways' => true,
                    'skinPath' => '../app/'.SITENAME.'/views/'
                )
            );
            
            return $volt;
        }
    );

    $di->set(
        'view',
        function () {
            $view = new ExtendedView();
            $view->addViewsDir(array('../app/common/views/','../app/'.SITENAME.'/views/'));
            $view->setLayout('common');
            $view->registerEngines(
                array(
                    ".volt" => 'voltService'
                )
            );
            return $view;
        }
    );
    
    /**
     * Database connection if needed 
     */

    $di->set('mongo', function () use($extended) {
        $mongo = new MongoClient();
        $sitename = $extended->sitename;
        return $mongo->selectDB($extended->config->$sitename->dbname);
    }, true);
    


    $di->set('collectionManager', function(){
        return new Phalcon\Mvc\Collection\Manager();
    }, true);


 
        $di->set('url', function () use($extended) {
            $url = new UrlProvider();
            $url->setBaseUri($extended->getBaseUri());
            return $url;
        });

    /**
     * Database connection if needed  ends
     */

    $application = new Application($di);
    $response = $application->handle();
    $response->send();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}
