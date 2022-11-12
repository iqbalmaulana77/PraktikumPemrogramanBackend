<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientRegistration;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::withCount('patientRegistrations')->get();
        $data = [
            'statusCode' => 200,
            'message' => 'Get All Resource',
            'data' => $patients
        ];

        if (count($patients) == 0) {
            $data['message'] = 'Data is empty';
        }

        return response()->json($data, 200);
    }

    public function searchByName($name)
    {
        if (!$name) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'name is required'
            ], 400);
        }

        $patients = Patient::withCount('patientRegistrations')->where('name', 'like', "%$name%")->get();
        if (count($patients) > 0) {
            $data = [
                'statusCode' => 200,
                'message' => 'Get searched resource',
                'data' => $patients
            ];
        } else {
            $data = [
                'statusCode' => 404,
                'message' => 'Resource not found'
            ];
        }
        return response()->json($data, $data['statusCode']);
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|min:2|max:75',
            'phone' => 'required|numeric|min:9999999|max:9999999999999',
            'address' => 'required|min:5'
        ]);

        $patient = Patient::create($input);

        $data = [
            'statusCode' => 201,
            'message' => 'Resource is added successfully',
            'data' => $patient
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Resource not found'
            ], 404);
        }

        $data = [
            'statusCode' => 200,
            'message' => 'Get Detail Resource',
            'data' => $patient
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:75',
            'phone' => 'required|numeric|min:9999999|max:9999999999999',
            'address' => 'required|min:5'
        ]);

        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Resource not found'
            ], 404);
        }

        $input = [
            'name' => $request->name ?? $patient->name,
            'phone' => $request->phone ?? $patient->phone,
            'address' => $request->address ?? $patient->address
        ];

        $patient->update($input);

        $data = [
            'statusCode' => 200,
            'message' => 'Resource is update successfully',
            'data' => $patient
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Resource not found'
            ], 404);
        }

        $patient->delete();
        PatientRegistration::where('patient_id', $patient->id)->delete();

        $data = [
            'statusCode' => 200,
            'message' => 'Resource is delete successfully'
        ];

        return response()->json($data, 200);
    }
}
