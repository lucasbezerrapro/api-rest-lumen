<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    protected  $jwt;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        //vai inicializar com login
        $this->jwt = $jwt;

        //vai inicializar middleware no bootstrap/app.php

        $this->middleware('auth:api', [
            'except' => ['usuarioLogin', 'cadastrarUsuario']
        ]);
    }

    public function usuarioLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
            # code...

            return response()->json(['usuario não encontrado'], 404);
        }
        return response()->json(compact('token')); //retorna usuarios do banco
    }

    public function mostrarUsuarioAutenticado() {
        $usuario = Auth::user();
        return response()->json($usuario);
    }

    public function mostrarTodosUsuarios()
    {
        return response()->json(Usuario::all()); //retorna usuarios do banco
    }

    public function cadastrarUsuario(Request $request)
    {

        //validação
        $this->validate($request, [
            'usuario' => 'required|min:5|max:40',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required'
        ]);
        //inserindo usuario
        $usuario = new Usuario;
        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->password = Hash::make($request->password);
        // Definindo valor padrão para 'verificado'
        $usuario->verificado = false; // ou true, dependendo dos requisitos do seu aplicativo

        #salvar o registro no banco
        $usuario->save();
        return response()->json($usuario);
    }

    public function mostrarUmUsuarios($id)
    {
        return response()->json(Usuario::find($id));
    }
    public function atualizarUsuario($id, Request $request)
    {
        // Encontrar o usuário pelo ID
        $usuario = Usuario::find($id);
    
        // Verificar se o usuário existe
        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
    
        // Atualizar os campos do usuário com os novos valores
        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password;
    
        // Definir valor padrão para 'verificado' se necessário
        $usuario->verificado = false; // ou true, dependendo dos requisitos do seu aplicativo
    
        // Salvar as alterações no banco de dados
        $usuario->save();
    
        return response()->json($usuario);
    }

    public function deletarUsuario($id)
    {
        $usuario = Usuario::find($id);
        
        $usuario->delete();

        return response()->json('Usuario deletado com sucesso!!!!!!', 200);
    }
    

    //

    public function usuarioLogout() {
        Auth::logout();
        return response()->json("Usuário deslogou com sucesso!");
    }
}
?>