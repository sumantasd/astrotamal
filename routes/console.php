<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('consultation:send-reminders')->everyFifteenMinutes();

