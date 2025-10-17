<body class="bg-gray-100 min-h-screen flex">
	<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

	<aside id="sidebar"
		class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl 
        sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%] 
        transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">

		<div class="flex items-center gap-5 mb-10">
			<img src="../assets/image/logo-smkn2kra.webp" alt="Logo" class="w-16 h-16 mx-auto rounded mb-2" />
			<h1 class="text-sm font-bold leading-tight">SISTEM INFORMASI SEKOLAH</h1>
		</div>

		<nav class="space-y-2">
			<!-- Dashboard -->
			<a href="/wali/dashboard"
				class="flex items-center gap-2 p-3 rounded-lg transition 
				@if(Str::startsWith($title, 'Dashboard')) bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400 
				@else hover:bg-blue-700 @endif">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
				</svg>
				Dashboard
			</a>

			<!-- Prestasi -->
			<a href="/wali/prestasi"
				class="flex items-center gap-2 p-3 rounded-lg transition 
				@if(Str::startsWith($title, 'Prestasi')) bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400 
				@else hover:bg-blue-700 @endif">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2l4 -4m1 10H8a2 2 0 01-2-2V6a2 2 0 
                    012-2h8a2 2 0 012 2v12a2 2 0 01-2 2z" />
				</svg>
				Prestasi Anak
			</a>

			<!-- Pelanggaran -->
			<a href="/wali/pelanggaran"
				class="flex items-center gap-2 p-3 rounded-lg transition 
				@if(Str::startsWith($title, 'Pelanggaran')) bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400 
				@else hover:bg-blue-700 @endif">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 5h6m2 0a2 2 0 012 2v11a2 2 0 
                    01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h2m2-1h2a1 
                    1 0 011 1v0a1 1 0 01-1 1h-2a1 1 0 
                    01-1-1v0a1 1 0 011-1z" />
				</svg>
				Pelanggaran Anak
			</a>

			<!-- Agenda -->
			<a href="/wali/agenda"
				class="flex items-center gap-2 p-3 rounded-lg transition 
				@if(Str::startsWith($title, 'Agenda')) bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400 
				@else hover:bg-blue-700 @endif">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M5 13l4 4L19 7" />
				</svg>
				Agenda Sekolah
			</a>

			<!-- Nilai Akademik -->
			<a href="/wali/nilai"
				class="flex items-center gap-2 p-3 rounded-lg transition 
				@if(Str::startsWith($title, 'Nilai')) bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400 
				@else hover:bg-blue-700 @endif">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M3 10h18M9 21V3m6 18V3" />
				</svg>
				Nilai Akademik
			</a>

			<!-- Kehadiran -->
			<a href="/wali/kehadiran"
				class="flex items-center gap-2 p-3 rounded-lg transition 
				@if(Str::startsWith($title, 'Kehadiran')) bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400 
				@else hover:bg-blue-700 @endif">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
					viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				Kehadiran
			</a>
		</nav>
	</aside>
</body>
