<?php

namespace App\Docs\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreUpdateValidationError",
 *     title="Validation Error",
 *     description="Schema untuk response validasi gagal",
 *     @OA\Property(property="code", type="integer", example=422),
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Data yang diberikan tidak valid"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         @OA\Property(
 *             property="name",
 *             type="array",
 *             @OA\Items(type="string", example="Nama tidak boleh kosong.")
 *         ),
 *         @OA\Property(
 *             property="email",
 *             type="array",
 *             @OA\Items(type="string", example="Email tidak boleh kosong.")
 *         ),
 *         @OA\Property(
 *             property="age",
 *             type="array",
 *             @OA\Items(type="string", example="Usia tidak boleh kosong.")
 *         )
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="DataNotFoundError",
 *     title="Data Not Found Error",
 *     description="Schema untuk response validasi gagal",
 *     @OA\Property(property="code", type="integer", example=404),
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Data tidak ditemukan"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *     )
 * )
 */
class ValidationErrorSchema {}
