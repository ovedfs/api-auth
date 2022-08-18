<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tasks = auth()->user()->tasks();
        $tasks = Task::where('user_id', auth()->user()->id)->get();

        return response()->json([
            'message' => 'Listado de tareas',
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:255',
            'color' => 'required|string',
        ]);

        $task = new Task();
        $task->text = $request->text;
        $task->color = $request->color;
        $task->user_id = auth()->user()->id;

        if($task->save()) {
            return response()->json([
                'message' => 'Tarea creada correctamente',
                'task' => $task,
            ]);
        }

        return response()->json([
            'message' => 'La tarea no pudo registrarse',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json([
            'message' => 'Tarea encontrada',
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'text' => 'required|max:255',
            'color' => 'required|string',
        ]);

        $task->text = $request->text;
        $task->color = $request->color;

        if($task->save()) {
            return response()->json([
                'message' => 'Tarea actualizada correctamente',
                'task' => $task,
            ]);
        }

        return response()->json([
            'message' => 'La tarea no pudo actualizarse',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->delete()) {
            return response()->json([
                'message' => 'Tarea eliminada correctamente',
            ]);
        }

        return response()->json([
            'message' => 'La tarea no pudo eliminarse',
        ]);
    }
}
