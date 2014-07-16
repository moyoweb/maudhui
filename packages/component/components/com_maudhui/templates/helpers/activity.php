<?php
/**
 * Created by Mark Head.
 * Date: 24/06/2013
 * Time: 11:06
 */

defined('KOOWA') or die('Restricted Access');

class ComMaudhuiTemplateHelperActivity extends KTemplateHelperDefault
{

    public function message($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'row'      => null
        ));

        if(!$config->row instanceof KDatabaseRowDefault) return;

        $article = $this->getService('com://site/maudhui.model.articles')
            ->id($config->row->row)
            ->getItem();

        // Display an article type specific template override
        $identifier = clone($this->getIdentifier());
        $identifier->path = array('template', 'helpers', 'activities', 'types');
        $identifier->name = $article->type;

        if(is_file($identifier->filepath))
        {
            $identifier->path = array('template', 'helper', 'activity', 'type', $article->type);
            $identifier->name = 'message';

            $config->article = $article;

            return $this
                ->getTemplate()
                ->renderHelper($identifier, $config->toArray());
        }

        $user = $this->getService('com://site/profile.model.users')
            ->id(JFactory::getUser()->id)
            ->getItem();

        // Render the type view
        $message = $this->getTemplate()
            ->loadIdentifier('com://site/maudhui.view.activity.types.'.$article->type, array(
                'activity'      => $config->row,
                'user'          => $user,
                $article->type  => $article
            ))
            ->render();

        return $message;
    }

}
