<?php
/**
 * ComMaudhui
 *
 * @author      Dave Li <dave@moyoweb.nl>
 * @category    Nooku
 * @package     Socialhub
 * @subpackage  ComMaudhui
 * @uses        Com_cck, com_taxonomy
 */

defined('KOOWA') or die('Protected resource');

class ComMaudhuiControllerUser extends ComProfileControllerDefault
{
    /**
     * @return array|KConfig|null
     */
    public function getRequest()
    {
        $this->_request->id = JFactory::getUser()->id;

        return $this->_request;
    }
}