<div class="d-flex {{ $message->sender_id == session('user')->id ? 'justify-content-end' : 'justify-content-start' }}">
    <div class="p-2 mb-1 rounded {{ $message->sender_id == session('user')->id ? 'bg-primary text-white' : 'bg-light text-dark' }} message-item " style="max-width: 70%;" data-id="{{ $message->id }}">
        {{ $message->message }}
        <small class="d-block text-muted" style="font-size: 0.7rem;">{{ $message->created_at->diffForHumans() }}</small>
    </div>
</div>
