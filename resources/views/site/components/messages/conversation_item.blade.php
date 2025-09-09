@php
    $user = $conversation['user'];
    $jobId = $conversation['job_id'];
    $lastMessage = $conversation['last_message'];
    $lastTime = $conversation['last_message_time'];
@endphp

<a href="javascript:void(0);"
   class="list-group-item list-group-item-action conversation-link"
   data-user-id="{{ $user->id }}"
   data-job-id="{{ $jobId }}">
    <div>
        <strong>{{ $user->name }}</strong><br>
        <small class="text-muted">{{ \Illuminate\Support\Str::limit($lastMessage, 40) }}</small>
        <small class="text-muted float-end">{{ \Carbon\Carbon::parse($lastTime)->diffForHumans() }}</small>
    </div>
</a>
