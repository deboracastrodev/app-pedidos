<?php

/**
 * @OA\Schema(
 *     title="Cliente",
 *     description="Cliente model",
 *     @OA\Xml(
 *         name="Cliente"
 *     )
 * )
 */
class Cliente
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Nome",
     *      description="Nome do cliente",
     *      example="João Silva"
     * )
     *
     * @var string
     */
    public $nome;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="E-mail do cliente",
     *      example="joao@mail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Telefone",
     *      description="Telefone do cliente",
     *      example="(99) 9999-9999"
     * )
     *
     * @var string
     */
    public $telefone;

    /**
     * @OA\Property(
     *      title="Username",
     *      description="Username do cliente",
     *      example="joao.silva"
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *     title="Deleted at",
     *     description="Deleted at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $deleted_at;

}