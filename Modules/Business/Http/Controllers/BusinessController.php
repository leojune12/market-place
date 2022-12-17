<?php

namespace Modules\Business\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\DateService;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\City;
use Modules\Address\Entities\Barangay;
use Modules\Address\Entities\Province;
use Modules\Business\Entities\Business;

class BusinessController extends Controller
{
    public $response_array = [
        "module" => "Business",
        "moduleRoute" => "businesses"
    ];


    public function index(Request $request)
    {
        $this->response_array["response"] = $this->getData($request);

        return Inertia::render('Business/Index', $this->response_array);
    }

    private function getData($request)
    {
        $query = DB::table('businesses');

        $query->whereNull('deleted_at');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->select(
            'id',
            'name',
            'full_address',
        );

        return $query->paginate($request->perPage ?? 10);
    }

    public function create()
    {
        return Inertia::render('Business/Create', $this->response_array);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('businesses'),
            ],
            'description' =>  'nullable',
            'contact_number' =>  'required',
            'website' =>  'nullable',
            'facebook_link' =>  'nullable',
            'map_location' =>  'nullable',
            'street' =>  'nullable',
            'barangay_id' =>  'required',
            'city_id' =>  'required',
            'province_id' =>  'required',
            'region_id' =>  'required',
        ]);

        DB::beginTransaction();

        try {
            $barangay = Barangay::where('brgyCode', $request->barangay_id)->first();
            $city = City::where('citymunCode', $request->city_id)->first();
            $province = Province::where('provCode', $request->province_id)->first();

            $street = $request->filled('street') ? $request->street . ', ' : '';

            $request->merge([
                'full_address' => $street . $barangay->brgyDesc . ', ' . ucwords(Str::lower($city->citymunDesc)) . ', ' . $province->provDesc,
                'slug' => Str::slug($request->name),
            ]);

            $model = Business::create($request->all());

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
        $model = Business::find($id);
        $model->load('user');

        $model['date_added'] = DateService::viewDate($model->created_at);

        $this->response_array["model"] = $model;

        return Inertia::render('Business/Show', $this->response_array);
    }

    public function edit($id)
    {
        // $model = Business::find($id);

        // $this->response_array["model"] = $model;

        // return Inertia::render('Business/Edit', $this->response_array);
    }

    public function update(Request $request, $id)
    {
        $model = Business::find($id);

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

                Business::destroy($request->id_array);
                DB::commit();
                return back();
            } catch (Throwable $e) {

                DB::rollBack();
                return back();
            }
        }
    }
}
