<main class="flex-1 sm:ml-[17rem] p-6">
		<div
			class="flex sm:relative z-30 justify-between items-center bg-gradient-to-br from-blue-500 to-blue-700 text-white px-6 py-4 rounded-lg shadow mb-6">
			<div class="flex items-center space-x-4 mr-5">
				<button id="toggleSidebar" class="sm:hidden p-2 text-white rounded-lg hover:bg-blue-700 transition">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M4 6h16M4 12h16M4 18h16" />
					</svg>
				</button>
				<div class="items-center">
					<h3 class="text-md sm:text-2xl text-white font-semibold">{{ $title }}</h3>
				</div>
			</div>

			

			<div class="flex items-center space-x-4 ml-5">
				<button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
					class="relative inline-flex items-center text-sm font-medium text-center text-gray-100 hover:text-gray-100 focus:outline-none light:hover:text-white light:text-gray-400"
					type="button">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
					</svg>
					<div
						class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 light:border-gray-900">
					</div>
				</button>

				<div id="dropdownNotification"
					class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-xl light:bg-gray-800 light:divide-gray-700"
					aria-labelledby="dropdownNotificationButton">
					<!-- Judul -->
					<div
						class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 light:bg-gray-800 light:text-white">
						Notifications
					</div>

					<!-- Isi Notifikasi -->
					<div class="divide-y divide-gray-100 light:divide-gray-700">
						<!-- Notifikasi: Pending -->
						<a href="detail-riwayat-pending.html"
							class="flex px-4 py-3 hover:bg-gray-100 light:hover:bg-gray-700">
							<div class="shrink-0 relative">
								<img class="rounded-full object-cover w-11 h-11"
									src="https://mm.feb.uncen.ac.id/wp-content/uploads/2016/01/tutor-8.jpg"
									alt="Dimas Prakoso" />
								<div
									class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-yellow-500 border border-white rounded-full light:border-gray-800">
									<svg class="w-2 h-2 text-white" xmlns="http://www.w3.org/2000/svg"
										fill="currentColor" viewBox="0 0 18 18">
										<circle cx="9" cy="9" r="8" />
									</svg>
								</div>
							</div>
							<div class="w-full ps-3">
								<div class="text-gray-500 text-sm light:text-gray-400">
									<span class="font-semibold text-gray-900 light:text-white">Dimas Prakoso</span>
									• Ruang Multimedia
								</div>
								<span class="text-gray-400 text-xs light:text-white">Beberapa komputer tidak menyala,
									mohon segera
									diperbaiki.</span>
								<div class="text-xs text-yellow-500 font-medium mt-1">
									17 Juli 2025, 10:20
								</div>
							</div>
						</a>
					</div>

					<!-- View All -->
					<a href="notifikasi.html"
						class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 light:bg-gray-800 light:hover:bg-gray-700 light:text-white">
						<div class="inline-flex items-center">
							<svg class="w-4 h-4 me-2 text-gray-500 light:text-gray-400"
								xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
								<path
									d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
							</svg>
							View all
						</div>
					</a>
				</div>

				<div class="relative">
					<button onclick="toggleDropdown()"
						class="p-1 rounded-full hover:ring-2 hover:ring-white transition">
						<img src="https://mm.feb.uncen.ac.id/wp-content/uploads/2016/01/tutor-8.jpg" alt="Profil"
							class="h-8 w-8 rounded-full object-cover border-2 border-white shadow" />
					</button>

					<div id="dropdown-menu"
						class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-xl shadow-lg hidden z-50">
						<div class="flex flex-col items-center py-4 px-4">
							<div class="w-16 h-16 rounded-full bg-gray-200 bg-cover bg-center"
								style="background-image: url('https://mm.feb.uncen.ac.id/wp-content/uploads/2016/01/tutor-8.jpg')">
							</div>
							<p class="mt-2 font-semibold text-green-600">Kurikulum</p>
						</div>

						<hr class="border-gray-200" />

						<a href="edit-profil.html" class="block px-4 py-2 hover:bg-blue-50 text-center">Edit Profil</a>
						<a href="/laporan-masyarakat/index.html"
							class="block px-4 py-2 hover:bg-blue-50 text-center text-red-500">Logout</a>
					</div>
				</div>
			</div>
		</div>