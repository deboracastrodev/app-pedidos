<?php

/**
 * @OA\Schema(
 *      title="Store Cliente request",
 *      description="Store Cliente request body data",
 *      type="object",
 *      required={"username"},
 * ),
 */
class StoreProjectRequest
{
    /**
     * @OA\Property(
     *      title="Nome",
     *      description="Nome do cliente",
     *      example="João Silva",
     * ),
     *
     * @var string
     */
    public $nome;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="E-mail do cliente",
     *      example="joao@mail.com",
     * ),
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Telefone",
     *      description="Telefone do cliente",
     *      example="(99) 9999-9999",
     * ),
     *
     * @var string
     */
    public $telefone;

    /**
     * @OA\Property(
     *      title="Username",
     *      description="Username do cliente",
     *      example="joao.silva",
     * ),
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password do cliente",
     *      example="y&hdy98",
     * ),
     *
     * @var string
     */
    public $password;
}