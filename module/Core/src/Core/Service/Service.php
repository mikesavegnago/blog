<?php

namespace Core\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Core\Db\TableGateway;

abstract class Service implements ServiceManagerAwareInterface {

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Retrieve EntityManager
     * 
     * @return Doctrine\ORM\EntityManager
     */
    public function getObjectManager() {
        $objectManager = $this->getService('Doctrine\ORM\EntityManager');
        return $objectManager;
    }

    /**
     * Retrieve Service
     * 
     * @return Service
     */
    protected function getService($service) {
        return $this->getServiceManager()->get($service);
    }
    
    /**
     * 
     * @param type $data
     * @param type $indexValue
     * @param type $indexDescription
     * @return array Array contendo $indexDescription
     */
    public function comboFormat($data, $indexValue, $indexDescription){      
        $combo = array();      
        foreach ($data as $d) {
            $combo[$d[$indexValue]] = $d[$indexDescription];
        }
        return $combo;
    }

      /**
    * 
    * @return string
    */
    
    protected function getRole(){
        $role = $this->getService('Session')->offsetGet('role');
        return $role;
    }

}
