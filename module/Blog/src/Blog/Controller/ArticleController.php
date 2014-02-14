<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    /**
     *
     * @var \Zend\Http\Request 
     * 
     */
       
    protected $request;
    private function getMapper() {
        // Service Manager
        // Composant qui stocke les objets associées à des clés
        // et qui sait les créer (avec new, avec une fabrique, avec singleton,
        // avec une fabrique abstraite, avec un builder...)
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new \Zend\Db\TableGateway\TableGateway("article", $adapter);
        return new \Blog\Mapper\ArticleMapper($gateway);
    }

    public function listerAction()
    {
        $mapper = $this->getMapper();
        $listeArticles = $mapper->getAll();
        
        return new ViewModel(array(
            "listeArticles" => $listeArticles,
        ));
    }

    public function detailsAction()
    {
        // Va chercher le paramètres id dans la route
        $id = $this->params("id");
        
        // Interroge le Model pour récupérer notre article
        $mapper = $this->getMapper();
        $article = $mapper->getById($id);
        
        // TODO si pas d'article
        // au choix rediriger ou erreur 404
        
        // On transmet l'article à la vue
        return new ViewModel(array(
            "article" => $article,
        ));
    }

    public function ajouterAction()
    {
        
        $form = new \Blog\Form\ArticleForm(); 
        
        /* On recupere notre Filtre 
         * 
         * On verifie que c'est un post
         *    
         *  */
        
        if ($this->request->isPost()){
        $form->setInputFilter(new \Blog\InputFilter\ArticleInputFilter());
        
        // on recupere les donner du post
        $data = $this->request->getPost();
        
        $form->setData($data);
        
        if($form->isValid()){
            $mapper =$this->getMapper();
            $article = new \Blog\Entity\Article();
         
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            
            $article->setMembreId(1); // remplace un id membre 1
            $hydrator->hydrate($form->getData(), $article);
            $mapper->add($article);
           $this->flashMessenger()->addSuccessMessage("L'article a bien été publié"); 
          return $this->redirect()->toRoute("home");
          
        }
        }
        return new ViewModel(array(
            "form"=>$form,
        ));
    }


}

