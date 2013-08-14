<?php
/**
 * Created by Mark Head.
 * Date: 24/06/2013
 * Time: 11:32
 */

defined('KOOWA') or die('Restricted Access');

class ComMaudhuiTemplateHelperActivityTypeReply extends KTemplateHelperDefault
{

    public function message($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'row'       => null,
            'article'   => null
        ));

        if(!$config->row instanceof KDatabaseRowDefault) return;

        $row  = $config->row;
        $reply = $config->article;
        if($reply->isRelationable()) $parent = $reply->getParent();
        $user = $this->getService('com://site/profile.model.users')
            ->id(JFactory::getUser()->id)
            ->getItem();

        $message = '';

        try
        {
            // Force change the status for replies
            $row->status = JText::_('replied to');

            $message = $this->getTemplate()
                ->loadIdentifier('com://site/maudhui.view.activity.types.reply', array(
                    'activity' => $row,
                    'user'     => $user,
                    'reply'    => $reply,
                    'parent'   => $parent
                ))
                ->render();
        }

        catch(Exception $e) {}

        return $message;
    }

}

