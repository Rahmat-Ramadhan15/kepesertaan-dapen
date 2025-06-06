<!-- SIDEBAR -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<aside class="sidebar">
    <div class="sidebar__inner scrollable-content">
        <!-- This element is only visible when sidebar Stick mode is active. -->
        <div class="sidebar__stuck align-items-center mb-3 px-3">
            <button type="button" class="sidebar-toggler btn-close btn-lg rounded-circle" aria-label="Close"></button>
            <p class="m-0 text-danger fw-bold">&lt;= Close the sidebar</p>
        </div>

        <!-- Sidebar tabs nav -->
        <div class="sidebar__wrap">
            <nav>
                <div class="nav nav-underline nav-fill nav-component flex-nowrap border-bottom" id="nav-tab"
                    role="tablist">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-chat" type="button"
                        role="tab" aria-controls="nav-chat" aria-selected="true">
                        <i class="d-block demo-pli-speech-bubble-5 fs-3 mb-2"></i>
                        <span>Chat</span>
                    </button>

                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-reports" type="button"
                        role="tab" aria-controls="nav-reports" aria-selected="false">
                        <i class="d-block demo-pli-information fs-3 mb-2"></i>
                        <span>Reports</span>
                    </button>

                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-settings" type="button"
                        role="tab" aria-controls="nav-settings" aria-selected="false">
                        <i class="d-block demo-pli-wrench fs-3 mb-2"></i>
                        <span>Settings</span>
                    </button>
                </div>
            </nav>
        </div>
        <!-- End - Sidebar tabs nav -->

        <!-- Sideabar tabs content -->
        <div class="tab-content sidebar__wrap" id="nav-tabContent">
            <!-- Chat tab Content -->
            <div id="nav-chat" class="tab-pane fade py-4 show active" role="tabpanel" aria-labelledby="nav-chat-tab">
                <!-- Family list group -->
                <h5 class="px-3">Family</h5>
                <div class="list-group list-group-borderless">
                    <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                            <img class="img-xs rounded-circle" src="./assets/img/profile-photos/2.png"
                                alt="Profile Picture" loading="lazy" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Stephen
                                Tran</a>
                            <small class="text-body-secondary">Available</small>
                        </div>
                    </div>

                    <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                            <img class="img-xs rounded-circle" src="./assets/img/profile-photos/8.png"
                                alt="Profile Picture" loading="lazy" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Betty
                                Murphy</a>
                            <small class="text-body-secondary">Iddle</small>
                        </div>
                    </div>

                    <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                            <img class="img-xs rounded-circle" src="./assets/img/profile-photos/7.png"
                                alt="Profile Picture" loading="lazy" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Brittany
                                Meyer</a>
                            <small class="text-body-secondary">I think so!</small>
                        </div>
                    </div>

                    <div class="list-group-item list-group-item-action d-flex align-items-start mb-2">
                        <div class="flex-shrink-0 me-3">
                            <img class="img-xs rounded-circle" src="./assets/img/profile-photos/4.png"
                                alt="Profile Picture" loading="lazy" />
                        </div>
                        <div class="flex-grow-1">
                            <a href="#" class="h6 d-block mb-0 stretched-link text-decoration-none">Jack
                                George</a>
                            <small class="text-body-secondary">Last seen 2 hours ago</small>
                        </div>
                    </div>
                </div>
                <!-- End - Family list group -->

                <!-- Friends Group -->
                <h5 class="d-flex mt-5 px-3">
                    Friends <span class="badge bg-success ms-auto">587 +</span>
                </h5>
                <div class="list-group list-group-borderless">
                    <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-success rounded-circle p-1 me-2"></span>
                        Joey K. Greyson
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-info rounded-circle p-1 me-2"></span>
                        Andrea Branden
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-warning rounded-circle p-1 me-2"></span>
                        Johny Juan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <span class="d-inline-block bg-secondary rounded-circle p-1 me-2"></span>
                        Susan Sun
                    </a>
                </div>
                <!-- End - Friends Group -->

                <!-- Simple news widget -->
                <div class="p-3 mt-5 rounded bg-info-subtle text-info-emphasis">
                    <h5 class="text-info-emphasis">News</h5>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui
                        consequatur ipsum porro a repellat eaque exercitationem
                        necessitatibus esse voluptate corporis.
                    </p>
                    <small class="fst-italic">Last Update : Today 13:54</small>
                </div>
                <!-- End - Simple news widget -->
            </div>
            <!-- End - Chat tab content -->

            <!-- Reports tab content -->
            <div id="nav-reports" class="tab-pane fade py-4" role="tabpanel" aria-labelledby="nav-reports-tab">
                <!-- Billing and Resports -->
                <div class="px-3">
                    <h5 class="mb-3">Billing &amp; Reports</h5>
                    <p>
                        Get <span class="badge bg-danger">$15.00 off</span> your next
                        bill by making sure your full payment reaches us before August
                        5th.
                    </p>

                    <h5 class="mt-5 mb-0">Amount Due On</h5>
                    <p>August 17, 2028</p>
                    <p class="h1">$83.09</p>

                    <div class="d-grid">
                        <button class="btn btn-success" type="button">Pay now</button>
                    </div>
                </div>
                <!-- End - Billing and Resports -->

                <!-- Additional actions nav -->
                <h5 class="mt-5 px-3">Additional Actions</h5>
                <div class="list-group list-group-borderless">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-information me-2 fs-5"></i>
                        Services Information
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-mine me-2 fs-5"></i>
                        Usage
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-credit-card-2 me-2 fs-5"></i>
                        Payment Options
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="demo-pli-support me-2 fs-5"></i>
                        Messages Center
                    </a>
                </div>
                <!-- End - Additional actions nav -->

                <!-- Contact widget -->
                <div class="px-3 mt-5 text-center">
                    <div class="mb-3">
                        <i class="demo-pli-old-telephone display-4 text-primary"></i>
                    </div>
                    <p>Have a question ?</p>
                    <p class="h5 mb-0">(415) 234-53454</p>
                    <small><em>We are here 24/7</em></small>
                </div>
                <!-- End - Contact widget -->
            </div>
            <!-- End - Reports tab content -->

            <!-- Settings content -->
            <div id="nav-settings" class="tab-pane fade py-4" role="tabpanel" aria-labelledby="nav-settings-tab">
                <!-- Account settings -->
                <h5 class="px-3">Account Settings</h5>
                <div class="list-group list-group-borderless">
                    <div class="list-group-item mb-1">
                        <div class="d-flex justify-content-between mb-1">
                            <label class="form-check-label text-body-emphasis stretched-link"
                                for="_dm-sbPersonalStatus">Show my personal status</label>
                            <div class="form-check form-switch">
                                <input id="_dm-sbPersonalStatus" class="form-check-input" type="checkbox" checked />
                            </div>
                        </div>
                        <small class="text-body-secondary">Lorem ipsum dolor sit amet, consectetuer adipiscing
                            elit.</small>
                    </div>

                    <div class="list-group-item mb-1">
                        <div class="d-flex justify-content-between mb-1">
                            <label class="form-check-label text-body-emphasis stretched-link"
                                for="_dm-sbOfflineContact">Show offline contact</label>
                            <div class="form-check form-switch">
                                <input id="_dm-sbOfflineContact" class="form-check-input" type="checkbox" />
                            </div>
                        </div>
                        <small class="text-body-secondary">Aenean commodo ligula eget dolor. Aenean massa.</small>
                    </div>

                    <div class="list-group-item mb-1">
                        <div class="d-flex justify-content-between mb-1">
                            <label class="form-check-label text-body-emphasis stretched-link"
                                for="_dm-sbInvisibleMode">Invisible Mode</label>
                            <div class="form-check form-switch">
                                <input id="_dm-sbInvisibleMode" class="form-check-input" type="checkbox" />
                            </div>
                        </div>
                        <small class="text-body-secondary">Cum sociis natoque penatibus et magnis dis parturient
                            montes, nascetur ridiculus mus.</small>
                    </div>
                </div>
                <!-- End - Account settings -->

                <!-- Public Settings -->
                <h5 class="mt-5 px-3">Public Settings</h5>
                <div class="list-group list-group-borderless">
                    <div class="list-group-item d-flex justify-content-between mb-1">
                        <label class="form-check-label" for="_dm-sbOnlineStatus">Online Status</label>
                        <div class="form-check form-switch">
                            <input id="_dm-sbOnlineStatus" class="form-check-input" type="checkbox" checked />
                        </div>
                    </div>

                    <div class="list-group-item d-flex justify-content-between mb-1">
                        <label class="form-check-label" for="_dm-sbMuteNotifications">Mute Notifications</label>
                        <div class="form-check form-switch">
                            <input id="_dm-sbMuteNotifications" class="form-check-input" type="checkbox" checked />
                        </div>
                    </div>

                    <div class="list-group-item d-flex justify-content-between mb-1">
                        <label class="form-check-label" for="_dm-sbMyDevicesName">Show my device name</label>
                        <div class="form-check form-switch">
                            <input id="_dm-sbMyDevicesName" class="form-check-input" type="checkbox" checked />
                        </div>
                    </div>
                </div>
                <!-- End - Public Settings -->
            </div>
            <!-- End - Settings content -->
        </div>
        <!-- End - Sidebar tabs content -->
    </div>
</aside>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END - SIDEBAR -->
