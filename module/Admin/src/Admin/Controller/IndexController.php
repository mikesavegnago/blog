<?php
/**
 *
 *  @author Paulo Cella <paulocella@unochapeco.edu.br>
 * 
 * 
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\Usuario as UsuarioForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
  //      $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
 //       $post = $em->getRepository('\Admin\Entity\Post')->findAll();
//       var_dump($post);exit;

        return new ViewModel(
            array(
            //'post' => $post
                )
            );
        
    }


    public function saveAction()
    {

    }


    public function paginaAction()
    {
      return new ViewModel();
  }		
}
