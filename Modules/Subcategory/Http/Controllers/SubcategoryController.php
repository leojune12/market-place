<?php

namespace Modules\Subcategory\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\DateService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Subcategory\Entities\Subcategory;

class SubcategoryController extends Controller
{
    public $response_array = [
        "module" => "Subcategories",
        "moduleRoute" => "subcategories"
    ];

    public function index(Request $request)
    {
        $this->response_array["response"] = $this->getData($request);

        return Inertia::render('Subcategory/Index', $this->response_array);
    }

    private function getData($request)
    {
        $query = DB::table('subcategories');

        $query->whereNull('subcategories.deleted_at');

        $query->join('categories', 'categories.id', '=', 'subcategories.category_id');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->select(
            'subcategories.id',
            'subcategories.name',
            'categories.name as category_name',
        );

        return $query->paginate($request->perPage ?? 10);
    }

    public function create()
    {
        $categories = Category::select('id', 'name')
            ->orderBy('name')
            ->get();

        $this->response_array["categories"] = $categories;

        return Inertia::render('Subcategory/Create', $this->response_array);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $model = Subcategory::create($request->all());

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
        $model = Subcategory::find($id);

        $model->load('category');

        $model['date_added'] = DateService::viewDate($model->created_at);

        $this->response_array["model"] = $model;

        return Inertia::render('Subcategory/Show', $this->response_array);
    }

    public function edit($id)
    {
        $model = Subcategory::find($id);

        $this->response_array["model"] = $model;

        return Inertia::render('Subcategory/Edit', $this->response_array);
    }

    public function update(Request $request, $id)
    {
        $model = Subcategory::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $model->update($request->all());

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

                Subcategory::destroy($request->id_array);
                DB::commit();
                return back();
            } catch (Throwable $e) {

                DB::rollBack();
                return back();
            }
        }
    }
}
