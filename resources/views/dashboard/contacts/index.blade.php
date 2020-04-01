@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')

    <div class="app-title">
        <div>
          <h1><i class="fa fa-home"></i> {{ $title }}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">
              <i class="fa fa-home fa-lg"></i>
          </a></li>
          <li class="breadcrumb-item"><a href="{{ URL::current() }}"> {{ $title }}</a></li>
        </ul>
    </div>

    <!-- Table Section -->

    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">{{ $title }}</h3>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  @forelse( $contacts as $contact )
                  <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>
                      <a href="#" class="text-center">
                        <i class="fa fa-eye fa-2x"></i>
                      </a>

                      <a href="#" class="text-center text-warning mx-2">
                        <i class="fa fa-reply fa-2x"></i>
                      </a>

                      <a href="#" class="text-center text-danger">
                        <i class="fa fa-trash fa-2x"></i>
                      </a>
                    </td>
                  </tr>
                  @empty

                  <p>No Contacts For Now</p>

                  @endforelse
                  
                </tbody>
                {{ $contacts->links() }}
              </table>
            </div>
          </div>
        </div>
      </div>



@endsection