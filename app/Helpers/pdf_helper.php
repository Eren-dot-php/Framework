<?php

use Dompdf\Dompdf;
use Dompdf\Options;

if (!function_exists('generatePDF')) {
    /**
     * Generate and stream PDF file
     *
     * @param string $html        HTML content to convert to PDF
     * @param string $filename    Filename for the generated PDF
     * @param bool   $download    If true, the PDF will be downloaded. If false, it will open in the browser.
     * 
     * @return void
     */
    function generatePDF($html, $filename = 'document.pdf', $download = false)
    {
        // Set Dompdf options
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Allow loading remote resources like images

        // Initialize Dompdf
        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Stream or download the PDF
        $outputMode = $download ? ['Attachment' => true] : ['Attachment' => false];
        $dompdf->stream($filename, $outputMode);
    }
}
