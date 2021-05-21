@extends('layouts.main')

@section('content')

    <div class="container">
        <h1>URL Shortener</h1>

        <div class="card">

            <div class="card-header">
                <form method="POST" action="{{ route('links.store') }}">
                    @csrf
                    <div class="input-group mb-3">
                    <input type="url" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Generate Shorten Link</button>
                    </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
        

                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Short Link</th>
                                <th>Link</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($shortLinks as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->link }}</td>
                                    <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                                    <td class="text-center"><a href="{{ route('links.edit', ['link' => $row]) }}" class="btn btn-secondary">Edit</a></td>
                                    <td  class="text-center">
                                        <form action="{{ route('links.destroy', ['link' => $row]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection