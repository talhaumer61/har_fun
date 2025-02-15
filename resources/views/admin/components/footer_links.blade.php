    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Prism JS -->
    <script src="{{asset('admin/libs/prismjs/prism.js')}}"></script>
    <script src="{{asset('admin/js/prism-custom.js')}}"></script>
    <!-- Filepond JS -->
    <script src="{{asset('admin/libs/filepond/filepond.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js')}}"></script>
    <script src="{{asset('admin/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js')}}"></script>

    <!-- Dropzone JS -->
    <script src="{{asset('admin/libs/dropzone/dropzone-min.js')}}"></script>

    <!-- Fileupload JS -->
    <script src="{{asset('admin/js/fileupload.js')}}"></script>

    <!-- Popper JS -->
    <script src="{{asset('admin/libs/%40popperjs/core/umd/popper.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{asset('admin/js/defaultmenu.min.js')}}"></script>

    <!-- Node Waves JS-->
    <script src="{{asset('admin/libs/node-waves/waves.min.js')}}"></script>

    <!-- Sticky JS -->
    <script src="{{asset('admin/js/sticky.js')}}"></script>

    <!-- Simplebar JS -->
    <script src="{{asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin/js/simplebar.js')}}"></script>

    <!-- Color Picker JS -->
    <script src="{{asset('admin/libs/%40simonwep/pickr/pickr.es5.min.js')}}"></script>


    <!-- Apex Charts JS -->
    <script src="{{asset('admin/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Swiper JS -->
    <script src="{{asset('admin/libs/swiper/swiper-bundle.min.js')}}"></script>

    <!-- index-4 JS -->
    <script src="{{asset('admin/js/index-4.js')}}"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{asset('admin/js/custom-switcher.min.js')}}"></script>  

    

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    
    <!-- Custom JS -->
    <script src="{{asset('admin/js/custom.js')}}"></script>
    <script src="{{asset('admin/js/show-password.js')}}"></script>

    <script>
        CKEDITOR.replace('ckeditor'); 
    </script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Delete Record --}}
    <script>
        function confirmDelete(table, id, column) {
            Swal.fire({
                title: "Are you sure?",
                text: "You are about to delete this record.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete.record') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            table: table,
                            id: id,
                            column: column
                        },
                        success: function(response) {
                            Swal.fire("Deleted!", response.message, "success").then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                }
            });
        }

    </script>
    

</body>


</html>