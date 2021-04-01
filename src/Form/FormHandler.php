<?php

namespace Blog\Form;

use Blog\Model\Manager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FormHandler
 */

class FormHandler
{
    protected $form;
    protected $manager;
    protected $request;

    /**
     * FormHandler constructor.
     * @param Form $form
     * @param Manager $manager
     * @param Request $request
     */
    public function __construct(Form $form, Manager $manager, Request $request)
    {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    /**
     * @return bool
     */
    public function process(): bool
    {
        if($this->request->getMethod() == 'POST' && $this->form->isValid()) {
            $this->manager->save($this->form->getModel());

            return true;
        }

        return false;
    }

    /**
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @param Manager $manager
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}