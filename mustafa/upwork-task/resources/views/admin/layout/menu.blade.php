<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none ">
        <h4 class=" text-truncate pr-3">
            <?= settings("title", "ar") ?>
        </h4>
    </div>
    <ul class="c-sidebar-nav">

        <?php
        $user = user();
        $r_group = DB::table("rc_usergroup")->where("id", $user->group)->first();
//        $permission = explode(",", $r_group->permission);

        $permission = array();
        if ($user->id > 1) {
            $where["view"] = 1;
            $where["id|IN"] = explode(",", $r_group->permission);
            $_q = DB::table('rc_menu');
            $_q = RC_dbWhere($_q, $where);
            $_q = $_q->get();
            foreach ($_q as $_r):
                if ($_r->parent == 2) {
                    $permission[] = 1;
                } else {
                    $permission[] = $_r->parent;
                }
            endforeach;
        }
        ?>

        <?php
        $where = array();
        $where["parent"] = 0;
        $where["view"] = 1;
        if ($user->id > 1) {
            $where["id|IN"] = $permission;
        }
        $q = DB::table('rc_menu');
        $q = RC_dbWhere($q, $where);
        $q = $q->get();
        ?>
        @foreach ($q as $r)
        <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class=" {{$r->icon}} ml-1"></i>  
                {{$r->title}}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <?php
                $where = array();
                $where["view"] = 1;
                $where["parent"] = $r->id;
                if ($r->id > 2 && $user->id > 1) {
                    $where["id|IN"] = explode(",", $r_group->permission);
                }

                $items = DB::table('rc_menu');
                $items = RC_dbWhere($items, $where);
//                $items = $items->where('view', 1)->where("parent", $r->id);
                $items = $items->get();
                ?>
                @foreach ($items as $item)
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{RC_url($item->url)}}"> {{$item->title}}</a></li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-unfoldable"></button>
</div>
