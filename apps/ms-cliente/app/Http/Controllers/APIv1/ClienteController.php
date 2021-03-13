<?php
namespace App\Http\Controllers\APIv1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * @OA\Info(title="Api microserviço MS-Cliente", version="0.1")
     */

    /**
     * @OA\Get(
     *     tags={"cliente"},
     *     summary="Retorna uma lista de clientes",
     *     description="Retorna um array de objetos do tipo cliente",
     *     path="/v1/cliente",
     *     @OA\Response(response="200", description="Uma lista de clientes"),
     * ),
     * 
    */
    public function index() {
        return $this->json_encode('teste');
    }

}