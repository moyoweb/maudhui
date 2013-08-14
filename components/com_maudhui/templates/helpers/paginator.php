<?php

class ComMaudhuiTemplateHelperPaginator extends KTemplateHelperSelect
{
	/**
	 * Initializes the options for the object
	 *
	 * Called from {@link __construct()} as a first step of object instantiation.
	 *
	 * @param 	object 	An optional KConfig object with configuration options
	 * @return  void
	 */
	protected function _initialize(KConfig $config)
	{
	    if($config->total != 0)
        {
            $config->limit  = (int) max($config->limit, 1);
            $config->offset = (int) max($config->offset, 0);

            if($config->limit > $config->total) {
                $config->offset = 0;
            }

            if(!$config->limit)
            {
                $config->offset = 0;
                $config->limit  = $config->total;
            }

            $config->count  = (int) ceil($config->total / $config->limit);

            if($config->offset > $config->total) {
                $config->offset = ($config->count-1) * $config->limit;
            }

            $config->current = (int) floor($config->offset / $config->limit) + 1;
        }
        else
        {
            $config->limit   = 0;
            $config->offset  = 0;
            $config->count   = 0;
            $config->current = 0;
        }

       	parent::_initialize($config);
    }

	/**
	 * Render item pagination
	 *
	 * @param 	array 	An optional array with configuration options
	 * @return	string	Html
	 * @see  	http://developer.yahoo.com/ypatterns/navigation/pagination/
	 */
	public function pagination($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'total'      => 0,
			'display'    => 4,
			'offset'     => 0,
			'limit'	     => 0,
			'attribs'    => array('onchange' => 'this.form.submit();'),
		    'show_limit' => true,
		    'show_count' => true
		));

		$this->_initialize($config);

        $html = '';

        $html .= '<div class="row-fluid paginator">';

        if($config->show_count) {
            $html .= '<div class="span2 count"> '.JText::_('Page').' '.$config->current.' '.JText::_('of').' '.$config->count.'</div>';
        }

		$html .= '<div class="span7 pagination">';

        $html .=  $this->_pages($this->_items($config));

		$html .= '</div>';

        if($config->show_limit) {
            $html .=
                '<div class="span3 limit">'
                .'<label for="limit">'.JText::_('Display').'</label>'
                .$this->limit($config)
                .'</div>';
        }

        $html .= '</div>';

		return $html;
	}

	/**
	 * Render a select box with limit values
	 *
	 * @param 	array 	An optional array with configuration options
	 * @return 	string	Html select box
	 */
	public function limit($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'limit'	  	=> 0,
			'attribs'	=> array(
                'id'    => 'limit',
                'class' => 'input-small'
            ),
		));

		$html = '';

		$selected = '';
		foreach(array(10 => 10, 20 => 20, 50 => 50, 100 => 100) as $value => $text)
		{
			if($value == $config->limit) {
				$selected = $value;
			}

			$options[] = $this->option(array('text' => $text, 'value' => $value));
		}

		$html .= $this->optionlist(array('options' => $options, 'name' => 'limit', 'attribs' => $config->attribs, 'selected' => $selected));
		return $html;
	}

	/**
	 * Render a list of pages links
	 *
	 * @param	araay 	An array of page data
	 * @return	string	Html
	 */
	protected function _pages($pages)
	{
		$html = '<ul>';

		$html .= $this->_link($pages['first'], '&larr;');
		$html .= $this->_link($pages['previous'], '&laquo;');

		foreach($pages['pages'] as $page) {
			$html .= $this->_link($page, $page->page);
		}

		$html .= $this->_link($pages['next'], '&raquo;');
		$html .= $this->_link($pages['last'], '&rarr;');

		$html .= '</ul>';
		return $html;
	}

	/**
	 * Render a page link
	 *
	 * @param	object The page data
	 * @param	string The link title
	 * @return	string	Html
	 */
	protected function _link($page, $title)
	{
		$url   = clone KRequest::url();
		$query = $url->getQuery(true);

		$query['limit']  = $page->limit;
		$query['offset'] = $page->offset;

		$url->setQuery($query);

        if(!$page->active && $page->current) {
            $html = '<li class="active"><a href="#">'.JText::_($title).'</a></li>';
        } elseif (!$page->active && !$page->current) {
            $html = '<li class="disabled"><a class="disabled" href="#">'.JText::_($title).'</a></li>';
        } else {
            $html = '<li><a href="'.$url.'">'.JText::_($title).'</a></li>';
        }

		return $html;
	}

 	/**
     * Get a list of pages
     *
     * @return  array   Returns and array of pages information
     */
    protected function _items(KConfig $config)
    {
        $elements  = array();
        $prototype = new KObject();
        $current   = ($config->current - 1) * $config->limit;

        // First
        $page    = 1;
        $offset  = 0;
        $active  = $offset != $config->offset;
        $props   = array('page' => 1, 'offset' => $offset, 'limit' => $config->limit, 'current' => false, 'active' => $active );
        $element = clone $prototype;
        $elements['first'] = $element->set($props);

        // Previous
        $offset  = max(0, ($config->current - 2) * $config->limit);
        $active  = $offset != $config->offset;
        $props   = array('page' => $config->current - 1, 'offset' => $offset, 'limit' => $config->limit, 'current' => false, 'active' => $active);
        $element = clone $prototype;
        $elements['previous'] = $element->set($props);

        // Pages
        $elements['pages'] = array();
        foreach($this->_offsets($config) as $page => $offset)
        {
            $current = $offset == $config->offset;
            $props = array('page' => $page, 'offset' => $offset, 'limit' => $config->limit, 'current' => $current, 'active' => !$current);
            $element    = clone $prototype;
            $elements['pages'][] = $element->set($props);
        }

        // Next
        $offset  = min(($config->count-1) * $config->limit, ($config->current) * $config->limit);
        $active  = $offset != $config->offset;
        $props   = array('page' => $config->current + 1, 'offset' => $offset, 'limit' => $config->limit, 'current' => false, 'active' => $active);
        $element = clone $prototype;
        $elements['next'] = $element->set($props);

        // Last
        $offset  = ($config->count - 1) * $config->limit;
        $active  = $offset != $config->offset;
        $props   = array('page' => $config->count, 'offset' => $offset, 'limit' => $config->limit, 'current' => false, 'active' => $active);
        $element = clone $prototype;
        $elements['last'] = $element->set($props);

        return $elements;
    }

    /**
     * Get the offset for each page, optionally with a range
     *
     * @return  array   Page number => offset
     */
    protected function _offsets(KConfig $config)
    {
        if($display = $config->display)
        {
            $start  = (int) max($config->current - $display, 1);
            $start  = min($config->count, $start);
            $stop   = (int) min($config->current + $display, $config->count);
        }
        else // show all pages
        {
            $start = 1;
            $stop = $config->count;
        }

        $result = array();
        if($start > 0)
        {
            foreach(range($start, $stop) as $pagenumber) {
                $result[$pagenumber] =  ($pagenumber-1) * $config->limit;
            }
        }

        return $result;
    }
}