<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('courses')->get()->toArray();
        return response()->json(array_reverse($categories), 200);
        // return $this->showAll($categories, 200);
    }

    public function store(CategoryRequest $request)
    {
        try {

            // 1- Start Uploading File
            $path = "";
            if ($request->has('photo')) {
                $driver = 'categories';
                $file = $request->photo;
                $file->store('/', $driver);
                $filename = $file->hashName();
                $path = 'images/' . $driver . '/' . $filename;
            }
            // End Uploading File

            // 2- Start creating slug 
            $slug = str_replace(' ', '-', $request->title);
            // End creating slug 

            // 3- Start creating category
            $category = new Category();
            $category->title = trim($request->title);
            $category->slug = $slug;
            $category->photo = $path;
            $category->save();
            // End creating category

            return response()->json(['message' => 'Category Created Successfully'], 201);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'There is a Problem with creating the category'], 422);
        }
    }
    public function update(Request $request, $id)
    {
        // try {
            $category = Category::find($id);
            // 1- Start uploading file
            $path = "";
            if ($request->has('photo') && $request->photo != null && getType($request->photo) !== 'string') {
                $folder = 'categories';
                $file = $request->photo;
                $file->store('/', $folder);
                $filename = $file->hashName();
                $path = 'images/' . $folder . '/' . $filename;
            }
            // End uploading file

            // 2- start Creating Slug
            $slug = str_replace(' ', '-', $request->title);
            // End Creating Slug

            // 3- Start Updating category

            $category->title = $request->title;
            $category->slug = $slug;
            if($category->photo && $category->photo !== null) {
                unlink($category->photo);
            }
            $category->photo = $path;
            if ($category->isDirty(['title',  'photo']))
                $category->save();
            else
                return response()->json(['message' => 'There Is No Value Updated Yet!'], 422);
            // End Updating category

            return response()->json(['message' => 'Category Updated Successfully'], 200);
        // } catch (\Exception $exp) {
            return response()->json(['message' => 'error on Updating Category'], 422);
        // }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);

            $category->delete();
            unlink($category->photo);
            return response()->json(['message' => 'Category Deleted Successfully'], 200);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'error on Deleting Category'], 422);
        }
    }
}
