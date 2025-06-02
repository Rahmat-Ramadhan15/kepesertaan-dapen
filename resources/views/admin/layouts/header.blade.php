<!-- HEADER -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<header class="header">
    <div class="header__inner">

        <!-- Brand -->
        <div class="header__brand">
            <div class="brand-wrap">

                <!-- Brand logo -->
                <a href="{{ route('operator.dashboard') }}" class="brand-img stretched-link">
                    <img src="{{ asset('images/sulselbar.png') }}" alt="Nifty Logo" class="Nifty logo" width="36"
                        height="36">
                </a>


                <!-- Brand title -->
                <div class="brand-title">Sulselbar</div>


                <!-- You can also use IMG or SVG instead of a text element. -->
                <!--
            <div class="brand-title">
               <img src="./assets/img/brand-title.svg" alt="Brand Title">
            </div>
            -->

            </div>
        </div>
        <!-- End - Brand -->


        <div class="header__content">

            <!-- Content Header - Left Side: -->
            <div class="header__content-start">


                <!-- Navigation Toggler -->
                <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
                    <i class="demo-psi-list-view"></i>
                </button>



            </div>
            <!-- End - Content Header - Left Side -->


            <!-- Content Header - Right Side: -->
            <div class="header__content-end">

                <div class="form-check form-check-alt form-switch mx-md-2">
                    <input id="headerThemeToggler" class="form-check-input mode-switcher" type="checkbox"
                        role="switch">
                    <label class="form-check-label ps-1 fw-bold d-none d-md-flex align-items-center "
                        for="headerThemeToggler">
                        <i class="mode-switcher-icon icon-light demo-psi-sun fs-5"></i>
                        <i class="mode-switcher-icon icon-dark d-none demo-psi-half-moon"></i>
                    </label>
                </div>


            </div>
        </div>
    </div>
</header>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END - HEADER -->
