<?php

/**
*
*/
class ComMaudhuiControllerArticle extends ComMaudhuiControllerDefault
{
    /**
     * Action Share
     *
     * @param KCommandContext $context
     * @notes This just ensures the participants value has come from the right place and contains the
     *        correct data type, most of the processing is done in the notifiable behavior, _afterInvite
     * @return bool
     */
    protected function _actionShare(KCommandContext $context)
    {

        $article = $this->getModel()->getItem();

        if (!$context->data->participants instanceof KConfig) {

            $this->setRedirect(
                'index.php?option=com_maudhui&view=article&layout=news&share=1&id='.$article->id,
                'It looks like you didn\'t add any invitees, please select users to invite.'
            );

            return false;
        }

        $link = KService::get('koowa:http.url', array('url' => KRequest::url()))->get(9) .
            JRoute::_('index.php?option=com_maudhui&view=article&layout=news&id='.$article->id);

        $context->data->fields = new KConfig(array(
            'title' => $article->title,
            'name' => JFactory::getUser()->name,
            'message' => $context->data->message ?: 'No Message Given',
            'link' => $link
        ));

        $context->status = KHttpResponse::OK;
        $context->log = true;


        $this->setRedirect('index.php?option=com_maudhui&view=article&layout=news&id='.$article->id, 'Thanks, Your invitation has been sent.');

        return true;
    }

    protected function _actionGet(KCommandContext $context)
    {
        if (KRequest::get('get.share', 'int') && JFactory::getUser()->guest) {
            $url = JRoute::_('index.php?option=com_users&view=login&return='
                .base64_encode('index.php?'.KRequest::url()->getQuery()));
            JFactory::getApplication()->redirect($url);

            return false;
        }

        return parent::_actionGet($context);
    }
}