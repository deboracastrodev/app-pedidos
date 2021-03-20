<?php
namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente as Cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\ClienteLoginRequest;
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
        $clientes = Cliente::all();

        return (new ClienteResource($clientes))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

        /**
     * @OA\Get(
     *      path="v1/cliente/{id}",
     *      operationId="getById",
     *      tags={"cliente"},
     *      summary="Busca dados do cliente",
     *      description="Retorna cliente data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Cliente id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function getById(Int $id)
    {
        $cliente = Cliente::findOrFail($id);

        return (new ClienteResource($cliente))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     tags={"cliente"},
     *     summary="Criar um cliente",
     *     description="Retorna um array de objetos do tipo cliente",
     *     path="/v1/cliente",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="username", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="nome", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *          ),
     *     ),
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
    
    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */	 
    public function login(ClienteLoginRequest $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()
            ->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

}