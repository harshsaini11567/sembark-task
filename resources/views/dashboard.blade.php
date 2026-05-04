<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- Bootstrap CDN (agar layout me nahi hai) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-5">

        <div class="card shadow">
            <div class="card-body">

                <h4 class="mb-3">Welcome, {{ auth()->user()->name }}</h4>

                <p class="text-muted">You're logged in!</p>

                <hr>

                <div class="d-flex gap-3 flex-wrap">

                    <!-- ✅ Invite Button (SuperAdmin + Admin only) -->
                    @role('SuperAdmin|Admin')
                        <a href="/invite" class="btn btn-primary">
                            ➕ Create User
                        </a>
                    @endrole

                    <!-- ✅ URL List -->
                    <a href="/urls" class="btn btn-success">
                        🔗 View URLs
                    </a>

                    <!-- ✅ Create URL (Admin + Member only) -->
                    @role('Admin|Member')
                        <a href="/urls" class="btn btn-warning">
                            ➕ Create Short URL
                        </a>
                    @endrole

                </div>

            </div>
        </div>

    </div>
</x-app-layout>