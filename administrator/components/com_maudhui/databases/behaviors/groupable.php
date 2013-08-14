<?php
/**
 * ComMaudhui
 *
 * @author      Mark Anthony Alcaide <marka@wizmediateam.com>
 * @category    Nooku
 * @package     SocialHub
 * @uses        Maudhui
 */

/**
*
*/
class ComMaudhuiDatabaseBehaviorGroupable extends KDatabaseBehaviorAbstract
{
    protected $_groups;

    protected function _afterTableInsert(KCommandContext $context)
    {
        $this->_afterTableSave($context);
    }

    protected function _afterTableUpdate(KCommandContext $context)
    {
        $this->_afterTableSave($context);
    }

    protected function _afterTableSave(KCommandContext $context)
    {
        if ($group_id = $context->data->group_id) {
            $table = $context->caller;

            $row = $context->data;

            if ($row->isRelationable()) {
                $row_tax = $row->getTaxonomy();
            }

            $group = $this->getService('com://admin/maudhui.model.articles')
                ->type('group')
                ->id($group_id)
                ->getItem();

            if ($group->isRelationable()) {
                $group_tax = $group->getTaxonomy();
            }

            $row_tax->deleteDescendants(array(
                'table' => 'maudhui_articles',
                'type' => 'group',
            ));

            if ($row_tax && $group_tax) {
                $group_tax->append($row_tax->id);
            }
        }
    }

    protected function _beforeTableSelect(KCommandContext $context)
    {
        if (!JFactory::getApplication()->isAdmin()) {
            $query = $context->query;
            $table = $context->caller;

            if (is_null($query)) {
                return;
            }

            $user = JFactory::getUser();

            if (!$user->guest) {
                $profile = $this->getService('com://site/profile.model.users')
                    ->id($user->id)
                    ->getItem();

                if ($profile->isRelationable()) {
                    if (!$this->_groups) {
                        $this->_groups = array();
                        $groups = $profile->getTaxonomy()
                            ->getAncestors(array(
                                'filter' => array('type' => 'group'),
                            ));

                        foreach ($groups as $group) {
                            if ($group->isRelationable()) {
                                $this->_groups[] = $group->getTaxonomy()->id;
                            }
                        }
                    }

                    $where = '(tbl.private = 0';

                    if (count($this->_groups)) {
                        $query->join('LEFT', 'taxonomy_taxonomies AS tx', array(
                                'tbl.'.$table->getIdentityColumn().' = tx.row',
                                'tx.table = '.$table->getDatabase()->quoteValue($table->getName()),
                            ))
                            ->join('LEFT', 'taxonomy_taxonomy_relations tr', 'tx.taxonomy_taxonomy_id = tr.ancestor_id')
                            ->group('tbl.'.$table->getIdentityColumn());

                        $where .= ' OR (tbl.private = 1 AND tr.descendant_id IN ('.implode(',', $this->_groups).'))';
                    }

                    $where .= ')';
                    $query->where($where);

                }
            } else {
                $query->where('tbl.private', '=', 0);
            }
        }
    }

    public function getGroup()
    {
        $group = false;

        if ($this->isRelationable()) {
            // Get the allocation
            $tax = $this->getTaxonomy();

            if (!$tax->isNew()) {
                $group = $tax->getDescendants(array(
                    'filter' => array('type' => 'group'),
                ))
                ->top();
            }
        }

        return $group;
    }
}