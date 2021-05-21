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
                                <th>Clicks</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shortLinks as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->link }}</td>
                                    <td><a onclick="clickLink({{$row}})" href="{{ route('shorten.link', $row) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                                    <td id="{{ 'clicks' . $row->id}}">{{ $row->clicks }}</td>
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

@push('layout_end_body')

<script>

function clickLink(link){
    let theURL='{{ route('click.link', 0)}}' + link.id;
    $.ajax({
            url: theURL,
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin' : '*',
            },
            data: {
                link: link
            }
        })
        .done(function(response) {
            $('#clicks'+ link.id).html(response.clicks);
        })
        .fail(function(jqXHR, response) {
            console.log('Fallido', response);
        });
}

</script>

@endpush