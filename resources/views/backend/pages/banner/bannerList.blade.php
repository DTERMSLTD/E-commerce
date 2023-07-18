@extends('backend.master')

@section('content')

<br><a class="btn btn-success float-end ml-2" href="{{ route('banner.form') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Banner</a>
 <br><h4 class="text-success text-center">Banner List</h4><br>



<table class="table">
    <thead>
      <tr>
        <th scope="col">serial</th>
        <th scope="col">Image</th>
        <th scope="col">Tittle</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    {{-- <tbody>
        @php
            $serial =1;
        @endphp

        @foreach ($banners as $item)
      <tr>


        <th scope="row">{{ $serial++}}</th>
        <td>{{ $item->name}}</td>
        <td>{{ $item->type}}</td>
        <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>

        <td>
            <a href="" class="btn btn-success"> <i class="fas fa-edit"></i></a>
            <a href="" class="btn btn-danger" onclick="return confirm('Do you want to delete ?')">  <i class="fas fa-trash"></i></a>
        </td>

      </tr>
      @endforeach

    </tbody> --}}
  </table>




@endsection
