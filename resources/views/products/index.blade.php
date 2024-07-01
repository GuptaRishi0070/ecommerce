@extends('layouts.app')

@section('content')
    <div class="container text-white"> 
        <div class="container">
            <h1 class="text-center font-weight-bold mb-4 display-4">CRUD Operations for Products</h1>        
            <div class="alert alert-info" role="alert">
                Products added, updated, and deleted will show in the database.
            </div>
        </div>
        
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4 float-right">Add Product</a>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr id="product-{{ $product->id }}">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-product-btn" data-product-id="{{ $product->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap and jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).on('click', '.delete-product-btn', function(event) {
            event.preventDefault();
            var productId = $(this).data('product-id');

            $.ajax({
                url: '/products/' + productId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Product deleted successfully!');
                    $('#product-' + productId).remove();
                },
                error: function(error) {
                    console.error('Error deleting product:', error);
                    alert('Error deleting product');
                }
            });
        });
    </script>
@endsection
