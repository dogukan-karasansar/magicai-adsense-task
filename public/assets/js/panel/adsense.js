function copyToClipboard(value) {
    navigator.clipboard.writeText(value);
    toastr.success( 'Adsense Script Copy to Clipboard' );
}