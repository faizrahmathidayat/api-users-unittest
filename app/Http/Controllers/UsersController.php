<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserStoreUpdateRequest;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="User API",
 *      description="Dokumentasi API User menggunakan Swagger di Laravel",
 *      @OA\Contact(
 *          email="support@example.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Server API"
 * )
 */

class UsersController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Mendapatkan daftar semua pengguna",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Daftar pengguna",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return $this->successResponse('Berhasil mengambil data', User::all());
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Mendapatkan pengguna berdasarkan ID",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID Pengguna",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pengguna berdasarkan ID",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/DataNotFoundError")
     *     )
     * )
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user) {
            return $this->successResponse('Berhasil mengambil data', $user);
        }
        return $this->errorResponse('Data tidak ditemukan', 404);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Menambahkan pengguna baru",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil menambahkan data",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Data yang diberikan tidak valid",
     *         @OA\JsonContent(ref="#/components/schemas/StoreUpdateValidationError")
     *     ),
     * )
     */
    public function store(UserStoreUpdateRequest $request)
    {
        $user = User::create($request->all());
        return $this->successResponse('Berhasil menambahkan data', $user);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Menambahkan pengguna baru",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID Pengguna",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengubah data",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Data yang diberikan tidak valid",
     *         @OA\JsonContent(ref="#/components/schemas/StoreUpdateValidationError")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/DataNotFoundError")
     *     )
     * )
     */
    public function update(UserStoreUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $this->successResponse('Berhasil mengubah data', $user);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Menghapus pengguna berdasarkan ID",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID Pengguna",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pengguna berdasarkan ID",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/DataNotFoundError")
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();
            return $this->successResponse('Berhasil menghapus data');
        }
        return $this->errorResponse('Data tidak ditemukan', 404);
    }
}
