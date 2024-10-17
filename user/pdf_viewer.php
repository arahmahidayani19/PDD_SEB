<?php
// Pastikan path PDF diambil dari parameter GET secara aman
$file = isset($_GET['file']) ? htmlspecialchars($_GET['file']) : '';

if ($file) {
    $file_path = "file_proxy.php?path=" . urlencode($file);
} else {
    die("No PDF file specified.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF</title>
    <link rel="stylesheet" href="pdf_viewer.css" />
<script src="pdf.min.js"></script>

    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

#pdf-viewer {
    max-width: 800px;
    margin: 20px auto;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

canvas {
    width: 100%;
    height: auto;
    border-bottom: 2px solid #007BFF;
}

#pdf-controls {
    display: flex;
    justify-content: center;
    padding: 10px;
    background: #007BFF;
}

#pdf-controls button {
    background-color: white;
    border: none;
    color: #007BFF;
    padding: 10px 20px;
    margin: 0 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
}

#pdf-controls button:hover {
    background-color: #007BFF;
    color: white;
}

#pdf-controls button:disabled {
    background-color: #e0e0e0;
    color: #999;
    cursor: not-allowed;
}

    </style>
</head>
<body>
<div id="pdf-viewer">
    <canvas id="pdf-canvas"></canvas>
    <div id="pdf-controls">
        <button id="prev">Previous</button>
        <button id="next">Next</button>
    </div>
</div>

<script>
    let pdfDoc = null;
    let pageNum = 1;

    async function renderPage(num) {
        const page = await pdfDoc.getPage(num);
        const viewport = page.getViewport({ scale: 1.5 });
        const canvas = document.getElementById('pdf-canvas');
        const context = canvas.getContext('2d');

        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderContext = {
            canvasContext: context,
            viewport: viewport
        };
        await page.render(renderContext).promise;

        document.getElementById('prev').disabled = (num <= 1);
        document.getElementById('next').disabled = (num >= pdfDoc.numPages);
    }

    (async () => {
        const loadingTask = pdfjsLib.getDocument('<?php echo $file_path; ?>');
        pdfDoc = await loadingTask.promise;
        renderPage(pageNum);
    })();

    document.getElementById('prev').addEventListener('click', () => {
        if (pageNum <= 1) return;
        pageNum--;
        renderPage(pageNum);
    });

    document.getElementById('next').addEventListener('click', () => {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        renderPage(pageNum);
    });
</script>
</body>
</html>
