<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>

<!--Export table buttons-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
<header>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</header>
<body>
<h3>
    <div class="well"> Products List</div>
</h3>
<div class="row-fluid">
    <table class="table" id="products">
        <thead>
        <tr>
            <th scope="col"># ID</th>
            <th scope="col">Store owner</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity Available</th>
            <th scope="col">Sold Items</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <div class="modal" id="exampleModalLong">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edith Products here</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form>
                            @csrf
                            <div class="modal-body">
                                <div class="well col-sm-6">
                                    <form>
                                        @csrf

                                            <input type="text" style="display: none" value="{{ old('id') }}"

                                                               id="id">
                                        <div class="col-xs-6">
                                            Store Owner:<input type="text" value="{{ old('store_owner') }}"
                                                               name="store_owner"
                                                               class="form-control"
                                                               id="store_owner">
                                        </div>
                                        <br>
                                        <div class="col-xs-6">
                                            Products:
                                            <input type="text" value="{{ old('product') }}" name="product"
                                                   class="form-control"
                                                   id="product">
                                        </div>
                                        <br>
                                        <div class="col-xs-6">
                                            Quantity:
                                            <input type="name" value="{{ old('quantity_available') }}"
                                                   name="quantity_available"
                                                   class="form-control" id="quantity_available">
                                        </div>
                                        <br>
                                        <div class="col-xs-6">
                                            Sold products:
                                            <input type="text" value="{{ old('sold') }}" name="sold"
                                                   class="form-control"
                                                   id="sold">
                                        </div>
                                        <br>
                                        <div class="col-xs-6">
                                            Date:
                                            <input type="date" class="form-control" value="{{ old('date') }}"
                                                   id="date"
                                                   name="date">
                                        </div>
                                        <br>
                                        <div class="col-xs-6">
                                            Status:
                                            <input type="name" class="form-control"
                                                   value="{{ old('clear_status') }}"
                                                   id="clear_status"
                                                   name="clear_status">
                                        </div>
                                        <br>
                                        <button type="submit" id="update" class="btn btn-primary">Update</button>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </table>
</div>
</body>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#products').DataTable({
            "processing": true,
            "serverSide": true,
            type: 'get',
            "ajax": '{{url('/products')}}',
            "columns": [
                {data: 'id', id: 'id'},
                {data: 'store_owner', id: 'store_owner'},
                {data: 'product', id: 'product'},
                {data: 'quantity_available', id: 'quantity_available'},
                {data: 'sold', id: 'sold'},
                {data: 'date', id: 'date'},
                {data: 'clear_status', id: 'clear_status'},
                {data: 'edit', id: 'edit'},
                {data: 'delete', id: 'delete'}
            ], dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'print', 'pdf'
            ]

        });
        $('#products').on('click', '#edit', function (e) {
            e.preventDefault();
            var data = table.row($(this).parents('tr')).data();
            $('#id').val(data.id);
            $('#store_owner').val(data.store_owner);
            $('#product').val(data.product);
            $('#quantity_available').val(data.quantity_available);
            $('#sold').val(data.sold);
            $('#date').val(data.date);
            $('#clear_status').val(data.clear_status);
            $("#exampleModalLong").modal('show');
        });
        $('#update').click(function (e) {
            e.preventDefault();
            $('#update').html('SENDING...')
            var id = $("input[id=id]").val();
            console.log(id);
            var store_owner = $("input[id=store_owner]").val();
            var product = $("input[id=product]").val();
            var quantity_available = $("input[id=quantity_available]").val();
            var sold = $("input[id=sold]").val();
            var date = $("input[id=date]").val();
            var clear_status = $("input[id=clear_status]").val();
            $.ajax({

                type: 'POST',

                url: "{{url('/edit/')}}/" + id,

                data: {
                    store_owner: store_owner,
                    product: product,
                    quantity_available: quantity_available,
                    sold: sold,
                    date: date,
                    clear_status: clear_status
                },
                success: function (data) {
                    alert("Success");
                    $("#exampleModalLong").modal('hide');
                    $("#exampleModalLong")[0].reset();
                    table.ajax.reload(null, false);
                    $('#update').html('UPDATING..')
                }, error: function (data) {
                    alert("Error try again");
                    $('#update').html('RE-SEND')
                }
            });
        });


        $("#products").on('click', '#delete', function (e) {
            e.preventDefault();
            var data = table.row($(this).parents('tr')).data();
            console.log(data.id)
            $.ajax(
                {
                    type: 'GET',
                    url: "/delete/" + data.id,
                    success: function () {
                        // console.log(data.id)
                        alert("Record deleted");
                        table.ajax.reload(null, false);
                    }, error: function (data) {
                        alert("Error try again");
                    }

                });
        });
    });
</script>

