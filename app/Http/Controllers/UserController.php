<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Sarmento
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::select('id', 'name', 'email')->paginate('2');

        return [
            'status' => 200,
            'menssagem' => 'Usuários encontrados!!',
            'user' => $user
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'menssagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    /**
 * Update the specified resource in storage.
 */
public function update(UserUpdateRequest $request, string $id)
{
    $user = User::find($id);

    if (is_null($user)) {
        return response()->json([
            'status' => 404,
            'mensagem' => 'Desculpe, não conseguimos encontrar o usuário para atualização.',
        ]);
    }

    // Atualiza o usuário com os dados recebidos
    $user->update($request->only(['name', 'email', 'password']));

    return response()->json([
        'status' => 200,
        'mensagem' => 'Atualização concluída! O usuário está atualizado.',
        'user' => $user
    ]);
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $user = User::find($id);

    if (is_null($user)) {
        return response()->json([
            'status' => 404,
            'mensagem' => 'Não conseguimos encontrar o usuário para remoção.',
        ]);
    }

    // Deleta o usuário
    if ($user->delete()) {
        return response()->json([
            'status' => 200,
            'mensagem' => 'Usuário removido com sucesso! Até a próxima!',
        ]);
    }

    return response()->json([
        'status' => 500,
        'mensagem' => 'Algo deu errado ao tentar remover o usuário. Tente novamente.',
    ]);
}