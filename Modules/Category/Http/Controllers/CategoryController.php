<?php

namespace Modules\Category\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\DateService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

class CategoryController extends Controller
{
    public $response_array = [
        "module" => "Categories",
        "moduleRoute" => "categories"
    ];

    public function index(Request $request)
    {
        $this->response_array["response"] = $this->getData($request);

        return Inertia::render('Category/Index', $this->response_array);
    }

    private function getData($request)
    {
        $query = DB::table('categories');

        $query->whereNull('deleted_at');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->select(
            'id',
            'name',
        );

        return $query->paginate($request->perPage ?? 10);
    }

    public function create()
    {
        return Inertia::render('Category/Create', $this->response_array);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $model = Category::create($request->all());

            DB::commit();

            return back();
        } catch (Throwable $e) {

            return $e;
            DB::rollBack();

            return back();
        }
    }

    public function show($id)
    {
        $model = Category::find($id);

        $model['date_added'] = DateService::viewDate($model->created_at);

        $this->response_array["model"] = $model;

        return Inertia::render('Category/Show', $this->response_array);
    }

    public function edit($id)
    {
        $model = Category::find($id);

        $this->response_array["model"] = $model;

        return Inertia::render('Category/Edit', $this->response_array);
    }

    public function update(Request $request, $id)
    {
        $model = Category::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $model->update($request->all());

            DB::commit();

            return back();
        } catch (Throwable $e) {

            return $e;
            DB::rollBack();

            return back();
        }
    }

    public function destroy(Request $request, $id)
    {
        if(!empty($request->id_array)) {

            DB::beginTransaction();

            try {

                Category::destroy($request->id_array);
                DB::commit();
                return back();
            } catch (Throwable $e) {

                DB::rollBack();
                return back();
            }
        }
    }
}
