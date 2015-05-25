<?php

namespace Admin\Service;

use Core\Service\Service;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

/**
 * Serviço de autenticacao de um usuario simples no sistema
 * 
 * @category Admin
 * @packcage Service
 * @Author Paulo Cella <paulocella@unochapeco.edu.br>
 */
class Auth extends Service {

    /**
     * Faz a autenticação
     * 
     * @params array $params
     * @return array
     */
    public function authentication($params) {
        if (!isset($params['email']) || !isset($params['senha'])) {
            throw new \Exception("Parâmetros inválidos");
        }

        $senha = md5($params['senha']);

        $authService = $this->getServiceManager()->get('Zend\Authentication\AuthenticationService');
        $authAdapter = $authService->getAdapter();
        $authAdapter->setIdentityValue($params['email'])->setCredentialValue($senha);
        $result = $authService->authenticate();

        if (!$result->isValid()) {
            throw new Exception("Loguin ou senha inválidos");
        }

        $session = $this->getServiceManager()->get('Session');
        $identity = $result->getIdentity();
        $session->offsetSet('user', $identity);
        $session->offsetSet('role', $identity->getRole());

        return true;
    }
    
    /**
     * Faz logout so sistema
     * 
     * @return void
     */
    public function logout()
    {
        $Auth = new AuthenticationService();
        $session = $this->getServiceManager()->get('Session');
        $session->offsetUnset('user');
        $session->offsetUnset('role');
        $Auth->clearIdentity();
        
        return true;
        
    }
    
    
    public function authorize($moduleName, $contollerName, $actionName)
    {
        $auth= new AuthenticationService();
        $role= 'VISITANTE';
        if($auth->hasIdentity()){
            
            $session = $this->getServiceManager()->get('Session');
            if(!$session->offsetGet('role')){
                $role = 'VISITANTE';
            }
            else{
               $role = $session->offseGet('role');
            }
        }
        
        $resource = $controllerName.'.'.$actionName;
        $acl = $this->getServiceManager()->get('Core\Acl\Builder')->build();
        if($acl->isAllowed($role,$resource)){
            return true;
        }
        return false;
    }
    
    

}
