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

class ComMaudhuiControllerArticle extends ComDefaultControllerDefault
{
    /**
     * Resource Controller Constructor
     *
     * @param KConfig $config
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        $this->registerCallback(array('before.add', 'before.edit'), array($this, 'beforeAdd'));
    }

    /**
     * Run on before add
     *
     * @param KCommandContext $context
     * @return bool
     */
    public function beforeAdd(KCommandContext $context)
    {
        // Setup demographic image data
        if(KRequest::get('files.image_image_file.tmp_name', 'raw')) {
            $context->data->image_image_file = KRequest::get('files.image_image_file.tmp_name', 'raw');
            $context->data->image_image_path = KRequest::get('files.image_image_file.name', 'koowa:filter.filename');
        }

        return true;
    }

    /**
     * Initialise Class
     *
     * @param KConfig $config
     */
    protected function _initialize(KConfig $config)
	{
		$config->append(array(
        	'behaviors' => array(
        		'com://admin/activities.controller.behavior.loggable',
        	)
        ));

        parent::_initialize($config);
    }

    /**
     * Add Action
     *
     * @param KCommandContext $context
     * @return KDatabaseRow
     */
    protected  function _actionAdd(KCommandContext $context)
    {
        if(is_numeric($context->data->maudhui_type_id))
        {
            $type = $this->getService('com://admin/maudhui.model.types')->id($context->data->maudhui_type_id)->getItem();
            $context->data->type = $type->slug;
            $context->data->cck_fieldset_id = $type->cck_fieldset_id;
            $context->data->template = $type->template;

            $context->data->content = $context->data->content;

            if(isset($context->data->image_image_file))
                $context->data->image = $this->uploadImage($context, 'image', 'article-images');

        }

        return parent::_actionAdd($context);
    }

    /**
     * Edit Action
     *
     * @param KCommandContext $context
     * @return KDatabaseRowset
     */
    protected  function _actionEdit(KCommandContext $context)
    {
        if(is_numeric($context->data->maudhui_type_id))
        {
            $type = $this->getService('com://admin/maudhui.model.types')->id($context->data->maudhui_type_id)->getItem();
            $context->data->type = $type->slug;
            $context->data->cck_fieldset_id = $type->cck_fieldset_id;
            $context->data->template = $type->template;

            //$context->data->content = htmlentities($context->data->content);

            if(isset($context->data->image_image_file))
                $context->data->image = $this->uploadImage($context, 'image', 'article-images');
        }

        return parent::_actionEdit($context);
    }

    /**
     * Upload an iamge
     *
     * @param $context
     * @param $type
     * @param $container
     * @return null|string
     */
    private function uploadImage($context, $type, $container)
    {
        $controller = $this->getService('com://admin/files.controller.file', array('request' => array('container' => $container)));

        try {

            $controller->add(array(
                'file' => $context->data->{$type.'_image_file'},
                'path' => $context->data->{$type.'_image_path'},
                'name' => $context->data->{$type.'_image_path'},
                'parent' => $context->data->{$type.'_image_parent'},
                'overwrite' => true,
            ));

            // Fetch file path from the container
            $path = $controller->getModel()->getItem()->container->relative_path;

            return $path .'/'. $context->data->{$type.'_image_path'};

        } catch (KControllerException $e) {

            // TODO: Catch and properly handel different error types.
            // TODO: Disable overwrite and handel error verbosely
            $context->setError($e);

            return null;
        }
    }
}
