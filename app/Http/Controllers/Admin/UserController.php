<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $recordUser = User::when(strlen($search), function ($query, $search) {
            $query->whereLike('name', "%$search%")
                ->orWhereLike('username', "%$search%")
                ->orWhereLike('email', "%$search%");
        })->paginate(15);

        return view('admin.user.user', [
            'recordUser' => $recordUser
        ])->render();
    }

    public function show(Request $request)
    {
        $search = $request->search;
        $rows_per_page = $request->input('rows_per_page', 50);

        $recordUser = User::with(['creator', 'updater'])
            ->when(strlen($search), function ($query, $search) {
                $query->whereLike('name', "%$search%")
                    ->orWhereLike('username', "%$search%")
                    ->orWhereLike('email', "%$search%");
            })
            ->paginate($rows_per_page);

        $recordUser->getCollection()->transform(function ($user) {
            $user->roleArray = $user->getRoleNames();
            return $user;
        });
        return response()->json([
            'data' => $recordUser->items(),
            'current_page' => $recordUser->currentPage(),
            'last_page' => $recordUser->lastPage(),
            'page' => $recordUser->perPage(),
            'links' => $recordUser->links('pagination::pagination-synoeun')->toHtml()
        ]);
    }
}
