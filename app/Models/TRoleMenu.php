<?phpnamespace App\Models;use Jenssegers\Mongodb\Eloquent\Model as Eloquent;class TRoleMenu extends Eloquent{	protected $connection = 'mongodb';	protected $collection = 't_role_menus';	public static $rules	=   array('t_role_id' =>  'required',);	public static $messages	=   array('t_role_id.required' =>  'Please Select The Role Name',);}