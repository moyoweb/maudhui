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

class ComMaudhuiControllerGroup extends ComMaudhuiControllerDefault
{
    /**
     * @return array|KConfig|null
     */
    public function getRequest()
    {
        $this->_request->type = 'group';

        return $this->_request;
    }

    protected function _actionJoin(KCommandContext $context)
    {
        if ($this->_request->id && JFactory::getUser()->id) {
            $row = $this->getModel()->getItem();

            if ($row->isRelationable()) {
                $taxonomy = $row->getTaxonomy();
                $profile = $this->getService('com://admin/profile.model.users')
                    ->id(JFactory::getUser()->id)
                    ->getItem();

                if ($profile->isRelationable()) {
                    $relation = $profile->getTaxonomy();
                    $relation->append($taxonomy->id);
                }
            }
        }

        header('Content-Type: application/json');
        echo "success";
        exit;
    }


    protected function _actionLeave(KCommandContext $context)
    {
        $row = $this->getModel()->getItem();
        $profile = $this->getService('com://admin/profile.model.users')
            ->id(JFactory::getUser()->id)
            ->getItem();

        if ($profile->isRelationable()) {
            $user_tax = $profile->getTaxonomy();
        }

        if ($row->isRelationable()) {
            $taxonomy = $row->getTaxonomy();

            if ($taxonomy->isAncestorOf($user_tax)) {
                $taxonomy->deleteRelation($taxonomy->id, $user_tax->id);
                header('Content-Type: application/json');
                echo "success";
                exit;
            }
        }
    }
}