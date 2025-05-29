<?php
namespace App\Http\ViewComposer;

use App\Models\Comment;
use Illuminate\View\View;

class CommentComposer 
{
    protected $comments;

    /**
     * Inject Category and Post models.
     */
    public function __construct(Comment $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        // Fetch all categories and count of approved posts
        $view->with('recent_comments', $this->comments->with('user' , 'post')->take(8)->latest()->get());
    }
}
