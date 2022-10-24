<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Brand;
use App\Models\User;
use App\Utilities\Common;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $authors = Brand::where('name', 'like', '%' . $search . '%')->paginate(5);
        return view('admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['avatar'] = Common::uploadFile($request->file('image'), 'front/imgs/authors');
        }
        $author = Brand::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'avatar' => $data['avatar'] ?? null
        ]);
        return redirect('admin/author/' . $author->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Brand::find($id);
        return  view('admin.author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Brand::find($id);
        return view('admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $author = Brand::find($id);
        $data = $request->all();
        //Xử lí ảnh
        if ($request->hasFile('image')) {
            $file_name_old = $request->get('image_old');
            $data['avatar'] = Common::uploadFile($request->file('image'), 'front/imgs/authors');
            //Xóa file cũ
            if ($file_name_old != '') {
                unlink('front/imgs/authors/' . $file_name_old);
            }
        }
        unset($data['image_old'], $data['image']);
        $author->update($data);

        return  redirect('admin/author/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Brand::find($id);
        //Xóa file
        //Xóa file cũ
        $file_name_old = $author['avatar'];
        $author->delete();
        if ($file_name_old != 'default-avatar.png' && $file_name_old != '') {
            unlink('front/imgs/authors/' . $file_name_old);
        }
        return  redirect('admin/author');
    }
}
