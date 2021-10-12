<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\TelecommunicationCenter;
use App\Station;
use App\DocumentType;
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
        $tc = TelecommunicationCenter::all();
        return DataTable::of($tc)
        ->addColumn('action', function ($tc) {
            $editBtn =  '<a type="button" ' .
                            ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_device" ' .
                            ' onclick="editTelecommunicationCenter('. $tc->tc_id .')"><i class="fas fa-user-edit"></i>' .
                        '</a>';

            $deleteBtn =  '<a type="button" ' .
                            ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                            ' onclick="deleteTelecommunicationCenter(' . $tc->tc_id . ')"><i class="fas fa-trash"></i>' .
                        '</a>';

            return $editBtn . $deleteBtn;
        })
        ->rawColumns(
        [
            'action',
        ])
        ->make(true);
    }
    public function findTelecommunicationCenter(Request $request)
    {
        $tc = TelecommunicationCenter::find($request->tc_id);
        return response()->json(['success'=>$tc]);
    }

    public function createTelecommunicationCenter(Request $request)
    {
        $tc = new TelecommunicationCenter;
        $tc->tc_name = $request->tc_name;
        $tc->tc_address = $request->tc_address;
        $tc->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function editTelecommunicationCenter(Request $request)
    {
        $tc = TelecommunicationCenter::find($request->tc_id);
        $tc->tc_name = $request->tc_name;
        $tc->tc_address = $request->tc_address;
        $tc->save();
        return response()->json(['success'=>"Sửa thành công !!!"]);
    }

    public function deleteTelecommunicationCenter(Request $request)
    {
        $tc = TelecommunicationCenter::find($request->tc_id);
        $tc->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }
//======================================================================//
//=================== Station Begin =======================//
    public function indexMangerStation()
    {
        $tc = TelecommunicationCenter::all();
        return view('admin/telecommunication/managerStation',['tc'=>$tc]);
    }

    public function getManagerStation()
    {
        $station = Station::all();
        return DataTables::of($station)
            ->addColumn('action', function ($station) {
                $editBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_device" ' .
                                ' onclick="editStation('. $station->station_id .')"><i class="fas fa-user-edit"></i>' .
                            '</a>';

                $deleteBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                                ' onclick="deleteStation(' . $station->station_id . ')"><i class="fas fa-trash"></i>' .
                            '</a>';

                return $editBtn . $deleteBtn;
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
    }

    public function findStation(Request $request)
    {
        $station = Station::find($request->station_id);
        return response()->json(['success'=>$station]);
    }

    public function createStation(Request $request)
    {
        $station = new Station;
        $station->station_name = $request->station_name;
        $station->station_lat = $request->station_lat;
        $station->station_long = $request->station_long;
        $station->tc_id = $request->tc_id;
        $station->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function editStation(Request $request)
    {
        $station = Station::find($request->station_id);
        $station->station_name = $request->station_name;
        $station->station_lat = $request->station_lat;
        $station->station_long = $request->station_long;
        $station->tc_id = $request->tc_id;
        $station->save();
        return response()->json(['success'=>"Sửa thành công !!!"]);
    }

    public function deleteStation(Request $request)
    {
        $station = Station::find($request->station_id);
        $station->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }
//======================================================================//
//=================== Document_Type Begin =======================//
    public function indexManagerDocumentType()
    {
        return view('admin/telecommunication/managerDocumentType');
    }

    public function getManagerDocumentType()
    {
        $dt = DocumentType::all();
        return DataTables::of($dt)
            ->addColumn('action', function ($dt) {
                $editBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-primary btn-circle btn-sm btn-edit_device" ' .
                                ' onclick="editDocumentType('. $dt->dt_id .')"><i class="fas fa-user-edit"></i>' .
                            '</a>';

                $deleteBtn =  '<a type="button" ' .
                                ' class="btn btn-outline-danger btn-circle btn-sm" ' .
                                ' onclick="deleteDocumentType(' . $dt->dt_id . ')"><i class="fas fa-trash"></i>' .
                            '</a>';

                return $editBtn . $deleteBtn;
            })
            ->rawColumns(
            [
                'action',
            ])
            ->make(true);
    }

    public function findDocumentType(Request $request)
    {
        $dt = DocumentType::find($request->dt_id);
        return response()->json(['success'=>$dt]);
    }

    public function createDocumentType(Request $request)
    {
        $dt = new DocumentType;
        $dt->dt_name = $request->dt_name;
        $dt->dt_contnet = $request->dt_content;
        $dt->save();
        return response()->json(['success'=>"Tạo thành công !!!"]);
    }

    public function editDocumentType(Request $request)
    {
        $dt = DocumentType::find($request->dt_id);
        $dt->dt_name = $request->dt_name;
        $dt->dt_contnet = $request->dt_content;
        $dt->save();
        return response()->json(['success'=>"Sửa thành công !!!"]);
    }

    public function deleteDocumentType()
    {
        $dt = DocumentType::find($request->dt_id);
        $dt->forceDelete();
        return response()->json(['success'=>"Đã Xoá"]);
    }

}