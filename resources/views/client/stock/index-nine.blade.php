@extends('client.base.style.base')
@section('title', 'Afrique évasion - index nine')
@section('content')
    <!-- Hero Start -->
    <section
        class="relative overflow-hidden md:h-screen flex items-center md:py-0 py-36 bg-cyan-100 dark:bg-cyan-500/20 bg-[url('client/assets/images/bg/bg3.png')] bg-no-repeat bg-top bg-cover">
        <div class="container relative">
            <div class="grid grid-cols-1 items-center mt-10">
                <div class="md:text-start text-center">
                    <h1 class="font-bold lg:leading-normal leading-normal text-4xl lg:text-5xl mb-6">We will find a perfect
                        <br> home for you</span>
                    </h1>
                    <p class="text-xl max-w-xl">A great plateform to buy, sell and rent your properties without any agent or
                        commisions.</p>

                    <div class="relative flex mt-8">
                        <div class="lg:w-5/6 w-full">
                            <ul class="inline-block sm:w-fit w-full flex-wrap justify-center text-center p-4 bg-white dark:bg-slate-900 rounded-t-xl border-b dark:border-gray-800"
                                id="myTab" data-tabs-toggle="#StarterContent" role="tablist">
                                <li role="presentation" class="inline-block">
                                    <button
                                        class="px-6 py-2 text-base font-medium rounded-md w-full hover:text-green-600 transition-all duration-500 ease-in-out"
                                        id="buy-home-tab" data-tabs-target="#buy-home" type="button" role="tab"
                                        aria-controls="buy-home" aria-selected="true">Buy</button>
                                </li>
                                <li role="presentation" class="inline-block">
                                    <button
                                        class="px-6 py-2 text-base font-medium rounded-md w-full transition-all duration-500 ease-in-out"
                                        id="sell-home-tab" data-tabs-target="#sell-home" type="button" role="tab"
                                        aria-controls="sell-home" aria-selected="false">Sell</button>
                                </li>
                                <li role="presentation" class="inline-block">
                                    <button
                                        class="px-6 py-2 text-base font-medium rounded-md w-full transition-all duration-500 ease-in-out"
                                        id="rent-home-tab" data-tabs-target="#rent-home" type="button" role="tab"
                                        aria-controls="rent-home" aria-selected="false">Rent</button>
                                </li>
                            </ul>

                            <div id="StarterContent"
                                class="p-6 bg-white dark:bg-slate-900 rounded-ss-none rounded-se-none md:rounded-se-xl rounded-xl shadow-md dark:shadow-gray-700">
                                <div class="" id="buy-home" role="tabpanel" aria-labelledby="buy-home-tab">
                                    <form action="#">
                                        <div class="registration-form text-dark text-start">
                                            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 lg:gap-0 gap-6">
                                                <div>
                                                    <label
                                                        class="form-label font-medium text-slate-900 dark:text-white">Search
                                                        : <span class="text-red-600">*</span></label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-search icons"></i>
                                                        <input name="name" type="text" id="job-keyword"
                                                            class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0"
                                                            placeholder="Search your keaywords">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-properties"
                                                        class="form-label font-medium text-slate-900 dark:text-white">Select
                                                        Categories:</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-estate icons"></i>
                                                        <select class="form-select z-2" data-trigger name="choices-catagory"
                                                            id="choices-catagory-buy" aria-label="Default select example">
                                                            <option>Houses</option>
                                                            <option>Apartment</option>
                                                            <option>Offices</option>
                                                            <option>Townhome</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-min-price"
                                                        class="form-label font-medium text-slate-900 dark:text-white">Budget
                                                        :</label>
                                                    <div class="filter-search-form relative mt-2">
                                                        <i class="uil uil-usd-circle icons"></i>
                                                        <select class="form-select" data-trigger name="choices-min-price"
                                                            id="choices-min-price-buy" aria-label="Default select example">
                                                            <option>Budget</option>
                                                            <option>500</option>
                                                            <option>1000</option>
                                                            <option>2000</option>
                                                            <option>3000</option>
                                                            <option>4000</option>
                                                            <option>5000</option>
                                                            <option>6000</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="md:mt-8">
                                                    <input type="submit" id="search-buy" name="search"
                                                        class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white searchbtn submit-btn w-full !h-[60px] rounded lg:rounded-none"
                                                        value="Search">
                                                </div>
                                            </div><!--end grid-->
                                        </div><!--end container-->
                                    </form>
                                </div>

                                <div class="hidden" id="sell-home" role="tabpanel" aria-labelledby="sell-home-tab">
                                    <form action="#">
                                        <div class="registration-form text-dark ltr:text-start rtl:text-end">
                                            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 lg:gap-0 gap-6">
                                                <div>
                                                    <label
                                                        class="form-label font-medium text-slate-900 dark:text-white">Search
                                                        : <span class="text-red-600">*</span></label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-search icons"></i>
                                                        <input name="name" type="text" id="job-keyword"
                                                            class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0"
                                                            placeholder="Search your keaywords">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-properties"
                                                        class="form-label font-medium text-slate-900 dark:text-white">Select
                                                        Categories:</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-estate icons"></i>
                                                        <select class="form-select z-2" data-trigger
                                                            name="choices-catagory" id="choices-catagory-sell"
                                                            aria-label="Default select example">
                                                            <option>Houses</option>
                                                            <option>Apartment</option>
                                                            <option>Offices</option>
                                                            <option>Townhome</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-min-price"
                                                        class="form-label font-medium text-slate-900 dark:text-white">Budget
                                                        :</label>
                                                    <div class="filter-search-form relative mt-2">
                                                        <i class="uil uil-usd-circle icons"></i>
                                                        <select class="form-select" data-trigger name="choices-min-price"
                                                            id="choices-min-price-sell"
                                                            aria-label="Default select example">
                                                            <option>Budget</option>
                                                            <option>500</option>
                                                            <option>1000</option>
                                                            <option>2000</option>
                                                            <option>3000</option>
                                                            <option>4000</option>
                                                            <option>5000</option>
                                                            <option>6000</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="md:mt-8">
                                                    <input type="submit" id="search-sell" name="search"
                                                        class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white searchbtn submit-btn w-full !h-[60px] rounded lg:rounded-none"
                                                        value="Search">
                                                </div>
                                            </div><!--end grid-->
                                        </div><!--end container-->
                                    </form>
                                </div>

                                <div class="hidden" id="rent-home" role="tabpanel" aria-labelledby="rent-home-tab">
                                    <form action="#">
                                        <div class="registration-form text-dark ltr:text-start rtl:text-end">
                                            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 lg:gap-0 gap-6">
                                                <div>
                                                    <label
                                                        class="form-label font-medium text-slate-900 dark:text-white">Search
                                                        : <span class="text-red-600">*</span></label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-search icons"></i>
                                                        <input name="name" type="text" id="job-keyword"
                                                            class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0"
                                                            placeholder="Search your keaywords">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-properties"
                                                        class="form-label font-medium text-slate-900 dark:text-white">Select
                                                        Categories:</label>
                                                    <div class="filter-search-form relative filter-border mt-2">
                                                        <i class="uil uil-estate icons"></i>
                                                        <select class="form-select z-2" data-trigger
                                                            name="choices-catagory" id="choices-catagory-rent"
                                                            aria-label="Default select example">
                                                            <option>Houses</option>
                                                            <option>Apartment</option>
                                                            <option>Offices</option>
                                                            <option>Townhome</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for="buy-min-price"
                                                        class="form-label font-medium text-slate-900 dark:text-white">Budget
                                                        :</label>
                                                    <div class="filter-search-form relative mt-2">
                                                        <i class="uil uil-usd-circle icons"></i>
                                                        <select class="form-select" data-trigger name="choices-min-price"
                                                            id="choices-min-price-rent"
                                                            aria-label="Default select example">
                                                            <option>Budget</option>
                                                            <option>500</option>
                                                            <option>1000</option>
                                                            <option>2000</option>
                                                            <option>3000</option>
                                                            <option>4000</option>
                                                            <option>5000</option>
                                                            <option>6000</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="md:mt-8">
                                                    <input type="submit" id="search-rent" name="search"
                                                        class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white searchbtn submit-btn w-full !h-[60px] rounded lg:rounded-none"
                                                        value="Search">
                                                </div>
                                            </div><!--end grid-->
                                        </div><!--end container-->
                                    </form>
                                </div>
                            </div>
                        </div><!--end grid-->
                    </div>
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- Start -->
    <section class="relative lg:py-24 py-16">
        <div class="container relative">

            <!-- control code  -->
            @include('client/base/components/home/control') ;

        </div><!--end container-->

        <div class="container relative lg:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">How It Works</h3>

                <p class="text-slate-400 max-w-xl mx-auto">A great plateform to buy, sell and rent your properties without
                    any agent or commisions.</p>
            </div><!--end grid-->

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">

                <!-- features code  -->
                @include('client/base/components/home/features') ;

            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->

    <!-- Start CTA -->
    <section class="relative py-24 bg-[url('client/assets/images/bg/01.jpg')] bg-no-repeat bg-center bg-fixed bg-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="container relative">
            <div class="grid lg:grid-cols-12 grid-cols-1 md:text-start text-center justify-center">
                <div class="lg:col-start-2 lg:col-span-10">
                    <div class="grid md:grid-cols-3 grid-cols-1 items-center">


                        <!-- cta code  -->
                        @include('client/base/components/home/cta') ;

                    </div>
                </div>
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- End CTA -->

    <section class="relative md:py-24 py-16">
        <div class="container relative">
            <div class="grid grid-cols-1 pb-8">
                <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Listing Categories
                </h3>

                <p class="text-slate-400 max-w-xl">A great plateform to buy, sell and rent your properties without any
                    agent or commisions.</p>
            </div><!--end grid-->

            <div class="grid lg:grid-cols-5 md:grid-cols-3 grid-cols-2 mt-8 md:gap-[30px] gap-3">

                <!-- categories code  -->
                @include('client/base/components/home/categories') ;

            </div><!--end grid-->
        </div><!--end container-->

        <div class="container relative lg:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Featured Properties
                </h3>

                <p class="text-slate-400 max-w-xl mx-auto">A great plateform to buy, sell and rent your properties without
                    any agent or commisions.</p>
            </div><!--end grid-->

            <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] mt-8">

                <!-- properties2 code  -->
                @include('client/base/components/home/properties2') ;

            </div><!--end grid-->

            <div class="md:flex justify-center text-center mt-6">
                <div class="md:w-full">
                    <a href="list.php"
                        class="btn btn-link text-green-600 hover:text-green-600 after:bg-green-600 transition duration-500">View
                        More Properties <i class="uil uil-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div><!--end container-->

        <div class="container relative lg:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">What Our Client Say ?
                </h3>

                <p class="text-slate-400 max-w-xl mx-auto">A great plateform to buy, sell and rent your properties without
                    any agent or commisions.</p>
            </div><!--end grid-->

            <div class="flex justify-center relative mt-16">
                <div class="relative lg:w-1/3 md:w-1/2 w-full">
                    <div class="absolute -top-20 md:-start-24 -start-0">
                        <i class="mdi mdi-format-quote-open text-9xl opacity-5"></i>
                    </div>

                    <div class="absolute bottom-28 md:-end-24 -end-0">
                        <i class="mdi mdi-format-quote-close text-9xl opacity-5"></i>
                    </div>

                    <div class="tiny-single-item">

                        <!-- reviews code  -->
                        @include('client/base/components/home/reviews') ;

                    </div>
                </div>
            </div><!--end grid-->
        </div><!--end container-->

        <div class="container relative lg:mt-24 mt-16">
            <div class="grid grid-cols-1 pb-8 text-center">
                <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Meet The Agent Team
                </h3>

                <p class="text-slate-400 max-w-xl mx-auto">A great plateform to buy, sell and rent your properties without
                    any agent or commisions.</p>
            </div><!--end grid-->

            <div class="grid md:grid-cols-12 grid-cols-1 mt-8 gap-[30px]">

                <!-- team code  -->
                @include('client/base/components/home/team') ;

            </div><!--end grid-->
        </div><!--end container-->

        <div class="container relative lg:mt-24 mt-16">

            <!-- get-in-touch code  -->
            @include('client/base/components/home/get-in-touch') ;

        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection
