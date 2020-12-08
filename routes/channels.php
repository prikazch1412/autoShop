<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-{id}', function () {
    return \Illuminate\Support\Facades\Auth::check();
});
