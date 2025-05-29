<?php

namespace App\Http\Controllers;

use App\Helpers\slug;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    
    public $post;

    public function __construct(Post $post)
    {   
        $this->post = $post;
    }


    public function index()
    {
        $posts= $this->post::with('user:id,name,profile_photo_path')->approved()->paginate(10);
        $title= 'جميع المنشورات';
        return view('index' , compact(['posts' , 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
    
        // التعامل مع رفع الصورة
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/images', $filename);
            // Storage::disk('public')->putFileAs('images', $file, $filename); // حفظ الصورة
            $path = Storage::disk('public')->putFileAs('images', $file, $filename); // حفظ الصورة

        }
    

        $this->post->title = $request->title;
        $this->post->category_id= $request->category_id;
        $this->post->body =$request->body;
        $this->post->image_path =$path ?? 'default.jpg';
        $this->post->user_id = auth()->id();
        
        $this->post->save();
    
        return back()->with('success', 'تم إضافة المنشور بنجاح, سيظهر بعد أن يوافق عليه المسؤول');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = $this->post::where('slug', $slug)->first();
        $comments = $post->comments->sortByDesc('created_at');

        return view('posts.show' , compact(['post', 'comments']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        abort_unless(auth()->user()->can('edit-post' , $post) , 403);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

    
        $data['slug'] = Slug::uniqueSlug($request->title, 'posts');
        $data['category_id'] = $request->category_id;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Save new image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public' ,$filename); // Store the image in 'images' directory
            $path = Storage::disk('public')->putFileAs('images', $file, $filename); // حفظ الصورة
            $data['image_path'] = $path;
        }
    
        $post->update($data);
    
        return redirect(route('post.show', $post->slug))->with('success', 'تم تعديل المنشور بنجاح');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {   
        abort_unless(auth()->user()->can('delete-post' , $post) , 403);
        $post->delete();
        return back()->with('success' , 'تم حذف المنشور بنجاح');
    }


    // public function search(Request $request){
    //     $posts = $this->post->where('body' , 'LIKE' , '%'.$request->keyword.'%');
    //     $title = "نتائج البحث عن ".$request->keyword ; 
    //     return view('index' , compact(['posts' , 'title']));
    // }

    public function search(Request $request)
    {
        // تحقق من أن الكلمة المفتاحية ليست فارغة
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            // استعلام البحث مع تقسيم الصفحات
            $posts = $this->post->where('body', 'LIKE', '%' . $keyword . '%')->paginate(10);

            // العنوان للصفحة
            $title = "نتائج البحث عن " . $keyword;

            // إعادة النتائج مع العنوان إلى العرض
            return view('index', compact('posts', 'title'));
        } else {
            // إذا كانت الكلمة المفتاحية فارغة، يمكن إعادة عرض جميع المنشورات أو عرض رسالة
            $title = "البحث";
            $posts = collect(); // مجموعة فارغة لعرض رسالة عدم وجود نتائج
            return view('index', compact('posts', 'title'));
        }
    }




    public function getByCategory ($id){
        $posts = $this->post->with('user')->whereCategory_id($id)->approved()->paginate(10);
        $title = "المنشورات العائدة لتصنيف : ".Category::find($id)->title;
        return view('index' , compact(['posts', 'title']));
    }

}
