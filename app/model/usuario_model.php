<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;
use App\Lib\Tokens;

use Exception;

class UsuarioModel
{
    private $db;
    public $response;

    private $servidor;
    private $dbbase;

    public function __CONSTRUCT($servidor,$dbbase,$usuario,$clave) {
        try{
            $this->response = new Response();
            $this->db = Database::StartUp($servidor,$dbbase,$usuario,$clave);
            $this->servidor = $servidor;
            $this->dbbase = $dbbase;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function Get($usuario='')
    {
		try
		{
			$stm = $this->db->prepare("CALL pa_usuarios('$usuario')");
			$stm->execute();
            
			$this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }

    public function Login($usuario,$clave)
    {
		try
		{
            if($usuario=='' || $clave==''){
                $this->response->setResponse(false, "Debe indicar usuario y clave para ingresar al sistema");
                return $this->response;
            }
            
            // $this->response->setResponse(false, "CALL pa_ingresar('$usuario','$clave')");
            // return $this->response;
            
            $stm = $this->db->prepare("CALL pa_ingresar('$usuario','$clave')");
			$stm->execute();
            
            $this->response->setResponse(true);
            
            $result = array();
            foreach ($stm->fetchAll() as $registro) {
                
                // ----------------- Sección de Token
                $jwt = new Tokens();
                $info = $registro;
                $info['clave'] = $clave;
                $token = $jwt->encode($info);
                $this->response->SetToken($token);
                // ----------------- Fin Sección de Token
                
                $registro['token'] = $token;
                $result=$registro;
                
            }

            $this->response->result = $result;
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }
}