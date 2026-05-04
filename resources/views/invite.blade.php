<x-app-layout>
    <div class="container mt-5">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Create User</h4>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="/invite">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="Admin">Admin</option>
                            <option value="Member">Member</option>
                        </select>
                    </div>

                    <!-- Company (only SuperAdmin) -->
                    @role('SuperAdmin')
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control">
                    </div>
                    @endrole

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary w-100">
                        Create User
                    </button>

                </form>

            </div>
        </div>

    </div>
</x-app-layout>