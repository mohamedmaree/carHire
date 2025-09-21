<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use App\Models\IntroService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroServices\Store;

class IntroServiceController extends Controller
{

    public function __construct()
    {
        $name = 'intro-service';
        $this->middleware('permission:read-all-' . $name)->only([ 'index' ]);
        $this->middleware('permission:read-' . $name)->only([ 'show' ]);
        $this->middleware('permission:create-' . $name)->only([ 'create', 'store' ]);
        $this->middleware('permission:update-' . $name)->only([ 'edit', 'update' ]);
        $this->middleware('permission:delete-' . $name)->only([ 'destroy' ]);
    }

    public function index($id = null)
    {
        if (request()->ajax()) {
            $services = IntroService::search(request()->searchArray)->paginate(30);
            $html = view('admin.introservices.table' ,compact('services'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.introservices.index');
    }
  

    public function create()
    {
        return view('admin.introservices.create');
    }
    public function store(Store $request)
    {
        IntroService::create($request->validated());
        Report::addToLog('  اضافه خدمة الي قسم خدماتنا بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introservices.index')]);
    }

    public function edit($id)
    {
        $service = IntroService::findOrFail($id);
        return view('admin.introservices.edit' , ['service' => $service]);
    }

    public function update(Store $request, $id)
    {
        IntroService::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل خدمة في قسم خدماتنا بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introservices.index')]);
    }


    public function show($id)
    {
        $service = IntroService::findOrFail($id);
        return view('admin.introservices.show' , ['service' => $service]);
    }

    public function destroy($id)
    {
        IntroService::findOrFail($id)->delete();
        Report::addToLog('  حذف خدمة من قسم خدماتنا بالموقع التعريفي') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroService::whereIntegerInRaw('id' , $ids)->get()->each->delete()) {
            Report::addToLog('  حذف مجموعه من الخدمات من قسم خدماتنا بالموقع التعريفي') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
