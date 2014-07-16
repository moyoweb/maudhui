<?php

class ModMaudhuiHtml extends ModDefaultHtml
{
	public function display()
	{
        $type = $this->module->params->layout;
        $limit = $this->module->params->limit;

        $articles = $this->getService('com://site/maudhui.model.articles')->type(KInflector::singularize($type))->limit($limit)->getList();

        $this->setLayout($type);
        $this->assign($type, $articles);

		return parent::display();
	}
}