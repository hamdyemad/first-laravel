@extends('layouts.app')
@section('content')
<div class="show-categories">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">About</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr class="{{ $category->id }}">
          <th scope="row">{{ $category->id }}</th>
          <td>
            <img src="{{'/' . $category->image }}" alt="">
            <span>{{ stringCutter(10, $category->name) }}</span>
          </td>
          <td>{{ $category->about }}</td>
          <td>
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                {{-- <a class="dropdown-item" href="{{ route('categories.show', $category->id) }}"><i class="fas fa-eye"></i> <span>Show</span></a> --}}
                <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit"></i> <span>Edit</span></a>
                <a class="dropdown-item" href="#"  data-toggle="modal" data-target=".deleteModal{{$category->id}}"><i class="fas fa-trash"></i> <span>Delete</span></a>
              </div>
              <!-- Modal -->
                <div class="modal fade deleteModal{{$category->id}}" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">{{ stringCutter(20, $category->name) }}</h5>
                        <i class="fas fa-times-circle close"data-dismiss="modal" aria-label="Close"></i>
                      </div>
                      <div class="modal-body">
                        Are You Sure That You Want To Delete It ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="submit" onclick="deleteProduct({{ $category->id }})">Remove Product</button>
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
  @if(count($categories) == 0)
    <div class="alert alert-danger">There Is No Categories Yet</div>
  @endif
  {{ $categories->links() }}
</div>
@endsection
@section('script')
@parent
<script>
  @if(Session::has('message'))
    toastr.success("{{ session('message') }}", "{{ session('heading') }}")
  @endif
  function deleteProduct(category_id) {
    $cat_id = 10;
    $.ajax({
      method: "DELETE",
      url: `/admin/categories/delete/${category_id}`,
      data: {
        _token: "{{ csrf_token() }}"
      },
      beforeSend: function(xhr) {
        $(`.show-categories .table tbody tr.${category_id} .modal .modal-footer .btn[type=submit]`).text('Deleting...');
      },
      success: function(data) {
        if(data.status) {
          $(`.show-categories .table tbody tr.${category_id}`).fadeOut();
          $(`.show-categories .table`).after('<div class="alert alert-danger">There Is No Categories Yet</div>');
          $(`.show-categories .table`).remove();
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
