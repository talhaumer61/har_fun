<div class="container py-4">
    <div class="row">
        <!-- LEFT: Conversation List -->
        <div class="col-md-4 border-end" style="height: 500px; overflow-y: auto;">
            <h5>Conversations</h5>
            <ul class="list-group">
                @foreach($conversations as $userId => $msgs)
    @php
        $lastMsg = $msgs->last();
        $user = $lastMsg->sender_id === session('user')->id ? $lastMsg->receiver : $lastMsg->sender;

        $conversation = [
            'user' => $user,
            'job_id' => $lastMsg->job_id,
            'last_message' => $lastMsg->message,
            'last_message_time' => $lastMsg->created_at
        ];
    @endphp

    @include('site.components.messages.conversation_item', ['conversation' => $conversation])
@endforeach

            </ul>
        </div>

        <!-- RIGHT: Chat Box -->
        <div class="col-md-8 d-flex flex-column" style="height: 500px;">
            <div class="flex-grow-1 overflow-auto border rounded p-3 mb-2" id="chat-box" data-receiver-id="{{ $activeUserId }}" data-job-id="{{ $jobId }}">
            <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>Chat</strong>
            <button class="btn btn-sm btn-danger" id="close-chat">X</button>
        </div>

                @if($messages)
                    @foreach($messages as $message)
                        @include('site.components.messages.single_message', ['message' => $message])
                    @endforeach
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted" style="min-height: 300px;">
                        <i class="bi bi-chat-dots" style="font-size: 2rem;"></i>
                        <p>Select a conversation to start chatting</p>
                    </div>
                @endif

            </div>

            <div id="chat-form-wrapper">
                @if($activeUserId)
                <!-- Send Box -->
                <form id="chat-form" class="d-flex border-top pt-2">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $activeUserId }}">
                    <input type="hidden" name="job_id" value="{{ $jobId }}">
                    <input type="text" name="message" class="form-control me-2" placeholder="Type a message..." required>
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
                @endif
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let polling = false;
        let chatBox = $('#chat-box');

        if (chatBox.length) {
            let lastMessageId = $('.message-item').last().data('id') || 0;

            // Read the receiver ID and job ID from data attributes on chat box
            let receiverId = chatBox.data('receiver-id');
            let jobId = chatBox.data('job-id');

            function pollNewMessages() {
                if (polling) return;

                polling = true;

                $.ajax({
                    url: '/messages/fetch-new',
                    method: 'GET',
                    data: {
                        user_id: receiverId,
                        job_id: jobId,
                        after_id: lastMessageId
                    },
                    success: function (response) {
                        if (response.new_messages_html) {
                            $('#chat-box').append(response.new_messages_html);

                            // Update last message ID
                            lastMessageId = response.last_id;

                            // Auto-scroll only if user is near the bottom
                            let isNearBottom = chatBox[0].scrollTop + chatBox[0].clientHeight >= chatBox[0].scrollHeight - 150;
                            if (isNearBottom) {
                                chatBox.scrollTop(chatBox[0].scrollHeight);
                            }
                        }
                    },
                    complete: function () {
                        polling = false;
                        setTimeout(pollNewMessages, 5000); // fetch again after 5 seconds
                    },
                    error: function (xhr, status, error) {
                        console.error("Polling error:", error);
                        polling = false;
                        setTimeout(pollNewMessages, 10000); // retry later on failure
                    }
                });
            }

            // Start polling if IDs are valid
            if (receiverId && jobId) {
                pollNewMessages();
            }
        }
    });
</script>

<script>
$(document).ready(function() {

    // Send Message
    $(document).on('submit', '#chat-form', function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find('button');
        btn.prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "{{ route('chat.send') }}",
            data: form.serialize(),
            success: function(response) {
                $('#chat-box').append(response.message_html);
                form.find('input[name="message"]').val(''); // Clear input
                let chatBox = $('#chat-box')[0];
                let isNearBottom = chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight - 150;

                if (isNearBottom) {
                    $('#chat-box').scrollTop(chatBox.scrollHeight);
                }


                // Update conversation list
                let receiver_id = form.find('input[name="receiver_id"]').val();
                let job_id = form.find('input[name="job_id"]').val();

                let convKey = `.conversation-link[data-user-id="${receiver_id}"][data-job-id="${job_id}"]`;
                let convListItem = $(convKey);

                if (convListItem.length) {
                    convListItem.replaceWith(response.last_message_html);
                } else {
                    $('.list-group').prepend(response.last_message_html);
                }
            },
            complete: function() {
                btn.prop('disabled', false);
            }
        });
        return false;
    });

    // // Chat auto-refresh (Optional)
    // @if($activeUserId)
    
    //     let lastMessageId = $('.message-item').last().data('id') || 0;

    //     setInterval(function () {
    //         console.log("Fetching new messages after ID:", lastMessageId);
    //         $.ajax({
    //             url: `/messages/fetch-new`,
    //             type: "GET",
    //             data: {
    //                 user_id: "{{ $activeUserId }}",
    //                 job_id: "{{ $jobId }}",
    //                 after_id: lastMessageId
    //             },
    //             success: function(response) {
    //                 if (response.new_messages_html) {
    //                     $('#chat-box').append(response.new_messages_html);

    //                     // Update last message ID
    //                     lastMessageId = response.last_id;

    //                     // Scroll if near bottom
    //                     let chatBox = $('#chat-box')[0];
    //                     let isNearBottom = chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight - 150;
    //                     if (isNearBottom) {
    //                         $('#chat-box').scrollTop(chatBox.scrollHeight);
    //                     }
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error("Fetch error:", error);
    //             }
    //         });
    //     }, 5000);


    // @endif

    // Click to open chat
    $(document).on('click', '.conversation-link', function() {
        let userId = $(this).data('user-id');
        let jobId = $(this).data('job-id');

        $.get('/messages', { user_id: userId, job_id: jobId }, function(response) {
            const chatBox = $(response).find('#chat-box').html();
            const form = $(response).find('#chat-form-wrapper').html();

            $('#chat-box').html(chatBox);
            $('#chat-form-wrapper').html(form);

            // ✅ Reset lastMessageId
            lastMessageId = $('.message-item').last().data('id') || 0;
        });
    });


    // Close chat
    $(document).on('click', '#close-chat', function() {
        $('#chat-box').html(`
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted" style="min-height: 300px;">
                <i class="bi bi-chat-dots" style="font-size: 2rem;"></i>
                <p>Select a conversation to start chatting</p>
            </div>
        `);
        $('#chat-form-wrapper').html('');
    });

});
</script>
@endpush

