<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat PDF</title>
    
    <style>
        iframe {
            width: 100%;
            height: 780px;
            border: none;
        }
    </style>
</head>

<body>

    <!-- Menggunakan default viewer dari PDF.js melalui iframe -->
    <iframe src="{{ asset('js/pdf.js/web/viewer.html?file=') . urlencode(route('pod.view', $podid)) }}&download=false"></iframe>
    <script>
        document.addEventListener('keydown', event => {
        if (event.ctrlKey && event.keyCode === 83 || event.keyCode === 80) {
            event.preventDefault();
            alert('Anda tidak bisa download');
        }
        });

        document.querySelector('body').addEventListener('contextmenu', event => {
        event.preventDefault();
        const menu = event.target.querySelector('.context-menu');
        const saveAsItem = menu.querySelector('.context-menu-item-saveas');
        saveAsItem.remove();

        const printItem = menu.querySelector('.context-menu-item-print');
        printItem.remove();
        });

    </script>

</body>

</html>
