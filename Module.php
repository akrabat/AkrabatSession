<?php

namespace AkrabatSession;

use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
class Module
{
    public function onBootstrap(\Zend\EventManager\EventInterface $e)
    {
        $sm = $e->getApplication()->getServiceManager();

        $config = $sm->get('session_config');
        try {
            $storage = $sm->get('session_storage');
        } catch (ServiceNotFoundException $e) {
            $storage = null;
        }
        try {
            $saveHandler = $sm->get('session_save_handler');
        } catch (ServiceNotFoundException $e) {
            $saveHandler = null;
        }
        
        $sessionManager = new SessionManager($config, $storage, $saveHandler);
        Container::setDefaultManager($sessionManager);

        $sessionManager->start();
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'sessionconfig' => function ($sm) {
                    $config = $sm->get('Config');

                    $sessionConfig = new SessionConfig();
                    if (isset($config['session'])) {
                        $sessionConfig->setOptions($config['session']);
                    }

                    return $sessionConfig;
                },
            ),
        );
    }

    public function getConfig()
    {
        return array(
            'session' => array(
                'use_cookies' => true,
                'use_only_cookies' => true,
                'cookie_httponly' => true,
                'name' => 'ZF2_SESSION',
                ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    ),
                ),
            );
    }

}
