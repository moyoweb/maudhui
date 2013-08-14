<?php
/**
 * Created by Mark Head.
 * Date: 25/06/2013
 * Time: 14:42
 */

defined('KOOWA') or die('Restricted Access');

class ComMaudhuiDatabaseBehaviorTypeable extends KDatabaseBehaviorAbstract
{

    protected function _beforeTableSelect(KCommandContext $context)
    {
        $query = $context->query;

        if(is_null($query)) return;

        $type = null;

        // Loop each where statement to look for the type
        foreach($query->where as $key => $where)
        {
            if($where['property'] == 'tbl.type' || $where['property'] == 'type')
            {
                $type = $where['value'];
                unset($context->query->where[$key]);
            }
        }

        // No need to build the query if no type is set
        if(!$type) return;

        $table = $context->caller;
        $query = $context->query;

        // Join the maudhui articles and filter by type
        // @todo: This uses a variable set in the caller db table as passing a config via the behavior is not supported in 12.1
        $article_id_column = $table->maudhui_article_id_column ?: 'maudhui_article_id';
        $query->join('LEFT', 'maudhui_articles AS ma', 'tbl.'.$article_id_column.'= ma.maudhui_article_id');

        // Include reply parents
        // @todo: this has dependency on taxonomy, is this the best solution?
        $query->join('LEFT', 'taxonomy_taxonomies AS t', 'ma.maudhui_article_id = t.row AND t.table = \'maudhui_articles\'');
        $query->join('LEFT', 'taxonomy_taxonomy_relations AS tr', 't.taxonomy_taxonomy_id = tr.descendant_id');
        $query->join('LEFT', 'taxonomy_taxonomies AS t2', 'tr.ancestor_id = t2.taxonomy_taxonomy_id');
        $query->join('LEFT', 'maudhui_articles AS ma2', 't2.row = ma2.maudhui_article_id');
        $query->where('ma.type = "'.$type.'" OR (ma.type = \'reply\' AND ma2.type = \''.$type.'\')');
    }

}
