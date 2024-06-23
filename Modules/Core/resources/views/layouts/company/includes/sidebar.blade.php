<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <div class="dropdown user-pro-body text-center">
      <div class="user-info">
        <span class="text-light fs-16">خوش آمدید {{ auth()->user()->name }}</span>
      </div>
    </div>
  </div>
  <div class="app-sidebar3 mt-0 ps ps--active-y is-expanded">

    <ul class="side-menu">

      @auth('company-web')
        <li class="slide">
          <a class="side-menu__item" href="{{route("company.profile.edit")}}">
            <i class="fa fa-user sidemenu_icon mr-1"></i>
            <span class="side-menu__label">پروفایل</span>
          </a>
        </li>
        <li class="slide">
          <a class="side-menu__item" href="{{route("company.drivers.index")}}">
            <i class="fa fa-car sidemenu_icon"></i>
            <span class="side-menu__label">مدیریت راننده ها</span>
          </a>
        </li>
      @endauth

    </ul>
  </div>
</aside>
