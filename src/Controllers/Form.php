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

    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function display(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $form = \Laasti\Form\FormFactory::createFromConfig($this->form, $request->request->all(), $this->validator->errors());
        } else {
            $form = \Laasti\Form\FormFactory::createFromConfig($this->form, $request->request->all());
        }
       
        $this->responder->setData('form', $form);

        return $this->responder->view('form');
    }

    public function submit(Request $request)
    {
        $data = $request->request->all();
        $this->validator = $this->getContainer()->get('Valitron\Validator', [$data]);
        $this->validator->rule('required', ['username', 'email', 'profile', 'profile2']);
        $this->validator->rule('email', 'email');

        if ($this->validator->validate()) {
            var_dump('Should do something');
        }

        return $this->display($request);
    }

}
