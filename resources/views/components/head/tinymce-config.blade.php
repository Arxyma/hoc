{{-- <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.5.0/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea', // ID dari elemen textarea
        plugins: 'wordcount preview lists emoticons', // Plugin yang akan digunakan
        toolbar: 'undo redo | formatselect | bold italic underline | emoticons | alignleft aligncenter alignright | bullist numlist | styles | preview  ', // Tombol toolbar
        menubar: false, // Atur apakah menu bar di atas akan ditampilkan
        height: 300, // Tinggi editor
        setup: function(editor) {
            // Sinkronkan konten TinyMCE dengan textarea sebelum submit
            editor.on('change', function() {
                editor.save();
            });
        }
    });
</script>
