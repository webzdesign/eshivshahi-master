<?php /*
    name:-puja
*/
?>
  <!-- top navigation -->
  <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   {{Auth::user()->first_name ." ". Auth::user()->last_name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li id="cp"><a href="{{url('changepwd')}}" >Change Password</a></li>
                  <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick= "event.preventDefault(); document.getElementById('logout-form').submit();">
                      {{ __('Logout') }} </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->