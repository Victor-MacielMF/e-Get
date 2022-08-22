<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\Carbon;
use App\Mail\Saudacoes;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }



    public function Redirect(Request $request) {


        /**
         * Tenho que fazer a senha hash
         * 'cep'
         */

        /** Verificando se as informações iniciais foram passadas para poder acessar o registro */
    if($request->email == null || $request->password == null|| $request->password_confirmation == null || $request->cpf == null || $request->cep == null ){
        return view('usuario.login');
    }else{
        /** Verificando se digitou a senha corretamente */
        if($request->password != $request->password_confirmation ){
            return redirect('/login')->with('error', 'As senhas não coincidem.');
        } else {
            /** Validando o CPF e o Email, se der errado redireciona automaticamente para onde o usuário estava. (['msg'=>$request->password,'email'=>$request->cpf]);   */
            $this->validate($request, [
                'cpf' => 'bail|required|cpf|unique:users',
                'email' => 'bail|required|email|unique:users',
            ]);
            /** Aqui eu pego o estado e a cidade através do cep */
            $results = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $request->get('cep'));
            /** Se der erro na consulta, volta no login */
            if($results->resultado_txt == 'sucesso - cep não encontrado'){
                return redirect('/login')->with('error', 'CEP inválido.');

            }else{
                /** Criando a hash da senha */
                $array=array('email'=>$request->email,'cpf'=>$request->cpf,'cep'=>$request->cep,
                'cidade'=>$results->cidade,'uf'=>$results->uf,'password'=>$request->password,
                'password_confirmation'=>$request->password_confirmation);
                /** permissão para acessar o registrar */
                /** Os campos do endereço são endereco->uf e endereco->cidade */
                return view('usuario.register',compact('array'));
            }
        }

    }


    }


    /**
     * Create a new user instance after a valid registration.
     *
     *   $user->nome =
     *   $user->email =
      *  $user->cpf =
     *   $user->rg =
     *
            *    $request->password = Hash::make($request->password);
     *   $user->nascimento =
      *  $user->telefone =
     *
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $endereco = new Endereco;

        $validation = Validator::make($data, [
            'cidade' => 'required',
            'cep' => 'required',
            'estado' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect('/login')->with('error', 'Insira as informações corretamente.');
        }

        $date = str_replace ( '/' , '-' , $data['nascimento']);
        $nascimento=date("Y/m/d", strtotime($date));
        $usuario =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'sexo' => $data['sexo'],
            'nascimento' => $nascimento ,
            'telefone' => $data['telefone']
        ]);

        $endereco->cidade = $data['cidade'];
        $endereco->cep = $data['cep'];
        $endereco->estado = $data['estado'];
        $endereco->endereco = $data['endereco'];
        $endereco->numero = $data['numero'];
        $endereco->complemento = $data['complemento'];
        $endereco->bairro = $data['bairro'];
        $endereco->referencia = $data['referencia'];
        $endereco->user_id = $usuario->id;
        $endereco->save();
        Mail::to($usuario->email)->send(new Saudacoes($usuario));

        return $usuario;


    }
}
