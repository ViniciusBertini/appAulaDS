var CACHE_NAME = 'appaulads-cache-v1'
var urlsToCache = [
    'css/estilo.css',
    'css/bootstrap.min.css',
    'img/icon128.png',
    'js/jquery-3.5.1.min.js',
    'js/bootstrap.min.js',
    'js/function.js',
    'libs/sweetalert2/dist/sweetalert2.css',
    'libs/sweetalert2/dist/sweetalert2.js',
    'libs/DataTables/datatables.css',
    'libs/DataTables/datatables.js',
    'libs/MaterialDesign/css/materialdesignicons.css',
]

self.addEventListener('install', function(event) { 
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(function(cache) {
            console.log('Cache aberto...')
            return cache.addAll(urlsToCache)
        })
    )
})

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
        .then(function(response) {
            if(response) {
                return response;
            } else {
                return fetch(event.request)
            }
        })
    )
})