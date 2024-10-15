<?php

namespace App\Http\Controllers;

use App\DataTables\EventsDataTable;
use App\DataTables\UsersDataTable;
use App\Models\User;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function show(User $user, EventsDataTable $dataTable)
    {
        return $dataTable->with([
            'organizer_id' => $user->id,
        ])
        // ->parameters([
        //     'responsive' => true,
        //     'autoWidth' => false,
        // ])
            ->render('users.show', [
                'user' => $user,
            ]);
    }
}
