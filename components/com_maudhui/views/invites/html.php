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

class ComMaudhuiViewInvitesHtml extends ComMaudhuiViewHtml
{
    public function display()
    {
        //TODO: Get all invites!

        $this->getService('com://profile.user.');

        return parent::display();
    }
}