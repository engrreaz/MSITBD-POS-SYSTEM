@extends('layouts.layout')
@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1 class="text-primary mt-2 mb-3">
            <i class="fa-brands fa-product-hunt" style="color: #3b71ce;"></i> Sub Categories</h1>
        <div class="row">
            <div class="col-md-8">
                <input type="text" placeholder="Search Here" name="search" id="search"
                    class="form-control mb-3" />
            </div>
            <div class="col-md-3">
                <button id="modalopen" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#myModal">
                     <i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i> Add New
                </button>
            </div>
        </div>


        {{-- Data Table --}}


        <!-- The Modal -->
        <div class="modal ajxx" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add/Edit Sub Categories</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="ajaxForm">

                            <input type="hidden" id="idno" name="idno" /><br>
                            <div class="form-group">
                                <label for="subname">Sub Category Name:</label>
                                <input type="text" class="form-control" value="Console"
                                    placeholder="Enter Sub Category Name" id="subname" name="subname">
                                <span id="nameerror"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Category Name:</label>
                                <select class="form-control" id="name" name="name">
                                    <option>Select a Category</option>
                                </select>
                                <span id="nameerror"></span>
                            </div>





                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" id="cross" class="btn btn-danger"
                            data-dismiss="modal">Close</button>
                        <button type="button" id="subs" class="btn btn-primary">Add</button>
                        <button type="button" id="subs2" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>




        <div id="dtable">
            <table class="table table-striped" id="dtablex">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sub Category Name</th>
                        <th>Category Name</th>
                        <th>Products</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>




            </table>



        </div>
        <div class="alerts"></div>

        </>


    </div>
</div>










<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //document.forms[0].submit();

    $(document).ready(function() {
        $(document).on('click', '#modalopen', function() {
            $('#subs2').hide();
            $('#subs').show();
        });

        $('#subs').click(function() {
            var x = $('#ajaxForm')[0];
            var data = new FormData(x);
            //console.log(data);

            $.ajax({
                url: '{{ route('category.store') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: data,

                success: function(response) {
                    $('#idno').val('');
                    $('#name').val('');
                    $("#cross").click();
                    if (response) {
                        swal("Success", response.success, "success");
                        $('#dtable').load(location.href + ' #dtable');
                    }
                },
                error: function(error) {
                    if (error) {
                        console.log();
                        $('#nameerror').html(error.responseJSON.errors.name);
                    }
                }
            });
        });


        //UPdate Fetch.....................
        $(document).on('click', '.keskes', function() {
            $('#subs').hide();
            $('#subs2').show();
            let id = $(this).data('id');
            let name = $(this).data('names');
            $('#idno').val(id);
            $('#name').val(name);
        });

        //update
        $('#subs2').click(function() {
            var x = $('#ajaxForm')[0];
            var data = new FormData(x);
            $.ajax({
                url: '{{ route('category.update') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: data,

                success: function(response) {
                    $('#idno').val('');
                    $('#name').val('');
                    $("#cross").click();
                    if (response) {
                        swal("Success", response.success, "success");
                        $('#dtable').load(location.href + ' #dtable');
                    }
                },
                error: function(error) {
                    if (error) {
                        console.log();
                        $('#nameerror').html(error.responseJSON.errors.name);
                    }
                }
            });
        });

        // Delete Item
        $(document).on('click', '.deldel', function() {
            let idno = $(this).data('id');
            if (confirm('Are you sure to delete this item???')) {
                $.ajax({
                    url: '{{ route('category.delete') }}',
                    method: 'POST',
                    data: {
                        'iid': idno
                    },

                    success: function(response) {
                        if (response) {
                            //("Success", response.success, "success");
                            Command: toastr["success"]("ll", "jj")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "2000",

                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }

                            $('#dtable').load(location.href + ' #dtable');
                        }
                    }
                });

            }
        });

        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr("href").split('page=')[1];
            pagi(page);
        });

        function pagi(page) {
            $.ajax({
                url: '/category/paginate?page=' + page,
                success: function(response) {
                    $('#dtable').html(response);
                }
            });
        }

        // SEARCH
        $(document).on('keyup', function(e) {
            e.preventDefault();
            $('.alerts').html('');
            let search = $('#search').val();
            console.log(search);

            $.ajax({
                url: '{{ route('category.search') }}',
                method: 'GET',
                data: {
                    'txt': search
                },

                success: function(response) {


                    $('#dtable').html(response);
                    if (response.status == 'Nothing Found') {
                        $('.alerts').html('Nothing Found');
                    }
                }
            });
        });
    });
</script>




@endsection
