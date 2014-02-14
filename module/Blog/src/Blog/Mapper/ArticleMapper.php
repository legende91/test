<?php

namespace Blog\Mapper;

use Blog\Entity\Article;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class ArticleMapper {
    
    protected $gateway;
    
    public function __construct(TableGateway $gateway) {
        $this->gateway = $gateway;
    }

    
    public function getAll() {
        $listeArticleAssoc = $this->gateway->select()->toArray();
        
        foreach ($listeArticleAssoc as $articleAssoc) {
            
            $article = new Article();
            
            $hydrator = new ClassMethods();
            $hydrator->hydrate($articleAssoc, $article);
                        
            $listeArticle[] = $article;
            
        }
        
        return $listeArticle;
    }
    
    public function getById($id) {
        $resultSet = $this->gateway->select(array("id" => $id));
        
        $articleAssoc = $resultSet->current();
        
        if($articleAssoc == null) {
            return null;
        }
        
        $article = new Article();
        $hydrator = new ClassMethods();
        $hydrator->hydrate((array) $articleAssoc, $article);
        
        return $article;
    }
    
    public function add (Article $article){
        
        $hydrator = new ClassMethods();
        $articleAsssoc = $hydrator->extract($article);
        unset($articleAsssoc["date_pub"]);
       $id=$this->gateway->insert($articleAsssoc);
       $article->setId($id);
    }
    
}
