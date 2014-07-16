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

class ComMaudhuiControllerReply extends ComMaudhuiControllerDefault
{
    /**
     * @return array|KConfig|null
     */
    public function getRequest()
    {
        $this->_request->type = 'reply';

        return $this->_request;
    }
}