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
use PhpParser\Comment\Doc;

class Doctor extends Model
{
    use HasFactory, ResponseTraits;

    protected $table = 'doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'level_id',
        'description',
        'introduce',
    ];

    private $modelProduct;
    private $url;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->url = Config::get('app.image.url');
    }

    /**
     * Relation with user
     *
     * @return BelongsTo
     */
    public function levelDoctor()
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function getDoctors()
    {
        try {
            $data = Doctor::orderBy('id', 'DESC')->where('active', 1)->get();
            $status = true;
            $message = null;
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    /**
     * Get category
     *
     * @param $id
     * @return array
     */
    public function getDoctor($id)
    {
        try {
            $status = false;
            $message = Lang::get('message.can_not_find');
            $doctor = Doctor::find($id);
            $data = null;
            if ($doctor && $doctor->where('active', 1)) {
                $status = true;
                $message = null;
                $data = $doctor;
            }
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    /**
     * Add doctor
     *
     * @param $request
     * @return array
     */
    public function addDoctor($request)
    {
        try {
            $status = false;
            $message = null;
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->level_id = $request->level;
            $doctor->description = $request->description ?? null;
            $doctor->introduce = $request->introduce ?? null;
            if ($request->image) {
                $image = $this->modelProduct->checkImage($request->image);
                if ($image['status']) {
                    $newImage = date('Ymdhis') . '.' . $request->image->getClientOriginalExtension();
                    $doctor->image = $this->url . $newImage;
                    $request->image->move($this->url, $newImage);
                    $doctor->save();
                    $status = true;
                    $message = Lang::get('message.add_done');
                } else {
                    throw new Exception($image['message']);
                }
            }
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
        }
        return $this->responseData($status, $message);
    }

    /**
     * Update doctor with id
     *
     * @param $request
     * @param $id
     * @return array
     */
    public function updateDoctor($request, $id)
    {
        try {
            $status = false;
            $message = Lang::get('message.exist');
            $data = null;
            $doctor = Doctor::find($id);
            if ($doctor && $doctor->where('active', 1)) {
                $doctor->name = $request->name;
                $doctor->level_id = $request->level;
                if (isset($request->description)) {
                    $doctor->description = $request->description;
                }
                if ($request->image) {
                    $image = $this->modelProduct->checkImage($request->image);
                    if ($image['status']) {
                        $newImage = date('Ymdhis') . '.' . $request->image->getClientOriginalExtension();
                        $doctor->image = $this->url . $newImage;
                        $request->image->move($this->url, $newImage);
                    } else {
                        throw new Exception($image['message']);
                    }
                }
                $doctor->save();
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

    public function deleteDoctor($id) {
        $data = null;
        $doctor = Doctor::find($id);
        $doctor->active = 0;
        $doctor->save();
        $message = Lang::get('message.update_done');
        $status = true;
        return $this->responseData($status, $message, $data);
    }
}
