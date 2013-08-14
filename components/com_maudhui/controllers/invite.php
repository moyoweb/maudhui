<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ComMaudhui
 * @uses        Com_cck, com_taxonomy
 */

defined('KOOWA') or die('Protected resource');

class ComMaudhuiControllerInvite extends ComDefaultControllerResource
{
    protected function _actionGet(KCommandContext $context)
    {
        //Check if parent_id or user is logged in else redirect to homepage.
        if($this->_request->parent_id && JFactory::getUser()->id) {
            $identifier = clone $this->getIdentifier();
            $identifier->name = 'article';

            $created_by = $this->getService($identifier)->id($this->_request->parent_id)->read()->created_by;

            //Check if the logged in user is the creator else redirect.
            if($created_by != JFactory::getUser()->id) {
                $this->_redirect();
            }

        } else {
            $this->_redirect();
        }

        if(JFactory::getUser()->id) {
            if($this->_request->action) {
                if(!JFactory::getUser()->id) {
                    $return = base64_encode(KRequest::url());

                    JFactory::getApplication()->redirect('index.php?option=com_users&view=login&return='.$return, JText::_('You must be logged into access this component'));
                }

                $action = '_action'.ucfirst($this->_request->action);
                $this->$action($context);
            }

        }

        return parent::_actionGet($context);
    }

	protected function _actionDecline(KCommandContext $context)
    {
		$user = $this->getService('com://site/profile.model.users')
			->id(JFactory::getUser()->id)
			->getItem();

		$userTaxonomy = $this->getService('com://admin/taxonomy.model.taxonomy')->row($user->id)->table('profile_users')->getItem();
		$parent = $this->getService('com://admin/taxonomy.model.taxonomy')->row(KRequest::get('get.parent_id', 'int'))->table('maudhui_articles')->getItem();

		$taxonomy = $this->getService('com://admin/taxonomy.model.taxonomy_relations')->ancestor_id($parent->id)->descendant_id($userTaxonomy->id)->getItem();
		$taxonomy->delete();

		JFactory::getApplication()->redirect(JRoute::_(''), JText::_('Declined invite.'));
	}

	protected function _actionAccept(KCommandContext $context)
    {
		$user = $this->getService('com://site/profile.model.users')
			->id(JFactory::getUser()->id)
			->getItem();

		$userTaxonomy = $this->getService('com://admin/taxonomy.model.taxonomy')->row($user->id)->table('profile_users')->getItem();
		$parent = $this->getService('com://admin/taxonomy.model.taxonomy')->row(KRequest::get('get.parent_id', 'int'))->table('maudhui_articles')->getItem();

		$taxonomy = $this->getService('com://admin/taxonomy.model.taxonomy_relations')->ancestor_id($parent->id)->descendant_id($userTaxonomy->id)->getItem();
		$taxonomy->draft = 0;
		$taxonomy->save();

		JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_maudhui&view='.$parent->type.'&id='.$parent->row), JText::_('Thank you for accepting the the invite.'));
	}

    protected function _actionInvite(KCommandContext $context)
    {
        if($context->data->parent_id) {
            foreach($context->data->id as $id) {
                $user = $this->getService('com://admin/taxonomy.model.taxonomy')->row($id)->table('profile_users')->getItem();
				$profile = $this->getService('com://site/profile.model.users')->id(JFactory::getUser()->id)->getItem();

                $parent = $this->getService('com://admin/taxonomy.model.taxonomy')->row($context->data->parent_id)->table('maudhui_articles')->getItem();

                if(!$user->isDescendantOf($parent->id)) {
                    $user->append($parent->id, 1);

					$mailContext = new KCommandContext(array(
						'data'  => array(
							'fields' => array(
								'accept'			=> '<a href="'.JRoute::_('index.php?option=com_maudhui&view=invite&parent_id='.$context->data->parent_id.'&action=accept').'">Accept Invetation</a>',
								'decline'			=> '<a href="'.JRoute::_('index.php?option=com_maudhui&view=invite&parent_id='.$context->data->parent_id.'&action=decline').'">Decline Invetation</a>',
								'content'           => '<strong>This is a simple test email with some simple content.</strong>'
							),
							'component'     => 'com_maudhui',
							'type'          => 'invite',
							'recipients'    => array($profile->email),
							'css'           => file_get_contents(JPATH_ROOT.'/media/com_payments/css/email.css'),
							'html'			=> true
						)
					));

					// Send order confirmation email
					$this->getService('com://site/emails.controller.email')->send($mailContext);
                }
            }
        }
    }

    protected function _redirect()
    {
        $return = base64_encode(KRequest::url());

//        JFactory::getApplication()->redirect('index.php?option=com_users&view=login&return='.$return, JText::_('You must be logged into access this component'));

        JFactory::getApplication()->redirect('');
    }
}