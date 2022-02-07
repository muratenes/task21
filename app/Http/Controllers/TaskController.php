<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest()->get();

        return response([
            'data' => TaskResource::collection($tasks)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();

        $task = Task::create(array_merge($data, [
            'user_id' => $request->user()->id,
            'status' => Task::TODO
        ]));

        return response([
            'data' => new TaskResource($task)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response([
            'data' => new TaskResource($task)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskUpdateRequest $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());

        return response([
            'data' => new TaskResource($task)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response([
            'data' => new TaskResource($task)
        ], 200);
    }
}
