// Define PWA configurations for different routes

// const path = window.location.pathname;
// const segments = path.split('/');
// let firstSegment = '';
// if (segments.length > 1) {
//     firstSegment = segments[1];
// } else {
//     console.log('No segments found in the route.');
// }
fetch(url, {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
    }
})
    .then(response => response.json())
    .then(data => {
        const pwaConfigurations = {
            defaultConfig: {
                name: data.name,
                manifest: {
                    name: data.name,
                    short_name: data.name,
                    start_url: data.start_url,
                    // Add other manifest properties as needed
                },
                icons: [
                    {src: data.favicon, sizes: '72x72', type: 'image/png'},
                    {src: data.favicon, sizes: '96x96', type: 'image/png'},
                    // Add more icons as needed
                ],
            }
        };

        // Detect the current route path
        const currentPath = window.location.pathname;

        // Retrieve the corresponding configuration for the current route
        const currentConfiguration = pwaConfigurations.defaultConfig;

        // Update PWA elements dynamically based on the configuration
        if (currentConfiguration) {
            // Update PWA elements using the currentConfiguration object
            // document.getElementById('pwa-name').textContent = currentConfiguration.name;
            // Update other PWA elements for the current route

            const manifest = Object.assign({}, currentConfiguration.manifest, {
                icons: currentConfiguration.icons.map(icon => ({
                    src: icon.src,
                    sizes: icon.sizes,
                    type: icon.type
                }))
            });

            // Register the service worker based on the configuration
            navigator.serviceWorker.register(`/serviceworker.js`)
                .then(() => {
                    const manifestTag = document.createElement('link');
                    manifestTag.setAttribute('rel', 'manifest');
                    manifestTag.setAttribute('href', URL.createObjectURL(new Blob([JSON.stringify(manifest)], {type: 'application/json'})));
                    document.body.append(manifestTag);
                    // document.querySelector('link[rel="manifest"]').setAttribute('href', URL.createObjectURL(new Blob([JSON.stringify(manifest)], { type: 'application/json' })));
                    // console.log('Service worker registered successfully');
                })
                .catch((error) => {
                    console.error('Service worker registration failed:', error);
                });
        } else {
            console.warn(`No PWA configuration found for path: ${currentPath}`);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });

