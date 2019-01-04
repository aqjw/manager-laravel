<?php

namespace Aqjw\ManagerLaravel\Controllers;

use Aqjw\ManagerLaravel\Library\Models\Models;
use Aqjw\ManagerLaravel\Library\Models\Relations\GetList;

/**
 * ModelsController
 */
class ModelsController
{
	
	function __construct()
	{
		//
	}

	public function index()
	{
		$models = app(Models::class)->getListModels();

		return view('managerl::models.index',
			compact('models')
		);
	}

	public function view($name)
	{
		// Aqjw\ManagerLaravel\Library\Models\Relations\GetList
		$relations = app(GetList::class)->getList($name);

		return view('managerl::models.view', 
			compact('name', 'relations')
		);
	}
}