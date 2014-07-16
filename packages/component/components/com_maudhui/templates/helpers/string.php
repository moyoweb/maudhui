<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  Maduhui
 * @uses        Com_taxonomy, com_cck
 */
 
defined('KOOWA') or die('Protected resource');

class ComMaudhuiTemplateHelperString extends KTemplateHelperAbstract
{
    public function truncate($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
                'text' => '',
                'offset' => 0,
                'length' => 100,
                'pad' => ' ...')
        );

        $config->endstr = (KHelperString::strlen($config->text) < $config->length) ? '' : $config->pad;

        return KHelperString::substr(strip_tags($config->text), $config->offset, $config->length) . $config->pad;
    }
}