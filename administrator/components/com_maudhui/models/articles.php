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
     * @param KDatabaseQuery $query
     */

    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->_state->insert('type', 'word');
    }

    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        parent::_buildQueryWhere($query);

        if ($this->_state->type) {
            $query->where('tbl.type', '=', $this->_state->type);
        }

        if ($this->_state->search) {
            $query->where('tbl.title', 'LIKE', '%'.$this->_state->search.'%');
        }
    }
}