<?php

namespace Laasti\Sandbox\Controllers;

use Laasti\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;

class Form
{
    use \League\Container\ContainerAwareTrait;

    protected $responder;
    protected $validator;

    protected $form = [
        'rules' => [
            'required' => [['name'], ['email']],
            'email' => 'email'
        ],
    'fields' => [
        [
            'type' => 'text',
            'name' => 'name',
            'label' => 'Label',
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'label' => 'E-mail address'
        ],
        [
            'type' => 'file',
            'name' => 'file',
            'label' => 'File'
        ],
        [
            'type' => 'textarea',
            'name' => 'textarea',
            'label' => 'Textarea'
        ],
        [
            'type' => 'submit',
            'name' => 'submit',
            'label' => 'Send'
        ],
    ]

    ];
    
    protected $session;

    public function __construct(ResponderInterface $responder, \Symfony\Component\HttpFoundation\Session\SessionInterface $session)
    {
        $this->responder = $responder;
        $this->session = $session;
    }

    public function display(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $form = \Laasti\Form\FormFactory::createFromConfig($this->form, $request->request->all(), $this->validator->errors());
        } else {
            $form = \Laasti\Form\FormFactory::createFromConfig($this->form, $this->session->all());
        }
       
        $this->responder->setData('form', $form);
        $this->responder->setData('success', $this->session->getFlashBag()->get('success'));

        return $this->responder->view('form');
    }

    public function submit(Request $request)
    {
        $data = $request->request->all();
        
        if ($this->getValidator($data)->validate()) {
            $this->session->getFlashBag()->add('success', 'The form was validated.');
            $this->session->set('name', $data['name']);
            $this->session->set('email', $data['email']);
            return $this->responder->redirect($request->getRequestUri());
        }

        return $this->display($request);
    }
    
    public function getValidator($data = [])
    {
        if (is_null($this->validator) || count($data)) {
            //Overwrite validator if data is passed
            $this->validator = $this->getContainer()->get('Valitron\Validator', [$data]);
            $this->validator->rules($this->form['rules']);
        }
        
        return $this->validator;
    }

}
