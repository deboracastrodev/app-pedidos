<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{    
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
        ];
    }
}