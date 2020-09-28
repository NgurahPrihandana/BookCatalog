<div class="flash-data" id="flash" data-flash-data="<?=Flasher::flash(); ?>"></div>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/admin">Admin</a>
                                    </li>
                                    <li class="breadcrumb-item active">Index
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Description -->
                <section id="description" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Session</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>Dalam login, disimpan 3 data dalam session yaitu : id_user, status, dan yang terakhir adalah role user</p>
                                <div class="alert alert-warning" role="alert">
                                    Data yang disimpan dalam session akan aman, karena tidak ada cara dari sisi client untuk mengaksesnya, untuk demonstrasi, saya akan menampilkan data agar lebih mudah untuk dilihat
                                </div>
                                <p>$_SESSION['id_user'] = <?= $_SESSION['id_user']; ?> ----------- <small>'Id user adalah 1'</small></p>
                                <p>$_SESSION['status'] = <?= $_SESSION['status']; ?> ----------- <small>'Status user adalah login'</small></p>
                                <p>$_SESSION['role'] = <?= $_SESSION['role']; ?> ----------- <small>'role user adalah admin'</small></p>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Description -->
                
                <!-- Description -->
                <section id="description" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cookie</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>Dalam login,jika remember me di-checklist, maka akan disimpan 3 data dalam cookie yaitu : id_user, verificator(username yang sudah di enkripsi), dan yang terakhir adalah role user, data akan disimpan selama 5 menit(untuk pengujian agar tidak terlalu lama)</p>
                                <div class="alert alert-warning" role="alert">
                                    Data yang disimpan dalam cookie akan dapat diakses oleh user, karena ada cara dari sisi client untuk mengaksesnya, karena itu verificator saya hash, agar user tidak dapat dengan mudah untuk membacanya, untuk demonstrasi, saya akan menampilkan data agar lebih mudah untuk dilihat
                                </div>
                                <p>$_COOKIE['id_user'] = <?= $_COOKIE['id']; ?> ----------- <small>'Id user adalah 1'</small></p>
                                <p>$_COOKIE['verificator'] = <?= $_COOKIE['verificator']; ?> ----------- <small>'Data verificator / username di enkripsi'</small></p>
                                <p>$_COOKIE['role'] = <?= $_COOKIE['role']; ?> ----------- <small>'role user adalah admin'</small></p>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Description -->
                <!-- CSS Classes -->

                <!-- <section id="css-classes" class="card">
                    <div class="card-header">
                        <h4 class="card-title">CSS Classes</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>This table contains all classes related to the 2 columns layout. This is a custom layout classes for 2
                                    columns layout page requirements.</p>
                                <p>All these options can be set via following classes:</p>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Classes</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><code>.2-columns</code></th>
                                                <td>You can create 2 columns layout by adding <code>2-columns</code> class in <code>&lt;body&gt;</code>
                                                    tag.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->

                <!--/ CSS Classes -->
                <!-- HTML Markup -->

                <!-- <section id="html-markup" class="card">
                    <div class="card-header">
                        <h4 class="card-title">HTML Markup</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>This layout has a navigation and content sections with common header & footer.</p>
                                <p>Vuexy has a ready to use starter kit, you can use this layout directly by using the starter kit pages from
                                    the <code>vuexy-html-bootstrap-admin-template/starter-kit</code> folder.</p>
                                <pre class="language-html">
        <code class="language-html">
            &lt;!DOCTYPE html&gt;
              &lt;html lang="en"&gt;
                &lt;head&gt;&lt;/head&gt;
                &lt;body data-menu="vertical-menu-modern" class="vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static menu-expanded"&gt;

                  &lt;!-- fixed-top--&gt;
                  &lt;nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow"&gt;
                  &lt;/nav&gt;

                  &lt;!-- BEGIN Navigation--&gt;
                  &lt;div class="main-menu menu-fixed menu-light menu-accordion menu-shadow"&gt;
                  &lt;/div&gt;
                  &lt;!-- END Navigation--&gt;

                  &lt;!-- BEGIN Content--&gt;
                  &lt;div class="app-content content"&gt;
                      &lt;div class="content-wrapper"&gt;
                      &lt;/div&gt;
                  &lt;/div&gt;
                  &lt;!-- END Content--&gt;

                  &lt;!-- START FOOTER LIGHT--&gt;
                  &lt;footer class="footer footer-static footer-light"&gt;
                  &lt;/footer&gt;
                  &lt;!-- END FOOTER LIGHT--&gt;

                &lt;/body&gt;
              &lt;/html&gt;
        </code>
        </pre>
                            </div>
                        </div>
                    </div>
                </section> -->

                <!--/ HTML Markup -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
