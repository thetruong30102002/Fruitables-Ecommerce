        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/checkout" method="POST">
                    @csrf
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Full Name<sup>*</sup></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            <hr>
                            <div class="form-item">
                                <textarea name="note" class="form-control" spellcheck="false" cols="30" rows="11"
                                    placeholder="Oreder Notes (Optional)" ></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        @foreach ($cart->list() as $key => $cart)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="{{ asset('storage/products/' . $cart['image'] . '') }}"
                                                            class="img-fluid rounded-circle"
                                                            style="width: 90px; height: 90px;" alt="">
                                                    </div>
                                                </th>
                                                <td class="py-5">{{ $cart['name'] }}</td>
                                                <td class="py-5">${{ $cart['price'] }} </td>
                                                <td class="py-5">{{ $cart['quantity'] }}</td>
                                                <td class="py-5">${{ $cart['quantity'] * $cart['price'] }}</td>
                                            </tr>
                                            @php
                                                $totalPrice += $cart['quantity'] * $cart['price'];
                                            @endphp
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Subtotal:</h5>
                                <p class="mb-0 pe-4">${{ $totalPrice }}</p>
                            </div>
                            <div class="d-flex justify-content-between py-4 mb-4">
                                <h5 class="mb-0 ps-4 me-4">special offer</h5>
                                <div class="">
                                    @php
                                        $discount = 0;
                                        if (isset($sales_discount)) {
                                            $discount = ($totalPrice * $sales_discount) / 100;
                                        }

                                    @endphp
                                    <p class="mb-0  pe-4">{{ $discount }} $</p>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <input type="hidden" name="total_amount" value="{{ $totalPrice - $discount }}">
                                <p class="mb-0 pe-4">${{ $totalPrice - $discount }}</p>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit"
                                    class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                    Order</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-5">
                    <form action="/discount" method="post">
                        @csrf
                        <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4"
                            placeholder="Coupon Code" name="sales_code">
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="submit">Apply
                            Coupon</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Checkout Page End -->
