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

defined('KOOWA') or die('Protected resource');

class ComMaudhuiDatabaseTableArticles extends ComMaudhuiDatabaseTableDefault
{
    /**
     * Initializes the options for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param 	object 	An optional KConfig object with configuration options
     * @return void
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'filters' => array(
                'description' => array('html', 'tidy')
            )
        ));

        parent::_initialize($config);
    }
}