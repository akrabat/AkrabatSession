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

        $storage = null;
        if ($sm->canCreate('session_storage', false)) {
            $storage = $sm->get('session_storage');
        }

        $saveHandler = null;
        if ($sm->canCreate('session_save_handler', false)) {
            $saveHandler = $sm->get('session_save_handler');
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

}
