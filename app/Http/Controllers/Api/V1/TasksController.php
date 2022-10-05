<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    protected function resourceAbilityMap()
    {
        return [
            'index' => 'viewAny',
            'show' => 'view',
            'store' => 'create',
            'update' => 'update',
            'destroy' => 'delete',
            'status' => 'status'
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tasks = Task::ofUser()->get();
        return TaskResource::collection($tasks);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreTaskRequest $request
     * @param Task $task
     * @return TaskResource
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response(null, 204);
    }

    /**
     * Change task status
     *
     * @param Task $task
     * @return Response
     */
    public function status(Task $task)
    {
        $task->toggleStatus();
        return response(null, 204);
    }
}
