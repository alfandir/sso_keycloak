<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $users = [
            '7065',
            '7648',
            '6763',
            '5078',
            '5247',
            '5760',
            '5779',
            '5893',
            '5957',
            '5975',
            '6106',
            '6121',
            '6260',
            '6280',
            '6310',
            '6313',
            '6387',
            '6412',
            '6418',
            '6498',
            '6576',
            '6586',
            '6604',
            '6642',
            '6693',
            '6701',
            '6702',
            '6863',
            '6866',
            '6898',
            '6904',
            '6988',
            '6990',
            '7027',
            '7040',
            '7046',
            '7129',
            '7209',
            '7215',
            '7232',
            '7302',
            '7315',
            '7339',
            '7340',
            '7354',
            '7382',
            '7395',
            '7485',
            '7576',
            '7072',
            '7521',
            '6365',
            '6207',
            '6472',
            '6175',
            '6471',
            '6064',
            '7586',
            '7522',
            '7508',
            '6314',
            '6497',
            '6971',
            '7602',
            '7463',
            '5598',
            '7630',
            '6147',
            '6830',
            '7647',
            '7604',
            '7618',
            '6400',
            '7050',
            '7238',
            '7009',
            '7298',
            'B866',
            '7594',
            '7267',
            '6683',
            '7617',
            '6201',
            '6791',
            '6867',
            'G335',
            '5925',
            '6610',
            '5959',
            '7563',
            '7514',
            '5890',
            '6762',
            '6659',
            '7465',
            '6805',
            '7216',
            '7476',
            '5546',
            '6678',
            '7342',
            '7116',
            '6836',
            '7641',
            '6256',
            '6768',
            '5992',
            '7190',
            '7519',
            '7191',
            '7200',
            '6611',
            '5401',
            '7621',
            '7195',
            '7196',
            '7310',
            '6237',
            '7412',
            '5867',
            '7312',
            '7467',
            '7566',
            'G766',
            '7727',
            '7728',
            '5406',
            'G724',
            '7426',
            '7437',
            '7442',
            '7199',
            '6224',
            '6100',
            '7607',
            '7546',
            '7418',
            '6828',
            '7509',
            '6486',
            '7456',

        ];
        $keycloakBaseUrl = 'http://localhost:8080';
        $realm = 'peruri';
        $clientSecret = 'IpBW5NfdcUnb2SBUXFmIE6ixeXE3Y7OC';

        $tokenResponse = Http::asForm()->post("$keycloakBaseUrl/realms/$realm/protocol/openid-connect/token", [
            'grant_type' => 'password',
            'username' => 'admin',
            'password' => 'admin',
            'client_id' => 'account-console',
            'client_secret' => $clientSecret,
        ]);

        $accessToken = $tokenResponse['access_token'];

        foreach ($users as $key => $user) {
            # code...
        }
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post("$keycloakBaseUrl/admin/realms/$realm/users", [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'enabled' => true,
            'credentials' => [
                [
                    'type' => 'password',
                    'value' => $request->input('password'),
                ],
            ],
            'realmRoles' => ['user'],  // Role yang ingin diberikan pada pengguna
        ]);

        if ($userResponse->successful()) {
            return response()->json(['message' => 'User registered successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to register user'], $userResponse->status());
        }
    }
}
