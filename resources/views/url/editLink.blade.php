@extends('layouts.main')

@section('content')
<h1>Edit Your Link Here!</h1>

<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Link</th>
            <th>Short Link</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $link->id }}</td>
            <td>{{ $link->link }}</td>
            <td>{{ $link->code }}</td>
        </tr>
    </tbody>
</table>
<br>
<br>
<form action="{{ route('links.update', ['link' => $link]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-row align-items-center">
        <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Add new Link</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Link</div>
              </div>
              <input type="url" class="form-control" id="inlineFormInputGroup" name="link" placeholder="Enter New Link">
            </div>
        </div>
        <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Add New Code</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Code</div>
              </div>
              <input type="text" class="form-control" id="inlineFormInputGroup" name="code" placeholder="Enter New Code">
            </div>
        </div>
        <div class="col-auto">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-2" value="Store">Submit</button>
        </div>
      </div>
</form>
@endsection
