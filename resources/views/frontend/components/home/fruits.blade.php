<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <form action="/add-cart" method="POST">
                                            @csrf
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <a href="/productdetail/{{ $product->id }}">
                                                        <img src="{{ asset('storage/products/' . $product->image . '') }}"
                                                            class="img-fluid w-100 rounded-top" alt=""
                                                            style="cursor: pointer">
                                                    </a>
                                                </div>
                                                {{-- <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                            style="top: 10px; left: 10px;">Fruits</div> --}}
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $product->product_name }}</h4>
                                                    <p>{{ $product->description }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">${{ $product->price }} /
                                                            kg</p>
                                                        <input type="hidden"
                                                            class="form-control form-control-sm text-center border-0"
                                                            value="{{ $product->id }}" name='id'>
                                                        <input type="hidden"
                                                            class="form-control form-control-sm text-center border-0"
                                                            value="1" name='quantity'>
                                                        @if ($product->stock_quantity > 0)
                                                            <button type="submit"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                    class="fa fa-shopping-bag me-2 text-primary"></i>
                                                                Add to
                                                                cart</button>
                                                        @endif
                                                        @if ($product->stock_quantity <= 0)
                                                            <button
                                                                class="btn border border-secondary rounded-pill px-3 text-light-subtle"
                                                                 disabled>
                                                                Hết Hàng</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
