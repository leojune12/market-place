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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
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

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Inertia::render('User/Create', [
            // '' => ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(User $user)
    {
        $user->load('roles:id,name');
        $user['date_added'] = DateService::viewDate($user->created_at);

        return Inertia::render('User/Show', [
            'model' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
