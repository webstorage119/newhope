<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }

    public function index(Request $request)
    {
        if (!$request->wantsJson()) {
            abort(404);
        }

        $topic = Topic::getModel();

        if ($request->get('search')) {
            $search = '%' . $request->get('search') . '%';
            $topic = $topic->orWhere('id', 'like', $search);
            $topic = $topic->orWhere('username', 'like', $search);
            $topic = $topic->orWhere('pid', 'like', $search);
        }

        if ($request->get('user')) {
            $topic = $topic->where('username', $request->get('username'));
        }

        if ($request->get('prob')) {
            $topic = $topic->where('pid', $request->get('prob'));
        }

        return $topic->orderBy('updated_at', 'desc')->get();
    }

    public function show(Topic $topic)
    {
        $topic->replies;
        return response()->json($topic);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50|min:2',
            'body' => 'required',
            'pid' => 'required|exists:problems,id',
        ]);

        $username = Auth::user()->username;
        $topic = Topic::create([
            'title' => $request->title,
            'body' => $request->body,
            'pid' => $request->pid,
            'username' => $username,
            'last_reply_username' => $username,
        ]);
        session()->flash('success', 'Add topic success.');
        return redirect()->route('topics.show', [$topic]);
    }

    public function destroy(Topic $topic)
    {
        if (Gate::denies('topic_destroy')) {
            if ($topic->username != Auth::user()->username) {
                abort(403);
            }
        }

        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Delete topic success.');
    }

    public function update(Topic $topic, Request $request)
    {
        if (Gate::denies('topic_edit')) {
            if ($topic->username != Auth::user()->username) {
                abort(403);
            }
        }

        $this->validate($request, [
            'title' => 'required|max:50|min:2',
            'body' => 'required',
        ]);
        $topic->update($request->all());
        session()->flash('success', 'Change topic success.');
        return redirect()->route('topics.show', [$topic]);
    }
}
