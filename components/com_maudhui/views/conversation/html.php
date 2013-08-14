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

class ComMaudhuiViewConversationHtml extends ComMaudhuiViewHtml
{
    public function display()
    {
        $row = $this->getModel()->getItem();

        //TODO: Dont fire when article is group or topic.
        if($row->isRelationable()) {
            $topic = $row->getParent(array('filter' => array('type' => 'topic')));
            $group = $row->getParent(array('filter' => array('type' => 'group')));

            $this->assign('topic', $topic);
            $this->assign('group', $group);
        }

        return parent::display();
    }
}