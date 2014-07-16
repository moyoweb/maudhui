<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 */

defined('KOOWA') or die('Protected resource');

class ComMaudhuiDatabaseRowArticle extends KDatabaseRowDefault
{
    /**
     * @param null $id
     * @return mixed
     */
    //TODO:: Improve!
    public function getUser($id = null)
    {
       $id = $id ? $id : $this->created_by;

        $row = $this->getService('com://admin/profile.model.users')
            ->id($id)
            ->getItem();

        return $row;
    }

    /**
     * @param $column
     * @return string
     */
    public function __get($column)
    {
        $result = parent::__get($column);

        if(array_key_exists($column, $this->getTable()->getColumns())) {
            return $result;
        } else {
            if($this->isElementable()) {
                $result = $this->getElement($column)->value ? $this->getElement($column)->value : $result;
            }
        }

        if($column == 'users') {
            if($this->isRelationable()) {
                //TODO: Cache
                //TODO: Return user object instead of children.
                $result = $this->getTaxonomy()->getDescendants(array('filter' => array('type' => array('user', 'reply')), 'groupby' => 'created_by'));

                $row = $result->find(array('created_by' => $this->created_by));

                //TODO: Improve!
                if($this->created_by && $row->find(array('created_by' => $this->created_by))->count() === 0) {
                    $result->insert($this->getService('com://site/profile.model.user')->id($this->created_by)->getItem());
                }
            }
        }

        if($column == 'replies') {
            if($this->isRelationable()) {
                //TODO: Cache
                //TODO: Database this!
                $result = $this->getTaxonomy()->getDescendants(array('filter' => array('type' => array('reply'))));
            }
        }

        if($column == 'latest_activity') {
            if($this->isRelationable()) {
                //TODO: Get this out of the table.
                $result = $this->getTaxonomy()->getDescendants()->top() ? $this->getTaxonomy()->getDescendants()->top() : $this;
            } else {
                $result = clone $this;
            }
        }

        return $result;
    }
}