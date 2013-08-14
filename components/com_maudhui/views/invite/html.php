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

class ComMaudhuiViewInviteHtml extends ComMaudhuiViewHtml
{
    public function display()
    {
        $user = $this->getService('com://site/profile.model.users')->id(JFactory::getUser()->id)->getItem();

        if($user->isRelationable()) {
            $article = $this->getService('com://site/maudhui.model.articles')->id(KRequest::get('get.parent_id', 'int'))->getItem();

            if($article->isRelationable()) {
                $friends = $user->getRelation(array('ancestors' => array('not' => array($article->getTaxonomy()->id)), 'filter' => array('type' => 'user')));
            }

            $this->assign('friends', $friends);
        }

        return parent::display();
    }
}