<div class="col-lg-12">
    <div class="mb-3">
        <h4>Categories</h4>
        <ul class="list-unstyled fruite-categorie">
            @foreach ($categories as $category)
                <li>
                    <div class="d-flex justify-content-between fruite-name">
                        <a href="#">{{ $category->category_name }}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>