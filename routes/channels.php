<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('blogNotification', function ($user) {
    return $user->isAdmin();
});
