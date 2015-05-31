<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Core\Controller\ActionController as ActionController;

/**
 * Controlador que para efetuar login
 *
 * @category Admin
 * @package Controller
 * @author Paulo Cella <paulocella@unochapeco.edu.br>
 */
class LoginController extends ActionController {

    

     /**
     *
     * @return void
     */
    public function loginAction(){
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $request = $this->getRequest();
        $session = $this->getServiceLocator()->get('Session');
       
        if ($request->isPost()){
            $values = $request->getPost();
            var_dump($values);
            
            try{               
                
                $auth = $this->getServiceLocator()->get('\Admin\Service\Auth')->authenticate($values);
                //var_dump($session->offsetGet('role'));exit;
                if($session->offsetGet('role') == 'ADMIN'){
                     return $this->redirect()->toUrl('/admin/usuarios');
                }else{
                     return $this->redirect()->toUrl('/admin/posts');
                }    
            } catch (Exception $e) {
                $this->flashMessenger()->addErrorMessage($e->getMessage());
            }
            
            return $this->redirect()->toUrl('/login/');
        }
        
         return new ViewModel();
    }
    
    public function logoutAction(){
        $this->getServiceLocator()->get('Admin\Service\Auth')->logout();
        
        return $this->redirect()->toUrl('/');
    }
        
}
