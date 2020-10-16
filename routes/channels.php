<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
/* callback de autorización para escuchar los canales que el usuario debe escuchar */
Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});