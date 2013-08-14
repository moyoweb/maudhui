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

echo KService::get('com://admin/maudhui.dispatcher', array('request'=>
    array('view' => KRequest::get('request.view','cmd','articles'))))->dispatch();