<div class="row gx-0 align-items-center">
    <div class="col-lg-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="main-title m0">Messages</h2>
        </div>
    </div>
</div>

<div class="bg-white card-box border-20 p0 mt-30">
    <div class="message-wrapper">
        <div class="row gx-0">
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="message-sidebar pt-20">
                    <div class="ps-3 pe-3 ps-xxl-4 pe-xxl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="page-title fw-500">Inbox</div>
                        </div>
                    </div>
                    <div class="email-read-panel" id="conversation-list">
                        @foreach ($conversations as $conversation)
                            <div class="email-list-item conversation-item {{ request('conversation_id') == $conversation->id ? 'active' : '' }}" data-id="{{ $conversation->id }}">
                                <div class="email-short-preview">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="sender-name {{ $conversation->unread_count ? 'fw-bold text-dark' : '' }}">
                                            {{ $conversation->client->name }}
                                            @if ($conversation->unread_count)
                                                <span class="badge bg-primary ms-1">{{ $conversation->unread_count }}</span>
                                            @endif
                                        </div>
                                        <div class="date">{{ $conversation->updated_at->format('M d') }}</div>
                                    </div>
                                    <div class="mail-sub">
                                        {{ optional($conversation->messages->last())->message ?? 'No message yet' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="col-lg-8">
                <div class="open-email-container pb-40">
                    <div class="email-header divider d-flex justify-content-between ps-4 pe-4 ps-xxl-5 pe-xxl-5">
                        <div class="sender-info d-flex align-items-center">
                            <img src="../images/lazy.svg" data-src="images/logo_03.png" alt="" class="lazy-img logo">
                            <div class="ps-3">
                                <div class="sender-name">Chat</div>
                                <div class="sender-email">Open a conversation</div>
                            </div>
                        </div>
                    </div>

                    <div class="email-body divider">
                        <div class="ps-4 pe-4 ps-xxl-5 pe-xxl-5">
                            <h2 id="conversation-title">Select a conversation</h2>
                            <div id="messages-container">
                                <!-- Messages will appear here -->
                            </div>
                            <div id="new-message-alert" class="position-absolute end-0 bottom-0 m-4" style="display: none;">
                                <button class="btn btn-sm btn-warning shadow" onclick="scrollToBottom()">New Message</button>
                            </div>
                        </div>
                    </div>

                    <div class="email-footer">
                        <div class="ps-4 pe-4 ps-xxl-5 pe-xxl-5">
                            <div id="reply-box" style="display: none;">
                                <form id="send-message-form" class="d-flex mt-3">
                                    <input type="hidden" name="conversation_id" id="current-conversation-id">
                                    <input type="text" name="message" id="new-message-input" class="form-control me-2" placeholder="Type your message">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #messages-container {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
        margin-top: 10px;
        background: #fafafa;
        border-radius: 8px;
        padding: 15px;
    }

    .message-block {
        padding: 10px;
        border-radius: 6px;
        background-color: #f2f2f2;
        margin-bottom: 8px;
    }
    .email-list-item.active {
        background-color: #e6f0ff;
        border-left: 4px solid #0d6efd;
    }
    .message-block {
        max-width: 70%;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 10px;
        clear: both;
    }

    .message-block.sent {
        background-color: #d1e7dd;
        margin-left: auto;
        text-align: right;
    }

    .message-block.received {
        background-color: #f8d7da;
        margin-right: auto;
        text-align: left;
    }

</style>
<script>
    const currentUserId = {{ session('user')->id }};
</script>

<script>
let currentConversationId = null;
let lastMessageId = null;

document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById('messages-container');
    const conversationIdInput = document.getElementById('current-conversation-id');
    const form = document.getElementById('send-message-form');
    const messageInput = document.getElementById('new-message-input');
    const replyBox = document.getElementById('reply-box');
    const title = document.getElementById('conversation-title');
    const newMessageAlert = document.getElementById('new-message-alert');

    // ✅ Attach listener to conversation items
    document.querySelectorAll('.conversation-item').forEach(item => {
        item.addEventListener('click', () => {
            const conversationId = item.dataset.id;
            currentConversationId = conversationId;
            conversationIdInput.value = conversationId;

            document.querySelectorAll('.conversation-item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            fetch(`/seller/messages/${conversationId}`)
                .then(res => res.json())
                .then(data => {
                    let html = '';
                    data.messages.forEach(msg => {
                        const isSent = msg.sender_id == currentUserId;
                        html += `
                            <div class="message-block ${isSent ? 'sent' : 'received'}">
                                <strong>${msg.sender.name}:</strong>
                                <p>${msg.message}</p>
                            </div>
                        `;
                        lastMessageId = msg.id;
                    });

                    container.innerHTML = html;
                    scrollToBottom();
                    replyBox.style.display = 'block';
                    title.innerText = `Chat with ${data.messages[0]?.sender?.name ?? 'User'}`;
                    newMessageAlert.style.display = 'none';

                    // Mark messages as read
                    fetch(`/seller/messages/${conversationId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                });
        });
    });

    // ✅ Send message handler
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const message = messageInput.value.trim();
        const conversationId = conversationIdInput.value;

        if (!message || !conversationId) {
            alert("Please select a conversation and type a message.");
            return;
        }

        fetch(`/seller/messages/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                conversation_id: conversationId,
                message: message
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const msg = data.message;
                const isSent = msg.sender_id == currentUserId;

                container.innerHTML += `
                    <div class="message-block ${isSent ? 'sent' : 'received'}">
                        <strong>${msg.sender.name}:</strong>
                        <p>${msg.message}</p>
                    </div>
                `;

                lastMessageId = msg.id;
                messageInput.value = '';
                scrollToBottom();
            } else {
                alert("Message send failed. Please try again.");
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert("Network error: " + error.message);
        });
    });

    function scrollToBottom() {
        container.scrollTop = container.scrollHeight;
        newMessageAlert.style.display = 'none';
    }

    function pollNewMessages() {
        if (!currentConversationId || !lastMessageId) return;

        fetch(`/seller/messages/${currentConversationId}/new?last_message_id=${lastMessageId}`)
            .then(res => res.json())
            .then(data => {
                data.messages.forEach(msg => {
                    const isSent = msg.sender_id == currentUserId;
                    container.innerHTML += `
                        <div class="message-block ${isSent ? 'sent' : 'received'}">
                            <strong>${msg.sender.name}:</strong>
                            <p>${msg.message}</p>
                        </div>
                    `;
                    lastMessageId = msg.id;
                });

                if (data.messages.length > 0) {
                    scrollToBottom();
                }
            });
    }

    setInterval(pollNewMessages, 10000);
});
</script>





