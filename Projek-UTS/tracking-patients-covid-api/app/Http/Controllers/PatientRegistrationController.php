<?php

namespace App\Http\Controllers;

use App\Patient;
use App\PatientRegistration;
use Illuminate\Http\Request;

class PatientRegistrationController extends Controller
{
    public function index()
    {
        $historyPatients = PatientRegistration::with('patient')->get();
        $data = [
            'statusCode' => 200,
            'message' => 'Get All Resource',
            'data' => $historyPatients
        ];

        if (count($historyPatients) == 0) {
            $data['message'] = 'Data is empty';
        }

        return response()->json($data, 200);
    }

    public function searchByStatus($status)
    {
        if (!$status) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'status is required'
            ], 400);
        }

        $historyPatients = PatientRegistration::with('patient')->where('status', $status)->get();
        $data = [
            'statusCode' => 200,
            'message' => "Get $status resource",
            'total' => count($historyPatients),
            'data' => $historyPatients
        ];
        return response()->json($data, 200);
    }

    public function checkin(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|integer',
            'create_by' => 'required|integer'
        ]);

        $patient = Patient::find($request->patient_id);

        if (!$patient) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Data not found'
            ], 404);
        }

        $input = [
            'patient_id' => $request->patient_id,
            'status' => 'positive',
            'in_date_at' => date('Y-m-d'),
            'create_by' => $request->create_by
        ];

        $patientRegistration = PatientRegistration::create($input);

        $data = [
            'statusCode' => 201,
            'message' => 'Success',
            'data' => $patientRegistration
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $patientRegistration = PatientRegistration::with('patient')->find($id);

        if (!$patientRegistration) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Resource not found'
            ], 404);
        }

        $data = [
            'statusCode' => 200,
            'message' => 'Get Detail Resource',
            'data' => $patientRegistration
        ];

        return response()->json($data, 200);
    }

    public function checkout(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:recovered,dead',
            'update_by' => 'required|integer'
        ]);

        $patientRegistration = PatientRegistration::find($id);

        if (!$patientRegistration) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Data not found'
            ], 404);
        }

        $input = [
            'status' => $request->status,
            'out_date_at' => date('Y-m-d'),
            'update_by' => $request->update_by
        ];

        $patientRegistration->update($input);

        $data = [
            'statusCode' => 200,
            'message' => 'Success',
            'data' => $patientRegistration
        ];

        return response()->json($data, 200);
    }
}
