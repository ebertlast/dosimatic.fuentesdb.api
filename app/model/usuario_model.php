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

    public function GetAll()
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("CALL pa_usuarios()");
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

}