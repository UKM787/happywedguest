@extends('layouts.admin')

@section('content')
<p><a href="{{route('adminwelcome')}}" class="btn wed-btn-main">back</a></p>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Wedding Venues</h2>
        </div>
        <div class="pull-right">
            <a class="btn wed-btn-main" href="{{ route('adminvenues.create') }}"> <i class="material-icons" title="Add new Venue">add</i></a>
        </div>
    </div>
</div>

<div class="row g-3 my-2">
    <div class="col-md-6">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$venues->count()}}</h3>
                <p class="fs-5">Venues</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{$locations->count()}}</h3>
                <p class="fs-5">Cites</p>
            </div>
            <i class="fa fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
        </div>
    </div>

</div>

<div class="row my-5">
    <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">address</th>
                    <th scope="col">City</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Published</th>
                    <th scope="col">Map</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($venues as $venue)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $venue->name }}</td>
                    <td>{{ $venue->description }}</td>
                    <td>{{ $venue->address}}</td>
                    <td>{{ $venue->location ? $venue->location->name : 'N/A' }}</td>
                    <td>{{ $venue->priority}}</td>
                    <td> {{ $venue->longitude}}</td>
                    <td> {{ $venue->latitude}}</td>
                    <td>{{ $venue->status ? 'Active' : 'Inactive'}}</td>
                    <td><a href="{{ $venue->map}}"><i class="material-icons">place</i></a></td>
                    <td><img src="{{asset('assets/venues\/').$venue->imageOne}}" alt="venueImage" style="width:75px; height:50px; border-radius:20%"></td>
                    <td>


                        <a class="badge text-success" href="{{ route('adminvenues.show',$venue) }}"><span class="material-icons">visibility</span></a>

                        <a class="badge text-primary" href="{{ route('adminvenues.edit',$venue) }}"><span class="material-icons">edit</span></a>
                        <form action="{{ route('adminvenues.destroy',$venue) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="badge text-danger btn-xs"><span class="material-icons">delete</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $venues->links() !!}
        </div>
    </div>
</div>


@endsection