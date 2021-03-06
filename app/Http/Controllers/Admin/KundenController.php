<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Auth;
use App\Client;
use App\Company;
use App\Http\Controllers\MenuController;
class KundenController extends AdminController
{
    //
    public function __construct()
    {
        parent::__construct();


        $this->template='admin_page/kunden';
    }

    public function index(){
        /*$this->user=Auth::user();*/

        if(Gate::denies('VIEW_ADMIN')){

            abort(403);
        }
        $data_nav['menu']=MenuController::index('admin_categories');
       
        $data_content['firms']=Company::orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        
        $data=array();
        $this->title = 'Панель администратора';
        return $this->renderOutput($data,$data_content);
    }
}
