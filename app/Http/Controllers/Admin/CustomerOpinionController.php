<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerOpinion;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\customer_opinions\Store;
use App\Http\Requests\Admin\customer_opinions\Update;

class CustomerOpinionController extends Controller
{
    public function __construct()
    {
        $name = 'customer-opinion';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index($id = null)
    {
        if (request()->ajax()) {
            $customerOpinions = CustomerOpinion::search(request()->searchArray)->paginate(30);
            $html = view('admin.customer_opinions.table', compact('customerOpinions'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.customer_opinions.index');
    }

    public function create()
    {
        return view('admin.customer_opinions.create');
    }

    public function store(Store $request)
    {
        CustomerOpinion::create($request->validated());
        Report::addToLog(__('admin.add_customer_opinion'));
        return response()->json(['url' => route('admin.customer-opinions.index')]);
    }

    public function edit($id)
    {
        $customerOpinion = CustomerOpinion::findOrFail($id);
        return view('admin.customer_opinions.edit', ['customerOpinion' => $customerOpinion]);
    }

    public function update(Update $request, $id)
    {
        CustomerOpinion::findOrFail($id)->update($request->validated());
        Report::addToLog(__('admin.update_customer_opinion'));
        return response()->json(['url' => route('admin.customer-opinions.index')]);
    }

    public function show($id)
    {
        $customerOpinion = CustomerOpinion::findOrFail($id);
        return view('admin.customer_opinions.show', ['customerOpinion' => $customerOpinion]);
    }

    public function destroy($id)
    {
        CustomerOpinion::findOrFail($id)->delete();
        Report::addToLog(__('admin.delete_customer_opinion'));
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CustomerOpinion::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog(__('admin.delete_many_customer_opinions'));
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
