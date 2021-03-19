<?php
namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente as Cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClienteRequest;
use App\Http\Resources\ClienteResource;

use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','cadastar']]);
    }

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
    public function listAll()
    {
        $cliente = Cliente::all();

        return (new ClienteResource($cliente))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Post(
     *     tags={"cliente"},
     *     summary="Criar um cliente",
     *     description="Retorna um array de objetos do tipo cliente",
     *     path="/v1/cliente",
     *     @OA\Response(
     *        response="201", 
     *        description="Success"
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden"
     *     ),
     *     @OA\Response(
     *        response=409,
     *        description="Conflict"
     *     )
     * ),
     * 
    */
    public function cadastrar(ClienteRequest $request)
    {
        try 
        {
            $cliente = new Cliente;
            $cliente->username = $request->input('username');
            $cliente->password = app('hash')->make($request->input('password'));
            $cliente->nome     = $request->input('nome'); 
            $cliente->email    = $request->input('email');
            $cliente->telefone     = $request->input('telefone'); 
            $cliente->save();

            return (new ClienteResource($cliente))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

        } 
        catch (\Exception $e) 
        {
            return response()->json( [
                'entity' => 'cliente', 
                'action' => 'create', 
                'result' => 'failed'
            ], 409);
        }
    }

}