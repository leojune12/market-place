<?php

namespace Modules\Product\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\DateService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\Business\Entities\Business;

class ProductController extends Controller
{
    public $response_array = [
        "module" => "Product",
        "moduleRoute" => "products"
    ];

    public function index(Request $request)
    {
        $this->response_array["response"] = $this->getData($request);

        return Inertia::render('Product/Index', $this->response_array);
    }

    private function getData($request)
    {
        $query = DB::table('products');

        $query->whereNull('products.deleted_at');

        $query->join('businesses', 'businesses.id', '=', 'products.business_id');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->select(
            'products.id',
            'products.name',
            'businesses.name as business_name',
        );

        return $query->paginate($request->perPage ?? 10);
    }

    public function create()
    {
        $businesses = Business::select('id', 'name')
            ->orderBy('name')
            ->get();

        $this->response_array['businesses'] = $businesses;

        return Inertia::render('Product/Create', $this->response_array);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'business_id' => 'required',
            'description' => 'nullable',
            'price' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $request->merge([
                'slug' => Str::slug($request->name),
            ]);

            $model = Product::create($request->all());

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
        $model = Product::find($id);

        $model->load('business:id,name');

        $model['date_added'] = DateService::viewDate($model->created_at);

        $this->response_array["model"] = $model;

        return Inertia::render('Product/Show', $this->response_array);
    }

    public function edit($id)
    {
        $model = Product::find($id);

        $this->response_array["model"] = $model;

        $businesses = Business::select('id', 'name')
            ->orderBy('name')
            ->get();

        $this->response_array['businesses'] = $businesses;

        return Inertia::render('Product/Edit', $this->response_array);
    }

    public function update(Request $request, $id)
    {
        $model = Product::find($id);

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $request->merge([
                'slug' => Str::slug($request->name),
            ]);

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

                Product::destroy($request->id_array);
                DB::commit();
                return back();
            } catch (Throwable $e) {

                DB::rollBack();
                return back();
            }
        }
    }
}
