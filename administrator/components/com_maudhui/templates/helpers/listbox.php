<?php defined('KOOWA') or die;
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maudhui
 * @uses        Com_cck, com_taxonomy
 */

class ComMaudhuiTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{
    /**
     * @param array $config
     * @return string
     */
    public function articles($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'model'    => 'articles',
            'value'    => 'id',
            'text'     => 'title',
            'name'     => 'maudhui_article_id',
        ));

        return parent::_render($config);
    }

    /**
     * @param array $config
     * @return string
     */
    public function types($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'model'    => 'types',
            'value'    => 'id',
            'text'     => 'title',
            'name'     => 'maudhui_type_id',
            'deselect' => false,
        ));

        return parent::_render($config);
    }
}