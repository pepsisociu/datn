<?php

namespace App\Models;

use App\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class Service extends Model
{
    use HasFactory, ResponseTraits;

    protected $table = 'service';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'introduce',
        'active',
    ];

    /**
     * Get brands
     *
     * @return array
     */
    public function getNameBrand($request)
    {
        try {
            $brands = Brand::where('name', 'like', '%'.$request->brand.'%')->get();
            $status = true;
            $message = null;
            $data = $brands;
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    /**
     * Get brands
     *
     * @return array
     */
    public function getServices()
    {
        try {
            $services = Service::orderBy('id', 'DESC')->get();
            $status = true;
            $message = null;
            $data = $services;
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    /**
     * Get brand
     *
     * @param $id
     * @return array
     */
    public function getService($id)
    {
        try {
            $status = false;
            $message = Lang::get('message.can_not_find');
            $brand = Service::find($id);
            $data = null;
            if ($brand) {
                $status = true;
                $message = null;
                $data = $brand;
            }
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    /**
     * Add brand
     *
     * @param $request
     * @return array
     */
    public function addService($request)
    {
        try {
            if (Service::where('name', $request->name)->first()) {
                $message = Lang::get('message.exist');
                $status = false;
                return $this->responseData($status, $message);
            }

            $service = new Service();
            $service->name = $request->name;
            $service->introduce = $request->introduce ?? null;
            if ($request->active) {
                $service->active = true;
            }
            $service->save();
            $status = true;
            $message = Lang::get('message.add_done');
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
        }
        return $this->responseData($status, $message);
    }

    /**
     * Update service with id
     *
     * @param $request
     * @param $id
     * @return array
     */
    public function updateService($request, $id)
    {
        try {
            $status = false;
            $message = Lang::get('message.exist');
            $data = null;
            $service = Service::find($id);
            if ($service) {
                $service_check = Service::where('name', $request->name)->first();
                if (($service_check) && $service->id !== $service_check->id) {
                    return $this->responseData($status, $message);
                }
                $service->name = $request->name;
                $service->description = $request->description ?? null;
                $service->introduce = $request->introduce ?? null;
                $service->active = isset($request->active) ? true : false;
                $service->save();
                $status = true;
                $message = Lang::get('message.update_done');
            } else {
                $message = Lang::get('message.can_not_find');
            }
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }
}
