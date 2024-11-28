<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
{
    $page = $request->input('page', 1);
    $offset = $request->input('offset', 10);

    $skip = ($page - 1) * $offset;

    $devices = Device::skip($skip)->take($offset)->get();

    return response()->json($devices);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'serial' => 'required|string',
            'store_code' => 'required|string',
            'store_name' => 'required|string',
            'status' => 'required|in:active,inactive,pending',
            'approval_status' => 'required|in:approved,pending,rejected',
            'counter' => 'required|integer',
        ]);

        $device = Device::create($validated);
        return response()->json($device, 201);
    }

    public function show($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        return response()->json($device);
    }

    public function update(Request $request, $id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }
        $validated = $request->validate([
            'serial' => 'string',
            'store_code' => 'string',
            'store_name' => 'string',
            'status' => 'in:active,inactive,pending',
            'approval_status' => 'in:approved,pending,rejected',
            'counter' => 'integer',
        ]);

        $device->update($validated);

        return response()->json($device);
    }

    public function destroy($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        $device->delete();

        return response()->json(['message' => 'Device deleted successfully']);
    }
}
