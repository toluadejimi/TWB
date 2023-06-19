<!-- Nav items -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
     <i class="fi fi-rs-dashboard"></i>
      <span class="nav-link-text">{{ __('Dashboard') }}</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/order*') ? 'active' : '' }}" href="{{ route('admin.order.index') }}">
     <i class="fi  fi-rs-boxes"></i>
      <span class="nav-link-text">{{ __('Orders') }}</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/plan*') ? 'active' : '' }}" href="{{ route('admin.plan.index') }}">
     <i class="fi  fi-rs-light-switch"></i>
      <span class="nav-link-text">{{ __('Logs') }}</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/customer*') ? 'active' : '' }}" href="{{ route('admin.customer.index') }}">
     <i class="fi fi-rs-users-alt"></i>
      <span class="nav-link-text">{{ __('Customers') }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/send-mail*') ? 'active' : '' }}" href="{{ route('admin.mail') }}">
     <i class="fi fi-rs-users-alt"></i>
      <span class="nav-link-text">{{ __('Send Mail') }}</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/credit*') ? 'active' : '' }}" href="{{ route('admin.credit') }}">
     <i class="fi fi-rs-users-alt"></i>
      <span class="nav-link-text">{{ __('Credit') }}</span>
    </a>
  </li>


 
  
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/support*') ? 'active' : '' }}" href="{{ route('admin.support.index') }}">
     <i class="fi  fi-rs-headset"></i>
      <span class="nav-link-text">{{ __('Help & Supports') }}</span>
    </a>
  </li>
</ul>





<h6 class="navbar-heading p-0 text-muted mt-4">{{ __('Site Settings') }}</h6>
<ul class="navbar-nav mb-md-3">
{{-- 
   <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.page-settings.index') }}">
      <i class="fi fi-rs-magic-wand"></i>
      <span class="nav-link-text">{{ __('Page Settings') }}</span>
    </a>
  </li> --}}
  
  
 
  
   <li class="nav-item">
    <a class="nav-link {{  Request::is('admin/developer-settings*') ? 'active' : '' }}" href="#dev-settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
      <i class="fi  fi-rs-settings"></i>
      <span class="nav-link-text">{{ __('Developer Settings') }}</span>
    </a>
    <div class="collapse" id="dev-settings">
      <ul class="nav nav-sm flex-column">
        
        <li class="nav-item">
          <a href="{{ route('admin.developer-settings.show','app-settings') }}" class="nav-link">{{ __('App Settings') }}</a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.developer-settings.show','mail-settings') }}" class="nav-link">{{ __('SMTP Settings') }}</a>
        </li>

       
      </ul>
    </div>
  </li>  
</ul>

<h6 class="navbar-heading p-0 text-muted mt-2">{{ __('My Settings') }}</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}" href="{{ url('/admin/profile') }}">
      <i class="fi fi fi-rs-comment-user"></i>
      <span class="nav-link-text">{{ __('Profile Settings') }}</span>
    </a>
  </li>
 
  <li class="nav-item">
    <a class="nav-link logout-button" href="#" >
      <i class="ni ni-button-power"></i>
      <span class="nav-link-text">{{ __('Logout') }}</span>
    </a>
  </li>
</ul>
