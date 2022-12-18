<?php

namespace Modules\User\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\DateService;
use Illuminate\Validation\Rule;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public $response_array = [
        "module" => "Users",
        "moduleRoute" => "users"
    ];

    public function index(Request $request)
    {
        $this->response_array["response"] = $this->getData($request);

        return Inertia::render('User/Index', $this->response_array);
    }

    private function getData($request)
    {
        $query = DB::table('users');

        $query->whereNull('users.deleted_at');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id');
        $query->join('roles', 'roles.id', '=', 'model_has_roles.role_id');

        $query->select(
            'users.id',
            'users.first_name',
            'users.last_name',
            'users.email',
            'roles.name as role_name',
        );

        // $this->queryHandler($query, $request);

        return $query->paginate($request->perPage ?? 10);
    }

    public function create()
    {
        $roles = Role::select('id', 'name')
            ->orderBy('id')
            ->get();

        $this->response_array["roles"] = $roles;

        return Inertia::render('User/Create', $this->response_array);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_id' => [
                'required',
                // 'exists:roles,name'
            ],
        ]);

        DB::beginTransaction();

        try {

            $user = User::create($request->except(['role']));

            $role = Role::find($request->role_id);

            if (!!$role) {
                $user->syncRoles([$role->name]);
            }

            DB::commit();

            return back();
        } catch (Throwable $e) {

            DB::rollBack();

            return $e;
            // return back();
        }
    }

    public function show($id)
    {
        $model = User::find($id);

        $model->load('roles:id,name');
        $model['date_added'] = DateService::viewDate($model->created_at);

        $this->response_array["model"] = $model;

        return Inertia::render('User/Show', $this->response_array);
    }

    public function edit($id)
    {
        $model = User::find($id);

        $model->load('roles:id,name');

        $roles = Role::select('id', 'name')
            ->orderBy('id')
            ->get();

        $this->response_array["model"] = $model;
        $this->response_array["roles"] = $roles;

        return Inertia::render('User/Edit', $this->response_array);
    }

    public function update(Request $request, $id)
    {
        $model = User::find($id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($model),
            ],
            'role_id' => [
                'required',
                // 'exists:roles,name'
            ],
        ]);

        DB::beginTransaction();

        try {

            $model->update($request->except(['role_id']));

            $role = Role::find($request->role_id);

            if (!!$role) {
                $model->syncRoles([$role->name]);
            }

            DB::commit();

            return back();
        } catch (Throwable $e) {

            DB::rollBack();

            return $e;
            // return back();
        }
    }

    public function destroy(Request $request, $id)
    {
        if(!empty($request->id_array)) {

            DB::beginTransaction();

            try {

                User::destroy($request->id_array);
                DB::commit();
                return back();
            } catch (Throwable $e) {

                DB::rollBack();
                return back();
            }
        }
    }
}
