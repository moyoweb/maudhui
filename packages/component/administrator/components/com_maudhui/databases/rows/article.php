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
    public function getUser($id = null)
    {
       $id = $id ? $id : $this->created_by;

        $row = $this->getService('com://admin/profile.model.users')
            ->id($id)
            ->getItem();

        return $row;
    }

    public function save()
    {
    	if(isset($this->_modified['featured']) && $this->featured)
    	{
    		$table = $this->getTable();
    		$database = $table->getDatabase();
    		$query = $database->getQuery()
    					->where('featured', '=', 1)
    					->where('type', '=', $this->type);

    		$database->update($table->getBase(), array('featured' => 0), $query);
    	}

    	return parent::save();
    }
}