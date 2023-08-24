<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
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
        $currentTimestamp = Carbon::now()->timestamp * 1000; // Konversi waktu saat ini menjadi timestamp dalam milidetik

        $response = Http::asForm()
            ->post('http://localhost:8080/admin/realms/Peruri/users', [
                "createdTimestamp" => $currentTimestamp,
                "username" => 'alfandi',
                "enabled" => true,
                "totp" => false,
                "emailVerified" => true,
                "firstName" =>  'alfandi',
                "lastName" => "restu",
                "email" => 'alfandi@peruri.co.id',
                "disableableCredentialTypes" => [],
                "requiredActions" => [],
                "notBefore" => 0,
                "access" => [
                    "manageGroupMembership" => true,
                    "view" => true,
                    "mapRoles" => true,
                    "impersonate" => true,
                    "manage" => true,
                ],
                "realmRoles" => ["mb-user"],
            ]);

        return $response->body();

        if ($response->status() === 200) {
        }
    }
}
