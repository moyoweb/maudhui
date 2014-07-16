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

class ComMaudhuiNotifierInstant extends ComNotificationsNotifierDefault
{
    /**
     * Send add notification
     *
     * @param $context
     * @return bool
     */
    public function onAfterAddNotification(KCommandContext $context)
    {

//        require_once(dirname(__FILE__)."/../../../../libraries/predis/autoload.php");
//        Predis\Autoloader::register();
//
//        $redis = new Predis\Client(array(
//            "scheme" => "tcp",
//            "host" => "127.0.0.1",
//            "port" => 6379
//        ));
//
//        $parent = $this->getParent($context);
//
//        $title = 'New reply to: ' . $parent->title;
//
//        $notification = new KConfig(array(
//            "participants" => $context->data->participants,
//            "title"   => $title,
//            "message" => $context->data->content));
//
//        $notification = json_encode(KConfig::unbox($notification));
//
//        $redis->publish("notify", $notification);

    }


    private function getParent(KCommandContext $context)
    {
        $item = $context->caller->getModel()->getItem();
        if($item->isRelationable()) return $item->getParent();

        return false;
    }
}