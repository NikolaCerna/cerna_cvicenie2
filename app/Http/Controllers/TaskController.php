<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Note;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Note $note)
    {
        $tasks = $note->tasks()
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['tasks' => $tasks], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => ['required','string','min:3','max:255'],
            'is_done' => ['sometimes','boolean'],
            'due_at' => ['nullable','date'],
        ]);

        $task = $note->tasks()->create($validated);

        return response()->json([
            'message' => 'Úloha bola úspešne vytvorená.',
            'task' => $task,
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show(Note $note, Task $task)
    {
        if ($task->note_id !== $note->id) {
            return response()->json([
                'message' => 'Úloha nepatrí k tejto poznámke.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'task' => $task
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'is_done' => ['sometimes', 'boolean'],
            'due_at' => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Úloha bola úspešne aktualizovaná.',
            'task' => $task,
        ], Response::HTTP_OK);
    }

//    public function update(Request $request, int $noteId, int $taskId)
//    {
//        $note = Note::find($noteId);
//        if (!$note) {
//            return response()->json([
//                'message' => 'Poznámka nenájdená.'
//            ], Response::HTTP_NOT_FOUND);
//        }
//        $task = $note->tasks()->find($taskId);
//        if (!$task) {
//            return response()->json([
//                'message' => 'Úloha nenájdená.'
//            ], Response::HTTP_NOT_FOUND);
//        }
//
//        $validated = $request->validate([
//            'title' => ['required' , 'string', 'max:255'],
//            'is_done' => ['sometimes', 'boolean'],
//            'due_at' => ['nullable', 'date'],
//        ]);
//
//        $task->update($validated);
//
//        return response()->json([
//            'message' => 'Úloha bola úspešne aktualizovaná.',
//            'task' => $task,
//        ], Response::HTTP_OK);
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note, Task $task)
    {
        if ($task->note_id !== $note->id) {
            return response()->json([
                'message' => 'Úloha nepatrí k tejto poznámke.'
            ], Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json([
            'message' => 'Úloha bola úspešne odstránená.'
        ], Response::HTTP_OK);
    }


}
