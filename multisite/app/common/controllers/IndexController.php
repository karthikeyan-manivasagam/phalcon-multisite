<?php

namespace Common\Controller;

class IndexController extends ControllerBase
{
    public function initialize()
    {
       $this->tag->setTitle('Title');
       $this->view->setTemplateAfter('index');
    }

    public function indexAction()
    {
    	
    }
}
