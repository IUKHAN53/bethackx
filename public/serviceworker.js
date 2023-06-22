// service-worker.js

// Cache name for your PWA assets
const cacheName = 'my-pwa-cache-v1';

// Files to be cached
const filesToCache = [
    '/',
    '/index.html',
    '/styles.css',
    '/script.js',
    '/image.jpg',
    // Add more files to cache as needed
];

// Install event: Add files to cache
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(cacheName)
            .then(cache => cache.addAll(filesToCache))
            .then(() => self.skipWaiting())
    );
});

// Activate event: Clear old caches
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(name => {
                    if (name !== cacheName) {
                        return caches.delete(name);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Fetch event: Serve cached files or fetch from network
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    return response;
                }
                return fetch(event.request);
            })
    );
});
