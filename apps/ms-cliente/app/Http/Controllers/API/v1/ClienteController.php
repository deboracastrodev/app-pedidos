<?php
namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente as Cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClienteRequest as ClienteRequest;
use App\Http\Requests\ClienteLoginRequest as ClienteLoginRequest;
use App\Http\Requests\ClienteEdicaoRequest as ClienteEdicaoRequest;
use App\Http\Resources\ClienteResource as ClienteResource;
use App\Http\Resources\ClienteCollection;

use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('authapi', ['except' => ['login','cadastar']]);
    // }

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
    public function listarTodos()
    {
        $clientes = Cliente::all();

        return (new ClienteCollection($clientes))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="v1/cliente/{id}",
     *      operationId="buscaPorId",
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
    public function buscaPorId(Int $id)
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
     *              @OA\Property(property="password_confirmation", type="string"),
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
            $cliente->username   = $request->input('username');
            $cliente->password   = app('hash')->make($request->input('password'));
            $cliente->nome       = $request->input('nome'); 
            $cliente->email      = $request->input('email');
            $cliente->telefone   = $request->input('telefone'); 
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
        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()
            ->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    /**
     * @OA\Put(
     *      path="v1/cliente/{id}",
     *      operationId="editar",
     *      tags={"cliente"},
     *      summary="Edita dados de um cliente",
     *      description="Retorna dados do cliente atualizados",
     *      @OA\Parameter(
     *          name="id",
     *          description="Cliente id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="nome", type="string"),
     *              @OA\Property(property="telefone", type="string"),
     *          ),
     *     ),
     *      @OA\Response(
     *          response=202,
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function editar(ClienteEdicaoRequest $request, Int $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->nome       = $request->input('nome'); 
        $cliente->email      = $request->input('email');
        $cliente->telefone   = $request->input('telefone'); 
        $cliente->save();

        return (new ClienteResource($cliente))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="v1/cliente/{id}",
     *      operationId="delete",
     *      tags={"cliente"},
     *      summary="Deleta um cliente",
     *      description="Deletes um cliente de acordo com o id enviado",
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
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function delete(Request $request)
    {
        $cliente = Cliente::findOrFail($request->id);
        $cliente->delete();

        return response('Cliente deletado com sucesso!', Response::HTTP_NO_CONTENT);
    }

}