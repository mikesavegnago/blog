<?php
namespace Admin\Service;

use Core\Service\Service;
use Zend\Db\Sql\Select;
use Core\Model\EntityException as EntityException;

/**
 * Serviço responsável por fazer os comentarios
 * 
 * @category Admin
 * @package Service
 */
class Comentario extends Service
{
    /**
    *Função Select All
    *
    *@return array
    */
    public function fetchAllComentariosPost($search = null)
    {
        $select = $this->getObjectManager()->createQueryBuilder()->select('Comentario')
            ->from('Main\Entity\Comentario', 'Comentario')
            ->where('Comentario.post = ?1')
            ->setParameter(1, $search);
        return $select->getQuery()->getArrayResult();
        }
}