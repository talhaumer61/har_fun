<section class="candidates-profile bg-color lg-pt-70 pb-160 xl-pb-150 lg-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="main-title mb-40">My Portfolio</h2>

                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                        Add New Portfolio
                    </button>
                </div>

                <div class="row">
                    @forelse($portfolios as $item)
                    <div class="col-md-4 mb-4">
                        <div class="bg-white card-box border-20 p-3 h-100">
                            <div class="position-relative">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                        class="w-100 rounded" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="w-100 bg-light rounded text-center d-flex align-items-center justify-content-center"
                                        style="height: 200px;">No Image</div>
                                @endif
                            </div>
                            <h5 class="mt-3">{{ $item->title }}</h5>
                            <p class="text-muted small mb-2">{{ Str::limit($item->description, 100) }}</p>
                            
                            @if($item->external_link)
                                <a href="{{ $item->external_link }}" target="_blank" class="text-primary d-block mb-2">View Work</a>
                            @endif

                            <div class="d-flex">
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-primary me-2"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editPortfolioModal"
                                    data-id="{{ $item->id }}"
                                    data-title="{{ $item->title }}"
                                    data-description="{{ $item->description }}"
                                    data-image="{{ asset($item->image) }}"
                                >
                                    Edit
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmDeleteModal"
                                    data-id="{{ $item->id }}"
                                >
                                    Delete
                                </button>
                            </div>

                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="bg-white card-box border-20 p-4 text-center">
                            <p class="text-muted mb-0">No portfolio items found. 
                            <a class="text-success fw-medium" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                                Add New Portfolio
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Add Portfolio Modal -->
<div class="modal fade" id="addPortfolioModal" tabindex="-1" aria-labelledby="addPortfolioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="addPortfolioForm" enctype="multipart/form-data" method="POST" action="{{ route('portfolio.store') }}">
      {{-- CSRF token for form submission --}}
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPortfolioModalLabel">Add Portfolio Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="deletePortfolioForm">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this portfolio item?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Edit Portfolio Modal -->
<div class="modal fade" id="editPortfolioModal" tabindex="-1" aria-labelledby="editPortfolioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="editPortfolioForm" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Portfolio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id" id="edit-id">

          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="edit-title" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" id="edit-description"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Image (optional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Set form action dynamically for Delete
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        document.getElementById('deletePortfolioForm').action = `/portfolio/${id}`;
    });

    // Set data in Edit modal
    const editModal = document.getElementById('editPortfolioModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-description').value = description;
        document.getElementById('editPortfolioForm').action = `/portfolio/${id}`;
    });
});
</script>
@endpush
