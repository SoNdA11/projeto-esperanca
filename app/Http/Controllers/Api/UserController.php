<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    /**
     * Retorna uma lista paginada de usuários
     *
     * Esse método recupera uma lista paginada de usuários do banco de dados
     * e a retorna como uma resposta JSON.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() : JsonResponse
    {
        // Recupera os usuários do banco de dados, ordenados pelo id em ordem decrescente, paginados
        $users = User::orderBy('id', 'DESC')->paginate(2);
        // Retorna os usuários recuperados como uma repostas JSON
        return response()->json([
            'status' => true,
            'users' => $users,
            ], 200);
    }



    /**
     * Exibe os detalhes de um usuário específico
     *
     * Este método retorna os detalhes de um usuário especifico em formato JSON
     *
     * @param  \App\Models\User  $user O objeto do usuário a ser exibido
     * @return \Illuminate\Http\JsonResponse
     */

    public function show(User $user): JsonResponse
    {
        // Retorna os usuários recuperados como uma repostas JSON
        return response()->json([
            'status' => true,
            'user' => $user,
            ], 200);
    }






    /**
     * Cria um novo usuário ou Cadastrar
     * @param  \App\Http\Requests\UserRequest  $request O objeto de requisição contendo os dados do usuário
     * @return \Illuminate\Http\JsonResponse
    */
    public function store(UserRequest $request): JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        Try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Operação realizada com sucesso
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário cadastrado com sucesso!",
                ], 201);

        }catch(Exception $e){

            // Operação não concluída com êxito
            DB::rollBack();

            // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "Usuário não cadastrado!",
                ], 400);

        }
    }










    /**
     * Atualizar os dados de um usuário existente
     *
     * @param  \App\Http\Requests\UserRequest  $request O objeto de requisição contendo os dados do usuário
     * @param  \App\Models\User  $user O objeto do usuário a ser atualizado
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {

        DB::beginTransaction();

        try{
            $user -> update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

         // Operação realizada com sucesso
         DB::commit();
        return response()->json([
        'status' => true,
        'user' => $user,
        'message' => "Usuário editado com sucesso!",
        ], 200);


        }catch(Exception $e){
            // Operação não concluída com êxito
            DB::rollBack();

            // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "Usuário não editado!",
                ], 400);
        }
        return response()->json([
            'status' => true,
            'user' => $request,
            'message' => "Usuário editado com sucesso!",
            ], 200);
    }









    /**
     * Exclui um usuário existente do banco de dados
     *
     * @param  \App\Models\User  $user O objeto do usuário a ser excluído
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try{
            // Apagar o registro no banco de dados
            $user->delete();

            // Retorna os dados do usário apagado e uma mensagem de sucesso com status 200
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário excluído com sucesso!",
                ], 200);

        }catch(Exception $e){
            // Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "Usuário não apagado!",
                ], 400);
        }
    }










}
