<table class="table table-striped" id="dtablex">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $pro)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $pro->category_name }}</td>
                <td>{{ $pro->sub_category_count }}</td>
                <td>{{ $pro->product_count }}</td>

                <td>

                    <button type="button" class="btn btn-info keskes" data-toggle="modal"
                        data-target="#myModal"
                        data-id="{{ $pro->id }}"
                        data-names="{{ $pro->category_name }}">
                        <i class="fa-solid fa-pen-to-square" style="color: #f7f7f7;"></i></button>

                    <button type="button" class="btn btn-danger deldel" data-toggle="modal"
                        data-target="#myModalS" data-id="{{ $pro->id }}"><i class="fa-solid fa-trash" style="color: #fff;"></i></button>

                </td>
            </tr>
        @endforeach

    </tbody>




</table>



{!! $products->links() !!}

