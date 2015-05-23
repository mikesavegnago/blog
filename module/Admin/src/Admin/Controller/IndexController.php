<?php
/**
**
 *  @author Paulo Cella <paulocella@unochapeco.edu.br>
 * 
 * 
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        //$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        //$post = $em->getRepository('\Main\Entity\Post')->findAll();
        
    return new ViewModel(
                array(
            'post' => $post
                )
        );
        
    }
	
    public function paginaAction()
	{
		return new ViewModel();
	}		
}
