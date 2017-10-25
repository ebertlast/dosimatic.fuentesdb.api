<?php
use App\Model\UsuarioModel;
use App\Lib\Response;

$app->group('/usuarios/', function () {
    $this->get('', function ($req, $res, $args) {
        try{
            $conf = $this->get('settings');
            $dbhost = $conf['database_default']['dbhost'];  
            $dbname = $conf['database_default']['dbname'];  
            $dbuser = $conf['database_default']['dbuser'];  
            $dbpasswd = $conf['database_default']['dbpasswd'];  
            
            $model = new UsuarioModel($dbhost, $dbname, $dbuser, $dbpasswd);
        }catch(Exception $e){
            $response = new Response();
            $response -> SetResponse (false, $e->getMessage());
            return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $response
                )
            );
        }

        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $model->GetAll()
            )
        );
    });
});