<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', true)->get();
        return ServiceResource::collection($services);
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return new ServiceResource($service);
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return new ServiceResource($service);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'Service deleted']);
    }
}