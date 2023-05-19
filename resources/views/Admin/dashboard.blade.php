@php
    $html_tag_data = [];
    $title = 'Dashboard';
    $description= 'Ecommerce Dashboard'
@endphp
@extends('admin.partial.master',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])
@section('contant')
<main>
    <div class="container">
      <!-- Title and Top Buttons Start -->
      <div class="page-title-container">
        <div class="row">
          <!-- Title Start -->
          <div class="col-12 col-md-7">
            <a class="muted-link pb-2 d-inline-block hidden" href="#">
              <span class="align-middle lh-1 text-small">&nbsp;</span>
            </a>
            <h1 class="mb-0 pb-0 display-4 text-info" id="title"><b>Welcome to admin dashboard!<br> Admin, {{Auth::guard('admin')->user()->name}}.</b></h1>
          </div>
          <!-- Title End -->
        </div>
      </div>
      <!-- Title and Top Buttons End -->

      <!-- Stats Start -->
      <div class="row">
        <div class="col-12">
          <div class="d-flex">
            <div class="dropdown-as-select me-3" data-setActive="false" data-childSelector="span">
              <a class="pe-0 pt-0 align-top lh-1 dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                <span class="small-title"></span>
              </a>
              <div class="dropdown-menu font-standard">
                <div class="nav flex-column" role="tablist">
                  <a class="active dropdown-item text-medium" href="#" aria-selected="true" role="tab">Today's</a>
                  <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Weekly</a>
                  <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Monthly</a>
                  <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Yearly</a>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-5">
            <div class="row g-2">
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-acorn-icon="dollar" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">USERS</div>
                    <div class="text-primary cta-4">{{$usercount}}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-acorn-icon="cart" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">POSTS</div>
                    <div class="text-primary cta-4">{{$postcount}}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-acorn-icon="server" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">CATEGORIES</div>
                    <div class="text-primary cta-4">{{$categorycount}}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-acorn-icon="user" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">TAGS</div>
                    <div class="text-primary cta-4">{{$tagcount}}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-acorn-icon="arrow-top-left" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">MENUES</div>
                    <div class="text-primary cta-4">{{$menucount}}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-acorn-icon="message" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">COMMENTS</div>
                    <div class="text-primary cta-4">{{$commentcount}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </main>
  @endsection