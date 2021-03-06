<?php

namespace Admin\Form;

use Zend\Form\Element;

class AddPageDetails extends \Zend\Form\Form implements \Zend\InputFilter\InputFilterProviderInterface {
   
   public $pageId;
   
   const ELEMENT_LANGUAGE = 'language';
   const ELEMENT_TITLE = 'title';
   const ELEMENT_DESCRIPTON = 'description';
   const ELEMENT_KEYWORDS = 'keywords';
   
   public function __construct($id, $languages) {
      $this->pageId = $id;
      parent::__construct('page_details_form');

      $this->setAttribute('action', '../editpage/'.$this->pageId);
      $this->setAttribute('class', 'styledForm');
      
      foreach($languages as $lang) {
         $dropDownElements[$lang['id']] = $lang['name'];
      }
      
      $this->add([
            'name' => self::ELEMENT_LANGUAGE,
            'type' => Element\Select::class,
            'options' => [
                'label' => 'Language',
                'value_options' => $dropDownElements
            ],
            'attributes' => [
                'required' => true
            ],
      ]);
      
      $this->add([
            'name' => self::ELEMENT_TITLE,
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Title'
            ],
            'attributes' => [
                'required' => true
            ],
      ]);
      
      $this->add([
            'name' => self::ELEMENT_DESCRIPTON,
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Opis'
            ],
            'attributes' => [
                'required' => true
            ],
      ]);
      
      $this->add([
            'name' => self::ELEMENT_KEYWORDS,
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Keywords'
            ],
            'attributes' => [
                'required' => true
            ],
      ]);
      
      $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'class' => 'btn btn-primary'
            ]
        ]);
      
      $this->completeMsg = 'form.addPageMetada.success';
   }
   
   public function getInputFilterSpecification()
    {
        return [
            [
                'name' => self::ELEMENT_TITLE,
                'filters' => [
                    ['name' => \Zend\Filter\StringTrim::class]
                ],
                'validators' => [
                    [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 3,
                            'messages' => [
                                \Zend\Validator\StringLength::TOO_SHORT => 'The minimum length is: %min%'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}