<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-5">

        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>Create Short URL</h4>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(!auth()->user()->hasRole('SuperAdmin'))

                <!--  CREATE URL -->
                <form method="POST" action="/urls">
                    @csrf

                    <div class="mb-3">
                        <label>Original URL</label>
                        <input type="url" name="original_url" class="form-control" required>
                    </div>

                    <button class="btn btn-success w-100">
                        Generate Short URL
                    </button>
                </form>

                @else
                    <div class="alert alert-warning">
                        SuperAdmin is not allowed to create short URLs
                    </div>
                @endif

            </div>
        </div>

    </div>

</x-app-layout>


<hr>

<h5>Your URLs</h5>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Original URL</th>
            <th>Short URL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($urls ?? [] as $u)
        <tr>
            <td>{{ $u->original_url }}</td>
            <td>
                <a href="/{{ $u->short_code }}" target="_blank">
                    {{ url('/'.$u->short_code) }}
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>