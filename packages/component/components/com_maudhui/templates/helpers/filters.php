<?php
/**
 * Com ......
 *
 * @author      Kyle Waters <development@organic-development.com>
 * @category    Com_***
 * @package     ******
 * @uses        Com_
 */
 
 defined('KOOWA') or die('Protected resource');

class ComMaudhuiTemplateHelperFilters extends KTemplateHelperSelect
{
    public function dateLookback($config = array())
    {

        $config = new KConfig($config);
        $config->append(array(
            'options' 	=> array(),
            'name'   	=> 'id',
            'attribs'	=> array('size' => 1),
            'selected'	=> null,
            'translate'	=> false
        ));




        $one_weeks_ago      = date( 'Y-m-d 00:00:00', strtotime('-1 week', time()));
        $two_weeks_ago      = date( 'Y-m-d 00:00:00', strtotime('-2 weeks', time()));
        $one_month_ago      = date( 'Y-m-d 00:00:00', strtotime('-1 month', time()));
        $three_months_ago   = date( 'Y-m-d 00:00:00', strtotime('-3 months', time()));
        $six_months_ago     = date( 'Y-m-d 00:00:00', strtotime('-6 months', time()));

        $options = array();
        $options[] = array('text' => 'Last Week',     'value' => urlencode($one_weeks_ago));
        $options[] = array('text' => 'Last 2 Weeks',  'value' => urlencode($two_weeks_ago));
        $options[] = array('text' => 'Last Month',    'value' => $one_month_ago);
        $options[] = array('text' => 'Last 3 Months', 'value' => $three_months_ago);
        $options[] = array('text' => 'Last 6 Months', 'value' => $six_months_ago);

        $config->append(array('options' => $options));

        return $this->optionlist($config);

    }
}