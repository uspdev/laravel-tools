@extends('laravel-usp-theme::master')

@section('styles')
  @parent
  <style>
    /* body {
                padding: 25px;
              } */

    /* h1 {
      font-size: 1.5em;
      margin-top: 0;
    } */

    #table-log {
      font-size: 0.85rem;
    }

    .sidebar {
      font-size: 0.85rem;
      line-height: 1;
    }

    .btn {
      font-size: 0.7rem;
    }

    .stack {
      font-size: 0.85em;
    }

    .date {
      min-width: 75px;
    }

    .text {
      word-break: break-all;
    }

    a.llv-active {
      z-index: 2;
      background-color: #f5f5f5;
      border-color: #777;
    }

    .list-group-item {
      word-break: break-word;
    }

    .folder {
      padding-top: 15px;
    }

    .div-scroll {
      height: 80vh;
      overflow: hidden auto;
    }

    .nowrap {
      white-space: nowrap;
    }

    .list-group {
      padding: 5px;
    }




    /**
              * DARK MODE CSS
              */
/*
    body[data-theme="dark"] {
      background-color: #151515;
      color: #cccccc;
    }

    [data-theme="dark"] a {
      color: #4da3ff;
    }

    [data-theme="dark"] a:hover {
      color: #a8d2ff;
    }

    [data-theme="dark"] .list-group-item {
      background-color: #1d1d1d;
      border-color: #444;
    }

    [data-theme="dark"] a.llv-active {
      background-color: #0468d2;
      border-color: rgba(255, 255, 255, 0.125);
      color: #ffffff;
    }

    [data-theme="dark"] a.list-group-item:focus,
    [data-theme="dark"] a.list-group-item:hover {
      background-color: #273a4e;
      border-color: rgba(255, 255, 255, 0.125);
      color: #ffffff;
    }

    [data-theme="dark"] .table td,
    [data-theme="dark"] .table th,
    [data-theme="dark"] .table thead th {
      border-color: #616161;
    }

    [data-theme="dark"] .page-item.disabled .page-link {
      color: #8a8a8a;
      background-color: #151515;
      border-color: #5a5a5a;
    }

    [data-theme="dark"] .page-link {
      background-color: #151515;
      border-color: #5a5a5a;
    }

    [data-theme="dark"] .page-item.active .page-link {
      color: #fff;
      background-color: #0568d2;
      border-color: #007bff;
    }

    [data-theme="dark"] .page-link:hover {
      color: #ffffff;
      background-color: #0051a9;
      border-color: #0568d2;
    }

    [data-theme="dark"] .form-control {
      border: 1px solid #464646;
      background-color: #151515;
      color: #bfbfbf;
    }

    [data-theme="dark"] .form-control:focus {
      color: #bfbfbf;
      background-color: #212121;
      border-color: #4a4a4a;
    } */
  </style>
@endsection

@section('content')
  @include('laravel-tools::partials.dashboard-menu', ['activeTab' => 'logs'])

  <script>
    // function initTheme() {
    //   const darkThemeSelected =
    //     localStorage.getItem('darkSwitch') !== null &&
    //     localStorage.getItem('darkSwitch') === 'dark';
    //   darkSwitch.checked = darkThemeSelected;
    //   darkThemeSelected ? document.body.setAttribute('data-theme', 'dark') :
    //     document.body.removeAttribute('data-theme');
    // }

    // function resetTheme() {
    //   if (darkSwitch.checked) {
    //     document.body.setAttribute('data-theme', 'dark');
    //     localStorage.setItem('darkSwitch', 'dark');
    //   } else {
    //     document.body.removeAttribute('data-theme');
    //     localStorage.removeItem('darkSwitch');
    //   }
    // }
  </script>

  <div class="row">
    <div class="col sidebar mb-3">
      <h5><i class="fa fa-calendar" aria-hidden="true"></i> Laravel Log Viewer</h5>
      <p class="text-muted"><i>by Rap2h</i></p>

      {{-- <div class="custom-control custom-switch" style="padding-bottom:20px;">
        <input type="checkbox" class="custom-control-input" id="darkSwitch">
        <label class="custom-control-label" for="darkSwitch" style="margin-top: 6px;">Dark Mode</label>
      </div> --}}

      @include('laravel-tools::logs.dir-tree')
    </div>
    <div class="col-10 table-container">
      @if ($logs === null)
        <div>Log file >50M, please download it.</div>
      @else
        @includeWhen($current_file, 'laravel-tools::logs.arquivo')
      @endif
      <div class="p-3">
        @includeWhen($current_file, 'laravel-tools::logs.file-footer')
      </div>
    </div>
  @endsection

  @section('javascripts_bottom')
    @parent
    <script>
      //   // dark mode by https://github.com/coliff/dark-mode-switch
      //   const darkSwitch = document.getElementById('darkSwitch');

      //   // this is here so we can get the body dark mode before the page displays
      //   // otherwise the page will be white for a second...
      //   initTheme();

      //   window.addEventListener('load', () => {
      //     if (darkSwitch) {
      //       initTheme();
      //       darkSwitch.addEventListener('change', () => {
      //         resetTheme();
      //       });
      //     }
      //   });

      // end darkmode js
    </script>
  @endsection
