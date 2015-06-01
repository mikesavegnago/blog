<?php

namespace Admin\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Controlador que para efetuar login
 *
 * @category Admin
 * @package Controller
 * @author Paulo Cella <paulocella@unochapeco.edu.br>
 */
class LoginController extends AbstractActionController 
{ 
     /**
     *
     * @return void
     */
    public function loginAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');      
        $request = $this->getRequest();
	$session = $this->getServiceLocator()->get('Session');

        if ($request->isPost()) {
            $values = $request->getPost();

	    try {
		$this->getServiceLocator()->get('Admin\Service\Auth')->authenticate($values);
                
                if($session->offsetGet('role') == 'ADMIN'){
                     return $this->redirect()->toUrl('/admin/index/opcoes');
                }else{
                     return $this->redirect()->toUrl('/admin/posts');
                }    
            } catch (Exception $e) {
                $this->flashMessenger()->addErrorMessage($e->getMessage());
            }
            
            return $this->redirect()->toUrl('/admin');
        }
        
         return new ViewModel();
    }
    
    public function logoutAction(){
        $this->getServiceLocator()->get('Admin\Service\Auth')->logout();
        
        return $this->redirect()->toUrl('/admin');
    }
        
}
