<?php

use App\Models\App;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('tower-alert.{appId}', function (User $user, int $appId) {
    $workplace = $user->current_workplace;
    $app = explode(',', $workplace)[1] ?? null;

    return (int) $app === (int) $appId;
});

Broadcast::channel('alert.{appId}', function (User $user, int $appId) {
    $workplace = $user->current_workplace;
    $app = explode(',', $workplace)[1] ?? null;

    return (int) $app === (int) $appId;
});
