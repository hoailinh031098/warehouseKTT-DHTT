<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeviceGroup;
use App\Device;
use App\DeviceLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exception\Handler\render;
use DataTables;

class deviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//=================== Device Group Begin =======================//
    public function indexManagerDeviceGroup()
    {
        return view('admin/device/managerDeviceGroup');
    }

    public function getManagerDeviceGroup()
    {
        $deviceGroup = DeviceGroup::all();
            return DataTables::of($deviceGroup)
            ->addColumn('action', function ($deviceGroup) {
                $editBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_device" ' .
                                ' onclick="editDeviceGroup('. $deviceGroup->dg_id .')"><i class="fas fa-user-edit"></i>' .
                            '</a>';

                $deleteBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                                ' onclick="deleteDeviceGroup(' . $deviceGroup->dg_id . ')"><i class="fas fa-trash"></i>' .
                            '</a>';

                return $editBtn . $deleteBtn;
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
        //return Datatables::of($device)->make(true);
    }

    public function findDeviceGroup(Request $request)
    {
        $dg = DeviceGroup::find($request->dg_id);
        return response()->json(['success'=>$dg]);
    }


    public function createDeviceGroup(Request $request)
    {
        $deviceGroup = new DeviceGroup;
        $deviceGroup->dg_name = $request->dg_name;
        $deviceGroup->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function editDeviceGroup(Request $request)
    {
        $id = $request->dg_id;
        $dg = DeviceGroup::where('dg_id',$id)
        ->update(['dg_name'=>$request->dg_name]);
        return response()->json(['success'=>'Đã Sửa !!!']);
    }

    public function deleteDeviceGroup(Request $request)
    {
        $dg = DeviceGroup::find($request->dg_id);
        $dg->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }
//=================== Device Group End =======================//



//=================== Device Begin ===========================//
    public function indexManagerDevice()
    {
        $dg = DeviceGroup::all();
        $device = DB::table('device')
            ->join('device_group','device.dg_id','=','device_group.dg_id')
            ->select('device.*','.dg_name')->get();
        return view('admin/device/managerDevice',
        [
            'dg'=>$dg]);
        // return $device;
    }

    public function getManagerDevice()
    {
        $device = DB::table('device')
            ->join('device_group','device.dg_id','=','device_group.dg_id')
            ->select('device.*','.dg_name')->get();
            return DataTables::of($device)
            ->addColumn('action', function ($device) {
                $editBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_device" ' .
                                ' onclick="editDevice('. $device->device_id .')"><i class="fas fa-user-edit"></i>' .
                            '</a>';

                $deleteBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                                ' onclick="deleteDevice(' . $device->device_id . ')"><i class="fas fa-trash"></i>' .
                            '</a>';

                return $editBtn . $deleteBtn;
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
        //return Datatables::of($device)->make(true);
    }

    public function findDevice(Request $request)
    {
        $device = Device::find($request->device_id);
        return response()->json(['success'=>$device]);
    }

    public function createDevice(Request $request)
    {
        $device = new Device;
        $device->device_name = $request->device_name;
        $device->dg_id = $request->dg_id;
        $device->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function editDevice(Request $request)
    {
        $device = Device::find($request->device_id);
        $device->device_name = $request->device_name;
        $device->dg_id = $request->dg_id;
        $device->save();
        return response()->json(['success'=>"Thay đổi thành công !!!"]);
    }

    public function deleteDevice(Request $request)
    {
        $device = Device::find($request->device_id);
        $device->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }
//=================== Device End =========================//


//=================== Device Line Begin =======================//
    
    public function indexManagerDeviceLine()
    {
        $dg = DeviceGroup::all();
        // return $dg;
        return view('admin/device/managerDeviceLine',
        ['dg'=>$dg]);
    }

    public function getManagerDeviceLine()
    {
        $dl = DB::table('device_line')
            ->join('device','device.device_id','=','device_line.device_id')
            ->join('device_group','device.dg_id','=','device_group.dg_id')
            ->select('device_line.*','.dg_name','.device_name')->get();
            return DataTables::of($dl)
            ->addColumn('action', function ($dl) {
                $editBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_deviceLine" ' .
                                ' onclick="editDeviceLine('. $dl->dl_id .')"><i class="fas fa-user-edit"></i>' .
                            '</a>';

                $deleteBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                                ' onclick="deleteDeviceLine(' . $dl->dl_id . ')"><i class="fas fa-trash"></i>' .
                            '</a>';

                return $editBtn . $deleteBtn;
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
    }

    public function findDeviceByDG(Request $request)
    {
        $device = Device::where('dg_id', $request->dg_id)->get();
        return response()->json(['success'=>$device]);
    }

    public function createDeviceLine(Request $request)
    {
        $deviceLine = new DeviceLine;
        $deviceLine->dl_name = $request->dl_name;
        $deviceLine->device_id = $request->device_id;
        $deviceLine->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function editDeviceLine(Request $request)
    {
        $deviceLine = DeviceLine::find($request->dl_id);
        $deviceLine->dl_name = $request->dl_name;
        $deviceLine->device_id = $request->device_id;
        $deviceLine->save();
        return response()->json(['success'=>"Thay đổi thành công !!!"]);
    }

    public function deleteDeviceLine(Request $request)
    {
        $deviceLine = DeviceLine::find($request->dl_id);
        $deviceLine->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }

    public function findDeviceLine(Request $request)
    {
        $deviceLine = DeviceLine::find($request->dl_id);
        $device = Device::where('device_id',$deviceLine->device_id)->first();
        return response()->json([   
                                    'deviceLine'=>$deviceLine,
                                    'device'=>$device,
                                ]);
    }


}