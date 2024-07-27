<header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
          <div class="close-btn">Close <i class="fa fa-close"></i></div>
          <form id="searchForm" action="#">
            <div class="form-group">
              <input type="search" name="search" placeholder="What are you searching for...">
              <button type="submit" class="submit">Search</button>
            </div>
          </form>
        </div>
      </div>
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">

            <div class="brand-text brand-big visible text-uppercase">
                @if (request()->is('admin*'))
                    <strong class="text-primary">داشبورد</strong><strong>  ادمین </strong>
                @else
                    <strong class="text-primary">داشبورد</strong><strong>  فروشنده </strong>
                @endif
            </div>
                    </div>


          </div>
          <!-- back home-->
          <div class="list-inline-item ">
            <a class="btn btn-primary mx-3 text-white" href="{{url('/')}}">برگشت به صفحه اصلی</a>
        </div>
          <!-- Log out               -->
          <div class="list-inline-item logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <input type="submit" class="btn btn-primary"  value="خروج از حساب کاربری">
            </form>
        </div>
        </div>
      </div>
    </nav>
  </header>


