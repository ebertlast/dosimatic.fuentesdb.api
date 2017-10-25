<?php
namespace App\Lib;
class Message
{
    protected $emailer;
    
    public function __construct($emailer)
    {
        $this->emailer = $emailer;
    }
    
    public function to($address, $name='')
    {
        if($name!==''){
            $this->emailer->addAddress($address,$name);   
        }else{
            $this->emailer->addAddress($address);   
        }
    }
    public function subject($subject)
    {
        $this->emailer->Subject = $subject;
    }
    public function body($body)
    {
        $this->emailer->Body = $body;
    }

    // Este es el cuerpo en texto plano para los clientes de correo no HTML
    public function altBody($body) 
    {
        $this->emailer->AltBody = $body;
    }
    
    public function from($email, $name)     // if you want to add different sender email in emailer call.
    {
        $this->emailer->From = $email;
        if(isset($name)){
            $this->emailer->setFrom($email, $name); // if you want different sender email in mailer call function
        }
    }
    public function fromName($fromName) // if you want to add different sender name in emailer call.
    {
        $this->emailer->FromName = $fromName;
    }

    public function addAddress($address, $name='')
    {
        if($name!==''){
            $this->emailer->addAddress($address,$name);   
        }else{
            $this->emailer->addAddress($address);   
        }
    }
    public function addReplyTo($address, $name='')
    {
        if($name!==''){
            $this->emailer->addReplyTo($address,$name);   
        }else{
            $this->emailer->addReplyTo($address);   
        }
    }
    public function addCC($address, $name='')
    {
        if($name!==''){
            $this->emailer->addCC($address,$name);   
        }else{
            $this->emailer->addCC($address);   
        }
    }
    public function addBCC($address, $name='')
    {
        if($name!==''){
            $this->emailer->addBCC($address,$name);   
        }else{
            $this->emailer->addBCC($address);   
        }
    }

    public function addAttachment($urlFile, $optionalName='')
    {
        if($optionalName!==''){
            $this->emailer->addAttachment($urlFile, $optionalName);   
        }else{
            $this->emailer->addAttachment($urlFile);   
        }
    }
    

}