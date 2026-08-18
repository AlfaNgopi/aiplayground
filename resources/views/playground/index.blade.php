<x-layouts.app>

    <div class="h-[calc(100vh-2rem)] flex flex-col">

        {{-- PAGE HEADER --}}
        <div class="mb-5 flex-shrink-0">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                {{ __('AI Playground') }}
            </h1>

            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Test and chat with your AI characters') }}
            </p>
        </div>

        {{-- PLAYGROUND --}}
        <div class="flex-1 min-h-0 grid grid-cols-1 lg:grid-cols-4 gap-6">

            {{-- CHARACTER SIDEBAR --}}
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col min-h-0">

                {{-- Sidebar Header --}}
                <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-full bg-blue-100 dark:bg-blue-900
                                    flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-blue-500 dark:text-blue-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9.75 17L8 20l4-1 4 1-1.75-3M12 3a6 6 0 00-6 6v2a6 6 0 006 6 6 6 0 006-6V9a6 6 0 00-6-6z" />
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h2 class="font-bold text-gray-800 dark:text-gray-100">
                                {{ __('Characters') }}
                            </h2>

                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                {{ __('Choose an AI character') }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Character List --}}
                <div class="flex-1 overflow-y-auto p-4">

                    <div class="space-y-3">

                        @forelse($characters as $character)

                        <button
                            type="button"
                            onclick='startConversation({{ $character->id }})'
                            class="w-full text-left p-4 rounded-lg border transition
                                    hover:bg-gray-50 dark:hover:bg-gray-700/50

                                    {{ $conversation?->character_id === $character->id
                                        ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 dark:border-blue-400'
                                        : 'border-gray-200 dark:border-gray-700' }}">

                            <div class="flex items-center gap-3">

                                {{-- Avatar --}}
                                @if($character->character_avatar)

                                <img
                                    src="{{ $character->character_avatar }}"
                                    class="w-11 h-11 rounded-full object-cover flex-shrink-0"
                                    alt="{{ $character->character_name }}">

                                @else

                                <div class="w-11 h-11 rounded-full
                                                    bg-blue-100 dark:bg-blue-900
                                                    flex items-center justify-center
                                                    font-bold text-blue-600
                                                    dark:text-blue-300
                                                    flex-shrink-0">
                                    {{ strtoupper(substr($character->character_name, 0, 1)) }}
                                </div>

                                @endif

                                {{-- Character Info --}}
                                <div class="min-w-0 flex-1">

                                    <div class="font-semibold text-sm
                                                    text-gray-800 dark:text-gray-100
                                                    truncate">
                                        {{ $character->character_name }}
                                    </div>

                                    <div class="text-xs text-gray-500
                                                    dark:text-gray-400
                                                    truncate mt-1">
                                        {{ $character->ai_model }}
                                    </div>

                                </div>

                                {{-- Active Indicator --}}
                                @if($conversation?->character_id === $character->id)

                                <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></div>

                                @endif

                            </div>

                        </button>

                        @empty

                        <div class="text-center py-10">

                            <div class="w-12 h-12 rounded-full
                                            bg-gray-100 dark:bg-gray-700
                                            flex items-center justify-center
                                            mx-auto mb-3">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m-3-13a9 9 0 110 18 9 9 0 010-18z" />
                                </svg>

                            </div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('No characters available.') }}
                            </p>

                        </div>

                        @endforelse

                    </div>

                </div>

                {{-- Current Conversation --}}
                @if($conversation)

                <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">

                    <p class="text-xs font-semibold uppercase tracking-wider
                                  text-gray-400 dark:text-gray-500 mb-2">
                        {{ __('Current Conversation') }}
                    </p>

                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">

                        <div class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">
                            {{ $conversation->title }}
                        </div>

                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            #{{ $conversation->id }}
                        </div>

                    </div>

                </div>

                @endif

            </div>


            {{-- CHAT AREA --}}
            <div class="lg:col-span-3 bg-white dark:bg-gray-800
                        rounded-lg shadow-sm
                        border border-gray-200 dark:border-gray-700
                        flex flex-col min-h-0 overflow-hidden">

                {{-- Chat Header --}}
                <div class="px-6 py-4 border-b border-gray-200
                            dark:border-gray-700 flex-shrink-0">

                    @if($conversation)

                    <div class="flex items-center gap-3">

                        {{-- Avatar --}}
                        @if($conversation->character?->character_avatar)

                        <img
                            src="{{ $conversation->character->character_avatar }}"
                            class="w-10 h-10 rounded-full object-cover"
                            alt="{{ $conversation->character?->character_name }}">

                        @else

                        <div class="w-10 h-10 rounded-full
                                            bg-blue-100 dark:bg-blue-900
                                            flex items-center justify-center
                                            font-bold text-blue-600
                                            dark:text-blue-300">

                            {{ strtoupper(
                                        substr(
                                            $conversation->character?->character_name ?? 'AI',
                                            0,
                                            1
                                        )
                                    ) }}

                        </div>

                        @endif

                        <div class="min-w-0">

                            <div class="font-semibold text-gray-800 dark:text-gray-100 truncate">
                                {{ $conversation->character?->character_name }}
                            </div>

                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $conversation->character?->ai_model }}
                            </div>

                        </div>

                    </div>

                    @else

                    <div>

                        <div class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ __('Playground') }}
                        </div>

                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('Select a character to start chatting') }}
                        </div>

                    </div>

                    @endif

                </div>


                {{-- Messages --}}
                <div
                    id="chatMessages"
                    class="flex-1 overflow-y-auto p-6 chat-scroll bg-gray-50/50 dark:bg-gray-900/20">

                    @if(!$conversation)

                    <div class="h-full flex items-center justify-center">

                        <div class="text-center max-w-md">

                            <div class="w-16 h-16
                                            bg-blue-100 dark:bg-blue-900
                                            rounded-full
                                            flex items-center justify-center
                                            mx-auto mb-5">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-blue-500 dark:text-blue-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m-3-13a9 9 0 110 18 9 9 0 010-18z" />
                                </svg>

                            </div>

                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                                {{ __('AI Playground') }}
                            </h2>

                            <p class="text-gray-500 dark:text-gray-400 mt-2">
                                {{ __('Select one of the characters to start a conversation.') }}
                            </p>

                        </div>

                    </div>

                    @else

                    <div
                        id="messagesContainer"
                        class="max-w-4xl mx-auto space-y-5">

                        @forelse($conversation->messages as $message)

                        @if($message->role === 'user')

                        {{-- USER MESSAGE --}}
                        <div class="flex justify-end">

                            <div class="max-w-[80%]">

                                <div class="text-xs text-gray-400 dark:text-gray-500
                                                        text-right mb-1">
                                    {{ __('You') }}
                                </div>

                                <div class="bg-blue-600 text-white
                                                        rounded-2xl rounded-br-md
                                                        px-4 py-3 shadow-sm">

                                    <div class="message-content">
                                        {{ $message->content }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        @elseif($message->role === 'assistant')

                        {{-- AI MESSAGE --}}
                        <div class="flex justify-start">

                            <div class="max-w-[80%]">

                                <div class="text-xs text-gray-400 dark:text-gray-500 mb-1">
                                    {{ $conversation->character?->character_name ?? 'AI' }}
                                </div>

                                <div class="bg-white dark:bg-gray-800
                                                        border border-gray-200
                                                        dark:border-gray-700
                                                        rounded-2xl rounded-bl-md
                                                        px-4 py-3 shadow-sm
                                                        text-gray-800 dark:text-gray-100">

                                    <div class="message-content">
                                        {{ $message->content }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        @endif

                        @empty

                        <div
                            id="emptyState"
                            class="text-center py-20 text-gray-400 dark:text-gray-500">
                            {{ __('Start a conversation with') }}
                            {{ $conversation->character?->character_name }}.
                        </div>

                        @endforelse

                    </div>

                    @endif

                </div>


                {{-- Chat Input --}}
                @if($conversation)

                <div class="p-4 border-t border-gray-200
                                dark:border-gray-700
                                bg-white dark:bg-gray-800 flex-shrink-0">

                    <form id="chatForm" class="max-w-4xl mx-auto">

                        <div class="flex items-end gap-3">

                            <textarea
                                id="messageInput"
                                rows="1"
                                maxlength="10000"
                                placeholder="{{ __('Type a message...') }}"
                                class="flex-1 resize-none rounded-lg
                                           border border-gray-300 dark:border-gray-600
                                           bg-white dark:bg-gray-700
                                           text-gray-800 dark:text-gray-100
                                           placeholder-gray-400 dark:placeholder-gray-500
                                           px-4 py-3
                                           focus:outline-none
                                           focus:ring-2 focus:ring-blue-500
                                           focus:border-transparent"></textarea>

                            <button
                                type="submit"
                                id="sendButton"
                                class="h-12 px-6 rounded-lg
                                           bg-blue-600 text-white
                                           font-semibold
                                           hover:bg-blue-700
                                           transition
                                           disabled:opacity-50
                                           disabled:cursor-not-allowed">
                                {{ __('Send') }}
                            </button>

                        </div>

                        <div class="flex justify-between mt-2 px-1">

                            <span
                                id="statusText"
                                class="text-xs text-gray-400 dark:text-gray-500"></span>

                            <span class="text-xs text-gray-400 dark:text-gray-500">
                                {{ __('Enter to send · Shift+Enter for new line') }}
                            </span>

                        </div>

                    </form>

                </div>

                @endif

            </div>

        </div>

    </div>

    <input type="hidden" id="conversationId" value="{{ $conversation?->id }}">


    {{-- PAGE STYLES --}}
    <style>
        .chat-scroll {
            scroll-behavior: smooth;
        }

        .message-content {
            white-space: pre-wrap;
            word-break: break-word;
        }
    </style>



    <script>
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        const conversationId = document.getElementById('conversationId')?.value;

        const chatMessages = document.getElementById('chatMessages');
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const statusText = document.getElementById('statusText');


        /**
         * Start conversation with character.
         */
        async function startConversation(characterId) {
            try {

                const response = await fetch(
                    '{{ route("playground.conversations.store") }}', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },

                        body: JSON.stringify({
                            character_id: characterId
                        })
                    }
                );

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(
                        data.message ?? 'Gagal membuat conversation.'
                    );
                }

                window.location.href = data.redirect;

            } catch (error) {

                alert(error.message);

            }
        }


        /**
         * Scroll chat to bottom.
         */
        function scrollToBottom() {
            if (!chatMessages) {
                return;
            }

            chatMessages.scrollTop = chatMessages.scrollHeight;
        }


        /**
         * Add message to UI.
         */
        function appendMessage(role, content) {
            const container =
                document.getElementById('messagesContainer');

            if (!container) {
                return;
            }

            const emptyState =
                document.getElementById('emptyState');

            if (emptyState) {
                emptyState.remove();
            }

            const wrapper = document.createElement('div');

            if (role === 'user') {

                wrapper.className = 'flex justify-end';

                wrapper.innerHTML = `
            <div class="max-w-[80%]">
                <div class="text-xs text-gray-400 text-right mb-1">
                    You
                </div>

                <div class="bg-black text-white
                            rounded-2xl rounded-br-md px-4 py-3">
                    <div class="message-content"></div>
                </div>
            </div>
        `;

            } else {

                wrapper.className = 'flex justify-start';

                wrapper.innerHTML = `
            <div class="max-w-[80%]">
                <div class="text-xs text-gray-400 mb-1">
                    AI
                </div>

                <div class="bg-white border
                            rounded-2xl rounded-bl-md
                            px-4 py-3 shadow-sm">
                    <div class="message-content"></div>
                </div>
            </div>
        `;
            }

            wrapper
                .querySelector('.message-content')
                .textContent = content;

            container.appendChild(wrapper);

            scrollToBottom();
        }


        /**
         * Submit chat.
         */
        if (chatForm) {

            chatForm.addEventListener('submit', async function(event) {

                event.preventDefault();

                const message = messageInput.value.trim();

                if (!message || !conversationId) {
                    return;
                }

                sendButton.disabled = true;
                messageInput.disabled = true;

                statusText.textContent = 'AI sedang berpikir...';

                appendMessage('user', message);

                messageInput.value = '';

                try {

                    const response = await fetch(
                        '{{ route("playground.chat.send") }}', {
                            method: 'POST',

                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },

                            body: JSON.stringify({
                                conversation_id: conversationId,
                                message: message
                            })
                        }
                    );

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(
                            data.message ?? 'Gagal mengirim pesan.'
                        );
                    }

                    appendMessage(
                        'assistant',
                        data.assistant_message.content
                    );

                    statusText.textContent = '';

                } catch (error) {

                    statusText.textContent = '';

                    appendMessage(
                        'assistant',
                        'Maaf, terjadi kesalahan: ' + error.message
                    );

                } finally {

                    sendButton.disabled = false;
                    messageInput.disabled = false;

                    messageInput.focus();

                }

            });


            /**
             * Enter = send
             * Shift + Enter = newline
             */
            messageInput.addEventListener('keydown', function(event) {

                if (
                    event.key === 'Enter' &&
                    !event.shiftKey
                ) {

                    event.preventDefault();

                    chatForm.requestSubmit();
                }

            });


            /**
             * Auto resize textarea.
             */
            messageInput.addEventListener('input', function() {

                this.style.height = 'auto';

                this.style.height =
                    Math.min(this.scrollHeight, 180) + 'px';

            });

        }


        /**
         * Initial scroll.
         */
        scrollToBottom();
    </script>

</x-layouts.app>