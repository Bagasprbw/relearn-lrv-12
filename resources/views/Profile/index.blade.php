<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #459af8;
            --primary-dark: #3a82d1;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color), #98dcf7);
            min-height: 100vh;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(69, 154, 248, 0.25);
        }

        .info-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-value {
            color: #333;
            font-size: 1.1rem;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .password-form {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Card -->
                <div class="profile-card mb-4">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face"
                             alt="Profile Picture" class="profile-img">
                        <h2 class="mb-0">{{ Auth::user()->name }}</h2>
                        <p class="mb-0 opacity-75">User</p>
                    </div>

                    <!-- Profile Body -->
                    <div class="p-4">
                        <h4 class="section-title">
                            <i class="bi bi-person-circle me-2"></i>Profile Information
                        </h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person me-2"></i>Name
                                    </div>
                                    <div class="info-value">{{ Auth::user()->name }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </div>
                                    <div class="info-value">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-geo-alt me-2"></i>Address
                                    </div>
                                    <div class="info-value">{{ Auth::user()->address }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-telephone me-2"></i>Phone
                                    </div>
                                    <div class="info-value">{{ Auth::user()->phone }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ALERTS -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Succeed!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle-fill me-2"></i>
                    <strong>Failed!</strong> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div id="loading-alert" class="alert alert-primary alert-dismissible fade show d-none" role="alert">
                    <div class="spinner-border spinner-border-sm me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <strong>Proccesing...</strong> Saving your profile changes.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <!-- Change Password Form -->
                <div class="profile-card">
                    <div class="p-4">
                        <h4 class="section-title">
                            <i class="bi bi-shield-lock me-2"></i>Change Password
                        </h4>

                        <div class="password-form">
                            <form action="{{ route('profile.changePassword') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="currentPassword" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" name="current_password" id="currentPassword" placeholder="Masukkan password saat ini">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-key"></i>
                                            </span>
                                            <input type="password" class="form-control" name="new_password" id="newPassword"
                                            placeholder="Masukkan password baru">
                                        </div>
                                        <div class="form-text">
                                            Password must be at least 8 characters with a combination of letters and numbers
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-check-circle"></i>
                                            </span>
                                            <input type="password" class="form-control" name="new_password_confirmation" id="confirmPassword" placeholder="Konfirmasi password baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-2"></i>Save Password
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                                    </button>
                                    <a href="/" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left-circle me-2"></i>Back to Home
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        const form = document.querySelector('form');
        const loadingAlert = document.getElementById('loading-alert');

        if (form && loadingAlert) {
            form.addEventListener('submit', () => {
                loadingAlert.classList.remove('d-none');
            });
        }
    </script>
</body>
</html>
