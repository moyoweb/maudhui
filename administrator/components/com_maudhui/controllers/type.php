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

class ComMaudhuiControllerType extends ComDefaultControllerDefault
{
	protected function _initialize(KConfig $config)
	{
		$config->append(array(
        	'behaviors' => array(
        		'com://admin/activities.controller.behavior.loggable',
        	)
        ));

        parent::_initialize($config);
    }

    protected  function _actionAdd(KCommandContext $context)
    {
        $filter = $this->getService('koowa:filter.slug');

        $context->data->template = $filter->sanitize($context->data->title);

        return parent::_actionAdd($context);
    }
}