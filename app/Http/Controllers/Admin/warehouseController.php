<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exception\Handler\render;
use DataTables;

class warehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

//=================== Warehouse =======================//
    public function indexManagerWarehouse()
    {
        $user = User::all();
        $warehouse = DB::table('warehouse')
            ->join('users','users.id','=','warehouse.user_id')
            ->select('warehouse.*','.fullname')->get();
        return view('admin/warehouse/managerWarehouse',['user'=>$user]);
    }

    public function getManagerWarehouse()
    {
        $warehouse = DB::table('warehouse')
            ->join('users','users.id','=','warehouse.user_id')
            ->select('warehouse.*','.fullname')->get();
            return DataTables::of($warehouse)
            ->addColumn('action', function ($warehouse) {
                $editBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_warehouse" ' .
                                ' onclick="editWarehouse('. $warehouse->warehouse_id .')"><i class="fas fa-user-edit"></i>' .
                            '</a>';

                $deleteBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                                ' onclick="deleteWarehouse(' . $warehouse->warehouse_id . ')"><i class="fas fa-trash"></i>' .
                            '</a>';

                return $editBtn . $deleteBtn;
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
    }

    public function createWarehouse(Request $request)
    {
        $warehouse = new Warehouse;
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->user_id = $request->user_id;
        $warehouse->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function findWarehouse(Request $request)
    {
        $warehouse = Warehouse::find($request->warehouse_id);
        return response()->json(['success'=>$warehouse]);
    }

    public function editWarehouse(Request $request)
    {
        $warehouse = Warehouse::find($request->warehouse_id);
        $warehouse->warehouse_name = $request->warehouse_name;
        $warehouse->user_id = $request->user_id;
        $warehouse->save();
        return response()->json(['success'=>"Sửa Thành Công !!!"]);
    }
    public function deleteWarehouse(Request $request)
    {
        $warehouse = Warehouse::find($request->warehouse_id);
        $warehouse->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }
}