<script src="{{ URL::asset('frontend/assets/js/loader.js') }}"></script>
<script src="{{ URL::asset('frontend/assets/js/scrollSticky.js') }}"></script>
<script src="{{ URL::asset('frontend/assets/fontawesome/js/all.min.js') }}"></script>
<script src="{{ URL::asset('frontend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')
<script type="text/javascript" src="{{ asset('backend/froala_editor_4.1.4/js/froala_editor.pkgd.min.js') }}"></script>
<script>
    new FroalaEditor("textarea#editor"), new FroalaEditor("textarea#editor1");
</script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script src="{{ URL::asset('frontend/assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('frontend/assets/aos-master/dist/aos.js') }}"></script>
<script>
    AOS.init();
</script>

<script src="{{ asset('assets/js/script.js') }}"></script>
