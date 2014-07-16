<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 * @uses        Com_taxonomy, com_cck
 */
 
 defined('KOOWA') or die('Protected resource');

class ComMaudhuiViewQuestionsHtml extends ComMaudhuiViewHtml
{
    public function display()
    {
        if(KRequest::get('get.search', 'word')) {
            $this->setLayout('form');
        }

        return parent::display();
    }
}