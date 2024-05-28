<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TypeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Analytics;
use App\Http\CommonFuncs\Common;
use App\Http\PostController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = DB::table('users')
            ->select('users.*')
            ->paginate(10);
        Paginator::defaultView('pagination::bootstrap-4');
        return view('dashboard.users.index', compact('list' ?? ''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $typeUserList = new TypeUser;
        $typeUserList = [

        ];

        return view('dashboard.users.new', compact('typeUserList'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile($name, $id)
    {
        try {
            $item = DB::table('users')
            ->select('users.*')
            ->where('users.id', '=', $id)
            ->get();
            return view('dashboard.users.edit', compact('item' ?? ''));

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = DB::table('users')
            ->select('users.*')
            ->where('users.id', '=', $id)
            ->paginate(10);
        Paginator::defaultView('pagination::bootstrap-4');
        return view('dashboard.users.edit', compact('item' ?? ''));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $response = User::find($id)->update($data);

            // atualizar profile
            if ($response) { 
                $status = true;
                $message = 'Salvo com sucesso';
            } 

            return redirect('dashboard/profile/xxx/'.$id)->with(['message'=>$message ?? $errorMessage, 'status'=>$status ?? false]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePicProfile(Request $request, $id)
    {
        try {
            

            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = User::find($id);
        return view('blog-admin.users.delete', compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
