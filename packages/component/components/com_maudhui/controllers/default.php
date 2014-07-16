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

class ComMaudhuiControllerDefault extends ComDefaultControllerDefault
{
    /**
     * @param KConfig $config
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'model' => 'com://site/maudhui.model.articles',
            'behaviors' => array(
                'com://admin/acl.controller.behavior.executable',
                'com://admin/taxonomy.controller.behavior.relationable',
                'com://site/notifications.controller.behavior.notifiable',
                'com://admin/activities.controller.behavior.loggable',
            )
        ));

        parent::_initialize($config);
    }

    /**
     * @param KCommandContext $context
     * @return KDatabaseRow
     */
    protected function _actionGet(KCommandContext $context)
    {
        $view = $this->getView();

        if($view instanceof KViewTemplate)
        {
            $package = $context->caller->getIdentifier()->package;

            $layout = clone $view->getIdentifier();
            $layout->package  = $package ? $package : 'maudhui';
            $layout->name     = $view->getLayout();

            $layout->path = array('view', $view->getName());

            if(!$this->_request->id && KInflector::isSingular($view->getName())) {
                $layout->name = 'form';
            }

            $layout->filepath = '';

            $view->setLayout($layout);
        }

        return parent::_actionGet($context);
    }

    protected function _actionAdd(KCommandContext $context)
    {
        if(is_numeric($context->data->maudhui_type_id)) {
            $type = $this->getService('com://admin/maudhui.model.types')->id($context->data->maudhui_type_id)->getItem();

            $context->data->cck_fieldset_id = $type->cck_fieldset_id;
        }

        //TODO: Move to com_redirects!
        $result = parent::_actionAdd($context);

        if($context->caller->getIdentifier()->name == 'reply') {
            $redirect = $context->caller->getRedirect();
            $this->setRedirect($redirect['url']->__toString());
        } else {
            $this->setRedirect('index.php?option=com_maudhui&view='.$this->_request->type.'&id='.$result->id);
        }

        return $result;
    }

    /**
     * Get action participants
     *
     * @param KCommandContext $context
     * @return array|bool
     */
    public function getActionParticipants(KCommandContext $context)
    {
        $article = $this->getModel()->getItem();

        if($article->isRelationable()) {

            $parent = $article->getParent();

            if($parent instanceof KDatabaseRowAbstract) {
                if($parent->isRelationable()) {

                    // Start building an array of thread participants
                    $users = array();

                    $author = $parent->getUser();
                    $users[$author->id] = $author->id;

                    foreach($parent->getReplies() as $reply) {

                        $participant = $reply->getUser();
                        if(!isset($users[$participant->id])) $users[$participant->id] = $participant->id;

                    }

                    return $users;
                }
            }
        }

        return false;
    }

    /**
     * Action to 'follow' anything that has the database behavior relationable.
     * See templates/bcla/javascripts/template.js, templates/bcla/html/com_maudhui/topics/default.php and template/bcla/sass/template.scss (class follow) for API use.
     *
     * @param KCommandContext $context
     */
    //TODO:: Add user count!
    protected function _actionFollow(KCommandContext $context)
    {
        if($this->_request->id && JFactory::getUser()->id) {
            $row = $this->getModel()->getItem();

            if($row->isRelationable()) {
                $taxonomy = $row->getTaxonomy();
                $user = $this->getService('com://admin/taxonomy.model.taxonomies')->row(JFactory::getUser()->id)->table('profile_users')->getItem();

                if(!$taxonomy->isAncestorOf($user)) {
                    $draft = $context->caller->hasRights() ? 0 : 1;

                    //TODO: If draft === 1 Send mail to owner to accept or reject the user that wants to join!

                    $user->append($taxonomy->id, $draft);
                }

                $response = array(
                    'id' => $this->_request->id,
                    'following' => true,
                );

				$activity = $this->getService('com://admin/activities.database.row.activity');
				$activity->setData(array(
					'action'	  => $context->action,
					'application' => $this->getIdentifier()->application,
					'type'        => $this->getIdentifier()->type,
					'package'     => $this->getIdentifier()->package,
					'name'        => $this->getIdentifier()->name,
					'status'      => 'followed',
					'row' 		  => $this->_request->id,
					'title'		  => $row->title
				));
				$activity->save();

                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }

        $context->setError(new KControllerException(
            'Unauthorized', KHttpResponse::UNAUTHORIZED
        ));

        return false;
    }

    //TODO:: Add user count!
    protected function _actionUnfollow(KCommandContext $context)
    {
        if($this->_request->id && JFactory::getUser()->id) {
            $row = $this->getModel()->getItem();

            if($row->isRelationable()) {
                $taxonomy = $row->getTaxonomy();
                $user = $this->getService('com://admin/taxonomy.model.taxonomies')->row(JFactory::getUser()->id)->table('profile_users')->getItem();
                $user->deleteRelation($taxonomy->id, $user->id);
            }

            $response = array(
                'id' => $this->_request->id,
                'following' => false,
            );

			$activity = $this->getService('com://admin/activities.database.row.activity');
			$activity->setData(array(
				'action'	  => $context->action,
				'application' => $this->getIdentifier()->application,
				'type'        => $this->getIdentifier()->type,
				'package'     => $this->getIdentifier()->package,
				'name'        => $this->getIdentifier()->name,
				'status'      => 'unfollowed',
				'row' 		  => $this->_request->id,
				'title'		  => $row->title
			));
			$activity->save();

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        $context->setError(new KControllerException(
            'Unauthorized', KHttpResponse::UNAUTHORIZED
        ));

        return false;
    }

//    protected function _actionRead(KCommandContext $context)
//    {
//        echo "<pre>";
//        print_r(parent::_actionRead($context));
//        echo "<pre>";
//
//        exit;
//    }
}
