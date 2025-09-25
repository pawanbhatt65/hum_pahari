<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header justify-content-end">
                <button type="button" class="close btn btn-danger btn-small" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @forelse ($images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100"
                                alt="Homestay Image {{ $index + 1 }}">
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <img src="{{ asset('images/placeholder.jpg') }}" class="d-block w-100"
                                alt="No Image Available">
                        </div>
                    @endforelse
                </div>
                @if (count($images) > 1)
                    <a class="carousel-control-prev carouse-arrow" href="#carouselExampleControls" role="button"
                        data-slide="prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    <a class="carousel-control-next carouse-arrow" href="#carouselExampleControls" role="button"
                        data-slide="next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
