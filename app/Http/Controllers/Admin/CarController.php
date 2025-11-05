<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cars\Store;
use App\Http\Requests\Admin\cars\Update;
use App\Models\Car;
use App\Models\CarImage;
use App\Traits\Report;

class CarController extends Controller
{
    public function __construct()
    {
        $name = 'car';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $cars = Car::with('pricePackages')->search(request()->searchArray)->paginate(30);
            $html = view('admin.cars.table', compact('cars'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.cars.index');
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        
        // Process features if provided - convert comma-separated strings to arrays
        if ($request->has('features')) {
            $features = [];
            foreach ($request->features as $lang => $featuresText) {
                if (!empty($featuresText)) {
                    $featuresArray = array_map('trim', explode(',', $featuresText));
                    $featuresArray = array_filter($featuresArray); // Remove empty values
                    $features[$lang] = $featuresArray;
                }
            }
            $data['features'] = $features;
        }
        
        $car = Car::create($data);
        
        // Create default price packages if provided
        if ($request->has('price_packages')) {
            foreach ($request->price_packages as $packageData) {
                $car->pricePackages()->create($packageData);
            }
        }
        
        // Handle car images
        if ($request->hasFile('car_images')) {
            foreach ($request->file('car_images') as $image) {
                $carImage = new CarImage();
                $carImage->image = $image;
                $carImage->car_id = $car->id;
                $carImage->save();
            }
        }
        
        Report::addToLog('إضافة سيارة جديدة');
        return response()->json(['url' => route('admin.cars.index')]);
    }

    public function edit($id)
    {
        $car = Car::with(['pricePackages', 'images'])->findOrFail($id);
        return view('admin.cars.edit', ['car' => $car]);
    }

    public function update(Update $request, $id)
    {
        $car = Car::findOrFail($id);
        $data = $request->validated();
        
        // Process features if provided - convert comma-separated strings to arrays
        if ($request->has('features')) {
            $features = [];
            foreach ($request->features as $lang => $featuresText) {
                if (!empty($featuresText)) {
                    $featuresArray = array_map('trim', explode(',', $featuresText));
                    $featuresArray = array_filter($featuresArray); // Remove empty values
                    $features[$lang] = $featuresArray;
                }
            }
            $data['features'] = $features;
        }
        
        $car->update($data);
        
        // Update price packages if provided
        if ($request->has('price_packages')) {
            $car->pricePackages()->delete(); // Remove existing packages
            foreach ($request->price_packages as $packageData) {
                $car->pricePackages()->create($packageData);
            }
        }
        
        // Handle car images - add new images
        if ($request->hasFile('car_images')) {
            foreach ($request->file('car_images') as $image) {
                $carImage = new CarImage();
                $carImage->image = $image;
                $carImage->car_id = $car->id;
                $carImage->save();
            }
        }
        
        Report::addToLog('تعديل سيارة');
        return response()->json(['url' => route('admin.cars.index')]);
    }

    public function show($id)
    {
        $car = Car::with(['pricePackages', 'images'])->findOrFail($id);
        return view('admin.cars.show', ['car' => $car]);
    }
    
    public function deleteImage($carId, $id)
    {
        $carImage = CarImage::where('car_id', $carId)->findOrFail($id);
        $carImage->delete();
        Report::addToLog('حذف صورة سيارة');
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id)->delete();
        Report::addToLog('حذف سيارة');
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Car::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog('حذف العديد من السيارات');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
