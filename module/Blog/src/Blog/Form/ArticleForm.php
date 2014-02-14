<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Blog\Form;
/**
 * Description of ArticleForm
 *
 * @author sylvain
 */
class ArticleForm  extends \Zend\Form\Form{
   
public function __construct($name = null, $options = array()) {
               parent::__construct("article");

               $element = new \Zend\Form\Element\Text("titre");
               $element->setLabel("Titre")
                               ->setAttribute("placeholder", "Titre");
               $this->add($element);

               $element = new \Zend\Form\Element\Textarea("contenu");
               $element->setLabel("Contenu")
                               ->setAttribute("placeholder", "Contenu");
               $this->add($element);

               $element = new \Zend\Form\Element\Submit("submit");
               $element->setValue("Valider");
               $this->add($element);
       }

}
