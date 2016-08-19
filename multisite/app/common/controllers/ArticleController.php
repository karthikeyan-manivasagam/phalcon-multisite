<?php
namespace Common\Controller;

class ArticleController extends ControllerBase
{
    public function initialize()
    {
       $this->tag->setTitle('Title');
       $this->view->setTemplateAfter('article');
    }

    public function indexAction()
    {
      
    }
}
