<?php
namespace Admin\Service;

use Core\Service\Service;
use Zend\Db\Sql\Select;
use Core\Model\EntityException as EntityException;

/**
 * Serviço responsável por fazer tratamento especial aos posts
 * 
 * @category Admin
 * @package Service
 */
class Index extends Service
{
    /**
    *Função Select All
    *
    *@return array
    */
    public function fetchAll($search = null)
    {
        $select = $this->getObjectManager()->createQueryBuilder()->select('Post')
            ->from('Admin\Entity\Post', 'Post')
            ->where('Post.titulo like ?1 AND Post.ativo = 1')
            ->setParameter(1, '%'.$search.'%')
            ->orderBy('Post.data', 'DESC');
        return $select;
    }
    /**
    *Função Select All
    *
    *@return array
    */
    public function fetchById($search = null)
    {
        $select = $this->getObjectManager()->createQueryBuilder()->select('Post')
            ->from('Admin\Entity\Post', 'Post')
            ->where('Post.id = ?1 AND Post.ativo = 1')
            ->setParameter(1, $search);
        return $select;
        }
}