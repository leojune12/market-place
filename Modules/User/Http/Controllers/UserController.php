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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Support\Renderable;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('User/Index', [
            'response' => $this->getData($request),
        ]);
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

        return Inertia::render('User/Create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
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
            'role' => [
                'required',
                'exists:roles,name'
            ],
        ]);

        DB::beginTransaction();

        try {

            $user = User::create($request->except(['role']));

            $user->syncRoles([$request->role]);

            DB::commit();

            return Redirect::route('users.index');
        } catch (Throwable $e) {

            return $e;
            DB::rollBack();

            return Redirect::route('users.index');
        }
    }

    public function show(User $user)
    {
        $user->load('roles:id,name');
        $user['date_added'] = DateService::viewDate($user->created_at);

        return Inertia::render('User/Show', [
            'model' => $user,
        ]);
    }

    public function edit(User $user)
    {
        $user->load('roles:id,name');

        $roles = Role::select('id', 'name')
            ->orderBy('id')
            ->get();

        return Inertia::render('User/Edit', [
            'model' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user),
            ],
            'role' => [
                'required',
                'exists:roles,name'
            ],
        ]);

        DB::beginTransaction();

        try {

            $user->update($request->except(['role']));
            $user->syncRoles([$request->role]);

            DB::commit();

            return Redirect::route('users.edit', [
                'user' => $user->id,
            ]);
        } catch (Throwable $e) {

            return $e;
            DB::rollBack();

            return Redirect::route('users.edit', [
                'user' => $user->id,
            ]);
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
