<?php
namespace App\Lib;
use App\Lib\Helper;
use PHPMailer\PHPMailer\Exception;
class Emailer
{
    protected $view;
    
    protected $emailer;
    

    
    public function __construct($view, $emailer)
    {
        $this->view = $view;
        $this->emailer = $emailer;
    }

    
    public function send($template, $data, $callback)
    {
        // try{
            $message = new Message($this->emailer);
            // $message->body($this->view->fetch($template, $data));
            // $message->body('This is the HTML message body <b>in bold!</b>');
            $helper = new Helper;
            $message->body($helper->printf_array(file_get_contents($template),$data,'%s'));
            call_user_func($callback, $message);
            $this->emailer->send();
        // }catch(Exception $e){
            // throw $e;
        // }
    }
}