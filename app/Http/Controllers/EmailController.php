<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $collection = Email::with(['messages'])->get();

        return response()->json($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreEmailRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEmailRequest $request)
    {
        $data = $request->only([
            'settings.send.host',
            'settings.send.port',
            'settings.send.login',
            'settings.send.password',
            'settings.send.secure',
        ]);

        $model = new Email();
        $model->email = $request->input('email');
        $model->settings = $data['settings'];

        $model->save();

        return response()->json($model, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\StoreEmailRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreEmailRequest $request, $id)
    {
        $data = $request->only([
            'settings.send.host',
            'settings.send.port',
            'settings.send.login',
            'settings.send.password',
            'settings.send.secure',
        ]);

        $model = Email::findOrFail($id);

        $model->email = $request->input('email');
        $model->settings = $data['settings'];

        $model->save();

        return response()->json($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $model = Email::findOrFail($id);

        $deleted = $model->delete();

        return response()->json(['deleted' => $deleted], $deleted ? 200 : 404);
    }
}
