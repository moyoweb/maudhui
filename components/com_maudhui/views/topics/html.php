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

class ComMaudhuiViewTopicsHtml extends ComMaudhuiViewHtml
{
    public function display()
    {
        /*
        $row = $this->getModel()->getItem();

        if($row->isRelationable()) {
            $this->assign('topics', $group);
        }
        */

        return parent::display();
    }
}