<?php


class SiteSpecificController extends ControllerBase
{
    public function initialize()
    {
       $this->tag->setTitle('');
       $this->view->setTemplateAfter('site_specific');
    }

    public function indexAction()
    {
    }
}
