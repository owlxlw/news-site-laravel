<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    // Сохранить новый комментарий
    public function store(Request $request, $articleId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = Comment::create([
            'article_id' => $articleId,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'is_moderated' => false,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Комментарий отправлен на модерацию. Он появится после проверки модератором.');
    }

    // Список комментариев на модерацию (только для модератора)
    public function pendingModeration()
    {
        if (Gate::denies('moderator')) {
            abort(403, 'Доступ только для модераторов.');
        }

        $pendingComments = Comment::where('is_moderated', false)
            ->where('is_approved', false)
            ->with(['user', 'article'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('comments.pending', compact('pendingComments'));
    }

    // Одобрить комментарий
    public function approve($id)
    {
        if (Gate::denies('moderator')) {
            abort(403);
        }

        $comment = Comment::findOrFail($id);
        $comment->is_moderated = true;
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий одобрен и опубликован.');
    }

    // Отклонить комментарий
    public function reject($id)
    {
        if (Gate::denies('moderator')) {
            abort(403);
        }

        $comment = Comment::findOrFail($id);
        $comment->is_moderated = true;
        $comment->is_approved = false;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий отклонён.');
    }
}
