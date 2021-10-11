<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\TelecommunicationCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;


class telecommunicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//=================== Telecommunication Begin =======================//

    public function indexManagerTelecommunicationCenter()
    {
        return view('admin/telecommunication/managerTelecommunicationCenter');
    }

    public function getManagerTelecommunicationCenter()
    {
        $TelecommunicationCenter = TelecommunicationCenter::all();
        return $TelecommunicationCenter;
    }
}