<?php

use App\Models\App;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('tower-alert.{appId}', function (Auth $auth, int $appId) {
    if ($auth->user()->role === 'admin') {
        return true;
    } else {
        $workplace = $auth->user()->current_workplace;
        $app = explode(',', $workplace)[1] ?? null;

        return $app === $appId;
    }
});
