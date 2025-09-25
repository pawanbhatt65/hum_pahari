<div class="col-12">
    <div class="search-box">
        <form action="" method="post">
            @csrf
            <div class="form-group-container position-relative form-group-location">
                <div class="icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <input type="text" name="location" id="placeLocation" class="form-control">
            </div>
            <div class="form-group-container position-relative form-group-check-in">
                <div class="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                <input type="text" name="check_in" id="check_in" class="form-control">
            </div>
            <div class="form-group-container position-relative form-group-check-out">
                <div class="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
                <input type="text" name="check_out" id="check_out" class="form-control">
            </div>
            <div class="form-group-container position-relative form-group-search">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>
</div>
