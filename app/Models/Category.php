<?php

namespace App\Models;

use App\Traits\ResponseTraits;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory, ResponseTraits;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relation with user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get categories
     *
     * @return void
     */
    public function getCategories(){
        try{
            $categories = Category::orderBy('id', 'DESC')->get();
            $status = true;
            $message = null;
            $data = $categories;
        } catch(Exception $e){
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }

    /**
     * Get category
     *
     * @return void
     */
    public function getCategory($id){
        try{
            $status = false;
            $message =  "Can't find category !!!";
            $category = Category::find($id);
            $data = null;
            if ($category){
                $status = true;
                $message =  null;
                $data =  $category;
            }
        }catch(Exception $e){
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }


     /**
     * Add category
     *
     * @param  mixed $request
     * @return void
     */
    public function addCategory($request){
        try{
            if (!is_null(Category::where('name', $request->name)->first())){
                $message = 'Exist category !!!';
                $status = false;
                return $this->responseData($status, $message);
            }

            $category = new Category();
            $category->name = $request->name;
            $category->user_id = Auth::id();
            $category->save();
            $status = true;
            $message = 'Add category successful !';
        }catch(Exception $e){
            $status = false;
            $message = $e->getMessage();
        }
        return $this->responseData($status, $message);
    }

    /**
     * Update category with id
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateCategory($request, $id){
        try{
            $status =  false;
            $message =  "Exist category !!!";
            $data = null;
            $category = Category::find($id);
            if ($category){
                $category_check = Category::where('name', $request->name)->first();
                if (!is_null($category_check) && $category->id !== $category_check->id){
                    return $this->responseData($status, $message);
                }
                $category->name = $request->name;
                $category->user_id = Auth::id();
                $category->save();
                $status =  true;
                $message =  "Update successful";
            } else{
                $message =  "Can't find category !!!";
            }
        } catch (Exception $e) {
            $status = false;
            $message = $e->getMessage();
            $data = null;
        }
        return $this->responseData($status, $message, $data);
    }
}
