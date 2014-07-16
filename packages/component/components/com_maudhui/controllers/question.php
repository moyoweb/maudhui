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

class ComMaudhuiControllerQuestion extends ComMaudhuiControllerDefault
{
    /**
     * @return array|KConfig|null
     */
    public function getRequest()
    {
        $this->_request->type = 'question';

        return $this->_request;
    }
}