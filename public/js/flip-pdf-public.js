jQuery(document).ready(function () {
    if (urlPdf.length >0 ) {
        jQuery('.pdf-container').FlipBook({
            pdf: urlPdf,
            controlsProps: {
                downloadURL: urlPdf,
                actions: {
                    cmdSinglePage: {
                        activeForMobile: true
                    }
                }
            }
        });
    }

})