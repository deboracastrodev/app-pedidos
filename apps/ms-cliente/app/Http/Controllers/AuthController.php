<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cliente as cliente;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Store a new cliente.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string|unique:clientes',
            'password' => 'required|confirmed',
        ]);

        try 
        {
            $cliente = new cliente;
            $cliente->username= $request->input('username');
            $cliente->password = app('hash')->make($request->input('password'));
            $cliente->save();

            return response()->json( [
                'entity' => 'cliente', 
                'action' => 'create', 
                'result' => 'success'
            ], 201);

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
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {			
            return response()->json(['message' => 'Não autorizado'], 401);
        }
        return $this->respondWithToken($token);
    }
    
    /**
     * Get cliente details.
     *
     * @param  Request  $request
     * @return Response
     */	 	
    public function me()
    {
        return response()->json(auth()->user());
    }
}