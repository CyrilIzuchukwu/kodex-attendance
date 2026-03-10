<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Kodex Student's Attendance Form</title>
    <meta name="description" content="This form helps us process the students attendance to class" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <style>
        .success-message {
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loader {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 lg:p-6">
    <div class="w-full">
        <!-- Main Form Container -->
        <div class="container-wrapper">

            <!-- Logo -->
            <div class="logo">
                <img src="/assets/images/logo.png" alt="KodexAfrica Logo" />
            </div>

            <!-- Form Body -->
            <div class="form-body">

                <div id="successMessage"
                    class="hidden success-message bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="font-semibold text-green-800">Attendance recorded successfully!</p>
                                <p class="text-green-700 text-sm mt-1">Your information has been saved for future use.
                                </p>
                            </div>
                        </div>
                        <button onclick="document.getElementById('successMessage').classList.add('hidden')"
                            class="text-green-500 hover:text-green-700 ml-4 text-xl font-bold leading-none">&times;</button>
                    </div>
                </div>

                <!-- Header -->
                <div class="header">
                    <h2 class="title">Kodex Student's Attendance</h2>
                    <p class="desc">Fill in your details to sign in and record your attendance.</p>
                </div>

                <div id="returningUserBadge"
                    class="hidden bg-blue-50 border-l-4 border-blue-500 p-3 mb-4 rounded flex items-center text-sm">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-blue-800 font-medium">Welcome back! Your info is pre-filled.</span>
                </div>

                <!-- Attendance Form -->
                <form id="attendanceForm" class="space-y-6" onsubmit="submitAttendance(event)">

                    <!-- Full Name -->
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="fullName" name="fullName"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg transition-all"
                            placeholder="Enter your full name" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{11}"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg transition-all"
                            placeholder="08012345678" />
                        <p class="text-xs text-gray-500 mt-1">Enter 11-digit phone number</p>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email"
                            class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg transition-all"
                            placeholder="your.email@example.com" />
                    </div>

                    <!-- Course -->
                    <div>
                        <label for="course" class="block text-sm font-medium text-gray-700 mb-2">
                            Course <span class="text-red-500">*</span>
                        </label>
                        <select id="course" name="course"
                            class="form-select w-full px-4 py-3 border border-gray-300 rounded-lg transition-all bg-white">
                            <option value="" disabled selected>Select a course</option>
                            <option value="web-development">Web Development</option>
                            <option value="data-analysis">Data Analysis</option>
                            <option value="ui-ux-design">UI/UX Design</option>
                            <option value="cybersecurity">Cybersecurity</option>
                            <option value="product-management">Product Management</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" id="submitBtn"
                            class="submit-btn w-full py-4 px-6 text-white font-semibold transition-all flex items-center justify-center gap-3">
                            <span id="btnText">Submit Attendance</span>
                            <div id="btnLoader" class="loader hidden"></div>
                        </button>
                    </div>


                    <div id="clearDataContainer" class="hidden pt-2">
                        <button type="button" id="clearDataBtn"
                            class="w-full py-2 px-4 text-sm text-gray-600 hover:text-red-600 font-medium transition-colors">
                            Clear saved information
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>

    <script>
        const STORAGE_KEY = 'kodex_user_info';
        const submitUrl = "{{ route('attendance.submit') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.addEventListener('DOMContentLoaded', function() {

            // ── Session flash toasts ──
            @if (session('success'))
                iziToast.success({
                    message: @json(session('success')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @elseif (session('error'))
                iziToast.error({
                    message: @json(session('error')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @elseif (session('info'))
                iziToast.info({
                    message: @json(session('info')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @elseif (session('warning'))
                iziToast.warning({
                    message: @json(session('warning')),
                    position: 'topRight',
                    timeout: 5000,
                    pauseOnHover: true,
                    progressBar: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                    resetOnHover: true,
                });
            @endif

            // ── Restore saved user data from localStorage ──
            const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
            if (saved) {
                document.getElementById('fullName').value = saved.fullName || '';
                document.getElementById('email').value = saved.email || '';
                document.getElementById('phone').value = saved.phone || '';
                document.getElementById('course').value = saved.course || '';

                document.getElementById('returningUserBadge').classList.remove('hidden');
                document.getElementById('clearDataContainer').classList.remove('hidden');
            }

            // ── Clear saved data button ──
            document.getElementById('clearDataBtn').addEventListener('click', function() {
                localStorage.removeItem(STORAGE_KEY);
                document.getElementById('fullName').value = '';
                document.getElementById('email').value = '';
                document.getElementById('phone').value = '';
                document.getElementById('course').value = '';
                document.getElementById('returningUserBadge').classList.add('hidden');
                document.getElementById('clearDataContainer').classList.add('hidden');

                iziToast.info({
                    message: 'Saved information cleared.',
                    position: 'topRight',
                    timeout: 3000,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                });
            });
        });

        // ── Helpers: button state ──
        function setButtonLoading() {
            const btn = document.getElementById('submitBtn');
            const btnTxt = document.getElementById('btnText');
            const loader = document.getElementById('btnLoader');
            btn.disabled = true;
            btnTxt.textContent = 'Submitting...';
            loader.classList.remove('hidden');
        }

        function resetButton() {
            const btn = document.getElementById('submitBtn');
            const btnTxt = document.getElementById('btnText');
            const loader = document.getElementById('btnLoader');
            btn.disabled = false;
            btnTxt.textContent = 'Submit Attendance';
            loader.classList.add('hidden'); // ← stops the spinner
        }

        function setButtonSuccess() {
            const btn = document.getElementById('submitBtn');
            const btnTxt = document.getElementById('btnText');
            const loader = document.getElementById('btnLoader');
            btn.disabled = true;
            loader.classList.add('hidden'); // ← stops the spinner
            btnTxt.textContent = '✅ Submitted!';
            btn.classList.add('opacity-60');
        }

        // ── Save to localStorage ──
        function saveToLocalStorage(data) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        }

        // ── Submit attendance via AJAX ──
        async function submitAttendance(event) {
            event.preventDefault();

            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const course = document.getElementById('course').value;

            // Client-side validation
            if (!fullName) {
                iziToast.warning({
                    title: 'Required',
                    message: 'Please enter your full name.',
                    position: 'topRight'
                });
                return;
            }
            if (!phone || !/^[0-9]{11}$/.test(phone)) {
                iziToast.warning({
                    title: 'Invalid',
                    message: 'Please enter a valid 11-digit phone number.',
                    position: 'topRight'
                });
                return;
            }
            if (!email) {
                iziToast.warning({
                    title: 'Required',
                    message: 'Please enter your email address.',
                    position: 'topRight'
                });
                return;
            }
            if (!course) {
                iziToast.warning({
                    title: 'Required',
                    message: 'Please select a course.',
                    position: 'topRight'
                });
                return;
            }

            setButtonLoading();

            try {
                const response = await fetch(submitUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        full_name: fullName,
                        email,
                        phone,
                        course
                    })
                });

                const data = await response.json();

                if (data.success) {
                    saveToLocalStorage({
                        fullName,
                        email,
                        phone,
                        course
                    });

                    // Hide success banner after 4 seconds
                    const banner = document.getElementById('successMessage');
                    banner.classList.remove('hidden');
                    setTimeout(() => banner.classList.add('hidden'), 4000);

                    document.getElementById('clearDataContainer').classList.remove('hidden');

                    iziToast.success({
                        title: 'Attendance Marked!',
                        message: data.message,
                        position: 'topRight',
                        timeout: 5000,
                        progressBar: true,
                        transitionIn: 'flipInX',
                        transitionOut: 'flipOutX',
                    });

                    setButtonSuccess();

                } else {
                    iziToast.warning({
                        title: 'Already Marked',
                        message: data.message,
                        position: 'topRight',
                        timeout: 5000,
                        progressBar: true,
                        transitionIn: 'flipInX',
                        transitionOut: 'flipOutX',
                    });

                    resetButton();
                }

            } catch (error) {
                iziToast.error({
                    title: 'Error',
                    message: 'Something went wrong. Please try again.',
                    position: 'topRight',
                    timeout: 5000,
                    progressBar: true,
                    transitionIn: 'flipInX',
                    transitionOut: 'flipOutX',
                });

                resetButton();
            }
        }
    </script>


</body>

</html>
