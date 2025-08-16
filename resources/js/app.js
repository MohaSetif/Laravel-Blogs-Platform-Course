 import './bootstrap';

window.Echo.channel('blogNotification')
    .listen('BlogCreated', (e) => {
        showNotification(`📝 New Blog Created: "${e.blog.title}"`);
    });

function showNotification(message) {
    const container = document.getElementById('notifications');

    // Create notification div
    const notif = document.createElement('div');
    notif.className = "bg-white border border-gray-200 shadow-lg rounded-lg p-4 flex items-center justify-between animate-slide-in";
    notif.innerHTML = `
        <span class="text-gray-800">${message}</span>
        <button class="ml-4 text-gray-400 hover:text-gray-600">&times;</button>
    `;

    // Close on click
    notif.querySelector('button').onclick = () => notif.remove();

    // Auto-remove after 5s
    setTimeout(() => notif.remove(), 5000);

    container.appendChild(notif);
}