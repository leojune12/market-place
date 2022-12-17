<?php

namespace Modules\Service\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\DateService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\Service;
use Modules\Business\Entities\Business;

class ServiceController extends Controller
{
    public $response_array = [
        "module" => "Service",
        "moduleRoute" => "services"
    ];

    public function index(Request $request)
    {
        $this->response_array["response"] = $this->getData($request);

        return Inertia::render('Service/Index', $this->response_array);
    }

    private function getData($request)
    {
        $query = DB::table('services');

        $query->whereNull('services.deleted_at');

        $query->join('businesses', 'businesses.id', '=', 'services.business_id');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->select(
            'services.id',
            'services.name',
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

        return Inertia::render('Service/Create', $this->response_array);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $model = Service::create($request->all());

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
        $model = Service::find($id);

        $model->load('business:id,name');

        $model['date_added'] = DateService::viewDate($model->created_at);

        $this->response_array["model"] = $model;

        return Inertia::render('Service/Show', $this->response_array);
    }

    public function edit($id)
    {
        $model = Service::find($id);

        $this->response_array["model"] = $model;

        return Inertia::render('Service/Edit', $this->response_array);
    }

    public function update(Request $request, $id)
    {
        $model = Service::find($id);

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

                Service::destroy($request->id_array);
                DB::commit();
                return back();
            } catch (Throwable $e) {

                DB::rollBack();
                return back();
            }
        }
    }
}
