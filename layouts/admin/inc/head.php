<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="/public/img/favicon.png">
<!-- Material Design CSS -->
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/animate.css/animate.min.css">
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/lightgallery/dist/css/lightgallery.min.css">
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/public/lib/material/vendors/bower_components/dropzone/dist/dropzone.css">
<link rel="stylesheet" href="/public/lib/material/css/app.min.css">
<!-- Owlcarousel CSS -->
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="/public/lib/fontawesome/css/font-awesome.min.css">
 <link rel="stylesheet" href="/public/lib/material/vendors/bower_components/trumbowyg/dist/ui/trumbowyg.min.css">
<!-- Main CSS -->
<link rel="stylesheet" href="/public/css/admin.css">


<!-- JQuery JS -->
<script src="/public/lib/material/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js"></script>
<script src="/public/lib/jquery/jquery-ui.js"></script>

<!-- Material Design JS -->
<script src="/public/lib/material/vendors/bower_components/tether/dist/js/tether.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/Waves/dist/waves.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/lightgallery/dist/js/lightgallery.min.js"></script>



<script src="/public/lib/material/vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/jszip/dist/jszip.min.js"></script>
<script src="/public/lib/material/vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>



     <script src="/public/lib/material/vendors/bower_components/dropzone/dist/min/dropzone.min.js"></script>
        <script src="/public/lib/material/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="/public/lib/material/vendors/bower_components/flatpickr/dist/flatpickr.min.js"></script>
        <script src="/public/lib/material/vendors/bower_components/nouislider/distribute/nouislider.min.js"></script>
        <script src="/public/lib/material/vendors/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="/public/lib/material/vendors/bower_components/trumbowyg/dist/trumbowyg.min.js"></script>
        
        

<!-- App min JS -->
<script src="/public/lib/material/js/app.min.js?v=1.1"></script>

<!-- Owlcarousel JS -->
<script src="/public/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Main JS -->
<script src="/public/js/admin.js?v=1.1"></script>


<!-- Editor -->
 <script src="/public/lib/redactor-2/tinymce.min.js"></script>
<script>
    var images_upload_path = '/public/gallery/pages/'+'blobid' + (new Date()).getTime();
    tinymce.init({
      selector: '.editor',
      height: 500,
      theme: 'modern',
      init_instance_callback: function (editor) {
        editor.on('keyup', function (e) {
          this.targetElm.innerHTML = e.target.innerHTML;  
          this.targetElm.click();
        });
      },
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
      ],
      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | fontselect | fontsizeselect',
      //image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '/public/lib/redactor-2/codepen.min.css'
      ],

      image_title: true, 
      automatic_uploads: true,
      images_upload_url: '?cmd=imageUpload',
      images_upload_path: images_upload_path+'.jpg',
      file_picker_types: 'image', 
      file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
          var file = this.files[0];
          var reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = function () {
            var id = images_upload_path;
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), { title: file.name });
          };
        };
        input.click();
       }
    });
</script>