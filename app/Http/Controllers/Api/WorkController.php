<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Work;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Work as WorkResource;
use Illuminate\Support\Facades\Validator;

class WorkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $work = Work::all();

        return $this->sendResponse(WorkResource::collection($work), 'Works retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails())
        {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $work = Work::create($input);

        return $this->sendResponse(new WorkResource($work), 'Work created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Work  $work
     * @return JsonResponse
     */
    public function show(Work $work): JsonResponse
    {
        if (is_null($work))
        {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new WorkResource($work), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Work  $work
     * @return JsonResponse
     */
    public function update(Request $request, Work $work): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $work->name = $input['name'];
        $work->status = $input['status'];
        $work->save();

        return $this->sendResponse(new WorkResource($work), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Work  $work
     * @return JsonResponse
     */
    public function destroy(Work $work): JsonResponse
    {
        $work->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
