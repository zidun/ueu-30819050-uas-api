<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::all();
        return $this->makeResponse($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip_dosen' => 'required',
            'name_dosen' => 'required',
            'gender_dosen' => 'required',
            'address_dosen' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->respondValidationError('The given data was invalid', $validator->errors());
        }

        $row = Dosen::create($request->all());

        return $this->respondCreated($row);
    }

    public function show($id)
    {
        $row = Dosen::find($id);

        return $this->makeResponse($row);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip_dosen' => 'required|max:8',
            'name_dosen' => 'required',
            'gender_dosen' => 'required',
            'address_dose' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->respondValidationError('The given data was invalid', $validator->errors());
        }

        $row = Dosen::find($id);
        $row->update($request->all());

        return $this->makeResponse($row);
    }

    public function destroy($id)
    {
        $row = Dosen::findOrFail($id);
        $row->delete();
        return $this->makeResponse(null, 'Data has been deleted');
    }
}
