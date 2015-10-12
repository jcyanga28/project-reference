<?php

class Task extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'task' => 'required|unique:tasks,task',
		);
	public static $update_rules = array(
			'task' => 'required',
		);	

	public static function access_intask_receiver($id)
	{
		$has_access = DB::table('task_receiver')
						->where('user_id', $id)
						->get();

		return count($has_access);					
	}

	public static function access_intask_approver($id)
	{
		$has_access = DB::table('task_approver')
						->where('user_id', $id)
						->get();

		return count($has_access);					
	}

	public static function select_allmytask_forcontact($filter,$search)
	{
		return DB::table('mytask_forcontact')
					->select('mytask_forcontact.*', 'tasks.task', 'contacts.fullname')
					->join('tasks', 'tasks.id', '=', 'mytask_forcontact.task_id')
					->join('contacts', 'contacts.id', '=', 'mytask_forcontact.contact_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forcontact.status', $filter)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_mytask_forcontact($filter,$search,$id)
	{
		return DB::table('mytask_forcontact')
					->select('mytask_forcontact.*', 'tasks.task', 'contacts.fullname')
					->join('tasks', 'tasks.id', '=', 'mytask_forcontact.task_id')
					->join('contacts', 'contacts.id', '=', 'mytask_forcontact.contact_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forcontact.status', $filter)
					->where('mytask_forcontact.created_by', $id)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_forcontact_details($id)
	{
		return DB::table('mytask_forcontact')
					->select('mytask_forcontact.*', 'tasks.task', 'contacts.fullname', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forcontact.task_id')
					->join('contacts', 'contacts.id', '=', 'mytask_forcontact.contact_id')
					->join('users', 'users.id', '=', 'mytask_forcontact.created_by')
					->where('mytask_forcontact.id', $id)
					->first();
	}

	public static function select_allmytask_forcompany($filter,$search)
	{
		return DB::table('mytask_forcompany')
					->select('mytask_forcompany.*', 'tasks.task', 'companies.company_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forcompany.task_id')
					->join('companies', 'companies.id', '=', 'mytask_forcompany.company_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forcompany.status', $filter)
					->where('mytask_forcontact.approved_request', 0)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('companies.company_name', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_mytask_forcompany($filter,$search,$id)
	{
		return DB::table('mytask_forcompany')
					->select('mytask_forcompany.*', 'tasks.task', 'companies.company_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forcompany.task_id')
					->join('companies', 'companies.id', '=', 'mytask_forcompany.company_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forcompany.status', $filter)
					->where('mytask_forcompany.created_by', $id)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('companies.company_name', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_forcompany_details($id)
	{
		return DB::table('mytask_forcompany')
					->select('mytask_forcompany.*', 'tasks.task', 'companies.company_name', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forcompany.task_id')
					->join('companies', 'companies.id', '=', 'mytask_forcompany.company_id')
					->join('users', 'users.id', '=', 'mytask_forcompany.created_by')
					->where('mytask_forcompany.id', $id)
					->first();
	}

	public static function select_allmytask_forproject($filter,$search)
	{
		return DB::table('mytask_forproject')
					->select('mytask_forproject.*', 'tasks.task', 'projects.project_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forproject.task_id')
					->join('projects', 'projects.id', '=', 'mytask_forproject.project_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forproject.status', $filter)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('projects.project_name', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_mytask_forproject($filter,$search,$id)
	{
		return DB::table('mytask_forproject')
					->select('mytask_forproject.*', 'tasks.task', 'projects.project_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forproject.task_id')
					->join('projects', 'projects.id', '=', 'mytask_forproject.project_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forproject.status', $filter)
					->where('mytask_forproject.created_by', $id)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('projects.project_name', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_forproject_details($id)
	{
		return DB::table('mytask_forproject')
					->select('mytask_forproject.*', 'tasks.task', 'projects.project_name', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forproject.task_id')
					->join('projects', 'projects.id', '=', 'mytask_forproject.project_id')
					->join('users', 'users.id', '=', 'mytask_forproject.created_by')
					->where('mytask_forproject.id', $id)
					->first();
	}

	public static function select_allmytask_forothers($filter,$search)
	{
		return DB::table('mytask_forothers')
					->select('mytask_forothers.*', 'tasks.task')
					->join('tasks', 'tasks.id', '=', 'mytask_forothers.task_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forothers.status', $filter)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_mytask_forothers($filter,$search,$id)
	{
		return DB::table('mytask_forothers')
					->select('mytask_forothers.*', 'tasks.task')
					->join('tasks', 'tasks.id', '=', 'mytask_forothers.task_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('mytask_forothers.status', $filter)
					->where('mytask_forothers.created_by', $id)
					->where(function($query) use ($search){
					$query->where('tasks.task', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_alltask_request_forcontact($filter,$search)
	{
		return DB::table('mytask_forcontact')
					->select('mytask_forcontact.*', 'tasks.task', 'contacts.fullname', 'users.first_name', 'users.last_name')
					->join('task_receiver', 'task_receiver.task_id', '=', 'mytask_forcontact.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forcontact.task_id')
					->join('contacts', 'contacts.id', '=', 'mytask_forcontact.contact_id')
					->join('users', 'users.id', '=', 'mytask_forcontact.created_by')
					->where('mytask_forcontact.status', $filter)
					->where('task_receiver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forcontact.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('contacts.fullname', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_forothers_details($id)
	{
		return DB::table('mytask_forothers')
					->select('mytask_forothers.*', 'tasks.task', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forothers.task_id')
					->join('users', 'users.id', '=', 'mytask_forothers.created_by')
					->where('mytask_forothers.id', $id)
					->first();
	}

	public static function details_forcontact_request($id)
	{
		return DB::table('mytask_forcontact')
					->select('mytask_forcontact.*', 'tasks.task', 'contacts.fullname', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forcontact.task_id')
					->join('contacts', 'contacts.id', '=', 'mytask_forcontact.contact_id')
					->join('users', 'users.id', '=', 'mytask_forcontact.created_by')
					->where('mytask_forcontact.id', $id)
					->first();
	}

	public static function getthread($id,$status)
	{
		$thread = DB::table('thread_forcontact')
				->select('thread_forcontact.*', 'users.first_name', 'users.last_name', 'users.image')
				->join('users', 'users.id', '=', 'thread_forcontact.user_id')
				->where('thread_forcontact.forcontact_id', $id)
				->where('thread_forcontact.status', $status)
				->orderBy('id','desc')
				->get();
	
		$data = array();		
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Task::getFiles($value->id);
		}

		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Task::getFile($value->id);
		}
		return $data;
	}

	public static function getthread_forcompany($id,$status)
	{
		$thread = DB::table('thread_forcompany')
				->select('thread_forcompany.*', 'users.first_name', 'users.last_name', 'users.image')
				->join('users', 'users.id', '=', 'thread_forcompany.user_id')
				->where('thread_forcompany.forcompany_id', $id)
				->where('thread_forcompany.status', $status)
				->orderBy('id','desc')
				->get();
	
		$data = array();		
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Task::getFiles_company($value->id);
		}

		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Task::getFile_company($value->id);
		}
		return $data;
	}

	public static function getthread_forproject($id,$status)
	{
		$thread = DB::table('thread_forproject')
				->select('thread_forproject.*', 'users.first_name', 'users.last_name', 'users.image')
				->join('users', 'users.id', '=', 'thread_forproject.user_id')
				->where('thread_forproject.forproject_id', $id)
				->where('thread_forproject.status', $status)
				->orderBy('id','desc')
				->get();
	
		$data = array();		
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Task::getFile_project($value->id);
		}

		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Task::getFiles_project($value->id);
		}
		return $data;
	}

	public static function getthread_forothers($id,$status)
	{
		$thread = DB::table('thread_forothers')
				->select('thread_forothers.*', 'users.first_name', 'users.last_name', 'users.image')
				->join('users', 'users.id', '=', 'thread_forothers.user_id')
				->where('thread_forothers.forothers_id', $id)
				->where('thread_forothers.status', $status)
				->orderBy('id','desc')
				->get();
	
		$data = array();		
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Task::getFiles_others($value->id);
		}

		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Task::getFile_others($value->id);
		}
		return $data;
	}

	public static function getFiles($thread_id)
	{
		return DB::table('thread_forcontact_image')
				->select('thread_forcontact_image.image as filename', 'thread_forcontact_image.id', 'thread_forcontact_image.user_id', 'thread_forcontact_image.forcontact_id', 'thread_forcontact_image.thread_id', 'thread_forcontact_image.datetime_created')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFile($thread_id)
	{
		return DB::table('thread_forcontact_file')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFiles_company($thread_id)
	{
		return DB::table('thread_forcompany_image')
				->select('thread_forcompany_image.image as filename', 'thread_forcompany_image.id', 'thread_forcompany_image.user_id', 'thread_forcompany_image.forcompany_id', 'thread_forcompany_image.thread_id', 'thread_forcompany_image.datetime_created')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFile_company($thread_id)
	{
		return DB::table('thread_forcompany_file')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFiles_project($thread_id)
	{
		return DB::table('thread_forproject_image')
				->select('thread_forproject_image.image as filename', 'thread_forproject_image.id', 'thread_forproject_image.user_id', 'thread_forproject_image.forproject_id', 'thread_forproject_image.thread_id', 'thread_forproject_image.datetime_created')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFile_project($thread_id)
	{
		return DB::table('thread_forproject_file')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFiles_others($thread_id)
	{
		return DB::table('thread_forothers_image')
				->select('thread_forothers_image.image as filename', 'thread_forothers_image.id', 'thread_forothers_image.user_id', 'thread_forothers_image.forothers_id', 'thread_forothers_image.thread_id', 'thread_forothers_image.datetime_created')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFile_others($thread_id)
	{
		return DB::table('thread_forothers_file')
				->where('thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function select_alltask_request_forcompany($filter,$search)
	{
		return DB::table('mytask_forcompany')
					->select('mytask_forcompany.*', 'tasks.task', 'companies.company_name', 'users.first_name', 'users.last_name')
					->join('task_receiver', 'task_receiver.task_id', '=', 'mytask_forcompany.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forcompany.task_id')
					->join('companies', 'companies.id', '=', 'mytask_forcompany.company_id')
					->join('users', 'users.id', '=', 'mytask_forcompany.created_by')
					->where('mytask_forcompany.status', $filter)
					->where('task_receiver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forcompany.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('companies.company_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function details_forcompany_request($id)
	{
		return DB::table('mytask_forcompany')
					->select('mytask_forcompany.*', 'tasks.task', 'companies.company_name', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forcompany.task_id')
					->join('companies', 'companies.id', '=', 'mytask_forcompany.company_id')
					->join('users', 'users.id', '=', 'mytask_forcompany.created_by')
					->where('mytask_forcompany.id', $id)
					->first();
	}

	public static function select_alltask_request_forproject($filter,$search)
	{
		return DB::table('mytask_forproject')
					->select('mytask_forproject.*', 'tasks.task', 'projects.project_name', 'users.first_name', 'users.last_name')
					->join('task_receiver', 'task_receiver.task_id', '=', 'mytask_forproject.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forproject.task_id')
					->join('projects', 'projects.id', '=', 'mytask_forproject.project_id')
					->join('users', 'users.id', '=', 'mytask_forproject.created_by')
					->where('mytask_forproject.status', $filter)
					->where('task_receiver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forproject.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('projects.project_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function details_forproject_request($id)
	{
		return DB::table('mytask_forproject')
					->select('mytask_forproject.*', 'tasks.task', 'projects.project_name', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forproject.task_id')
					->join('projects', 'projects.id', '=', 'mytask_forproject.project_id')
					->join('users', 'users.id', '=', 'mytask_forproject.created_by')
					->where('mytask_forproject.id', $id)
					->first();
	}

	public static function select_alltask_request_forothers($filter,$search)
	{
		return DB::table('mytask_forothers')
					->select('mytask_forothers.*', 'tasks.task', 'users.first_name', 'users.last_name')
					->join('task_receiver', 'task_receiver.task_id', '=', 'mytask_forothers.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forothers.task_id')
					->join('users', 'users.id', '=', 'mytask_forothers.created_by')
					->where('mytask_forothers.status', $filter)
					->where('task_receiver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forothers.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function details_forothers_request($id)
	{
		return DB::table('mytask_forothers')
					->select('mytask_forothers.*', 'tasks.task', 'users.first_name', 'users.last_name')
					->join('tasks', 'tasks.id', '=', 'mytask_forothers.task_id')
					->join('users', 'users.id', '=', 'mytask_forothers.created_by')
					->where('mytask_forothers.id', $id)
					->first();
	}

	public static function select_alltask_approver_forcontact($filter,$search)
	{
		return DB::table('mytask_forcontact')
					->select('mytask_forcontact.*', 'tasks.task', 'contacts.fullname', 'users.first_name', 'users.last_name')
					->join('task_approver', 'task_approver.task_id', '=', 'mytask_forcontact.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forcontact.task_id')
					->join('contacts', 'contacts.id', '=', 'mytask_forcontact.contact_id')
					->join('users', 'users.id', '=', 'mytask_forcontact.approved_by')
					->where('mytask_forcontact.status', $filter)
					->where('mytask_forcontact.approved_request', $filter)
					->where('task_approver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forcontact.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('contacts.fullname', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_alltask_approver_forcompany($filter,$search)
	{
		return DB::table('mytask_forcompany')
					->select('mytask_forcompany.*', 'tasks.task', 'companies.company_name', 'users.first_name', 'users.last_name')
					->join('task_approver', 'task_approver.task_id', '=', 'mytask_forcompany.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forcompany.task_id')
					->join('companies', 'companies.id', '=', 'mytask_forcompany.company_id')
					->join('users', 'users.id', '=', 'mytask_forcompany.approved_by')
					->where('mytask_forcompany.status', $filter)
					->where('mytask_forcompany.approved_request', $filter)
					->where('task_approver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forcompany.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('companies.company_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_alltask_approver_forproject($filter,$search)
	{
		return DB::table('mytask_forproject')
					->select('mytask_forproject.*', 'tasks.task', 'projects.project_name', 'users.first_name', 'users.last_name')
					->join('task_approver', 'task_approver.task_id', '=', 'mytask_forproject.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forproject.task_id')
					->join('projects', 'projects.id', '=', 'mytask_forproject.project_id')
					->join('users', 'users.id', '=', 'mytask_forproject.approved_by')
					->where('mytask_forproject.status', $filter)
					->where('mytask_forproject.approved_request', $filter)
					->where('task_approver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forproject.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('projects.project_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

	public static function select_alltask_approver_forothers($filter,$search)
	{
		return DB::table('mytask_forothers')
					->select('mytask_forothers.*', 'tasks.task', 'users.first_name', 'users.last_name')
					->join('task_approver', 'task_approver.task_id', '=', 'mytask_forothers.task_id')
					->join('tasks', 'tasks.id', '=', 'mytask_forothers.task_id')
					->join('users', 'users.id', '=', 'mytask_forothers.approved_by')
					->where('mytask_forothers.status', $filter)
					->where('mytask_forothers.approved_request', $filter)
					->where('task_approver.user_id', Auth::id())
					->where(function($query) use ($search){
					$query->where('mytask_forothers.remarks', 'LIKE' ,"%$search%")
						->orwhere('tasks.task', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('id', 'desc')
					->get();
	}

}