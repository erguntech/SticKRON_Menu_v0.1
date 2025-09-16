<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Mail\NewUserMail;
use App\Models\Client;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ClientController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:Sistem Yöneticisi'], only: ['index', 'create', 'store', 'edit', 'update', 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        $data = Client::all();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('userFullName', function ($row_userFullName) {
                    return $row_userFullName->linkedUser->getUserFullName();
                })
                ->addColumn('companyName', function ($row_companyName) {
                    return $row_companyName->company_name;
                })
                ->addColumn('userEmail', function ($row_userEmail) {
                    return $row_userEmail->linkedUser->email;
                })
                ->addColumn('clientStatus', function ($row_clientStatus) {
                    return ($row_clientStatus->linkedUser->is_active) ? '<span class="badge rounded-pill badge-light-success">Aktif</span>' : '<span class="badge rounded-pill badge-light-danger">Pasif</span>';
                })
                ->rawColumns(['userFullName', 'companyName', 'clientStatus'])
                ->make(true);
        }

        return view('pages.clients.clients_index');
    }

    public function show(string $id)
    {
        $client = Client::find($id);
        $user = User::find($client->user_id);

        return view('pages.clients.clients_show', compact('client', 'user'));
    }

    public function create()
    {
        return view('pages.clients.clients_create');
    }

    public function store(ClientRequest $request)
    {
        $password = '';

        for($i = 0; $i < 8; $i++) {
            $password .= mt_rand(0, 9);
        }

        $user = new User();
        $user->first_name = $request['input-first_name'];
        $user->last_name = $request['input-last_name'];
        $user->email = $request['input-email'];
        $user->password = bcrypt($password);
        $user->user_type = 2; // Clients
        $user->is_active = $request['input-is_active'];
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();

        $user->api_token = $user->createToken(Str::random(10))->plainTextToken;
        $user->save();

        $client = new Client();
        $client->user_id = $user->id;
        $client->company_name = $request['input-company_name'];
        $client->company_address = $request['input-company_address'];
        $client->company_phone = $request['input-company_phone'];
        $client->save();

        $user->assignRole("İşletme Yöneticisi");

        Mail::to($user->email)->send(new NewUserMail([
            'user_name' => $user->getUserFullName(),
            'email' => $user->email,
            'password' => $password
        ]));

        return redirect()->route('Clients.Index')
            ->with('result','success')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile sisteme eklendi.");
    }

    public function edit(string $id)
    {
        $client = Client::find($id);
        $user = User::find($client->user_id);

        return view('pages.clients.clients_edit', compact('client', 'user'));
    }

    public function update(ClientRequest $request, string $id)
    {
        $client = Client::find($id);
        $user = User::find($client->user_id);

        $user->first_name = $request['input-first_name'];
        $user->last_name = $request['input-last_name'];
        $user->is_active = $request['input-is_active'];
        $user->save();

        $client->company_name = $request['input-company_name'];
        $client->company_address = $request['input-company_address'];
        $client->company_phone = $request['input-company_phone'];
        $client->save();

        return redirect()->route('Clients.Edit', $id)
            ->with('result','warning')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Kayıt başarı ile güncellendi.");
    }

    public function destroy(string $id)
    {
        $client = Client::find($id);
        $user = User::find($client->user_id);

        $client->delete();
        $user->delete();

        return response()->json([
            'status' => 'danger',
            'title' => "İşlem Başarılı!",
            'message' => "Kayıt başarı ile sistemden silindi."
        ]);
    }
}
