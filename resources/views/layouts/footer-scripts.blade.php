<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = '{{ asset('assets/js') }}/';
</script>

<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>



@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif



<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('select[name="project_id"] , select[name="type"]').on('change', function() {

            var project_id = $('select[name="project_id"]').val();
            var type = $('select[name="type"]').val();
            
            if (project_id) {
                $.ajax({
                    url: "{{route('departments_by_project')}}",
                    type: "GET",
                    data: {
                        'id': project_id,
                        'type':type
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="parent_id"]').empty();
                        $('select[name="parent_id"]').append(
                            '<option disabled selected value="">' + 'اختر القسم من القائمة' +
                            '</option>');
                            data.forEach(e => {
                                $('select[name="parent_id"]').append(
                                    '<option value="' + e.id + '">' + e.name + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


