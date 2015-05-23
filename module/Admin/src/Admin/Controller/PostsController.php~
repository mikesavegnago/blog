<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use \Admin\Form\Post as PostForm;
use \Admin\Entity\Post as Post;

/**
 * Controlador que gerencia os posts
 *
 * @category Admin
 * @package Controller
 * @author  Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 */
class PostsController extends AbstractActionController
{

    /**
     * Exibe os posts
     * @return void
     */
    public function indexAction()
    {
		$em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $posts = $em->getRepository('\Admin\Entity\Posts')->findAll();
        var_dump("vardumpi nos post estou aqui em postsController"+$posts);exit;
        return new ViewModel(
            array(
                'posts' => $posts
            )
        );
    }

    /**
     * Cria ou edita um post
     * @return void
     */
    public function saveAction()
    {
                return new ViewModel(
                    );
    }

     

    /**
     * Exclui um post
     * @return void
     */
    public function deleteAction()
    {
       
    }

}
