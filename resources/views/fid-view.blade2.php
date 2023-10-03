<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat PDF</title>
    <style>
        .pdf-download-button {
            display: none;
        }

        .my-pdf-download-button {
            display: block;
        }

        -webkit-user-select: none;
        /* Safari */
        -moz-user-select: none;
        /* Firefox */
        -ms-user-select: none;
        /* IE/Edge */
        user-select: none;
        /* Standard */
    </style>
</head>

<body>
    <iframe src="{{ route('fid.view', $pdfId) }}#toolbar=0" width="100%" height="780" style="border: none;"></iframe>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mencari tombol download PDF
            const downloadButton = document.querySelector('.pdf-download-button');

            // Menyembunyikan tombol download PDF secara perlahan
            if (downloadButton) {
                downloadButton.addEventListener('click', () => {
                    downloadButton.style.display = 'none';
                    downloadButton.style.transition = 'all 1s ease-in-out';
                });
            }

            // Disable context menu on iframe
            const iframe = document.querySelector("iframe");
            if (iframe) {
                iframe.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                });
            }
        });
    </script>
</body>

</html>
