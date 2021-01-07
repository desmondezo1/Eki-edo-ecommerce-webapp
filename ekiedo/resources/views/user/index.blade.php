<!DOCTYPE html>
<html>
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>@yield('title')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
       @if(Session::get("is_rtl")==0)
      <link rel="stylesheet" type="text/css" href="{{asset('public/Ecommerce/css/style.css').'?v=45'}}">
      @else
      <link rel="stylesheet" type="text/css" href="{{asset('public/Ecommerce/css/rtl.css').'?v=44'}}">
      @endif
      <link rel="stylesheet" type="text/css" href="{{asset('public/Ecommerce/css/bootstrap.min.css').'?v=17'}}">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="{{asset('public/Ecommerce/css/responsive.css').'?v=28'}}">
      <link rel="stylesheet" type="text/css" href="{{asset('public/Ecommerce/css/responsivertl.css').'?v=56'}}">
      <link rel="stylesheet" type="text/css" href="{{asset('public/Ecommerce/css/animate.min.css')}}">
      <script type="text/javascript" src="{{asset('public/Ecommerce/js/bootstrap.min.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <script type="text/javascript" src="{{asset('public/Ecommerce/js/aos.js')}}"></script>
      <script type="text/javascript" src="{{ URL::to('public/js/zoomsl.js') }}"></script>
   </head>
   <style type="text/css">
      .product-heading h1:before{
      background-color:<?= Session::get('site_color') ?> !important;
      }
      .product-heading h1:after{
      background-color:<?= Session::get('site_color') ?> !important;
      }
      .one-product-slider h1:after{
      background-color:<?= Session::get('site_color') ?> !important;
      }
      .col-md-3.services:after{
      background-color:<?= Session::get('site_color') ?> !important;
      }
      .user-login-pop_up .nav-tabs .nav-link.active{
      background-color:<?= Session::get('site_color') ?> !important;
      border-top:<?= Session::get('site_color') ?> !important;
      }
      .fancy-checkbox input[type="checkbox"]:checked~big:before{
      color:<?= Session::get('site_color') ?> !important;
      }
      .add a:hover{
      background-color:<?= Session::get('site_color') ?> !important;
      }
      td.View a:hover{
      background-color:<?= Session::get('site_color') ?> !important;
      }
      .Sort ul li .active-2{
      border-color:<?= Session::get('site_color') ?> !important;
      color:<?= Session::get('site_color') ?> !important;
      }
     
   </style>
   <body class="rtl">
      
 <div id="overlaychk">
                        <div class="cv-spinner">
                           <span class="spinner"></span>
                        </div>
                     </div>
      <div class="modal log Log out" id="myModal1">
         <div class="modal-dialog">
            <div class="modal-content logout">
               <button type="button" class="close" data-dismiss="modal">
               <span>×</span>
               </button>
               <div class="logout-text">
                  <p>{{__('messages.logout_msg')}}</p>
               </div>
               <div class="logout-btn">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('messages.cancel')}}</button>
                  <button type="button" onclick="userlogout()" class="btn log" data-dismiss="modal" style="background-color:<?= Session::get('site_color') ?> !important">{{__('messages.logout')}}</button>
               </div>
            </div>
         </div>
      </div>
      <div class="user-login-pop_up">
         <div class="modal" id="myModal">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                     <div id="overlay">
                        <div class="cv-spinner">
                           <span class="spinner"></span>
                        </div>
                     </div>
                     <div id="forgotbody" class="forgotbody">
                        <div class="reset-p" style="background-color:<?= Session::get('site_color') ?> !important;">
                           <h1>{{__('messages.forgot_note')}}
                           </h1>
                        </div>
                        <div class="tab-content space">
                           <form class="log-1">
                              <span id="forgot_msg"></span>
                              <div class="logi">
                                 <a href="#">
                                 <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                 <a href="javascript:loginmodel()">{{__('messages.back_to_login')}}</a>
                                 </a>
                              </div>
                              <input type="text" name="forgot_email"  placeholder="Email" id="value">
                           </form>
                           <div class="button-sign_in-1" >
                              <a href="javascript:forgotpassword()" style="background-color:<?= Session::get('site_color') ?> !important;">
                              {{__('messages.forgot_pwd')}}
                              </a>
                           </div>
                        </div>
                     </div>
                     <div id="loginbody">
                        <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">{{__('messages.login')}}</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">{{__('messages.register')}}</a>
                           </li>
                        </ul>
                        <div class="tab-content">
                           <div role="tabpanel" class="tab-pane fade in active" id="profile">
                              <form>
                                 <span id="login_error_msg"></span>
                                 <input type="email" name="login_email" value="{{isset($_COOKIE['user_email'])?$_COOKIE['user_email']:''}}" placeholder="Enter Your Email"  id="value">
                                 <br>
                                 <input type="password" value="{{isset($_COOKIE['password'])?$_COOKIE['password']:''}}" name="login_password" placeholder="Enter Password"  id="value">
                                 <div class="form-group">
                                    <input type="checkbox" <?php echo isset($_COOKIE[ 'rem_me'])? "checked": ''?> id="html" name="login_remember">
                                    <label for="html">
                                    <span>{{__('messages.rem_me')}}</span>
                                    </label>
                                    <a href="javascript:forgotmodel()">{{__('messages.lost_pwd')}}</a>
                                 </div>
                              </form>
                              <div class="button-sign_in">
                                 <input type="button" name="btnlogin" onclick="loginuser('login_')" value="{{__('messages.login')}}" class="regiterbtn" style="background-color: <?= Session::get('site_color') ?> !important"/>
                              </div>
                              @if(Session::get("facebook_active"))
                              <div class="button-facebook">
                                 <a href="{{ url('auth/facebook') }}">
                                 <img src="{{asset('public/Ecommerce/images/facebook.png')}}">
                                 </a>
                              </div>
                              @endif
                              @if(Session::get("google_active"))
                              <div class="button-facebook">
                                 <a href="{{ url('auth/google') }}">
                                 <img src="{{asset('public/Ecommerce/images/google.png')}}">
                                 </a>
                              </div>
                              @endif
                           </div>
                           <div role="tabpanel" class="tab-pane fade" id="buzz">
                              <form>
                                 <span id="reg_success_msg"></span>
                                 <span id="reg_error_msg"></span>
                                 <input type="text" name="first_name"  id="value" placeholder="{{__('messages.name')}}">
                                 <br>
                                 <input type="email" name="reg_email"  id="value" placeholder="{{__('messages.email')}}">
                                 <br>
                                 <input type="text" name="reg_phone" id="value" placeholder="{{__('messages.phone')}}">
                                 </br>
                                 <input type="password" name="reg_password"  id="value" placeholder="{{__('messages.password')}}">
                                 </br>
                                 <input type="password" name="confirm_password" id="value" placeholder="{{__('messages.confirm_password')}}">
                              </form>
                              <div class="button-sign_in">
                                 <input type="button" name="btnsubmit" onclick="registeruser()" value="REGISTER" class="regiterbtn" style="background-color: <?= Session::get('site_color') ?> !important"/>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    
      <input type="hidden" id="select_cate_name" value="<?=isset($_GET['ca'])?$_GET['ca']:'All'; ?>" />
      <input type="hidden" id="select_cate_id" value="<?=isset($_GET['ca'])?$_GET['ca']:'0'; ?>" />
      <input id="settings-btn" type="checkbox" class="settings-btn">
      @if(Session::get("set_show")==0)
      <label for="settings-btn" class="settings-box-element" style="background: <?= Session::get('site_color') ?> !important"><i class="fa fa-2x fa-gear"></i></label>
      @endif
      <div id="style-switcher">
         <h2 class="color-title">{{__('messages.choose_color')}} : 
         </h2>
         <div class="tab-content-1" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-base" role="tabpanel" aria-labelledby="pills-base-tab">
               <div>
                  <ul class="colors themecolor" id="colorslist">
                     <li id="colorbox1" class="<?=Session::get("colorid")==1? 'active-1' : '';?>" onclick="changebox(1,'#f07f13')">
                        <a  data-color="f07f13" class="color1" onclick="changecolorlog(1)"></a>
                     </li>
                     <li id="colorbox2" class="<?=Session::get("colorid")==2? 'active-1' : '';?>" onclick="changebox(2,'#E91E63')">
                        <a data-color="E91E63" class="color2" onclick="changecolorlog(2)"></a>
                     </li>
                     <li id="colorbox3" class="<?=Session::get("colorid")==3? 'active-1' : '';?>" onclick="changebox(3,'#673AB7')">
                        <a  data-color="673AB7" class="color3" onclick="changecolorlog(3)"></a>
                     </li>
                     <li id="colorbox4" class="<?=Session::get("colorid")==4? 'active-1' : '';?>" onclick="changebox(4,'#00BCD4')">
                        <a  data-color="00BCD4" class="color4" onclick="changecolorlog(4)"></a>
                     </li>
                     <li id="colorbox5" class="<?=Session::get("colorid")==5? 'active-1' : '';?>" onclick="changebox(5,'#009688')">
                        <a  data-color="009688" class="color5" onclick="changecolorlog(5)"></a>
                     </li>
                     <li id="colorbox6" class="<?=Session::get("colorid")==6? 'active-1' : '';?>" onclick="changebox(6,'#4CAF50')">
                        <a  data-color="4CAF50" class="color6" onclick="changecolorlog(6)"></a>
                     </li>
                     <li id="colorbox7" class="<?=Session::get("colorid")==7? 'active-1' : '';?>" onclick="changebox(7,'#8BC34A')">
                        <a  data-color="8BC34A" class="color7" onclick="changecolorlog(7)"></a>
                     </li>
                     <li id="colorbox8" class="<?=Session::get("colorid")==8? 'active-1' : '';?>" onclick="changebox(8,'#353b48')">
                        <a  data-color="353b48" class="color8" onclick="changecolorlog(8)"></a>
                     </li>
                     <li id="colorbox9" class="<?=Session::get("colorid")==9? 'active-1' : '';?>" onclick="changebox(9,'#E88EBA')"> 
                        <a  data-color="E88EBA" class="color9" onclick="changecolorlog(9)"></a>
                     </li>
                     <li id="colorbox10" class="<?=Session::get("colorid")==10? 'active-1' : '';?>" onclick="changebox(10,'#795548')">
                        <a data-color="795548" class="color10" onclick="changecolorlog(10)"></a>
                     </li>
                     <li id="colorbox11" class="<?=Session::get("colorid")==11? 'active-1' : '';?>" onclick="changebox(11,'#f1c40f')">
                        <a  data-color="f1c40f" class="color11" onclick="changecolorlog(11)"></a>
                     </li>
                     <li id="colorbox12" class="<?=Session::get("colorid")==12? 'active-1' : '';?>" onclick="changebox(12,'#D8616D')">
                        <a  data-color="D8616D" class="color12" onclick="changecolorlog(12)"></a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <?php   if(strpos($_SERVER['REQUEST_URI'],"productslist")){
         $myclass="container my-container";
         }else{
         $myclass="container";
         }
         ?>
      <div class="{{$myclass}}">
         <div class="e-nav">
            <div class="row">
               <div class="col-lg-2 col-md-3 col-8">
                  <a href="{{url('/')}}">
                     <div class="top-logo" style="background: <?= Session::get('site_color') ?> !important;-webkit-mask-image:url('<?=Session::get("logo")?>')"></div>
                  </a>
               </div>
               <div class="col-lg-7 col-md-6 ser-show">
                  <form action="{{url('searchproduct')}}" method="post">
                     {{csrf_field()}}
                     <div class="search">
                        <div id="divNoImage">      
                        </div>
                        <div class="sea-input">
                           <input type="text" required name="search_product" value="<?=isset($_GET['s'])?$_GET['s']:''; ?>" onfocus="changesearcat()" id="search_product" placeholder="Search product...">
                        </div>
                        <button class="search-btn" type="submit" style="background: <?= Session::get('site_color') ?> !important">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                     </div>
                  </form>
               </div>
               <div class="cartbar_pop_mbox">
                  <div class="cartbar_pop_mcon">
                     @if(Auth::id()!="")
                     <a href="{{url('myaccount')}}" class="user" >
                        <i class="fa fa-user" aria-hidden="true"></i>
                     </a>
                     @endif
                     @if(Auth::id()=="")
                     <a href="#" class="user" data-toggle="modal" onclick="resetmodel()" data-target="#myModal">
                        <i class="fa fa-user" aria-hidden="true"></i>
                     </a>
                     @endif
                   
                     <div class="popover__wrapper">
                        <a href="#" class="cart hover-popup" data-modal-target="modal1" id="cart-1">
                           <i class="fa fa-shopping-cart popover__title" aria-hidden="true"></i>
                           <?php $cartCollection = Cart::getContent();?>
                           <div class="e-nav-cricle" style="background: <?= Session::get('site_color') ?> !important">
                              <h1 id="totalcart">{{$cartCollection->count()}}</h1>
                           </div>
                        </a>
                        <div class="popover__content">
                           <div class="user-cart-pop_up">
                              <div class="modal-content">
                                 <div class="cart-pop_up-box" id="cartview">
                                    <?php $cartCollection = Cart::getContent();$i=0;?>
                                    @if($cartCollection->count()!=0)
                                    <div class="cart-pop_up-sbox">
                                       @foreach($cartCollection as $item)
                                       <div class="cart-pop_up-content">
                                          <div class="cart-pop_up-imgbox">
                                             @foreach($productdata as $hs)
                                             @if($hs->id==$item->id)
                                             <img src="{{asset('public/upload/product').'/'.$hs->basic_image}}" width="75" height="auto">
                                             @endif
                                             @endforeach
                                          </div>
                                          <div class="cart-pop_up-detail-box">
                                             <div class="pop_up-detail-head">
                                                <h2>{{$item->name}}</h2>
                                                <div class="cart-pop_up-cross">
                                                   <i class="fa fa-times" aria-hidden="true"></i>
                                                   <span>{{$item->quantity}}</span>
                                                </div>
                                                <a href="javascript:deletecartitem('{{$item->id}}')"><i class="fa fa-trash-o pop_up-delete" aria-hidden="true" style="color: <?= Session::get('site_color') ?> !important"></i></a>
                                             </div>
                                             <p>
                                                <?php $option=explode(",",$item->attributes[0]['option']);
                                                   $label=explode(",",$item->attributes[0]['label']);
                                                   $price=explode(",",$item->attributes[0]['price']);
                                                   ?>
                                                
                                                   <?php for($i=0;$i<count($option);$i++){?>
                                                   <span style="font-size:small"><b>{{$option[$i]}}</b><span>  {{$label[$i]}}</span></span></br>
                                                   <?php }?>
                                               
                                             </p>
                                             <h2>{{Session::get('currency').number_format((float)$item->price, 2, '.', '')}}</h2>
                                          </div>
                                       </div>
                                       @endforeach
                                       <div class="cart-pop_up-subtotal">
                                          <h3>{{__('messages.subtotal')}} :</h3>
                                          
                                          <h3 class="cart-pop_up-prize">{{Session::get('currency').number_format(Cart::getTotal(), 2, '.', '')}}</h3>
                                       </div>
                                       <a href="{{url('cartdetail')}}">
                                          <div class="pop_up-viewcart-b">
                                             {{__('messages.view_cart')}}
                                          </div>
                                       </a>
                                       <a href="#">
                                          <div class="">
                                             <form action="{{url('checkout')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="check_delivery" id="check_delivery" value="{{Session::get('home_delivery')}}" />
                                                <input type="hidden" name="check_discount_type" id="check_discount_type" value="1" />
                                                <input type="hidden" name="check_discount_value" id="check_discount_value"   value="15"/>
                                                <input type="hidden" name="check_free_shipping" id="check_free_shipping" value="0" />
                                                <input type="hidden" name="check_coupon_value" id="check_coupon_value" />
                                                <input type="hidden" name="check_couponcode" id="check_couponcode" />
                                                <button value="submit" class="pop_up-checkout-b" type="submit" onclick="Checkout()" style="background-color: <?= Session::get('site_color') ?> !important">
                                                {{__('messages.proceed_to_checkout')}}
                                                </button>
                                             </form>
                                          </div>
                                       </a>
                                    </div>
                                    @endif
                                    @if($cartCollection->count()==0)
                                     <div class="cart-pop_up-content">
                                       <div class="cart-pop_up-content empty">
                                          <div class="cart-pop_up-imgbox">
                                             <img src="{{asset('public/Ecommerce/images/empty.png')}}">
                                             <h1>{{__('messages.cart_empty')}}</h1>
                                          </div>
                                       </div>
                                    </div>
                                     @endif
                                 </div>
                              </div>
                           </div>
                       </div>
                     </div>
                     <a href="{{url('mywishlist')}}" class="wish">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <div class="e-nav-cricle" style="background: <?= Session::get('site_color') ?> !important">
                           <h1 id="totalwish">{{count($mywish)}}</h1>
                        </div>
                     </a>
                     <a class="compare" href="{{url('compare')}}"> 
                        <img src="{{asset('public/Ecommerce/images/compareheader.png')}}">
                         <div class="e-nav-cricle comparesp" style="background: <?= Session::get('site_color') ?> !important">
                           <?php $arr=explode(",",Session::get("compare"));?>
                           <h1 id="totalcompare">{{count(array_filter($arr))}}</h1>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="{{$myclass}}">
         <div class="main-menu">
            <div class="row">
               <ul>
                  @foreach($header_menu as $category)
                  <li>
                     <a href="{{url('productslist/').'/'.$category->id.'/0/0/0'}}">
                     {{$category->name}}
                     <i class="fa fa-angle-down" aria-hidden="true"></i>
                     </a>
                     <div class="main-sub">
                        <div class="sub">
                           @foreach($category->subcategory as $subcat)
                           <ul class="sub-menu">
                              <h4><a href="{{url('productslist/').'/0/'.$subcat->id.'/0/0'}}">{{$subcat->name}}</a></h4>
                              @foreach($subcat->brand as $brand)
                              <li><a href="{{url('productslist/').'/'.$category->id.'/'.$subcat->id.'/'.$brand->id.'/0'}}">{{$brand->brand_name}}</i></a></li>
                              @endforeach
                           </ul>
                           @endforeach
                        </div>
                     </div>
                  </li>
                  @endforeach
                  <li><a href="{{url('Offers')}}">{{__('messages.offers')}}</a>
               </ul>
               <div class="col-lg-7 col-md-12 ser-hide">
                  <form action="{{url('searchproduct')}}" method="post">
                     {{csrf_field()}}
                     <div class="search">
                        <div id="divNoImage1">
                        </div>
                        <input type="text" name="search_product" value="<?=isset($_GET['s'])?$_GET['s']:''; ?>" onfocus="changesearcat()"required  id="search_product_mobile" placeholder="Search product...">
                        <button class="search-btn" type="submit" style="background-color:<?= Session::get('site_color') ?> !important;">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                     </div>
                  </form>
               </div>
               <div class="col-md-12 toggle">
                  <nav class="navbar navbar-dark">
                     <a class="navbar-brand" href="#">{{__('messages.all_category')}}</a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggle-but">
                           <h1 class="but-lines"></h1>
                           <h1 class="but-lines"></h1>
                           <h1 class="but-lines"></h1>
                        </span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                           @foreach($header_menu as $category)
                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                              {{$category->name}}
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <div class="{{$myclass}}">
                                    <div class="row">
                                       <div class="col-md-4">
                                          <ul>
                                             @foreach($category->subcategory as $subcat)
                                             <li><a href="{{url('productslist/').'/0/'.$subcat->id.'/0/0'}}">{{$subcat->name}}</i></a></li>
                                             @endforeach                      
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           @endforeach 
                           <li><a href="{{url('Offers')}}">{{__('messages.offers')}}</a>
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      @yield('content')
      @yield('footer')
      <div class="footer-background">
         <div class="footer-logo">
            <div class="f-logo" style="background: <?= Session::get('site_color') ?> !important;-webkit-mask-image:url('<?=Session::get("logo")?>')"></div>
         </div>
         <div class="{{$myclass}}">
            <div class="row">
               <div class="col-md-12 col-lg-4">
                  <div class="contact">
                     <div class="f-head">
                        <h1>{{__('messages.contact_us')}}</h1>
                     </div>
                     <div class="contact-text">
                        <div class="contact-icon">
                           <div class="footer-icon" style="background: <?= Session::get('site_color') ?> !important"></div>
                        </div>
                        <div class="c-text">
                           <h1>{{__('messages.address')}} : </h1>
                           <p>{{Session::get('site_address')}}</p>
                        </div>
                     </div>
                     <div class="contact-text">
                        <div class="contact-icon">
                           <div class="footer-icon-1" style="background: <?= Session::get('site_color') ?> !important"></div>
                        </div>
                        <div class="c-text">
                           <h1>{{__('messages.phone')}} : </h1>
                           <p>{{Session::get('site_phone')}}</p>
                        </div>
                     </div>
                     <div class="contact-text">
                        <div class="contact-icon">
                           <div class="footer-icon-2" style="background: <?= Session::get('site_color') ?> !important"></div>
                        </div>
                        <div class="c-text">
                           <h1>{{__('messages.email')}} : </h1>
                           <p>{{Session::get('site_email')}}</p>
                        </div>
                     </div>
                     <div class="contact-text">
                        <div class="contact-icon">
                           <div class="footer-icon-3" style="background: <?= Session::get('site_color') ?> !important"></div>
                        </div>
                        <div class="c-text">
                           <h1>{{__('messages.working_day')}} :</h1>
                           <p>{{Session::get('site_workinghour')}}</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 col-lg-8">
                  <div class="row">
                     <div class="f-box">
                        <div class="f-head">
                           <h1>{{__('messages.my_account')}}</h1>
                        </div>
                        <div class="f-account">
                           <li><a href="{{url('aboutus')}}">{{__('messages.about')}}</a></li>
                           <li><a href="{{url('helpsupport')}}">{{__('messages.helpsupport')}}</a></li>
                           <li><a href="{{url('termscondition')}}">{{__('messages.termscon')}}</a></li>
                           <li><a href="{{url('contactus')}}">{{__('messages.contact_us')}}</a></li>
                           <?php if(Auth::id()!=""){?>
                           <li><a href="{{url('myaccount')}}">{{__('messages.my_account')}}</a></li>
                           <li><a href="{{url('myaccount')}}">{{__('messages.order_history')}}</a></li>
                           <?php }else{?>
                           <li><a href="#" data-toggle="modal" data-target="#myModal">{{__('messages.my_account')}}</a></li>
                           <li><a href="#" data-toggle="modal" data-target="#myModal">{{__('messages.order_history')}}</a></li>
                           <?php }?>
                        </div>
                     </div>
                     <div class="f-box-1">
                        <div class="f-head">
                           <h1>{{__('messages.main_feature')}}</h1>
                        </div>
                        <div class="f-account">
                           {{Session::get('site_mainfeature')}}
                        </div>
                     </div>
                     <div class="f-box-2">
                        <div class="f-head">
                           <h1>{{__('messages.newsletternote')}}</h1>
                        </div>
                        <div class="f-be">
                           <p>{{Session::get('site_newsletter')}}</p>
                           <div class="news">
                              @if(Session::has('message1'))
                              <div class="col-sm-12">
                                 <div class="alert  {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">{{ Session::get('message1') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                              </div>
                              @endif
                              <form action="{{url('newsletter')}}" method="post">
                                 {{csrf_field()}}
                                 <input type="text" name="newsletter" placeholder="{{__('messages.email')}}" required="">
                                 <button class="go-btn" type="submit" style="background: <?= Session::get('site_color') ?> !important">{{__('messages.go')}}</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="pay">
                     <a href="#"><img src="{{asset('public/Ecommerce/images/pay-1.jpg')}}"></a>
                     <a href="#"><img src="{{asset('public/Ecommerce/images/pay-2.jpg')}}"></a>
                     <a href="#"><img src="{{asset('public/Ecommerce/images/pay-3.jpg')}}"></a>
                     <a href="#"><img src="{{asset('public/Ecommerce/images/pay-4.jpg')}}"></a>
                     <span>{{date('Y')}} {{__('messages.footer_note')}}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <input type="hidden" id="path" value="{{url('/')}}">
      <input type="hidden" id="cartsuccesslang" value="{{__('messages_error_success.product_add_success')}}"/>
      <input type="hidden" id="login_user_id" value="{{Auth::id()}}">
      <input type="hidden" id="currency" value='{{Session::get("currency")}}'>
      <input type="hidden" id="coupon_ds" value='{{__("messages.coupon")}}'>
      <input type="hidden" id="not_found_lang" value="{{__('messages.No Result Found')}}">
      <input type="hidden" id="All_lang" value="{{__('messages.All')}}">
      <input type="hidden" id="required_field_lang" value="{{__('messages_error_success.required_field')}}">
      <input type="hidden" id="login_account_lang" value="{{__('messages.Please Login to Your Account')}}">
      <input type="hidden" id="ent_current_pwd_lang" value="{{__('messages.ent_current_pwd')}}">
      <input type="hidden" id="invaild_coupon_lang" value="{{__('messages.Invaild Coupon')}}">
      <input type="hidden" id="coupon_req_lang" value="{{__('messages.Please Enter Coupon Code')}}">
      <input type="hidden" id="np_product_lang" value="{{__('messages.No Product')}}">
      <input type="hidden" id="is_required_lang" value="{{__('messages.is Required')}}">
      <input type="hidden" id="email_success_lang" value="{{__('messages.Email Send Successfully')}}">
      <input type="hidden" id="email_not_lang" value="{{__('messages.Your Entered Email Not Exist')}}"> 
      <input type="hidden" id="email_req_lang" value="{{__('messages.Entered Your Email')}}">
      <input type="hidden" id="site_color_store" value="{{Session::get('site_color')}}">
      <script type="text/javascript" src="{{ asset('public/js/select.js') }}"></script>
      <input type="hidden" id="quick_view_lang" value="{{__('messages.Quick View')}}">
      <input type="hidden" id="user_register" value="{{__('messages.user_register')}}"/>
      <input type="hidden" id="compare_add_lang" value="{{__('messages.The product has been added to your compare list')}}">
      <script type="text/javascript" src="{{ URL::to('public/js/code.js').'?v=20000' }}"></script>
   </body>
  
</html>