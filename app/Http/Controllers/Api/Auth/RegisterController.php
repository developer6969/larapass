<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    use IssueTokenTrait;
    private $client;

    /**
     * It will fetch the secret from  oauth_clients table
     *
     */
    public function __construct()
    {
        /* Db_Table :  oauth_clients
            Column : Value
                id : 2,
                name : Laravel Password Grant Client
        */
        $this->client = Client::find(2);
    }


    /**
     * Register Api Function
     *
     * It validates the request parameter
     */
    public function register(Request $request){

        // For Debuging
        //dd($request->all());

    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:6'
    	]);

    	$user = User::create([
    		'name' => request('name'),
    		'email' => request('email'),
    		'password' => bcrypt(request('password'))
    	]);

        return $this->issueToken($request, 'password');
        
    	// $params = [
        //     'grant_type' => 'password',
        //     'client_id' => $this->client->id,
        //     'client_secret' => $this->client->secret,
        //     'username' => request('email'),
        //     'password' => request('password'),
        //     'scope' => '*'
        // ];

        // $request->request->add($params);

    	// $proxy = Request::create('oauth/token', 'POST');

    	// return Route::dispatch($proxy);

    }
}
