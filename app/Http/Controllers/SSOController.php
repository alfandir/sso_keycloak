<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SSOController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth/sso', ['message' => null]);
    }

    public function login(Request $request)
    {

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $response = Http::asForm()->post('http://localhost:8080/realms/Peruri/protocol/openid-connect/token', [
                'client_id' => 'ess-peruri',
                'username' =>  $request->username,
                'password' => $request->password,
                'grant_type' => 'password',
            ]);

            $responseData = json_decode($response->body(), true);

            if (isset($responseData['access_token'])) {
                $accessToken = $responseData['access_token']; // Mengambil nilai access_token
                session()->put('accessToken', $accessToken);

                // Otentikasi berhasil
                return redirect()->intended('/home');
            } else {
                return view('auth.sso', ['message' => 'Tidak dapat melakukan login dengan SSO']);
            }
        } else {
            // Otentikasi gagal
            return view('auth.sso', ['message' => 'Username atau password yang anda masukkan tidak ditemukan']);
        }
    }
}
