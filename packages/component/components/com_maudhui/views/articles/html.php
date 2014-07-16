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

class ComMaudhuiViewArticlesHtml extends ComMaudhuiViewHtml
{
    /**
     * @return string
     */
    public function display()
    {
        $model = $this->getModel();

        if($model->getState()->type) {
            $this->setLayout($model->getState()->type);
        }

        return parent::display();
    }
}