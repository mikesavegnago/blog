<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Main\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;

class IndexController extends ActionController
{
    public function indexAction()
    {			
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $search = $request->getPost('search');
            $search = mb_strtoupper($search, 'UTF-8');
        }
        $posts = $this->getService('Admin\Service\Index')->fetchAll($search);
        $adapter = new DoctrineAdapter(new ORMPaginator($posts));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(2);
        $page = (int) $this->params()->fromRoute('page', 0);

        if($page)
            $paginator->setCurrentPageNumber($page);

        return new ViewModel(array(
            'posts' => $paginator , 'em' => $em
            )
        );
    }

    /**
    * Visualiza um post
    * @return void
    */
    public function paginaAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $posts = $this->getService('Admin\Service\Index')->fetchById($id);
        $comentarios = $this->getService('Admin\Service\Comentario')->fetchAllComentariosPost($id);
        $adapter = new DoctrineAdapter(new ORMPaginator($posts));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(2);
        $page = (int) $this->params()->fromRoute('page', 0);
        
        if($page)
            $paginator->setCurrentPageNumber($page);
        
        
        return new ViewModel(array(
            'posts' => $paginator , 'comentarios' => $comentarios
            )
        );
    }	
}
