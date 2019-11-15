<?php /*

    name:-puja

*/

?>  <?php

      $title=DB::table('companydetails')->get();

      $menus=DB::table('modules')->orderBy('display_sequence', 'asc')->get();
      $master_menus=DB::table('modules')->where('is_master','1')->orderBy('display_sequence', 'asc')->get();
      $master_without=DB::table('modules')->where('is_master','0')->orderBy('display_sequence', 'asc')->get();


    ?>
    @php
      $usertype_id = Auth::user()->usertype_id;
    @endphp

        <div class="left_col scroll-view">

            <div class="navbar nav_title" style="border: 0;">

              <a href="" class="site_title"><i class="fa fa-bus"></i> <span>{{$title[0]->name}}</span></a>

            </div>



            <div class="clearfix"></div>



            <!-- menu profile quick info -->



            <!-- /menu profile quick info -->



            <!-- sidebar menu -->

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <div class="menu_section">

                <ul class="nav side-menu">
				    <!-- Pratik Donga 12-09-18 -->

              @if($usertype_id == '1')
              <li><a href="{{url('/home')}}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                  <li><a><i class="fa fa-codepen"></i>Admin Masters <span class="fa fa-chevron-down fa-4x"></span></a>
                    <ul class="nav child_menu">
                      @foreach($master_menus as $key=>$val)
                      <li><a href="{{url($val->routes)}}"><i class="{{$val->icon}}"></i> {{$val->display_name}}</a></li>
                      @endforeach
                    </ul>
                  </li>

                  @foreach($master_without as $key=>$vals)
                    @if($vals->routes != 'billsummarymanagerconfirm')
                    <li><a href="{{url($vals->routes)}}"><i class="{{$vals->icon}}"></i><span>{{$vals->display_name}}</span></a></li>
                    @endif
                  @endforeach

              @else
              <li><a href="{{url('/home')}}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>

              @foreach($menus as $menu)
                  @php
                    $getPermission = Helper::getPermission($menu->id,$usertype_id);
                  @endphp

                  @if(! $getPermission->isEmpty())
                    @if($getPermission[0]->create != 0 || $getPermission[0]->edit != 0 || $getPermission[0]->view != 0)
                      <li ><a href="{{url($menu->routes)}}"><i class="{{$menu->icon}}"></i><span>{{$menu->display_name}}</span></a></li>
                    @endif
                  @endif

                  @if($usertype_id =='2')
                    @if($menu->routes=='vendorinvoice' || $menu->routes=='vendordetail' || $menu->routes=='vendoraccountant' || $menu->routes=='parisishthabinvoice' || $menu->routes == 'billsummarymanagerconfirm' || $menu->routes == 'user')
                      <li ><a href="{{url($menu->routes)}}"><i class="{{$menu->icon}}"></i><span>{{$menu->display_name}}</span></a></li>
                    @endif

                  @elseif($usertype_id =='3')
                    @if($menu->routes=='vendorinvoice' || $menu->routes=='parisishthabinvoice')
                        <li><a href="{{url($menu->routes)}}"><i class="{{$menu->icon}}"></i><span>{{$menu->display_name}}</span></a></li>
                    @endif
                  @else
                    @if($menu->routes=='billsummaryconfirm' || $menu->routes=='vendorinvoice')
                        <li><a href="{{url($menu->routes)}}"><i class="{{$menu->icon}}"></i><span>{{$menu->display_name}}</span></a></li>
                    @endif
                  @endif


              @endforeach
              <li><a href="{{url('/query')}}"><i class="fa fa-question"></i><span>Query</span></a></li>
              @endif


              </ul>

              </div>



            </div>

            <!-- /sidebar menu -->



            <!-- /menu footer buttons -->

            <div class="sidebar-footer hidden-small">



              <a data-toggle="tooltip" data-placement="top" title="Settings">



              </a>

              <a data-toggle="tooltip" data-placement="top" title="FullScreen">



              </a>

              <a data-toggle="tooltip" data-placement="top" title="Lock">



              </a>

              <a data-toggle="tooltip" data-placement="top" title="Logout">



              </a>

            </div>

            <!-- /menu footer buttons -->

          </div>