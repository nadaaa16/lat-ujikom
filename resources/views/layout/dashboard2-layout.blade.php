<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield ('title') - Perpustakaan</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="/back/vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="/back/vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="/back/vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->
	</head>
	<body>


		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
			</div>
			<div class="header-right">
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							{{-- <span class="user-icon">
								<img src="/back/vendors/images/photo1.jpg" alt="" />
							</span> --}}
							<span class="user-name"> Halo {{ Auth::user()->name }}!</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" >
								<form action="{{ route('logout') }}" method="POST">
									@csrf
									<a href="{{ route('logout') }}" 
										class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); this.closest('form').submit();">
										<i class="fas fa-sign-out-alt"></i>
										Logout
									</a>
								</form>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>		

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="dashboard">
					<img src="/back/vendors/images/bg-perpus.png" alt="dashboard" class="dark-logo" />
					<img
						src="/back/vendors/images/bg-perpus.png"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						@if (Auth::user()->role === 'admin' || Auth::user()->role === 'pustakawan')
						<li class="menu-header" style="font-weight: bold; font-style: italic; padding: 5px 0; font-size: smaller;"> Home </li>
							<li>
								<a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard')) active @endif">
									<span class="micon bi bi-house"></span>
									<span class="mtext">Home</span>
								</a>
							</li>
							<li class="menu-header" style="font-weight: bold; font-style: italic; padding: 5px 0; font-size: smaller;"> Perpustakaan </li>
							<li>
								<a href="{{ route('kategori.index') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/perpustakaan/kategori*')) active @endif">
									<span class="micon bi bi-paperclip"></span>
									<span class="mtext">Kategori</span>
								</a>
							</li>
							<li>
								<a href="{{ route('buku.index') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/perpustakaan/buku*')) active @endif">
									<span class="micon bi bi-book"></span>
									<span class="mtext">Buku</span>
								</a>
							</li>
							<li>
								<a href="{{ route('peminjaman.admin') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/perpustakaan/peminjaman/admin*')) active @endif">
									<span class="micon bi bi-journal"></span>
									<span class="mtext">Data Peminjam</span>
								</a>
							</li>
							@if (Auth::user()->role === 'admin')
							<li class="menu-header" style="font-weight: bold; font-style: italic; padding: 5px 0; font-size: smaller;"> Pengaturan </li>
								<li>
									<a href="{{ route('user.index') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/pengaturan/user*')) active @endif">
										<span class="micon bi bi-person-check"></span>
										<span class="mtext">Pengguna</span>
									</a>
								</li>
							@endif
						@elseif (Auth::user()->role === 'pembaca')
							<li>
								<a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard')) active @endif">
									<span class="micon bi bi-house"></span>
									<span class="mtext">Home</span>
								</a>
							</li>
							<li>
								<a href="{{ route('pustaka.index') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/perpustakaan/pustaka*')) active @endif">
									<span class="micon bi bi-book"></span>
									<span class="mtext">Pustaka</span>
								</a>
							</li>
							<li>
								<a href="{{ route('koleksi.index') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/perpustakaan/koleksi*')) active @endif">
									<form action="{{ route('koleksi.index') }}" method="GET">
										<input type="hidden" name="user" value="{{ Auth::user()->id }}">
										<button type="submit" class="nav-link btn" style="background: none; border: none;" onclick="event.preventDefault(); this.closest('form').submit();">
											<i class="micon bi bi-bookmark"></i>
											<span>Koleksi</span>
										</button>
									</form>
								</a>
							</li>						
							<li>
								<a href="{{ route('peminjaman.index') }}" class="dropdown-toggle no-arrow @if(request()->is('dashboard/perpustakaan/peminjaman*')) active @endif">
									<form action="{{ route('peminjaman.index') }}" method="GET" style="display: inline-block; margin-right: 20px;">
										<input type="hidden" name="user" value="{{ Auth::user()->id }}">
										<button type="submit" class="nav-link btn" style="background: none; border: none;" onclick="event.preventDefault(); this.closest('form').submit();">
											<i class="micon bi bi-bag"></i>
											<span>Buku Yang Dipinjam</span>
										</button>
									</form>
								</a>
							</li>
						@endif
					</ul>
					
				</div>
			</div>
						
		</div>
		<div class="mobile-menu-overlay"></div>
			@yield('content')

		<!-- js -->
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="/back/vendors/scripts/dashboard3.js"></script>
		
	</body>
</html>
