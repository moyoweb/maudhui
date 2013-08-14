<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 * @uses        Com_cck, com_taxonomy
 */

defined('KOOWA') or die('Protected resource');

class ComMaudhuiViewArticleHtml extends ComMaudhuiViewHtml
{
    /**
     * @return string
     */
    public function display()
    {
        $model = $this->getModel();

        $item = $this->getModel()->getItem();

        if($item->isRelationable()){
            $parent = $item->getParent();
        }

        $layout = $model->getItem()->template ? $model->getItem()->template : $parent->template;

        if($layout) {
            $this->setLayout($layout);
        }

        $this->assign('parent', $parent);

        return parent::display();
    }
}