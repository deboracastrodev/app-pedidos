<?php
namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * @OA\Info(title="Documentação para MS-Cliente", version="0.1",
     * @OA\Contact(email="deboracastro.pm@gmail.com"))
     */

    /**
     * @OA\Get(
     *     tags={"cliente"},
     *     summary="Retorna uma lista de clientes",
     *     description="Retorna um array de objetos do tipo cliente",
     *     path="/v1/cliente",
     *     @OA\Response(
     *        response="200", 
     *        description="Success"
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *     )
     * ),
     * 
    */
    public function listAll() {
        return Cliente::all();
    }

}