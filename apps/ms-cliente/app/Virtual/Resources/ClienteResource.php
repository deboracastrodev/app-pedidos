<?php

/**
 * @OA\Schema(
 *     title="ClienteResource",
 *     description="Cliente resource",
 *     @OA\Xml(
 *         name="ClienteResource"
 *     )
 * )
 */
class ClienteResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Cliente[]
     */
    private $data;
}