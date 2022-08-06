{{view('admin/layout/head')}}
<!--c-dark-theme-->
<body class="c-app c-no-layout-transition ">
    <script>
        document.body.classList.add(localStorage["body_class"]);
    </script>

    {{view('admin/layout/menu')}}
    {{view('admin/layout/menu_left')}}
    <div class="c-wrapper">
        {{view('admin/layout/header')}}
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        <?= (isset($container)) ? $container : "" ?>
                    </div>
                </div>
            </main>
        </div>
        {{view('admin/layout/footer')}}
    </div>
    {{view('admin/layout/js')}}
</body>
{{view('admin/layout/foot')}}