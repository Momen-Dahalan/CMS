<?php
namespace App\Http\ViewComposer;

use App\Models\Role;
use Illuminate\View\View;

class RoleComposer 
{
    protected $roles;

    /**
     * Inject Category and Post models.
     */
    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        // Fetch all categories and count of approved posts
        $view->with('roles', $this->roles->all());
    }
}
