<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 * @uses        Com_cck, com_taxonomy
 */

class ComMaudhuiModelArticles extends ComDefaultModelDefault
{

	/**
	 * Container for the featured item
	 * @var mixed
	 */
	protected $_featured;

    /**
     * @param KConfig $config
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->_state
            ->insert('parent'           , 'int')
            ->insert('parent_id'        , 'int')
            ->insert('type'             , 'word')
            ->insert('filter'           , 'word')
            ->insert('created_after'    , 'string')
            ->insert('created_before'   , 'string')
            ->insert('sort'             , 'string'  , 'created_on')
            ->insert('direction'        , 'string'  , 'DESC')
            ->insert('featured'			, 'boolean')
            ->insert('days_ago'			, 'int')
            ->insert('enabled'          , 'int'     , 1)
        ;
    }

    /**
     * @param KDatabaseQuery $query
     */
    protected function _buildQueryJoins(KDatabaseQuery $query)
    {
        $state = $this->_state;

        if($state->parent_id) {
            $query->select('taxonomies.taxonomy_taxonomy_id');
            $query->join('INNER', '#__taxonomy_taxonomies AS taxonomies', array(
                'taxonomies.row = tbl.maudhui_article_id',
                'taxonomies.table = LOWER("'.strtoupper($this->getTable()->getName()).'")',
            ));

            $query->join('inner', '#__taxonomy_taxonomy_relations AS r', 'r.descendant_id = taxonomies.taxonomy_taxonomy_id');
        }

        parent::_buildQueryJoins($query);
    }

    /**
     * @param KDatabaseQuery $query
     */
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        $state = $this->_state;

        parent::_buildQueryWhere($query);

        if($state->parent_id) {
            $query->where('r.ancestor_id', 'IN', $state->parent_id);
        }

        if($state->type) {
            $query->where('tbl.type', '=', $state->type);
        }

        if($state->search) {
            $query->where('tbl.title', 'LIKE', '%'. $state->search .'%');
        }

        if($state->created_before) {
            $query->where('tbl.created_on', '<', $state->created_before);
        }

        if($state->created_after) {
            $created_after = urldecode($state->created_after);
            $query->where('tbl.created_on', '>', $created_after);
        }

        if($state->template) {
            $query->where('tbl.template', '=', $state->template);
        }

        if($state->featured) {
            $query->where('tbl.featured', '=', $state->featured);
        }

        if($this->_state->days_ago > 0) {
            $query->where('tbl.created_on', '>=', date('Y-m-d 00:00:00', strtotime('-'.(string)$this->_state->days_ago.' days')));
        }

        if($state->enabled) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }
    }

    public function getList()
    {
    	if ($this->_state->featured) {
    		return $this->getFeaturedItem();
    	}

    	return parent::getList();
    }

    public function getItem()
    {
    	if ($this->_state->featured) {
    		return $this->getFeaturedItem();
    	}

    	return parent::getItem();
    }

    public function getFeaturedItem()
    {
    	if($this->_featured === null)
    	{
    		// Make sure the features state is on true
    		$this->featured(true);

    		// If nothing is featured, try to get it from most commented items
    		if($this->getTotal() < 1)
    		{
    			$this->featured(false);
				$items = $this->sort('comments', 'DESC')->getList();

				// Don't let the limit go over the result count
				$limit = ($this->_state->limit <= ($item_count = count($items))) ? $this->_state->limit : $item_count;

				// Get the index of the randomly selected item
				$random = rand(0, $limit - 1);
				// Make sure iteration starts at the beginning
				$items->rewind();

				// Iterate and select an item based on the random index.
				for($i = 0; $i < $limit; $i++)
				{
					if($i !== $random){
						$items->next();
						continue;
					}

					$this->_featured = $items->current();
					break;
				}

				// Make featured true again as per original state
    			$this->featured(true);
    		}else{
    			$this->_featured = parent::getList()->top();
    		}
    	}

    	return $this->_featured;
    }
}