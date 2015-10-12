<?php

class NotificationController extends \BaseController {

	public function contact_notification()
	{

		$pagetitle = 'Contact Notification';

		if(Session::get('role') == 1)
		{
			$contact_result_ofrequest = DB::table('contacts')
											->select('contacts.*', 'users.first_name', 'users.last_name')
											->join('users', 'users.id', '=' , 'contacts.approved_by')
											->where('contacts.notif', '=', '1')
											->orderBy('notif_dt', 'desc')
											->paginate(5);
		
		}else{
			$contact_result_ofrequest = DB::table('contacts')
											->select('contacts.*', 'users.first_name', 'users.last_name')
											->join('users', 'users.id', '=' , 'contacts.approved_by')
											->where('contacts.notif', '=', '1')
											->where('contacts.created_by', Auth::id())
											->orderBy('notif_dt', 'desc')
											->paginate(5);
			
		}
		
		return View::make('notification.contact', compact('pagetitle', 'contact_result_ofrequest'));
	}

	public function company_notification()
	{

		$pagetitle = 'Company Notification';

		if(Session::get('role') == 1)
		{
			$company_result_ofrequest = DB::table('companies')
											->select('companies.*', 'users.first_name', 'users.last_name')
											->join('users', 'users.id', '=' , 'companies.approved_by')
											->where('companies.notif', '=', '1')
											->orderBy('notif_dt', 'desc')
											->paginate(10);
											// ->get();
		
		}else{
			$company_result_ofrequest = DB::table('companies')
											->select('companies.*', 'users.first_name', 'users.last_name')
											->join('users', 'users.id', '=' , 'companies.approved_by')
											->where('companies.notif', '=', '1')
											->where('companies.created_by', Auth::id())
											->orderBy('notif_dt', 'desc')
											->paginate(10);
											// ->get();
			
		}
		
		return View::make('notification.company', compact('pagetitle', 'company_result_ofrequest'));
	}

	public function project_notification()
	{

		$pagetitle = 'Project Notification';

		if(Session::get('role') == 1)
		{
			$project_result_ofrequest = DB::table('projects')
											->select('projects.*', 'users.first_name', 'users.last_name')
											->join('users', 'users.id', '=' , 'projects.approved_by')
											->where('projects.notif', '=', '1')
											->orderBy('notif_dt', 'desc')
											->paginate(10);
		
		}else{
			$project_result_ofrequest = DB::table('projects')
											->select('projects.*', 'users.first_name', 'users.last_name')
											->join('users', 'users.id', '=' , 'projects.approved_by')
											->where('projects.notif', '=', '1')
											->where('projects.bdo_id', Auth::id())
											->orderBy('notif_dt', 'desc')
											->paginate(10);
			
		}
		
		return View::make('notification.project', compact('pagetitle', 'project_result_ofrequest'));
	}


}