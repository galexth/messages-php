<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $collection = Sms::with(['messages'])->get();

        return response()->json($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', Rule::unique('sms')],
        ]);

        $model = Sms::create($request->only(['phone']));

        return response()->json($model, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => ['required', Rule::unique('sms')->ignore($id)],
        ]);

        $model = Sms::findOrFail($id);

        $model->update($request->only(['phone']));

        return response()->json($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $model = Sms::findOrFail($id);

        $deleted = $model->delete();

        return response()->json(['deleted' => $deleted], $deleted ? 200 : 404);
    }
}
