<?php include('Back-end/machine_display.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDD</title>
    <link rel="shortcut icon" href="../assets/compiled/png/LOGO.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="../assets/compiled/css/iconly.css">
        <link rel="stylesheet" href="../assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/compiled/css/style.css">
    <link rel="stylesheet" href="../assets/compiled/css/machine_display.css">

</head>

<body>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="container">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-md-6">
                        <h3 class="mt-3">Line - <?php echo htmlspecialchars($line) . ' Machine ' . htmlspecialchars($machine); ?></h3>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Machine</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('Back-end/machine_detail.php'); ?>
            <div class= "btn" id="btn-back" >
<a href="javascript:history.back()" class="btn btn-primary mt-3 btn-white">
    <i class="bi bi-arrow-left"></i>
</a>
</div>

       <div class="row mt-3">
    <?php if ($machineDetails): ?>

     <div class="row mt-3">
    <?php if ($machineDetails): ?>
        <div class="col-lg-12">
            <div class="machine-details-card">
                <h2 class="machine-details-title">Machine Details - <?php echo htmlspecialchars($machine); ?></h2>
                
                <div class="machine-info">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="info-text">
                            <p><strong>Brand:</strong> <?php echo htmlspecialchars($machineDetails['brand']); ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="info-text">
                            <p><strong>Model:</strong> <?php echo htmlspecialchars($machineDetails['model']); ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <div class="info-text">
                            <p><strong>Serial No:</strong> <?php echo htmlspecialchars($machineDetails['serial_no']); ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-weight-hanging"></i>
                        </div>
                        <div class="info-text">
                            <p><strong>Tonnage:</strong> <?php echo htmlspecialchars($machineDetails['tonnage']); ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="info-text">
                            <p><strong>Asset No:</strong> <?php echo htmlspecialchars($machineDetails['asset_no']); ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-text">
                        <p><strong>Date of Machine:</strong> <?php echo htmlspecialchars($machineDetails['date']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="col-lg-12">
            <div class="machine-details-card no-data">
                <p>No details available for this machine.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

    <?php else: ?>
        <div class="col-lg-12">
            <div class="machine-details-card no-data">
                <p>No details available for this machine.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="machine-details-card" id="machine-details">
    <div class="info-item">
        <div class="info-icon">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="info-text">
            <p><strong>Part Number Currently Running:</strong> <?php echo htmlspecialchars($part_number); ?></p>
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">
            <i class="fas fa-tachometer-alt"></i>
        </div>
        <div class="info-text">
            <p><strong>Machine Status:</strong> <?php echo htmlspecialchars($machineStatus); ?></p>
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="info-text">
            <p><strong>Shift:</strong> <?php echo htmlspecialchars($shift); ?></p>
        </div>
    </div>
    <div class="info-item">
        <div class="info-icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="info-text">
            <p><strong>Date Star Part Number:</strong> <?php echo htmlspecialchars(date('Y-m-d', strtotime($transaction_date))); ?></p>
        </div>
    </div>
</div>
    

<div id="pdf-viewer" style="display:none;">
    <canvas id="pdf-canvas"></canvas>
    <div id="pdf-controls">
        <button id="prev">Previous</button>
        <button id="next">Next</button>
    </div>
</div>

<div class="container-machine">
    <div class="box">
        <h3>Work Instruction</h3>
        <p>Instructions for operating the machine or assembling the product.</p>
        <button onclick="openPDFInNewTab('<?php echo urlencode($work_instruction); ?>')">View</button>
    </div>
    <div class="box">
        <h3>Packaging</h3>
        <p>Instructions on how to package the part.</p>
        <button onclick="openPDFInNewTab('<?php echo urlencode($packaging); ?>')">View</button>
    </div>
    <div class="box">
        <h3>Master Parameter</h3>
        <p>The master parameters for the machine operation.</p>
        <button onclick="openPDFInNewTab('<?php echo urlencode($master_parameter); ?>')">View</button>
    </div>
</div>
    <footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2024 &copy; PT Sanwa Engineering Batam</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="#">Arahma Hidayani</a></p>
        </div>
    </div>
</footer>



<script src="../assets/extensions/jquery/jquery.min.js"></script>
    <script src="../assets/extensions/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/static/js/components/dark.js"></script>
<script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/compiled/js/app.js"></script>
<script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="../assets/static/js/pages/dashboard.js"></script>

<script>
    function openPDFInNewTab(filePath) {
        window.open('pdf_viewer.php?file=' + filePath, '_blank');
    }
</script>


<script>
    let pdfDoc = null;
    let pageNum = 1;

    async function viewPDF(filePath) {
        const loadingTask = pdfjsLib.getDocument(`file_proxy.php?path=${filePath}`);
        pdfDoc = await loadingTask.promise;
        renderPage(pageNum);
        document.getElementById('pdf-viewer').style.display = 'block';
    }

    async function renderPage(num) {
    const page = await pdfDoc.getPage(num);
    const scale = 1.5;
    const viewport = page.getViewport({ scale });

    // Menyesuaikan canvas dengan viewport
    const canvas = document.getElementById('pdf-canvas');
    const context = canvas.getContext('2d');
    
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render halaman ke dalam canvas
    const renderContext = {
        canvasContext: context,
        viewport: viewport
    };
    await page.render(renderContext).promise;

    document.getElementById('prev').disabled = (num <= 1);
    document.getElementById('next').disabled = (num >= pdfDoc.numPages);
}

</script>


<script>

    function updateDateTime() {
        var now = new Date();
        var options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('date-time').textContent = now.toLocaleDateString('en-US', options);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime(); 
</script>
</body>
</html>
