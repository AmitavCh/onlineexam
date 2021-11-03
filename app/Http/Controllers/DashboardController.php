<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\TMenu;
use App\Models\TRole;
use App\Models\SubMenu;
use App\User;
use DB;
use Hash;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Redirect;
use Validator;
use Session;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller {
	    public function dashboard() {
			return view('dashboard.dashboard');
		}
}