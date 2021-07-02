@extends('layouts.app')
@section('content')
<div class="show-products">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr class="{{ $product->id }}">
          <th scope="row">{{ $product->id }}</th>
          <td>
            <img src="{{ '/' . $product->image }}" alt="">
            <span>{{ stringCutter(10, $product->name) }}</span>
          </td>
          <td>{{ $product->category->name }}</td>
          <td>{{ $product->description }}</td>
          <td>
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('products.show', $product->id) }}"><i class="fas fa-eye"></i> <span>Show</span></a>
                <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"><i class="fas fa-edit"></i> <span>Edit</span></a>
                <a class="dropdown-item" href="#"  data-toggle="modal" data-target=".deleteModal{{$product->id}}"><i class="fas fa-trash"></i> <span>Delete</span></a>
              </div>
              <!-- Modal -->
                <div class="modal fade deleteModal{{$product->id}}" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">{{ stringCutter(20, $product->name) }}</h5>
                        <i class="fas fa-times-circle close"data-dismiss="modal" aria-label="Close"></i>
                      </div>
                      <div class="modal-body">
                        Are You Sure That You Want To Delete It ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="submit" onclick="deleteProduct({{ $product->id }})">Remove Product</button>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- Modal -->
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
  </table>
  @if(count($products) == 0)
  <div class="alert alert-danger">There Is No Products Yet</div>
  @endif
  {{ $products->links() }}
</div>
@endsection
@section('script')
@parent
<script>
  @if(Session::has('message'))
    toastr.success("{{ session('message') }}", "{{ session('heading') }}")
  @endif
  function deleteProduct(product_id) {
    $.ajax({
      method: "DELETE",
      url: `/admin/products/delete/${product_id}`,
      data: {
        _token: "{{ csrf_token() }}"
      },
      beforeSend: function(xhr) {
        $(`.show-products .table tbody tr.${product_id} .modal .modal-footer .btn[type=submit]`).text('Deleting...');
      },
      success: function(data) {
        if(data.status) {
          $(`.show-products .table tbody tr.${product_id}`).fadeOut();

          $('.show-products .table').after('<div class="alert alert-danger">There Is No Products Yet</div>');
          $('.show-products .table').remove();

          $(`.modal-backdrop`).fadeOut();
          toastr.success(data.message, data.data.name);
        }
      },
      error: function(e) {
        console.log(e)
      }
    }
    );
  }

</script>
@endsection
