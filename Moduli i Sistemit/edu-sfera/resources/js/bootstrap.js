import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true,
  authEndpoint: 'http://127.0.0.1:8000/pusher/auth',
  auth: {
      headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
  },
});
console.log('Setting up Pusher listener for channel:', `chat.${window.userId}`);

window.Echo.private(`chat.${window.userId}`)
    .listen('MessageSent', (event) => {
        console.log('Message received:', event.message); // Add this line
        const chatStore = Alpine.store('chat');
        if (chatStore) {
            chatStore.messages.push(event.message);
        }
    })
    .error((error) => {
        console.error('Pusher error:', error);
    });