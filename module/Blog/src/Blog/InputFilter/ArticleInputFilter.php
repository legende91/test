<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

/**
 * Description of articleInputFilter
 *
 * @author sylvain
 */
class ArticleInputFilter extends InputFilter {

    public function __construct() {

        /*  Titre  */

        $input = new Input("titre");


        $validator = new \Zend\Validator\NotEmpty();
        $validator->setMessage("Le titre est obligatoire", \Zend\Validator\NotEmpty::IS_EMPTY);
        $input->getValidatorChain()->attach($validator);


        $validator = new StringLength();

        $validator->setMin(5)
                ->setMax(100)
                ->setMessage("il faut au moins %min% Charatheres", StringLength::TOO_SHORT)
                ->setMessage("il faut au maximum %max% Charatheres", StringLength::TOO_LONG);

        $input->getValidatorChain()->attach($validator);

        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);

        $stripTags = new StripTags();
        $input->getFilterChain()->attach($stripTags);

        $this->add($input);
        /*  Contenu  */

        $input = new Input("contenu");


        $validator = new \Zend\Validator\NotEmpty();
        $validator->setMessage("Le contenu est obligatoire", \Zend\Validator\NotEmpty::IS_EMPTY);
        $input->getValidatorChain()->attach($validator);

        $validator = new StringLength();
        $validator->setMin(5)
                ->setMessage("L'article doit avoir au moins %min% Charatheres", StringLength::TOO_SHORT);
        $input->getValidatorChain()->attach($validator);

        $filter = new StringTrim();
        $input->getFilterChain()->attach($filter);

        $stripTags = new StripTags();
        $input->getFilterChain()->attach($stripTags);

        $this->add($input);
    }

}
