<?php
namespace App\Http\ViewComposer;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class CategoryComposer 
{
    protected $categories;
    protected $postModel;

    /**
     * Inject Category and Post models.
     */
    public function __construct(Category $categories, Post $postModel)
    {
        $this->categories = $categories;
        $this->postModel = $postModel;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        // Fetch all categories and count of approved posts
        $view->with('categories', $this->categories->all())
             ->with('post_number', $this->postModel->where('approved', 1)->count());
    }
}
