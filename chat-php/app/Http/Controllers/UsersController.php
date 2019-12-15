<?php


namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

class UsersController extends Controller {
    private $users;

    public function __construct(Users $users) 
    {
        $this->users = $users;
    }

    public function index() 
    {
        return $this->users->all();
    }

    public function show(Request $request) 
    {
        $request->email = trim($request->email);
        if (empty($request->email)) {
            return [
                'status' => false,
                'message'=> 'O email deve ser passado como parâmetro da requisição'
            ];
        }
        $user = $this->users->where('user_email',$request->email)->first();
        if (empty($user)) {
            return [
                'status' =>  false,
                'message'=> 'Email inválido'
            ];
        }
        return [
            'status' => true,
            'message'=> $user
        ];
    }

    public function store(Request $request) 
    {
        $request->name = trim($request->name);
        $request->email = trim($request->email);
        if (isset($request->name) && isset($request->email)) {
            if (!$this->validateEmail($request->email)) {
                return [
                    'status' => false,
                    'message'=> 'Email inválido'
                ];
            }

            if ($this->emailExists($request->email)) {
                return [
                    'status' => false,
                    'message'=> 'Email já existe'
                ];
            }
            return [
                'status'   => true,
                'mensagem' => $this->users->create([
                    'user_name' => $request->name,
                    'user_email'=> $request->email
                ])
            ];
        } else {
            return [
                'status'  => false,
                'mensagem'=> 'Name and e-mail are necessary for the cadastro'
            ];
        }
        return $request;
    }

    public function validateEmail($email)
    {
        return strpos($email,'@') > -1 && substr_count($email,'@') == 1;
    }

    public function emailExists($email) {
        $user = $this->users->where('user_email',$email)->first();
        return !empty($user) ? true: false;
    }
}