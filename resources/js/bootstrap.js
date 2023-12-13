/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const messagesBlock = document.getElementById('messages-block');
if(messagesBlock != null){
    messagesBlock.scrollTop = messagesBlock.scrollHeight;
}
if(typeof channelName !== 'undefined'){
    window.Echo.channel(channelName)
    .listen('SendMessage', (e) => {
        const message = e.message;
        console.log(message)
        messagesBlock.innerHTML += `
            <div class="flex items-center space-x-1">
                <div class="w-7 h-7 rounded-full">
                    <img src="${message.sender.avatar_url}" alt="${message.sender.name}" class="w-7 h-7 object-cover rounded-full">
                </div>
                <pre class="my-4 p-2 bg-stone-500 rounded-md w-fit">${message.body}</pre>
            </div>
        `;
    })
}
