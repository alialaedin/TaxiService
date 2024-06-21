<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <div class="dropdown user-pro-body text-center">
      <div class="user-info">
        <span class="text-light fs-18">مدیریت فرش ابراهیمی</span>
      </div>
    </div>
  </div>
  <div class="app-sidebar3 mt-0 ps ps--active-y is-expanded">

    <ul class="side-menu">

      <li class="slide">
        <a class="side-menu__item" href="{{route("admin.dashboard")}}">
          <i class="feather feather-home sidemenu_icon"></i>
          <span class="side-menu__label">داشبورد</span>
        </a>
      </li>

      @auth('admin-web')

        <li class="slide">
          <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="fe fe-edit sidemenu_icon"></i>
            <span class="side-menu__label">اطلاعات پایه</span><i class="angle fa fa-angle-left"></i>
          </a>
          <ul class="slide-menu">
            <li><a href="{{route("admin.shifts.index")}}" class="slide-item">شیفت ها</a></li>
          </ul>
          <ul class="slide-menu">
            <li><a href="{{route("admin.school-types.index")}}" class="slide-item">انواع مدرسه</a></li>
          </ul>
          <ul class="slide-menu">
            <li><a href="{{route("admin.education-levels.index")}}" class="slide-item">مقاطع تحصیلی</a></li>
          </ul>
        </li>

        <li class="slide">
          <a class="side-menu__item" href="{{route("admin.companies.index")}}">
            <i class="feather feather-home sidemenu_icon"></i>
            <span class="side-menu__label">شرکت ها</span>
          </a>
        </li>

        <li class="slide">
          <a class="side-menu__item" href="{{route("admin.schools.index")}}">
            <i class="feather feather-home sidemenu_icon"></i>
            <span class="side-menu__label">مدرسه ها</span>
          </a>
        </li>

        <li class="slide">
          <a class="side-menu__item" href="{{route("admin.settings.edit")}}">
            <i class="feather feather-settings sidemenu_icon"></i>
            <span class="side-menu__label">تنظیمات</span>
          </a>
        </li>

      @endauth

    </ul>
  </div>
</aside>
