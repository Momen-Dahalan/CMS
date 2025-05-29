<?php
namespace App\Http\ViewComposer;

use App\Models\Page;
use Illuminate\View\View;

class PageComposer 
{
    protected $page;

    /**
     * Inject Category and Post models.
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        // Fetch all categories and count of approved posts
        return $view->with('pages' , $this->page->all());
    }
}
