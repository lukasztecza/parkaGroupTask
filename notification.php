<?php
/**
 * 4. Design a php class or classes.
 */

/**
 * Notifcation class
 */
class Notification
{
    /**
     * @var string
     */
    private $sender;
    
    /**
     * @var string
     */
    private $recipient;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var string
     */
    private $content;
    
    /**
     * Contructor for notificaiton object
     * @param string $recipient recipient of the notificaiton
     * @param string $content content of the notificaiton
     */
    public function __construct($sender, $recipient, $title, $content) {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->title = $title;
        $this->content = $content;
    }
    
    /**
     * Get sender of the notification
     * @return string sender of the notificaiton
     */
    public function getSender() {
        return $this->sender;
    }
    
    /**
     * Get recipient of the notification
     * @return string recipient of the notificaiton
     */
    public function getRecipient() {
        return $this->recipient;
    }

    /**
     * Get title of the notification
     * @return string title of the notificaiton
     */
    public function getTitle() {
        return $this->title;
    }
    
    /**
     * Get content of the notification
     * @return string content of the notificaiton
     */
    public function getContent() {
        return $this->content;
    }  
}


/**
 * Media class
 */
abstract class Media
{
    /**
     * This method has to be implemented
     * @param Notification $notification Notification object
     */
    public abstract function sendNotification($notification);
}

/**
 * Class to send email notification
 */
class EmailMedia extends Media
{
   /**
    * Send notification
    * @param Notification $notification Notification object
    */
   public function sendNotification($notification)
   {
        $headers = "From: <" . $notification->getSender() . ">\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8";
        mail(
            $notification->getRecipient(),
            $notification->getTitle(),
            $notification->getContent(),
            $headers
        );
   }
}

/**
 * Class to send sms notification
 */
class SmsMedia extends Media
{
   /**
    * Send notification
    * @param Notification $notification Notification object
    */
   public function sendNotification($notification)
   {
       // send sms notification
   }
}

/**
 * Class to send irc notification
 */
class IrcMedia extends Media
{
   /**
    * Send notification
    * @param Notification $notification Notification object
    */
   public function sendNotification($notification)
   {
       // send irc notification
   }
}

/**
 * Class to handle notification sending
 */
class NotificationHandler {
    /**
     * @var Media media object 
     */
    private $media;

    /**
     * Set media which is supposed to be use by handler
     * @param Media $media media object
     */
    public function setMedia($media) {
        $this->media = $media;
    }
    
    /**
     * Send notification using actually selected media
     * @param Notification $notification notification object
     */
    public function sendNotification($notification) {
        $this->media->sendNotification($notification);
    }
}


/** Sample usage of notification handler */
$emailMedia = new EmailMedia();
//$smsMedia = new SmsMedia();
//$ircMedia = new IrcMedia();
$notification = new Notification('lukasz', 'lukasztecza.pl@gmail.com', 'title of notification', 'This is some notification to lukasz');
$notificationHandler = new NotificationHandler();
$notificationHandler->setMedia($emailMedia);
$notificationHandler->sendNotification($notification);
echo 'notification has been sent';