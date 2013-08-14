<?php
/**
 * @version     $Id: article.php 3314 2012-02-10 02:14:52Z johanjanssens $
 * @category    Nooku
 * @package     Nooku_Server
 * @subpackage  Articles
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Article Element Class
 *
 * @author      Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @category    Nooku
 * @package     Nooku_Server
 * @subpackage  Articles
 */

class JElementArticle extends JElement
{
    /**
     * Element name
     *
     * @access  protected
     * @var     string
     */
    var $_name = 'Article';

    function fetchElement($name, $value, &$node, $control_name)
    {
        global $mainframe;

        $db         =& JFactory::getDBO();
        $doc        =& JFactory::getDocument();
        $template   = $mainframe->getTemplate();
        $fieldName  = $control_name.'['.$name.']';
      //  $article =& JTable::getInstance('#__maudhui_articles');

        $article_model = KService::get('com://site/maudhui.model.article');

        if ($value) {
            $article = $article_model->id($value)->getItem();
        } else {
            $article = (object) array();
            $article->title = JText::_('Select an Article');
        }

        $js = "
        function jSelectArticle(id, title, object) {
            document.getElementById(object + '_id').value = id;
            document.getElementById(object + '_name').value = title;
            SqueezeBox.close();
        }";
        $doc->addScriptDeclaration($js);

        $link = 'index.php?option=com_maudhui&view=articles&layout=element&tmpl=component&object='.$name;

        JHTML::_('behavior.modal', 'a.modal');
        $html = "\n".'<div style="float: left;"><input style="background: #ffffff;" type="text" id="'.$name.'_name" value="'.htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8').'" disabled="disabled" /></div>';
//      $html .= "\n &nbsp; <input class=\"inputbox modal-button\" type=\"button\" value=\"".JText::_('Select')."\" />";
        $html .= '<div class="button2-left"><div class="blank"><a class="modal" title="'.JText::_('Select an Article').'"  href="'.$link.'" rel="{handler: \'iframe\', size: {x: 650, y: 375}}">'.JText::_('Select').'</a></div></div>'."\n";
        $html .= "\n".'<input type="hidden" id="'.$name.'_id" name="'.$fieldName.'" value="'.(int)$value.'" />';

        return $html;
    }
}