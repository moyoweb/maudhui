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

class ComMaudhuiTemplateHelperListbox extends KTemplateHelperListbox
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
            'name'     => 'maudhui_article_id'
        ));

        return $this->_listbox($config);
    }

    public function date($config = array())
    {
    	$config = new KConfig($config);
    	$config->append(array(
    		'attribs'   => array(
                'data-submit'   => 'true',
                'data-theme'    => 'a'
            ),
            'prompt'    => 'By Date'
    	));

    	$config->options = array(
    		array('value' => null, 'text' => $config->prompt),
    		array('value' => 7,    'text' => 'Last Week'),
    		array('value' => 14,   'text' => 'Last 2 Weeks'),
    		array('value' => 30,   'text' => 'Last 30 Days'),
    		array('value' => 60,   'text' => 'Last 60 Days'),
    		array('value' => 120,  'text' => 'Last 120 Days'),
    	);

    	return parent::optionlist($config);
    }
}